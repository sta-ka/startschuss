<?php namespace App\Http\Requests\Article;

use App\Http\Requests\Request;
use App\Http\Requests\HandleImage;

class UpdateDataRequest extends Request {

    use HandleImage;

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
			'slug' 				=> 'required|alpha_dash|unique:articles,slug,'. $article_id,
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
     * @param int       $article_id
     *
     * @return bool|int
     */
    public function persist($articleRepo, $article_id)
    {
        $article = $articleRepo->findById($article_id);

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

        return $article->update($data);
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
