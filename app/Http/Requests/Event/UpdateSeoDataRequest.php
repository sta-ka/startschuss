<?php namespace App\Http\Requests\Event;

use App\Http\Requests\Request;

class UpdateSeoDataRequest extends Request {

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
			'slug'			   => 'required|alpha_dash|min:3',
			'meta_description' => 'max:160'
		];
	}

    /**
     * Persist data.
     *
     * @param object    $eventRepo
     * @param int       $event_id
     *
     * @return bool|int
     */
    public function persist($eventRepo, $event_id)
    {
        $event = $eventRepo->findById($event_id);

        $data = [
            'slug'				=> $this->request->get('slug'),
            'meta_description'	=> $this->request->get('meta_description'),
            'keywords'			=> $this->request->get('keywords')
        ];

        return $event->update($data);
    }


}
