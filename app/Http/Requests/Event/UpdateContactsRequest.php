<?php namespace App\Http\Requests\Event;

use App\Http\Requests\Request;

class UpdateContactsRequest extends Request {

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
			'website'  => 'url',
			'facebook' => 'url',
			'twitter'  => 'url'
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
            'website' 	=> $this->request->get('website'),
            'facebook' 	=> $this->request->get('facebook'),
            'twitter' 	=> $this->request->get('twitter')
        ];

        return $event->update($data);
    }
}
