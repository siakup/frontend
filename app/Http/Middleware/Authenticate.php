<?php 
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Http;

class Authenticate
{
    public function handle(Request $request, Closure $next)
    {
        $token = @$_COOKIE['central_access_token'];
        $headers = [
            'Authorization: Bearer ' . $token,
        ];
        $url = config('endpoint.users.url') . '/api/me';
        $response = getCurl($url, null, $headers);

        // Jika response tidak sukses, return unauthorized
        if (!$response || !isset($response->success) || $response->success !== true) {
            return Redirect::to(config('central.auth_url'));
        }

        session(['username' => $response->data->username]);
        session(['nama' => $response->data->nama]);

        // Jika semua validasi berhasil, lanjutkan ke request berikutnya
        return $next($request);
    }
}