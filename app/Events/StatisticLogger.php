<?php namespace App\Events;

use App\Models\Misc\Statistic\DbStatisticRepository as Statistic;

class StatisticLogger {

    /**
     * @var Statistic
     */
    private $statisticRepo;

    /**
     * Constructor: inject dependencies.
     *
     * @param Statistic $statisticRepo
     */
    public function __construct(Statistic $statisticRepo)
    {
        $this->statisticRepo = $statisticRepo;
    }

    /**
     * Write message to logs table.
     *
     * @param string $type
     * @param string $info
     */
    public function handle($type, $info)
    {
        if (\Input::has('page')) {
            return;
        }

        $data = [
            'ip_address' => $_SERVER['REMOTE_ADDR'],
            'type'	     => $type,
            'info'	     => $info,
        ];

        $this->statisticRepo->create($data);
    }

}