<?php

namespace App\Endpoint;

class CplService
{
    private static $instance = null;

    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new self;
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
        return config('endpoint.lecture.url').'/api/cpl';
    }

    public function cplUrl($id)
    {
        return $this->url().'/'.$id;
    }

    public function bulkStore()
    {
        return $this->url().'/bulk-store';
    }
}
