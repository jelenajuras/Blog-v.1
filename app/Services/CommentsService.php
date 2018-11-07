<?php

namespace App\Services;

use Illuminate\View\Factory;
use Sentinel;
use App\Models\Post;

class CommentsService
{
	protected $view;
	
	public function __construct(Factory $view)
	{
		$this->view =  $view;
	}
	
	public function pendingComments()
	{
		$posts = Post::where('user_id', Sentinel::getuser()->id)->get();
		
		$comments_num = 0;
		foreach ($posts as $post) {
			$comments_num += $post->pendingComments->count();
		
	}
	return $comments_num;
	}
}