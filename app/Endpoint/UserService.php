<?php 

namespace App\Endpoint;

class UserService
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
        return config('endpoint.users.url') . '/api/';
    }

    public function getListAllUsers()
    {
        return $this->url() . 'users/list';
    }

    public function getUserDetail($nomor_induk)
    {
        return $this->url() . 'users/detail/' . $nomor_induk;
    }

    public function getUserByUsername($username)
    {
        return $this->url() . 'users/show/' . $username;
    }

    public function searchUser($params)
    {
        return $this->url() . 'users/search/' . $params;
    }

    public function getListAllRoles()
    {
        return $this->url() . 'roles/list';
    }

    public function getListAllInstitution()
    {
        return $this->url() . 'institutions/list';
    }

    public function getListInstitutionByRoles($role)
    {
        return $this->url() . 'institutions/list-by-role/' . $role;
    }

    public function searchStaff($params)
    {
        return $this->url() . 'staff/search/';
    }
}

