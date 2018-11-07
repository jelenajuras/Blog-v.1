<?php

namespace App\Http\Controllers\Admin;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpdatePostRequest;
use Sentinel;
use App\Models\Category;
use App\Models\UserCategory;
use App\Models\Comment;

class PostController extends Controller
{
    /**
   * Set middleware to quard controller.
   *
   * @return void
   */
    public function __construct()
    {
        $this->middleware('sentinel.auth');
    }
	/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Sentinel::getUser();
		$userCategory = UserCategory::where('user_id',$user->id)->first();
		$categories = Category::get();
		$posts = Post::orderBy('created_at','DESC')->get();
		
		$demand_categories = '';
		$offer_categories= '';
		
		if($userCategory){
			if($userCategory->demand_category_id  != ''){
				$demand_categories = explode(',',$userCategory->demand_category_id);
			}
			if($userCategory->offer_category_id != ''){
				$offer_categories = explode(',',$userCategory->offer_category_id);
			}	
		}
		
		return view('admin.posts.index',['posts'=>$posts,'demand_categories'=>$demand_categories,'offer_categories'=>$offer_categories, 'categories'=>$categories,'user' => $user]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user_id = Sentinel::getUser()->id;
		$userCategory = UserCategory::where('user_id',$user_id)->first();
		$categories = Category::get();
		$demand_categories = '';
	
		if($userCategory){
			if($userCategory->demand_category_id){
				$demand_categories = explode(',',$userCategory->demand_category_id);
			}
		}
		
		$demands = array();
		foreach($demand_categories as $demand_category){
			array_push($demands,
				['category_id' => $demand_category,
				'naziv'		  => $categories->where('id',$demand_category)->first()->name]
			);
		}

		return view('admin.posts.create',['user_id'=>$user_id, 'demands' => $demands]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\PostRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {
        $user_id = Sentinel::getUser()->id;
		$input = $request->except(['_token']);
		
		$data = array(
			'user_id'  => $user_id,
			'title'    => trim($input['title']),
			'content'  => $input['content'],
			'category_id'  => $input['category_id']
		);
		
		$post = new Post();
		$post->savePost($data);
		
		$message = session()->flash('success', 'You have successfully addad a new post.');
		
		//return redirect()->back()->withFlashMessage($messange);
		return redirect()->route('admin.posts.index')->withFlashMessage($message);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);

		return view('admin.posts.show', ['post' => $post]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);

		return view('admin.posts.edit', ['post' => $post]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostRequest $request, $id)
    {
		$post = Post::find($id);
		$input = $request->except(['_token']);
		dd($post);
		
		$data = array(
			'user_id'  => $post->user_id,
			'title'    => trim($input['title']),
			'content'  => $input['content'],
			'category_id'  => $input['category_id']
		);
		
		$post->updatePost($data);
		
		$message = session()->flash('success', 'You have successfully update a post with ID'.$id.'.');
		
		return redirect()->route('admin.posts.index')->withFlashMessage($message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);
		$post->delete();
		
		$message = session()->flash('success', 'You have successfully delete a post.');
		
		return redirect()->route('admin.posts.index')->withFlashMessage($message);
    }
}
