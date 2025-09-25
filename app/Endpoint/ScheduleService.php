<?php

namespace App\Endpoint;

class ScheduleService
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
        return config('endpoint.lecture.url') . '/api/schedule-preparation';
    }

    

    private function urlLecture()
    {
      return config('endpoint.lecture.url') . '/api/lecture-preparation';
    }

    public function getCourseList($periode)
    {
        return $this->url() . '/course/' . $periode;
    }

    public function getLectureList()
    {
        return $this->url() . '/dosen';
    }

    public function getRoomList()
    {
      return $this->urlLecture() . '/rooms';
    }

    public function createSchedule()
    {
      return $this->url() . '/';
    }
}
