<?php

namespace App\Http\Controllers\Admin;

use Mail;
use Sentinel;
use App\Http\Requests;
use Centaur\AuthManager;
use Illuminate\Http\Request;
use Cartalyst\Sentinel\Users\IlluminateUserRepository;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\UserCategory;

class UserController extends Controller
{
    /** @var Cartalyst\Sentinel\Users\IlluminateUserRepository */
    protected $userRepository;

    /** @var Centaur\AuthManager */
    protected $authManager;

    public function __construct(AuthManager $authManager)
    {
        // Middleware
        $this->middleware('sentinel.auth');
        $this->middleware('sentinel.access:users.create', ['only' => ['create', 'store']]);
        $this->middleware('sentinel.access:users.view', ['only' => ['index', 'show']]);
        $this->middleware('sentinel.access:users.update', ['only' => ['edit', 'update']]);
        $this->middleware('sentinel.access:users.destroy', ['only' => ['destroy']]);

        // Dependency Injection
        $this->userRepository = app()->make('sentinel.users');
        $this->authManager = $authManager;
    }

    /**
     * Display a listing of the users.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = $this->userRepository->createModel()->with('roles')->paginate(15);

        return view('admin.users.index', ['users' => $users]);
    }

    /**
     * Show the form for creating a new user.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = app()->make('sentinel.roles')->createModel()->all();
		$categories = Category::get();
		
        return view('admin.users.create', ['roles' => $roles],['categories'=> $categories]);
    }

    /**
     * Store a newly created user in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
		// Validate the form data
        $result = $this->validate($request, [
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
        ]);

        // Assemble registration credentials and attributes
        $credentials = [
            'email' => trim($request->get('email')),
            'password' => $request->get('password'),
            'first_name' => $request->get('first_name', null),
            'last_name' => $request->get('last_name', null),
			'company'  		=> $request->get('company', null),
			'address'  		=> $request->get('address', null),
			'city'  		=> $request->get('city', null),
			'telefon'  		=> $request->get('telefon', null),
			'status'  		=> $request->get('status', null)	
        ];
        $result = $this->authManager->register($data, $activation=true);

        if ($result->isFailure()) {
            return $result->dispatch;
        }

        // Do we need to send an activation email?
        if (!$activate) {
            $code = $result->activation->getCode();
            $email = $result->user->email;
            Mail::queue(
                'email.welcome',
                ['code' => $code, 'email' => $email],
                function ($message) use ($email) {
                    $message->to($email)
                        ->subject('Your account has been created');
                }
            );
        }

        // Assign User Roles
        foreach ($request->get('roles', []) as $slug => $id) {
            $role = Sentinel::findRoleBySlug($slug);
            if ($role) {
                $role->users()->attach($result->user);
            }
        }
		// snimi kategorije usera 
		
		// snimi kategorije ponude i potražnje
		$potraznja ='';
		foreach($request->get('demand_category_id', []) as $key => $demand){
			if($potraznja == ''){
				$potraznja = $demand;
			}else {
				$potraznja .= ',' . $demand;
			}
		}
		
		$ponuda ='';
		foreach($request->get('offer_category_id', []) as $key => $offer){
			if($ponuda == ''){
				$ponuda = $offer;
			}else {
				$ponuda .= ',' . $offer;
			}
		}
		
		$data = array(
			'user_id'  => $result->user->id,
			'demand_category_id'    => $potraznja,
			'offer_category_id'  	=> $ponuda
		);
		
		$category = new UserCategory();
		$category->saveUserCategory($data);

        $result->setMessage("User {$request->get('email')} has been created.");
        return $result->dispatch(route('users.index'));
    }

    /**
     * Display the specified user.
     *
     * @param  string  $hash
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // The user detail page has not been included for the sake of brevity.
        // Change this to point to the appropriate view for your project.
        return redirect()->route('users.index');
    }

    /**
     * Show the form for editing the specified user.
     *
     * @param  string  $hash
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // Fetch the user object
        // $id = $this->decode($hash);
        $user = $this->userRepository->findById($id);

        // Fetch the available roles
        $roles = app()->make('sentinel.roles')->createModel()->all();
		$categories = Category::get();
		$userCategory = UserCategory::where('user_id',$user->id)->first();
		
		$demand_category = '';
		$offer_category = '';
		
		if($userCategory){
			if($userCategory->demand_category_id){
				$demand_category = explode(',',$userCategory->demand_category_id);
			}
			if($userCategory->offer_category_id){
				$offer_category = explode(',',$userCategory->offer_category_id);
			}	
		}
		
        if ($user) {
            return view('admin.users.edit', [
                'user' => $user,
                'roles' => $roles,
				'demand_category'=> $demand_category,
				'offer_category'=> $offer_category,
				'categories' => $categories
            ]);
        }
		
        session()->flash('error', 'Invalid user.');
        return redirect()->back();
    }

    /**
     * Update the specified user in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $hash
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
		// Decode the user id
        // $id = $this->decode($hash);

        // Validate the form data
        $result = $this->validate($request, [
            'email' => 'required|email|max:255|unique:users,email,'.$id
        ]);
		if($request->get('password')){
			$result = $this->validate($request, [
				'password' => 'confirmed|min:6'
			]);
		}

        // Assemble the updated attributes
        $attributes = [
            'email' => trim($request->get('email')),
            'first_name' => $request->get('first_name', null),
            'last_name' => $request->get('last_name', null),
			'company'  		=> $request->get('company', null),
			'address'  		=> $request->get('address', null),
			'city'  		=> $request->get('city', null),
			'telefon'  		=> $request->get('telefon', null),
			'status'  		=> $request->get('status', null)	
        ];
		
        // Do we need to update the password as well?
        if ($request->get('password') != null) {
            $attributes['password'] = $request->get('password');
        }

        // Fetch the user object
        $user = $this->userRepository->findById($id);
        if (!$user) {
            if ($request->ajax()) {
                return response()->json("Invalid user.", 422);
            }
            session()->flash('error', 'Invalid user.');
            return redirect()->back()->withInput();
        }

        // Update the user
        $user = $this->userRepository->update($user, $attributes);

        // Update role assignments
        $roleIds = array_values($request->get('roles', []));
        $user->roles()->sync($roleIds);
		
		// snimi kategorije ponude i potražnje
		$potraznja ='';
		foreach($request->get('demand_category_id', []) as $key => $demand){
			if($potraznja == ''){
				$potraznja = $demand;
			}else {
				$potraznja .= ',' . $demand;
			}
		}

		$ponuda ='';
		foreach($request->get('offer_category_id', []) as $key => $offer){
			if($ponuda == ''){
				$ponuda = $offer;
			}else {
				$ponuda .= ',' . $offer;
			}
		}

		$data = array(
			'user_id'  =>$user->id ,
			'demand_category_id'    => $potraznja,
			'offer_category_id'  	=> $ponuda
		);

		$userCategory = UserCategory::where('user_id',$user->id)->first();
		if($userCategory){
			$userCategory->updateUserCategory($data);
		} else {
			$userCategory = new UserCategory();
			$userCategory->saveUserCategory($data);
		}

        // All done
        if ($request->ajax()) {
            return response()->json(['user' => $user], 200);
        }

        session()->flash('success', "{$user->email} has been updated.");
        return redirect()->route('users.index');
    }

    /**
     * Remove the specified user from storage.
     *
     * @param  string  $hash
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        // Fetch the user object
        //$id = $this->decode($hash);
        $user = $this->userRepository->findById($id);

        // Check to be sure user cannot delete himself
        if (Sentinel::getUser()->id == $user->id) {
            $message = "You cannot remove yourself!";

            if ($request->ajax()) {
                return response()->json($message, 422);
            }
            session()->flash('error', $message);
            return redirect()->route('users.index');
        }


        // Remove the user
        $user->delete();

        // All done
        $message = "{$user->email} has been removed.";
        if ($request->ajax()) {
            return response()->json([$message], 200);
        }

        session()->flash('success', $message);
        return redirect()->route('users.index');
    }

    /**
     * Decode a hashid
     * @param  string $hash
     * @return integer|null
     */
    // protected function decode($hash)
    // {
    //     $decoded = $this->hashids->decode($hash);

    //     if (!empty($decoded)) {
    //         return $decoded[0];
    //     } else {
    //         return null;
    //     }
    // }
}
