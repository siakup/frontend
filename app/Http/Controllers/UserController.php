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
      try {
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
        if(!$response || !$response->success || !isset($response->success)) {
          throw New \Exception(json_encode($response));
        }
        $data = json_decode(json_encode($response), true);

        if ($request->ajax()) {
          return $this->successResponse($response->data ?? [], 'Berhasil mendapatkan data');
        }
        
        return view('users.index', get_defined_vars());
      } catch (\Throwable $err) {
        $decoded = json_decode($err->getMessage());

        Log::error('Gagal memuat halaman kelola pengguna', [
          'url' => $url ?? null,
          'request_data' => $request->all(),
          'response' => $decoded
        ]);

        if($request->ajax()) {
          return $this->errorResponse($response->message);
        }
        return redirect()->route('home')->withErrors(['error' => $decoded->message ?? 'Gagal memuat halaman kelola pengguna']);
      }
    }

    // public function getUser($username)
    // {
    //   $url = UserService::getInstance()->getUserByUsername($username);
    //   $response = getCurl($url, null, getHeaders());

    //   return view('users.view', get_defined_vars());
    // }

    public function detail(Request $request)
    {
      try {
        $nomor_induk = $request->input('nomor_induk');
        $url = UserService::getInstance()->getUserDetail($nomor_induk);
        $response = getCurl($url, null, getHeaders());
        if(!$response || !isset($response->success) || !$response->success) {
          throw new \Exception(json_encode($response));
        }
        if ($request->ajax()) {
            return view('users._modal-view', get_defined_vars())->render();
        }
        return view('users.view', get_defined_vars());
      } catch (\Throwable $err) {
        $decoded = json_decode($err->getMessage());
        Log::error('Gagal memuat data pengguna', [
          'url' => $url ?? null,
          'request_data' => $request->all(),
          'response' => $decoded
        ]);

        if($request->ajax()) {
          return $this->errorResponse($decoded->message ?? 'Gagal memuat data pengguna');
        }

        return redirect()->route('users.index')->withErrors(['error' => $decoded->message ?? 'Gagal memuat data pengguna']);
      }
    }

    public function create(Request $request)
    {
      try {
        $url = UserService::getInstance()->getListAllRoles();
        $roles = getCurl($url, null, getHeaders());
        if (!$roles || !isset($roles->data) || empty($roles->data) || !isset($roles->success) || !$roles->success) {
          throw New \Exception(json_encode($roles));
        }
        return view('users.create', get_defined_vars());
      } catch (\Throwable $err) {
        $decoded = json_decode($err->getMessage());
        Log::error('Gagal memuat halaman tambah pengguna', [
          'url' => $url ?? null,
          'request_data' => $request->all(),
          'response' => $decoded
        ]);
        return redirect()->route('users.index')->withErrors(['error' => $decoded->message ?? 'Gagal memuat halaman tambah pengguna! Tunggu sebentar lagi']);
      }
    }

    public function store(StoreUserRequest $request)
    {
      try {
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
            throw new \Exception(json_encode($response));
          }
        } else {
          throw new \Exception(json_encode([
            'message' => 'Request tidak valid',
            'success' => false
          ]));
        }
      } catch (\Throwable $err) {
        $decoded = json_decode($err->getMessage());

        Log::error('Gagal menyimpan user', [
          'url' => $url ?? null,
          'request_data' => $request->all(),
          'response' => $decoded
        ]);

        if($request->ajax()) {
          return response()->json([
            'success' => false,
            'message' => $decoded->message ?? 'Gagal menyimpan user',
            'data' => null
          ], 422);
        } else {
          return redirect()->route('users.index')->withErrors(['error' => $decoded->message ?? 'Gagal menyimpan user']);
        }
      }
    }

    public function update(UpdateUserRequest $request, $id)
    {
      try {
        $userData = array_merge($request->all(), [
          'status' => 
            ($request->input('status') == 'active' || $request->input('status') == "true") 
              ? 'active' 
              : 'inactive'
        ]);
  
        logger()->info( 'User update debug', $userData);
  
        $url = UserService::getInstance()->update($id);
        $response = putCurl($url, $userData, header: getHeaders());
        if(!$response || !isset($response->success) || !$response->success) {
          throw new \Exception(json_encode($response));
        }


        if ($request->ajax()) {
          if ($response && isset($response->success) && $response->success) {
            return response()->json([
              'success' => true,
              'message' => 'Berhasil disimpan',
              'data' => $response->data ?? null,
              'redirect_uri' => route('users.index')
            ]);
          }
        } else {
          return redirect()->route('users.index')->with('success', 'Berhasil mengubah data pengguna');
        }
      } catch (\Throwable $err) {
        $decoded = json_decode($err->getMessage());

        Log::error('Gagal mengubah data pengguna', [
          'url' => $url ?? null,
          'request_data' => $request->all(),
          'response' => $decoded
        ]);

        return response()->json([
          'success' => false,
          'message' => $decoded->message ?? 'Gagal menyimpan',
          'data' => null
        ], 422);
      }
    }

    public function edit($nomor_induk)
    {
      try {
        $url = UserService::getInstance()->getUserDetail($nomor_induk);
        $response = getCurl($url, null, getHeaders());
        if(!$response || !isset($response->success) || !$response->success) {
          throw new \Exception(json_encode([
            'url' => $url,
            'response' => $response
          ]));
        }

        $urlRoles = UserService::getInstance()->getListAllRoles();
        $roles = getCurl($urlRoles, null, getHeaders());
        if (!$roles || !isset($roles->data) || empty($roles->data) || !isset($roles->success) || !$roles->success) {
          throw new \Exception(json_encode([
            'url' => $urlRoles,
            'response' => $roles
          ]));
        }

        return view('users.edit', get_defined_vars());
      } catch (\Throwable $err) {
        $decoded = json_decode($err->getMessage());
        Log::error('Gagal memuat halaman edit pengguna', [
          'url' => $decoded->url ?? null,
          'request_data' => ['nomor_induk' => $nomor_induk],
          'response' => $decoded->response
        ]); 

        return redirect()->route('users.index')->withErrors(['error' => $decoded->response->message ?? 'Gagal memuat halaman edit pengguna! Tunggu beberapa saat lagi']);
      }
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

    public function searchByNip(Request $request)
    {
      try {
        $search = $request->input('search', '');

        $params = compact('search');
        $url = UserService::getInstance()->searchStaff();
        $response = getCurl($url, $params, getHeaders());

        if(!$response || !isset($response->success) || !$response->success) {
          throw new \Exception(json_encode($response));
        }

        if ($request->ajax()) {
          return $this->successResponse($response->data ?? [], 'Berhasil mendapatkan data');
        }

        throw new \Exception(json_encode([
          'message' => 'Request tidak valid',
          'success' => false,
        ]));

      } catch (\Throwable $err) {
        $decoded = json_decode($err->getMessage());
        Log::error('Gagal memuat data berdasarkan NIP', [
          'url' => $url ?? null,
          'request_data' => $request->all(),
          'response' => $decoded
        ]);

        if($request->ajax()) {
          return $this->errorResponse($decoded->message ?? 'Gagal memuat data berdasarkan NIP');
        }

        return redirect()->route('users.index')->withErrors(['error' => $decoded->message ?? 'Gagal memuat data berdasarkan NIP']);
      }
    }

    public function generateUsername(Request $request)
    {
      try {
        $params['name'] = $request->name;
        $params['type'] = 'staff';
        $url = UserService::getInstance()->generateUsername();
        $response = getCurl($url, $params, getHeaders());
        if(!$response || !isset($response->success) || !$response->success) {
          throw new \Exception(json_encode($response));
        }

        if ($request->ajax()) {
          return $this->successResponse($response->data ?? [], 'Berhasil mendapatkan data');
        }
        else{
          return redirect()->back()->with('data', $response->data);
        }
        
      } catch (\Throwable $err) {
        $decoded = json_decode($err->getMessage());

        Log::error('Gagal mendapatkan data berdasarkan nama pengguna', [
          'url' => $url ?? null,
          'request_data' => $request->all(),
          'response' => $decoded
        ]);

        if ($request->ajax()) {
          return $this->errorResponse($decoded->message ?? 'Gagal mendapatkan data berdasarkan nama pengguna');
        } else {
          return redirect()->back()->with('error', $decoded->message ?? 'Gagal mendapatkan data berdasarkan nama pengguna');
        }
            
      }
    }

    public function resetPassword(Request $request)
    {
      try {
        $nomor_induk = $request->input('nomor_induk');
        $url = UserService::getInstance()->getUserDetail($nomor_induk);
        $response = getCurl($url, null, getHeaders());
        if(!$response || !isset($response->success) || !$response->success) {
          throw new \Exception(json_encode($response));
        }
        if ($request->ajax()) {
            return view('users._modal-resetpass', get_defined_vars())->render();
        } 
        throw new \Exception(json_encode([
          'success' => false,
          'message' => "Request tidak valid"
        ]));
      } catch (\Throwable $err) {
        $decoded = json_decode($err->getMessage());
        Log::error('Gagal memuat reset password', [
          'url' => $url,
          'request_data' => $request->all(),
          'response' => $decoded
        ]);

        if($request->ajax()) {
          return $this->errorResponse($decoded->message ?? 'Gagal memuat modal reset password');
        }

        return redirect()->back()->withErrors(['error' => $decoded->message ?? 'Gagal memuat modal reset password']);
      }
    }

    public function updatePassword(Request $request, $id)
    {
      try {
        $url = UserService::getInstance()->updatePassword($id);
        Log::info('Reset password URL', ['url' => $url]);
        Log::info('Headers', getHeaders());
        Log::info('Data yang dikirim', []);
        
        $response = postCurl($url, [], header: getHeaders());

        Log::info('Response dari postCurl', (array) $response);
        
        if (isset($response->success) && $response->success) {
          if($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => $response->message,
                'data' => $response->data ?? null
            ]);
          } 
          return redirect()->route('users.index')->with('success', $response->message ?? 'Berhasil melakukan reset password akun pengguna');
        }

        throw new \Exception(json_encode($response));
      } catch (\Throwable $err) {
        $decoded = json_decode($err->getMessage());
        if($request->ajax()) {
          return response()->json([
            'success' => false,
            'message' => $decoded->message ?? 'Gagal reset password',
            'data' => null
          ], 422);
        }
        return redirect()->back()->with('error', $decoded->message ?? 'Gagal reset password');
      }
    }
}