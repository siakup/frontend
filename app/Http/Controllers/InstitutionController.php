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
      try {
        $role = $request->input('role');
        $params = compact('role');
        $url = UserService::getInstance()->getListInstitutionByRoles($role);
        $response = getCurl($url, $params, getHeaders());
        
        if (!isset($response->data) || !isset($response->success) || !$response->success || !$response) {
          throw new \Exception(json_encode($response));
        }

        if(!$request->ajax()) {
          throw new \Exception(json_encode([
            'message' => 'Request tidak valid',
            'success' => false
          ]));
        }
        
        return $this->successResponse($response->data, 'Institusi berhasil diambil');
      } catch (\Throwable $err) {
        $decoded = json_decode($err->getMessage());
        Log::error('Gagal memuat data institusi berdasarkan role', [
          'url' => $url ?? null,
          'request_data' => $request->all(),
          'response' => $decoded
        ]);

        return $this->errorResponse($decoded->message ?? 'Institusi tidak ditemukan');
      }
    }
}