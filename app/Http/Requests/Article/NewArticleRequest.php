<?php namespace App\Http\Requests\Article;

use App\Http\Requests\Request;

class NewArticleRequest extends Request {

    // the input keys that should not be flashed on redirect
    protected $dontFlash = ['image'];
	
	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
			'title'				=> 'required',
			'slug' 				=> 'required|alpha_dash|unique:articles,slug',
			'body'		 		=> 'required',
			'image'				=> 'image|max:1000',
			'meta_description'	=> 'max:160',
			'keywords' 			=> 'max:160'
		];
	}

}
