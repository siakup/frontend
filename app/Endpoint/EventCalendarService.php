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
        return config('endpoint.academics.url') . '/api';
    }

    public function getListStudyProgram()
    {
      return config('endpoint.users.url') . '/api/institutions/list-by-user';
    }

    public function getListUniversityProgram()
    {
      return config('endpoint.users.url') . '/api/programs/list-by-user';
    }

    public function getListAllPeriode()
    {
        return $this->url() . '/period/';
    }

    public function eventUrl()
    {
        return $this->url() . '/calendars';
    }

    public function store()
    {
        return $this->url() . '/calendars';
    }

    public function bulkStore()
    {
        return $this->url() . '/bulk-store';
    }

    public function edit($id)
    {
      return $this->url() . '/calendars' . '/' . $id;
    }
}
