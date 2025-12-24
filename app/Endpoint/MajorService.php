<?php

namespace App\Endpoint;

class MajorService
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
        return config('endpoint.users.url').'/api/institutions';
    }

    public function getList()
    {
        return $this->url().'/list';
    }
}
