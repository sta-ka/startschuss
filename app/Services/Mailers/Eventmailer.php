<?php namespace App\Services\Mailers;

class EventMailer extends Mailer {

    /**
     * Prepare new event notification mail.
     *
     * @param $data
     *
     * @return $this
     */
	public function newEvent($data)
	{
        $this->subject  = 'Neue Messe gemeldet';
        $this->view     = 'emails.user.new_event';

		$this->data = [
			'contact'		=> $data['contact'],
			'email'			=> $data['email'],
			'name'			=> $data['name'],
			'location'		=> $data['location'],
			'start_date'	=> $data['start_date'],
			'end_date'		=> empty($data['end_date']) ? $data['start_date'] : $data['end_date'],
			'region'		=> $data['region'],
			'organizer'		=> $data['organizer']
		];

		return $this;
	}
}