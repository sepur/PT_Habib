<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Session;
use Jenssegers\Agent\Facades\Agent;

use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;
class Aplikasicontroller extends Controller
{

    public function indexaplikasi()
    {
        $endpoint = api_url('checkToken');
        $cek = requestGetAPI($endpoint);
        if($cek->statusToken == "valid")
        {
            return view('aplikasis.index');
        }else{
            return redirect('/login');
        }
    }

    public function listaplikasi()
{
    try {
        $endpoint = api_url('listaplikasi');
        $response = requestGetAPI($endpoint);

        if ($response->status == 200 && $response->data != null) {
            return view('aplikasis.dataaplikasi', ['list' => $response->data]);
        }
    } catch (\Exception $e) {
        return response()->json(['error' => $e->getMessage()], 500);
    }
}


    public function dasboardportal()
    {
        // try {
            $endpoint = api_url('dasboard');
            $response = requestGetAPI($endpoint);

            // if ($response->status == 200 && $response->data != null) {
                // return view('users.list-user', ['list' => $response->data]);
                return view('aplikasis.dahsboardportal', ['list' => $response->data]);
        //     }else{
        //         return view('login.login');

        //     }
        // } catch (\Exception $e) {
        //     return response()->json(['error' => $e->getMessage()], 500);
        // }
    }
    public function createaplikasi()
    {
        return view('aplikasis.modalcreate');
    }

    public function addaplikasi(Request $request)
    {
    $endpoint = api_url('createaplikasi');
    $browser = Agent::browser();
    $os = Agent::platform();
    $clientIP = request()->ip();
    $validator = Validator::make($request->all(), [
        'nama'        => 'required',
        'keterangan'  => 'nullable',
        'gambar'      => 'required|mimes:png,jpg,jpeg|max:5048',
        'link'        => 'required',
    ]);

    if ($validator->fails()) {
        return response()->json(['error' => $validator->errors()], 422);
    }

    $method = 'POST';
    $array = [
        'nama' => $request->input('nama'),
        'keterangan' => $request->input('keterangan'),
        'gambar' => $request->file('gambar'),  // Menggunakan $request->file() untuk mendapatkan file
        'link' => $request->input('link'),
        'browser' => $browser,
        'os' => $os,
        'ip' => $clientIP
    ];

    try {
        $response = requestPostImageAPI($method, $endpoint, $array);
        // Mengganti $response->status menjadi $response->status_code
        if ($response->status_code == 200) {
            Alert::success($response->message);
            return redirect()->intended('/listaplikasi')->with('message', 'Registration Is successfull, Please Login');
        }
    } catch (\Exception $e) {
        return response()->json(['error' => $e->getMessage()], 422);
    }
}

    public function showupdateaplikasi($id)
    {
      try {
        $endpoint = api_url('getaplikasi/'.$id);
        $response = requestGetAPI($endpoint);

        // dd(($response->data));
        if ($response->status == 200 && $response->data != null) {
            return view('aplikasis.modalupdate', ['aplikasi' => $response->data]);
        }
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function storeupdateaplikasi(Request $request,$id)
    {

    $endpoint = api_url('editaplikasi/'.$id);
    $browser = Agent::browser();
    $os = Agent::platform();
    $clientIP = request()->ip();
    $validator = Validator::make($request->all(), [
        'nama'        => 'required',
        'keterangan'  => 'nullable',
        'gambar'      => 'nullable|mimes:png,jpg,jpeg|max:5048',
        'link'        => 'required',
    ]);

    if ($validator->fails()) {
        return response()->json(['error' => $validator->errors()], 422);
    }

    $method = 'POST';
    $array = [
        'nama' => $request->input('nama'),
        'keterangan' => $request->input('keterangan'),
        'gambar' => $request->file('gambar'),  // Menggunakan $request->file() untuk mendapatkan file
        'link' => $request->input('link'),
        'browser' => $browser,
        'os' => $os,
        'ip' => $clientIP,
        '_method' => "PUT"
    ];

    try {
        $response = requestPostImageAPI($method, $endpoint, $array);
        // Mengganti $response->status menjadi $response->status_code
        if ($response->status_code == 200) {
            Alert::success($response->message);
            #return redirect()->intended('/listaplikasi')->with('message', 'Registration Is successfull, Please Login');
        }
    } catch (\Exception $e) {
        return response()->json(['error' => $e->getMessage()], 422);
    }

    }

    public function deleteaplikasi($id)
    {
        $endpoint = api_url('hapusaplikasi/'.$id);
        $browser = Agent::browser();
        $os = Agent::platform();
        $clientIP = request()->ip();
        $method = 'POST';
        try {
            $response = requestDeleteAPI($method, $endpoint);
            if ($response->status == 200) {
            Alert::success($response);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 422);
        }
    }
}
