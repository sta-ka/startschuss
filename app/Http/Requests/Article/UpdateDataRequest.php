<?php namespace App\Http\Requests\Article;

use App\Http\Requests\Request;

class UpdateDataRequest extends Request {


    /**
     * The input keys that should not be flashed on redirect.
     *
     * @var array
     */
    protected $dontFlash = ['image'];

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		$article_id = $this->route()->parameter('article_id');
		
		return [
			'title'				=> 'required',
			'slug' 				=> 'required|alpha_dash|unique:articles,slug,'.$article_id,
			'body'		 		=> 'required',
			'image'				=> 'image|max:1000',
			'meta_description'	=> 'max:160',
			'keywords' 			=> 'max:160'
		];
	}

}
