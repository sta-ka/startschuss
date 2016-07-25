<?php namespace App\Http\Requests\Article;

use App\Http\Requests\Request;
use App\Http\Requests\HandleImage;

class NewArticleRequest extends Request {

    use HandleImage;

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

    /**
     * Persist data.
     *
     * @param object    $articleRepo
     *
     * @return bool|int
     */
    public function persist($articleRepo)
    {
        $data = [
            'title'				=> $this->request->get('title'),
            'slug'				=> $this->request->get('slug'),
            'body'				=> \Purifier::clean($this->request->get('body')),
            'active'			=> $this->request->get('active', false),
            'featured'			=> $this->request->get('featured', false),
            'meta_description'	=> $this->request->get('meta_description'),
            'keywords'			=> $this->request->get('keywords')
        ];

        if (\Input::hasFile('image')) {
            $data['image'] = $this->processImage();
        }

        return $articleRepo->create($data);
    }

    /**
     * Process image.
     *
     * @return bool|int
     */
    protected function processImage()
    {
        $filename = $this->createFilename();

        $this->uploadImage(\Input::file('image'), 120, 120, 'uploads/images/small/' . $filename);

        \Input::file('image')->move('uploads/images/original/', $filename);

        return $filename;
    }

    /**
     * Create random filename.
     *
     * @return string
     */
    protected function createFilename()
    {
        $filename = \Str::random(20) . '.' . \File::extension(\Input::file('image')->getClientOriginalName());
        return \Str::lower($filename);
    }

}
