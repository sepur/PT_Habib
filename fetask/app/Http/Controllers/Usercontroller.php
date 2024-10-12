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

class Usercontroller extends Controller
{
    public function create() {
        $user = request()->validate([
            'name' => ['required', 'max:50'],
            'email' => ['required', 'email', 'max:50', Rule::unique('users', 'email')],
            'password' => ['required', 'min:5', 'max:20']
        ]);
        $user['password'] = bcrypt($user['password'] );

        session()->flash('Berhasil', 'Akun telah dibuat');
        $user = User::create($user);
        Auth::login($user);
        return redirect('users.list-user');
    }

    public function indexuser()
    {
        // dd(Session::all());
        //   try {
        //         $getstatus = Session::get('status');
        //         if ($getstatus == 200) {
            return view('users.index');
        //     }
        //     else{
        //         return redirect('/login');
        //     }
        // } catch (\Exception $e) {
        //     return redirect('/login')->with(['loginError' => "Sesi Anda Exired"]);
        // }
    }


    // public function listUser()
    // {

    //     // dd( Session::get('token'));
    //     try {
    //         $endpoint = api_url('listuser');
    //         $response = requestGetAPI($endpoint);
    //         // return response()->json($response);
    //         if ($response->status == 200 && $response->data != null) {
    //         return view('users.list-user', ['list' => $response->data]);
    //         }
    //     } catch (\Exception $e) {
    //         return redirect('/login')->with(['loginError' => "Sesi Anda Exired"]);
    //         // return view('error_data.error', ['error' => $e->getMessage()]);
    //     }
    // }
    public function listUser()
{
    try {
        $endpoint = api_url('listuser');
        $response = requestGetAPI($endpoint);

        if ($response->status == 200 && $response->data != null) {
            // return view('users.list-user', ['list' => $response->data]);
            return view('users.datauser', ['list' => $response->data]);
        }
    } catch (\Exception $e) {
        return response()->json(['error' => $e->getMessage()], 500);
    }
}

    public function createuser()
    {
        return view('users.modalcreate');
    }

    public function adduser(Request $request)
        {
            // dd('masukkk pa ekooo');
            $endpoint = api_url('save-registrasi');
            $browser = Agent::browser();
            $os = Agent::platform();
            $clientIP = request()->ip();
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'email' => 'required|string|max:255',
                'username' => 'required|string|max:255',
                'password' =>'required|min:8|confirmed',
            ]);

            if ($validator->fails()) {
                return response()->json(['error' => $validator->errors()], 422);
            }
            $method = 'POST';
            $array = [
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'username' => $request->input('username'),
                'password' => $request->input('password'),
                'password_confirmation' => $request->input('password_confirmation'),
                'browser' => $browser,
                'os' => $os,
                'ip' => $clientIP
            ];

            try {
                $response = requestPostAPI($method, $endpoint, $array);
                // dd($response);
                if ($response->status == 200) {
                // $responseData = json_decode($response->getBody(), true);
                Alert::success($response);
                return redirect()->intended('/listUser')->with('message', 'Registration Is successfull, Please Login');
                }
            } catch (\Exception $e) {
                return response()->json(['error' => $e->getMessage()], 422);
            }
            #return redirect()->intended('/register')->with('success', $response->error);

            // return response()->json(['message' => $response->error]);
        }


    public function showupdateuser($id)
    {
      try {
        $endpoint = api_url('getuser/'.$id);
        $response = requestGetAPI($endpoint);
        // dd($response);
        if ($response->status == 200 && $response->data != null) {
            return view('users.modalupdate', ['usr' => $response->data]);
        }
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function storeupdateuser(Request $request,$id)
        {
            $endpoint = api_url('edituser/'.$id);
            $browser = Agent::browser();
            $os = Agent::platform();
            $clientIP = request()->ip();
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'email' => 'required|string|max:255',
                'username' => 'required|string|max:255',
            ]);
            if ($validator->fails()) {
                return response()->json(['error' => $validator->errors()], 422);
            }
            $method = 'PUT';
            $array = [
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'username' => $request->input('username'),
                'browser' => $browser,
                'os' => $os,
                'ip' => $clientIP
            ];

            try {
                $response = requestPostAPI($method, $endpoint, $array);
                if ($response->status == 200) {
                Alert::success($response);
                return redirect()->intended('/listUser')->with('success', 'Registration Is successfull, Please Login');
                }
            } catch (\Exception $e) {
                return response()->json(['error' => $e->getMessage()], 422);
            }
        }
        public function deleteuser($id)
    {
            $endpoint = api_url('hapususer/'.$id);
            $browser = Agent::browser();
            $os = Agent::platform();
            $clientIP = request()->ip();
            $method = 'POST';
            try {
                $response = requestDeleteAPI($method, $endpoint);
                if ($response->status == 200) {
                // $responseData = json_decode($response->getBody(), true);
                Alert::success($response);
                // return redirect()->intended('/listUser')->with('success', 'Registration Is successfull, Please Login');
                }
            } catch (\Exception $e) {
                return response()->json(['error' => $e->getMessage()], 422);
            }
     }
}