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
        return config('endpoint.academics.url') . '/api/';
    }

    public function getListAllEvents()
    {
      return $this->url() . 'events/list';
    }

    public function getEventDetails()
    {
      return $this->url() . 'events/detail';
    }

    public function getListAllPeriode()
    {
      
      return $this->url() . 'periode/list';
    }
}

