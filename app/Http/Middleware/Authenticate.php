<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class Authenticate
{
    public function handle(Request $request, Closure $next)
    {
        $cookieName = 'central_access_token';
        $token = $_COOKIE[$cookieName] ?? null;

        $headers = [
            'x-app-id: '.config('central.client_app_id'),
            'Authorization: Bearer '.$token,
        ];

        // check auth user central
        $url = config('central.api_url').'/api/v1/client/session';
        $response = postCurl($url, null, $headers);

        if (
            $response &&
            ($response->success ?? false) &&
            isset($response->data) &&
            isset($response->data->cookie)
        ) {
            $cookie = $response->data->cookie;

            setcookie(
                $cookie->name,
                $cookie->value,
                [
                    'expires' => time() + ($cookie->expire ?? 0),
                    'path' => $cookie->path ?? '/',
                    'secure' => $cookie->secure ?? false,
                    'httponly' => $cookie->httpOnly ?? true,
                    'samesite' => $cookie->sameSite ?? 'Lax',
                ]
            );
        }

        // Jika response tidak sukses, redirect ke SSO
        if (! $response || ! isset($response->success) || $response->success !== true) {
            return Redirect::to(config('central.auth_url'));
        }

        // Set session user
        if (isset($response->data->user)) {
            session([
                'username' => $response->data->user->username ?? null,
                'nama' => $response->data->user->full_name ?? null,
            ]);
        }

        return $next($request);
    }
}
