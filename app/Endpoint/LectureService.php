<?php

namespace App\Endpoint;

class LectureService
{
    private static $instance = null;

    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    private function url()
    {
        return config('endpoint.lecture.url') . '/api/courses';
    }

    public function getMataKuliah()
    {
        return $this->url() . '/';
    }
    
}
