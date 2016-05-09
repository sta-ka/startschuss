<?php namespace App\Services\Notification;

class NotificationService {

    /**
     * Start and end wrapper.
     *
     * @var array
     */
    protected $wrapper = [
        'start' => '<div id="messages">',
        'end'   => '</div>'
    ];

    /**
     * Start and end delimiter.
     *
     * @var array
     */
    protected $message_delimiter = [
        'start' => '<p>',
        'end'   => '</p>'
    ];

	/**
	 * Helper Method for the set method.
     *
     * @param $message
	 */
	public function success($message)
	{
		$this->set($message, 'success');
	}

    /**
     * Helper Method for the set method.
     *
     * @param $message
     */
    public function error($message)
	{
		$this->set($message, 'danger');
	}

    /**
     * Set a message with a specific type.
     *
     * @param $message
     * @param $type
     */
    public function set($message, $type)
	{
		$message = [
			'type' 		=> $type,
			'message' 	=> $message
		];

		\Session::flash('message', $message);
    }

    /**
     * Display notification.
     *
     * @return string
     */
    public function display()
	{
		$message = \Session::get('message');

		if (count($message) == 0 || $message['type'] == '') {
            return false;
        }

        $output  = '<div class="alert-' . $message['type'] . '">';

        $text    = \Lang::get('notification.' . $message['message']);
        $output .= $this->wrap($text, $this->message_delimiter);

        $output .= '</div>';

        return $this->wrap($output, $this->wrapper);
	}

    /**
     * Wrap text with a delimiter.
     *
     * @param string    $text
     * @param array     $delimiter
     *
     * @return string
     */
    private function wrap($text, $delimiter)
    {
        return $delimiter['start'] . $text . $delimiter['end'] . "\r\n";
    }

}