<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Storage;

use App\Traits\ApiResponse;
use App\Endpoint\UserService;

use Exception;

class InstitutionController extends Controller
{
    use ApiResponse;

    public function index(Request $request)
    {
        $search = $request->input('search');

        $params = [];
        if ($search) {
            $params['search'] = $search;
        }
        
        $url = UserService::getInstance()->getListAllInstitution();
        $response = getCurl($url, $params, getHeaders());
        $data = json_decode(json_encode($response), true);
    }

    public function getInstitutionsByRole(Request $request)
    {
        $role = $request->input('role');

        $params = [];
        if ($role) {
            $params['role'] = $role;
        }

        $url = UserService::getInstance()->getListInstitutionByRoles($role);
        $response = getCurl($url, $params, getHeaders());
        
        if (!isset($response->data)) {
            return $this->errorResponse($response->message ?? 'Institusi tidak ditemukan');
        }
        return $this->successResponse($response->data, 'Institusi berhasil diambil');
    }
}