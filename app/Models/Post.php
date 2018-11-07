<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Post extends Model
{
	use Sluggable;
    /**
	* The attributes thet are mass assignable
	*
	* @var array
	*/
	protected $fillable = ['user_id','title','slug','content','category_id'];
	
	/*
	* The Eloquent users model names
	* 
	* @var string
	*/
	protected static $usersModel = 'App\Models\Users'; /* putanja do modela user
	
	/*
	* The Eloquent comments model name
	* 
	* @var string
	*/
	protected static $commentsModel = 'App\Models\Comment'; 	
	
	/*
	* Returns the users relationship
	* 
	* @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	*/
	
	public function user()
	{
		return $this->belongsTo(static::$usersModel,'user_id');
	}
	
	/*
	* Returns the comments relationship
	* 
	* @return \Illuminate\Database\Eloquent\Relations\HasMany
	*/
	
	public function comments()
	{
		return $this->hasMany(static::$commentsModel,'post_id')->where('status',1)->orderBy('created_at','DESC')->paginate(10);
	}	
	
	public function pendingComments()
	{
		return $this->hasMany(static::$commentsModel,'post_id')->where('status',0);
	}	
	/*
	* Save Post
	* 
	* @param array $post
	* @return void
	*/
	
	public function savePost($post=array())
	{
		return $this->fill($post)->save();
	}
	
	/*
	* Update Post
	* 
	* @param array $post
	* @return void
	*/
	
	public function updatePost($post=array())
	{
		return $this->update($post);
	}	
	
	/**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
}
