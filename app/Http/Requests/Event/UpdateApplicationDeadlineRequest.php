<?php namespace App\Http\Requests\Event;

use App\Http\Requests\Request;

class UpdateApplicationDeadlineRequest extends Request {

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
			'application_deadline'  => 'min:10|max:50'
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
            'application_deadline' => $this->request->get('application_deadline')
        ];

        return $event->update($data);
    }
}
