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

    public function url()
    {
        return config('endpoint.calendar.url') . '/api/calendar';
    }

    public function getListAllPeriode()
    {
        return $this->url() . '/list';
    }

    public function eventUrl($idPeriode)
    {
        return $this->url() . '/event/' . $idPeriode;
    }

    public function bulkStore()
    {
        return $this->url() . '/bulk-store';
    }
}
