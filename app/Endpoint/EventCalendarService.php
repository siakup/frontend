<?php

namespace App\Endpoint;

class EventCalendarService
{
    private static $instance = null;

    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    /**
     * Constructs the base URL for accessing the calendar API.
     *
     * @return string The base URL for the calendar API.
     */

    public function baseEventURL()
    {
        return config('endpoint.calendar.url') . '/api/calendar';
    }

    public function getListAllPeriode()
    {
        return $this->baseEventURL() . '/list';
    }

    public function eventUrl($idPeriode)
    {
        return $this->baseEventURL() . '/event/' . $idPeriode;
    }

    public function getCalendarDetails()
    {
        return $this->baseEventURL() . 'events/detail';
    }

    public function bulkStore()
    {
        return $this->baseEventURL() . '/bulk-store';
    }
}
