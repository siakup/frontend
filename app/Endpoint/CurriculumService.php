<?php

namespace App\Endpoint;

class CurriculumService
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
        return config('endpoint.lecture.url') . '/api/curriculums';
    }

    public function listCurriculum()
    {
        return $this->url() . '/';
    }

    public function listCourseCurriculums($id)
    {
      return $this->url() . '/' . $id . '/courses' ;
    } 

    public function getCurriculum($id)
    {
      return $this->url() . '/' . $id;
    }

    public function courseUrl() 
    {
      return config('endpoint.lecture.url') . '/api/courses';
    }

    public function getJenisMataKuliah()
    {
      return $this->courseUrl() . '/category';
    }

    public function assignedCourse($id)
    {
      return $this->url() . '/' . $id . '/assigned';
    }

    public function unassignedCourse($id)
    {
      return $this->courseUrl() . '/' . $id . '/unassigned';
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
