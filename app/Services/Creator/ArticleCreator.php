<?php namespace App\Services\Creator;

use App\Models\Misc\Article\ArticleRepository as Articles;

class ArticleCreator extends Creator {

	private $articleRepo;

    /**
     * @param Articles $articleRepo
     */
    public function __construct(Articles $articleRepo)
	{
		$this->articleRepo = $articleRepo;
	}

    /**
     * Perform create.
     *
     * @param array $input
     *
     * @return static
     */
    public function createArticle($input)
	{
		$data = [
			'title'				=> $input['title'],
			'slug'				=> $input['slug'],
			'body'				=> \Purifier::clean($input['body']),
			'active'			=> \Input::get('active', false),
			'featured'			=> \Input::get('featured', false),
			'meta_description'	=> $input['meta_description'],
			'keywords'			=> $input['keywords']
		];

		if (\Input::hasFile('image')) {
            $data['image'] = $this->processImage();
		}

		return $this->articleRepo->create($data);
	}

    /**
     * Perform update.
     *
     * @param array $input
     * @param int   $article_id
     *
     * @return bool|int
     */
    public function edit($input, $article_id)
	{
		$article = $this->articleRepo->findById($article_id);

		$data = [
			'title'				=> $input['title'],
			'slug'				=> $input['slug'],
			'body'				=> \Purifier::clean($input['body']),
			'active'			=> \Input::get('active', false),
			'featured'			=> \Input::get('featured', false),
			'meta_description'	=> $input['meta_description'],
			'keywords'			=> $input['keywords']
		];

		if (\Input::hasFile('image')) {
            $data['image'] = $this->processImage();
		}

		return $article->update($data);
	}

    /**
     * Perform update.
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