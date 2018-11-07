<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserCategory extends Model
{
    /**
	* The attributes thet are mass assignable
	*
	* @var array
	*/
	protected $fillable = ['user_id','demand_category_id','offer_category_id'];
	
	/*
	* The Eloquent users model names
	* 
	* @var string
	*/
	protected static $usersModel = 'App\Models\Users';

	/*
	* The Eloquent category model names
	* 
	* @var string
	*/
	protected static $categoryModel = 'App\Models\Category';
	
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
	* Returns the users relationship
	* 
	* @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	*/
	
	public function demand_category()
	{
		return $this->belongsTo(static::$categoryModel,'demand_category_id');
	}
	
	/*
	* Returns the users relationship
	* 
	* @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	*/
	
	public function offer_category()
	{
		return $this->belongsTo(static::$categoryModel,'offer_category_id');
	}
	
	/*
	* Save UserCategory
	* 
	* @param array $user_category
	* @return void
	*/
	
	public function saveUserCategory($user_category=array())
	{
		return $this->fill($user_category)->save();
	}
	
	/*
	* Update UserCategory
	* 
	* @param array $user_category
	* @return void
	*/
	
	public function updateUserCategory($user_category=array())
	{
		return $this->update($user_category);
	}	
	
}
