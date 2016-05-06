<?php namespace App\Events;

use App\Models\Misc\Log\DbInfoRepository as Info;

class EventLogger {

    /**
     * @var Info
     */
    private $infoRepo;

    /**
     * Constructor: inject dependencies.
     *
     * @param Info $infoRepo
     */
    public function __construct(Info $infoRepo)
    {
        $this->infoRepo = $infoRepo;
    }

    /**
     * Write message to logs table.
     *
     * @param string $message
     */
    public function handle($message)
    {
        $data = [
            'ip_address' => $_SERVER['REMOTE_ADDR'],
            'message'	 => $message,
        ];

        $this->infoRepo->create($data);
    }

}