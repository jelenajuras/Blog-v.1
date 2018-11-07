<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\UserCategory;
use App\Models\Post;
use App\Models\Comment;
use Sentinel;

class HomeController extends Controller
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
		
	    return view('user.home',['posts'=>$posts,'demand_categories'=>$demand_categories,'offer_categories'=>$offer_categories, 'categories'=>$categories,'user' => $user]);
    }
	
	
}
