<?php namespace App\Services\Mailers;

abstract class Mailer {

    /**
     * Email address from admin user.
     * @var string
     */
    protected $info_mail = 'info@startschuss-karriere.de';

    /**
     * Domain of website.
     * @var string
     */
    protected $domain = 'startschuss-karriere.de';

    /**
     * To name.
     * @var string
     */
    protected $to;

    /**
     * Mail address.
     * @var string
     */
	protected $email;

    /**
     * Subject of the mail.
     * @var string
     */
	protected $subject;

    /**
     * View for email.
     * @var string
     */
	protected $view;

    /**
     * Associated data.
     * @var array
     */
	protected $data = [];

    /**
     * Construct "to" and "email" property depending of given user.
     *
     * @param object|null $user
     */
    public function __construct($user = null)
	{
		if ($user) {
			$this->to    = $user->username;
            $this->email = $user->email;
        } else {
            $this->to    = $this->domain;
            $this->email = $this->info_mail;
        }
	}

    /**
     * Send mail and give feedback.
     *
     * @param bool $feedback
     *
     * @return bool
     */
    public function deliver($feedback = true)
	{
		try {
			$success = \Mail::send($this->view, $this->data, function($message) {
				$message->to($this->email, $this->to)
					    ->subject($this->subject);
			});

			if ($feedback) { // by default the deliver method sends a notification
				notify($success, 'mail_sent');
			}

			return $success;
		} catch (\Exception $e) {
			notify('error', 'mail_sent');

			return false;
		}

	}
}