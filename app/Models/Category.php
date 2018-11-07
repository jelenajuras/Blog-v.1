<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    /**
	* The attributes thet are mass assignable
	*
	* @var array
	*/
	protected $fillable = ['name','description'];
	
	/*
	* The Eloquent users model names
	* 
	* @var string
	*/
	protected static $usersModel = 'App\Models\Users'; /* putanja do modela user
	
	/*
	* Returns the users relationship
	* 
	* @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	*/
	
	public function user()
	{
		return $this->hasMany(static::$usersModel,'user_id');
	}

	/*
	* Save Category
	* 
	* @param array $category
	* @return void
	*/
	
	public function saveCategory($category=array())
	{
		return $this->fill($category)->save();
	}
	
	/*
	* Update Category
	* 
	* @param array $category
	* @return void
	*/
	
	public function updateCategory($category=array())
	{
		return $this->update($category);
	}	
}
