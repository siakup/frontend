<?php 

namespace App\Endpoint;

class EventAcademicService
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
        return config('endpoint.academics.url') . '/api/events';
    }

    public function getListAllEvents()
    {
      return $this->url() . '/';
    }

    public function eventUrl($id)
    {
      return $this->url() . '/' . $id;
    }
}

