<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Sentinel;
use App\Models\Comment;
use App\Http\Requests\CommentRequest;

class IndexController extends Controller
{
  /**
   * Set middleware to quard controller.
   *
   * @return void
   */
    public function __construct()
    {
     //   $this->middleware('sentinel.guest'); 
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::orderBy('created_at', 'DESC')->get();
		
		return view('index')->with('posts', $posts);
    }
	
	public function show($slug)
	{
		$post = Post::where('slug',$slug)->first();
		return view('post.show')->with('post', $post);
	}
	
	public function storeComment(CommentRequest $request)
	{
		$user_id = Sentinel::getUser()->id;
		// $comments = Comment::where('post_id', $post->id)->get();  može i tako, nije dobra praksa, bolje preko relacije
		
		//$input = $request->except(['_token']); // bez tokena
		//$input = $request->all();
		//$input = $request->get('post_id');
		//dd($input);
		
		$data = array(
			'user_id'  => $user_id,                     // ili Sentinel::getUser()->id
			'post_id'  =>  $request->get('post_id'),    //$input['post_id'],
			'content'  =>  $request->get('content')     // )$input['content']
		);
		$comment = new Comment();
		$comment->saveComment($data);
		
		$message = session()->flash('success', 'You have successfully addad a new comment.');
		
		return redirect()->back()->withFlashMessage($message);
		//return redirect()->route('admin.posts.index')->withFlashMessage($message);
	}
}