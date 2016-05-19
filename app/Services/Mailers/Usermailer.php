<?php namespace App\Services\Mailers;

class UserMailer extends Mailer {

    /**
     * Prepare contact mail.
     *
     * @param $data
     *
     * @return $this
     */
	public function contact($data)
	{
		$this->subject  = 'Nachricht über das Kontaktformular';
		$this->view     = 'emails.user.contact';

		$this->data = [
			'name' 		=> $data['name'],
			'email' 	=> $data['email'],
			'body' 		=> $data['body']
		];

		return $this;
	}

    /**
     * Prepare reset password mail.
     *
     * @param $data
     *
     * @return $this
     */
	public function resetPasswordMail($data)
	{
		$this->subject  = 'Passwort zurücksetzen | '. $this->domain;
		$this->view     = 'emails.user.reset_password_mail';
		$this->data     = $data;

		return $this;
	}

    /**
     * Prepare mail to contact specific user.
     *
     * @param $data
     *
     * @return $this
     */
	public function contactUser($data)
	{
		$this->subject  = $this->domain . ' | Nachricht';
		$this->view     = 'emails.user.contact_user';

		$this->data = [
			'subject' 	=> $data['subject'],
			'body'		=> $data['body']
		];

		return $this;
	}

    /**
     * Prepare mail to send activation code to user.
     *
     * @param $data
     *
     * @return $this
     */
	public function sendActivationCode($data)
	{
		$this->subject  = 'Kontoaktivierung | ' . $this->domain;
		$this->view     = 'emails.user.send_activation_code';

		$this->data = $data;

		return $this;
	}
}