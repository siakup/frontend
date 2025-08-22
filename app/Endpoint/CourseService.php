<?php

namespace App\Endpoint;



class CourseService
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
        return config('endpoint.lecture.url') . '/api/courses';
    }
    public function courseUrl($id)
    {
        return $this->url() . '/' . $id;
    }

    public function bulkStore()
    {
        return $this->url() . '/bulk-store';
    }

    public function getMataKuliahPrasyarat()
    {
        return $this->url() . '/mata-kuliah-prasyarat';
    }
}
