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

    private function baseEventURL()
    {
        return config('endpoint.academics.url') . '/api/events';
    }

    public function getListAllEvents()
    {
      return $this->baseEventURL() . '/';
    }

    public function eventUrl($id)
    {
      return $this->baseEventURL() . '/' . $id;
    }

    
    public function getEventDetails()
    {
      return $this->baseEventURL() . 'events/detail';
    }
}

