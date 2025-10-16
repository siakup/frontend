<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Log;

use App\Traits\ApiResponse;
use App\Endpoint\UserService;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;

class UserController extends Controller
{
    use ApiResponse;

    public function index(Request $request)
    {
      $search = $request->input('search');
      $sort = $request->input('sort', 'nama,asc');
      $page = $request->input('page', 1);
      $limit = $request->input('limit', 10);

      $params = [
          'search' => $search,
          'page' => $page,
          'sort' => $sort,
          'limit' => $limit,
      ];
      
      $url = UserService::getInstance()->getListAllUsers();
      $response = getCurl($url, $params, getHeaders());
      $data = json_decode(json_encode($response), true);

      if ($request->ajax()) {
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
      $url = UserService::getInstance()->getUserDetail($nomor_induk);
      $response = getCurl($url, null, getHeaders());
      if ($request->ajax()) {
          return view('users._modal-view', get_defined_vars())->render();
      }
      return view('users.view', get_defined_vars());
    }

    public function create(Request $request)
    {
      $url = UserService::getInstance()->getListAllRoles();
      $roles = getCurl($url, null, getHeaders());
      if (!$roles || !isset($roles->data) || empty($roles->data)) {
          abort(500, 'Roles not found or response invalid.');
      }
      return view('users.create', get_defined_vars());
    }

    public function store(StoreUserRequest $request)
    {
      $userData = array_merge($request->all(), ['type' => 'staff']);
      logger()->info('User store debug', $userData);

      $url = UserService::getInstance()->store();
      $response = postCurl($url, $userData, getHeaders());

      if ($request->ajax()) {
        if ($response && isset($response->success) && $response->success) {
          return response()->json([
            'success' => true,
            'message' => 'User berhasil disimpan',
            'data' => $response->data ?? null,
            'redirect_uri' => route('users.index')
          ]);
        } else {
          return response()->json([
            'success' => false,
            'message' => $response->message ?? 'Gagal menyimpan user',
            'data' => null
          ], 422);
        }
      } else {
        return redirect()->route('users.index');
      }
    }

    public function update(UpdateUserRequest $request, $id)
    {
      $userData = array_merge($request->all(), [
        'status' => 
          ($request->input('status') == 'active' || $request->input('status') == "true") 
            ? 'active' 
            : 'inactive'
      ]);

      logger()->info( 'User update debug', $userData);

      $url = UserService::getInstance()->update($id);
      $response = putCurl($url, $userData, header: getHeaders());
      if ($request->ajax()) {
        if ($response && isset($response->success) && $response->success) {
          return response()->json([
            'success' => true,
            'message' => 'Berhasil disimpan',
            'data' => $response->data ?? null,
            'redirect_uri' => route('users.index')
          ]);
        } else {
          return response()->json([
            'success' => false,
            'message' => $response->message ?? 'Gagal menyimpan',
            'data' => null
          ], 422);
        }
      } else {
        return redirect()->route('users.index');
      }
    }

    public function edit($nomor_induk)
    {
        $url = UserService::getInstance()->getUserDetail($nomor_induk);
        $response = getCurl($url, null, getHeaders());
        $urlRoles = UserService::getInstance()->getListAllRoles();
        $roles = getCurl($urlRoles, null, getHeaders());
        if (!$roles || !isset($roles->data) || empty($roles->data)) {
          abort(500, 'Roles not found or response invalid.');
        }
        return view('users.edit', get_defined_vars());
    }

    public function updateStatus(Request $request, $id)
    {
        $status = ['status' => $request->input('status')];
        $url = UserService::getInstance()->updateStatus($id);
        $response = putCurl($url, $status, header: getHeaders());
        if (isset($response->success) && $response->success) {
            return response()->json([
              'success' => true,
              'message' => 'Status berhasil diperbarui',
              'data' => $response->data ?? null
            ]);
        } else {
            return response()->json([
              'success' => false,
              'message' => $response->message ?? 'Gagal memperbarui status',
              'data' => null
            ], 422);
        }
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

    public function resetPassword(Request $request)
    {
        $nomor_induk = $request->input('nomor_induk');
        $url = UserService::getInstance()->getUserDetail($nomor_induk);
        $response = getCurl($url, null, getHeaders());
        if ($request->ajax()) {
            return view('users._modal-resetpass', get_defined_vars())->render();
        }
    }

    public function updatePassword($id)
    {
        $url = UserService::getInstance()->updatePassword($id);
        Log::info('Reset password URL', ['url' => $url]);
        Log::info('Headers', getHeaders());
        Log::info('Data yang dikirim', []);
        
        $response = postCurl($url, [], header: getHeaders());

        Log::info('Response dari postCurl', (array) $response);
        
        if (isset($response->success) && $response->success) {
            return response()->json([
                'success' => true,
                'message' => $response->message,
                'data' => $response->data ?? null
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => $response->message ?? 'Gagal reset password',
                'data' => null
            ], 422);
        }
    }
}