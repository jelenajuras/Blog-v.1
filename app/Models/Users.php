<?php

namespace App\Models;

use Cartalyst\Sentinel\Users\EloquentUser;

class Users extends EloquentUser
{
	/*
	* The Eloquent post model names
	* 
	* @var string
	*/
	protected static $postsModel = 'App\Models\Post'; /* putanja do modela posts
	
	/*
	* The Eloquent comments model name
	* 
	* @var string
	*/
	protected static $commentsModel = 'App\Models\Comment'; /* putanja do modela comments
	
	/*
	* Returns the posts relationship
	* 
	* @return \Illuminate\Database\Eloquent\Relations\HasMany
	*/
	
	public function posts()
	{
		return $this->hasMany(static::$postsModel,'user_id');
	}
	
	/*
	* Returns the comments relationship
	* 
	* @return \Illuminate\Database\Eloquent\Relations\HasMany
	*/
	
	public function comments()
	{
		return $this->hasMany(static::$commentsModel,'user_id');
	}	
}
