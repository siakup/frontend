<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;

use App\Traits\ApiResponse;
use App\Endpoint\UserService;

class UserController extends Controller
{
    use ApiResponse;

    public function index(Request $request)
    {
        $search = $request->input('search');

        $params = [];
        if ($search) {
            $params['search'] = $search;
        }
        
        $url = UserService::getInstance()->getListAllUsers();
        $response = getCurl($url, $params, getHeaders());
        $data = json_decode(json_encode($response), true);

        if ($request->ajax()) {
            // Tambahan pengecekan jika response tidak valid
            if (!isset($response->data)) {
                return $this->errorResponse($response->message);
            }
            
            return $this->successResponse($response->data ?? [], 'Berhasil mendapatkan data');
        }
        
        return view('users.index', get_defined_vars());
    }

    public function getUser($username)
    {
        $url = UserService::getInstance()->getUserByUsername($username);
        $response = getCurl($url, null, getHeaders());

        return view('users.view', get_defined_vars());
    }

    public function detail(Request $request)
    {
        $nomor_induk = $request->input('nomor_induk');

        $params = [];
        if ($nomor_induk) {
            $params['search'] = $nomor_induk;
        }

        $url = UserService::getInstance()->getUserDetail($nomor_induk);
        $response = getCurl($url, $params, getHeaders());
    }

    public function create(Request $request)
    {
        $url = UserService::getInstance()->getListAllRoles();
        $roles = getCurl($url, null, getHeaders());
        return view('users.create', get_defined_vars());
    }

    public function store(Request $request)
    {
        return redirect()->route('users.index');
    }

    public function edit($username)
    {
        $url = UserService::getInstance()->getUserByUsername($username);
        $response = getCurl($url, null, getHeaders());
        return view('users.edit', get_defined_vars());
    }

    public function update(Request $request, $username)
    {
        return redirect()->back();
    }

    public function getInstitutionsByRole(Request $request)
    {
        $role = $request->input('role');
        $url = UserService::getInstance()->getListInstitutionByRoles($role);
        $response = getCurl($url, null, getHeaders());

        if (!isset($response->data)) {
            return $this->errorResponse($response->message ?? 'Institusi tidak ditemukan');
        }
        return $this->successResponse($response->data, 'Institusi berhasil diambil');
    }

    public function searchByNip(Request $request)
    {
        $search = $request->input('search');

        $params = [];
        if ($search) {
            $params['search'] = $search;
        }

        $url = UserService::getInstance()->searchStaff();
        $response = getCurl($url, $params, getHeaders());
        $data = json_decode(json_encode($response), true);
        if ($request->ajax()) {
            if (!isset($response->data)) {
                return $this->errorResponse($response->message);
            }
            
            return $this->successResponse($response->data ?? [], 'Berhasil mendapatkan data');
        }
        else{
            if (!isset($response->data)) {
                return $this->errorResponse($response->message);
            }
            
            return $this->successResponse($response->data , 'Berhasil mendapatkan data');
        }
    }

    public function generateUsername(Request $request)
    {
        $params['name'] = $request->name;
        $params['type'] = 'staff';
        $url = UserService::getInstance()->generateUsername();
        $response = getCurl($url, $params, getHeaders());
        $data = json_decode(json_encode($response), true);
        if ($request->ajax()) {
            if (!isset($response->data)) {
                return $this->errorResponse($response->message);
            }
            
            return $this->successResponse($response->data ?? [], 'Berhasil mendapatkan data');
        }
        else{
            if (!isset($response->data)) {
                return $this->errorResponse($response->message);
            }
            
            return $this->successResponse($response->data , 'Berhasil mendapatkan data');
        }
    }
}