<?php namespace App\Presenters;

trait DatePresenter {

    /**
     * Format 'created_at' attribute.
     *
     * @param $date
     *
     * @return string
     */
    public function getCreatedAtAttribute($date)
    {
        return $this->getDateFormated($date);
    }

    /**
     * Format date
     *
     * @param $date
     * @return string
     */
    private function getDateFormated($date)
    {
        return \Date::format($date, 'datetime');
    }

}