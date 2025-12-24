<?php

namespace App\Endpoint;

class LecturerService
{
    private static $instance = null;

    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new self;
        }

        return self::$instance;
    }

    private function url()
    {
        return config('endpoint.users.url').'/api/lecturers';
    }

    public function getLecturer()
    {
        return $this->url().'/';
    }
}
