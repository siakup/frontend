<?php 

namespace App\Endpoint;

class AcademicService
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

    private function basePeriodeURL()
    {
      return config('endpoint.academics.url') . '/api/periode';
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
    
    public function getListAllPeriode()
    {
      return $this->basePeriodeURL() . '/';
    }

    public function periodeUrl($id)
    {
      return $this->basePeriodeURL() . '/' . $id;
    }
}

