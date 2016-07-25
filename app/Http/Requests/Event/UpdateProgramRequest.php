<?php namespace App\Http\Requests\Event;

use App\Http\Requests\Request;

class UpdateProgramRequest extends Request {

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [

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
            'program' => \Purifier::clean($this->request->get('program'))
        ];

        return $event->update($data);
    }
}
