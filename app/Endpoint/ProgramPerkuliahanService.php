<?php

namespace App\Endpoint;

class ProgramPerkuliahanService
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
        return rtrim(config('endpoint.lecture.url'), '/').'/api/programs';
    }

    public function getPrograms()
    {
        return $this->url().'/';
    }

}
