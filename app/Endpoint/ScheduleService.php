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

  private function lectureUrl()
  {
    return config('endpoint.lecture.url') . '/api/lectures';
  }

  public function getCourseList($periode)
  {
    return $this->url() . '/course/' . $periode;
  }

  public function getLectureList()
  {
    return $this->url() . '/dosen';
  }

  public function getListLecture()
  {
    return $this->lectureUrl() . '/dosen';
  }

  public function getRoomList()
  {
    return $this->lectureUrl() . '/rooms';
  }

  public function getAvailableRooms()
  {
    return $this->lectureUrl() . '/getAvailableRooms';
  }

  public function getSchedule()
  {
    return $this->lectureUrl() . '/';
  }


  public function createSchedule()
  {
    return $this->url() . '/';
  }

  public function detailSchedule($id)
  {
    return $this->lectureUrl() . '/' . $id;
  }
}
