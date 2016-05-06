<?php namespace App\Models\Misc\Article;

class DbArticleRepository implements ArticleRepository {

	/**
	 * Create new article.
     *
     * @param  array  $data
     *
     * @return static
	 */
	public function create(array $data)
	{
		return Article::create($data);
	}

	/**
	 * Get all articles.
     *
     * @return \Illuminate\Database\Eloquent\Collection
	 */
	public function getAll()
	{
		return Article::all();
	}

	/**
	 * Get featured and active articles.
     *
     * @param $limit
     *
     * @return \Illuminate\Database\Eloquent\Collection
	 */
	public function getFeatured($limit)
	{
		return Article::active()
					->take($limit)
					->latest()
					->orderBy('featured', 'desc')
					->get();
	}

	/**
	 * Get other articles if slug is given get 3 other articles.
     *
     * @param string $slug
     *
     * @return \Illuminate\Database\Eloquent\Collection
	 */
	public function getOthers($slug = '')
	{
		if ($slug) {
			return Article::active()
				->where('slug', '!=', $slug)
				->take(3)
				->orderByRaw('RAND()')
				->get();
		}

		return Article::active()
						->skip(2)
						->take(20)
						->latest()
						->orderBy('featured', 'desc')
						->get();
	}

	/**
	 * Get article by slug.
     *
     * @param string $slug
     *
     * @return \Illuminate\Database\Eloquent\Collection
	 */
	public function findBySlug($slug)
	{
		return Article::where('slug', $slug)
					->active()
					->firstOrFail();
	}

	/**
	 * Get article by ID.
     *
     * @param int $id
     *
     * @return \Illuminate\Database\Eloquent\Collection
	 */
	public function findById($id)
	{
		return Article::findOrFail($id);
	}

	/**
	 * Get last modified article in database.
     *
     * @return \Illuminate\Database\Eloquent\Collection
	 */
	public function getLastModifiedArticle()
	{
		return Article::orderBy('updated_at', 'desc')
					->first();
	}
}