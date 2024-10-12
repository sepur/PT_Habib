<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

use GuzzleHttp\Client;


class Cek_login
{
 public function handle($request, Closure $next)
{
    $checkToken = Session::get('token');

    if ($checkToken) {
        $tokenInfo = $this->validateToken($checkToken);
        if ($tokenInfo['isValid']) {
            // Token valid, lanjutkan eksekusi request
            return $next($request);
        } else {
            // Token tidak valid, arahkan ke halaman login
            return redirect()->route('login')->with('error', $this->getErrorMsg($tokenInfo['status']));
        }
    }

    // Tidak ada token, arahkan ke halaman login
    return redirect()->route('login')->with('error', 'Token is not provided. Please log in.');
}

protected function getErrorMsg($status)
{
    switch ($status) {
        case 'expired':
            return 'Token has expired. Please log in again.';
        case 'invalid':
            return 'Token is invalid. Please log in again.';
        case 'error':
            return 'Error while checking the token. Please log in again.';
        default:
            return 'Token is not valid. Please log in again.';
    }
}

protected function validateToken($token)
{
    try {
        $endpoint = api_url('checkToken');
        $client = new Client();
        $response = $client->request('GET', $endpoint, [
            'headers' => [
                'Authorization' => 'Bearer ' . $token,
            ],
        ]);

        $responseData = json_decode($response->getBody(), true);

        // Periksa status token dari respons
        $statusToken = $responseData['statusToken'];

        if ($statusToken === 'valid') {
            // Token valid
            return ['isValid' => true, 'status' => 'valid'];
        } elseif ($statusToken === 'expired') {
            // Token kadaluwarsa
            return ['isValid' => false, 'status' => 'expired'];
        } else {
            // Token invalid atau status lainnya
            return ['isValid' => false, 'status' => 'invalid'];
        }
    } catch (\Exception $e) {
        // Tangani kesalahan saat memeriksa token
        return ['isValid' => false, 'status' => 'error'];
    }
}
    // public function handle($request, Closure $next)
    // {
    //     $checkToken = Session::get('token');
    //     if ($checkToken) {
    //         return $next($request);
    //     }
    //     return redirect()->route('login');
    // }
}
