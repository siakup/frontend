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
        $cookieName = 'central_access_token';
        $token = @$_COOKIE[$cookieName];
        $headers = [
            'x-app-id: ' . config('central.client_app_id'),
            'Authorization: Bearer ' . $token,
        ];

        // check auth user central
        $url = config('central.api_url') . '/api/v1/client/session';
        $response = postCurl($url, null, $headers);

        if (
            $response 
            && $response->success ?? false
            && $response->data ?? false
            && $response->data->cookie ?? false
        ) {
            setcookie(
                $response->data->cookie->name,
                $response->data->cookie->value,
                [
                    'expires' => time() + $response->data->cookie->expire,
                    'path' => $response->data->cookie->path,
                    'secure' => $response->data->cookie->secure,
                    'httponly' => $response->data->cookie->httpOnly,
                    'samesite' => $response->data->cookie->sameSite
                ]
            );
        }

        // check auth user service
        // $url = config('endpoint.users.url') . '/api/me';
        // $response = getCurl($url, null, $headers);

        // Jika response tidak sukses, return unauthorized
        if (!$response || !isset($response->success) || $response->success !== true) {
            return Redirect::to(config('central.auth_url'));
        }

        session(['username' => $response->data->user->username]);
        session(['nama' => $response->data->user->full_name]);

        // Jika semua validasi berhasil, lanjutkan ke request berikutnya
        return $next($request);
    }
}