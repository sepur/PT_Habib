<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Controller;
use Jenssegers\Agent\Facades\Agent;
use Illuminate\Support\Facades\Session;
use RealRashid\SweetAlert\Facades\Alert;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Client;

class Authcontroller extends Controller
{
    public function viewLogin() {
        return view('login.login');
    }
    public function login() {

        $attributes = request()->validate([
            'email'=>'required|email',
            'password'=>'required'
        ]);

        if(Auth::attempt($attributes))
        {
            session()->regenerate();
            return redirect('dashboard')->with(['Berhasil'=>'Selamat Datang']);
        }
        else{

            return back()->withErrors(['Error'=>'Email atau password salah.']);
        }
    }
    // public function logout() {
    //     Auth::logout();
    //     return redirect('/login')->with(['Berhasil'=>'Selamat Tinggal']);
    // }

    public function authenticate(Request $request)
    {
        $endpoint = api_url('login');
        $client = new \GuzzleHttp\Client();
        $browser = Agent::browser();
        $os = Agent::platform();
        $clientIP = request()->ip();
        $validator = validator(request()->all(), [
            'email' => 'required',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect('/login')
                ->with(['loginError' => 'Inputan yang anda masukan tidak sesuai.'])
                ->withInput(['email' => $request->email]);
        }
        try {
            $result = $client->request(
                'POST',
                $endpoint,
                [
                    'form_params' => [
                        'email' => $request->input('email'),
                        'password' => $request->input('password'),
                        'browser' => $browser,
                        'os' => $os,
                        'ip' => $clientIP
                    ],
                    'verify' => false
                ]
            );
            $ceklogin = json_decode($result->getBody());
        } catch (ClientException $e) {
            $response = $e->getResponse();
            $res = $response->getBody()->getContents();
            $ceklogin = json_decode($res);
        }
        if ($ceklogin->status == 200) {
            $request->session()->regenerate();
            Session::put('token', $ceklogin->access_token);
            Session::put('email', $ceklogin->email);
            Session::put('isLoggedIn', $ceklogin->isLoggedIn);
            // Session::put('login_as', 'Superadmin');
            Alert::success('Selamat Datang', $ceklogin->email);
            return redirect()->intended('/dasboardportal');
            // return redirect('/dashboard');
        } else {
            return redirect('/login')->with(['loginError' => $ceklogin->message])->withInput(['username' => $request->email]);
        }
    }

//     public function logout()
// {
//     $client = new \GuzzleHttp\Client();
//     $checkToken = Session::get('token');
//     $url_target = api_url('logout');
//     if ($checkToken) {
//         try {
//             $result = $client->request(
//                 'POST',
//                 $url_target,
//                 [
//                     'verify' => false,
//                     'headers' => [
//                         'Authorization' => "Bearer {$checkToken}"
//                     ]
//                 ]
//             );
//             $ceklogout = json_decode($result->getBody());
//         } catch (\GuzzleHttp\Exception\ClientException $e) {
//             $response = $e->getResponse();
//             $res = $response->getBody()->getContents();
//             $ceklogout = json_decode($res);
//         }

//         if ($ceklogout->status == 200) {
//             Session::forget('token'); // Menghapus token dari sesi
//             return redirect('/login');
//         } else if ($ceklogout->status == "Invalid token") {
//             Session::forget('token'); // Menghapus token dari sesi
//             return redirect('/login');
//         } else {
//             Session::forget('token'); // Menghapus token dari sesi
//             return redirect('/login');
//         }
//     } else {
//         return redirect('/login');
//     }
// }

public function logout()
{
    $client = new \GuzzleHttp\Client();
    $checkToken = Session::get('token');

    if ($checkToken) {
        try {
            $result = $client->request(
                'POST',
                api_url('logout'),
                [
                    'verify' => false,
                    'headers' => [
                        'Authorization' => "Bearer {$checkToken}"
                    ]
                ]
            );
            $ceklogout = json_decode($result->getBody());
        } catch (\GuzzleHttp\Exception\ClientException $e) {
            $ceklogout = json_decode($e->getResponse()->getBody()->getContents());
        }
        Session::forget('isLoggedIn');
        Session::forget('token'); // Menghapus token dari sesi

        if ($ceklogout->status == 200 || $ceklogout->status == "Invalid token") {
            // return redirect('/login');
            return redirect('/');
        }
    }

    return redirect('/login');
}

}