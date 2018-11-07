<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Cviebrock\EloquentSluggable\Sluggable;

class PostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
			'title'  =>'required',
			'content'=>'required',
			'category_id'=>'required'
        ];
    }
	
	/**
	 * Get the error messages for the defined validation rules.
	 *
	 * @return array
	 */
	public function messages()
	{
		return [
			'title.required' => 'Unos naslova poruke je obavenzan', //max.required
			'content.required'  => 'Unos poruke je obavenzan',
			'category_id.required'  => 'Unos osobe je obavenzan',
		];
	}
}
