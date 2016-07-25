<?php namespace App\Http\Requests\City;

use App\Http\Requests\Request;

class UpdateDataRequest extends Request {

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
			'name' 				=> 'required',
			'slug' 				=> 'required',
			'description' 		=> 'required',
			'meta_description'	=> 'max:160',
			'keywords' 			=> 'max:160'
		];
	}

    /**
     * Persist data.
     *
     * @param object    $cityRepo
     * @param int       $city_id
     *
     * @return bool|int
     */
    public function persist($cityRepo, $city_id)
    {
        $city = $cityRepo->findById($city_id);

        $data = [
            'name'				=> $this->request->get('name'),
            'slug'				=> $this->request->get('slug'),
            'description'		=> \Purifier::clean($this->request->get('description')),
            'meta_description'	=> $this->request->get('meta_description'),
            'keywords'			=> $this->request->get('keywords')
        ];

        return $city->update($data);

    }

}
