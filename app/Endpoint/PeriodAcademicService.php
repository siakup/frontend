<?php 

namespace App\Endpoint;

class PeriodAcademicService
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
    return rtrim(config('endpoint.academics.url'), '/') . '/api/period/';
    }

    public function store()
    {
      return $this->url();
    }

    public function getListAllPeriode()
    {
      
      return $this->url() . 'list';
    }
}

