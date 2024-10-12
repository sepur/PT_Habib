<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Jenssegers\Agent\Facades\Agent;
use Illuminate\Support\Facades\Session;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;
class RegisterController extends Controller
{
    public function create()
    {
        return view('dash.register');
    }


    public function store(Request $request)
{
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
        return redirect()->intended('/login')->with('success', 'Registration Is successfull, Please Login');
         }
    } catch (\Exception $e) {
        return response()->json(['error' => $e->getMessage()], 422);
    }
    return redirect()->intended('/register')->with('success', $response->error);

    // return response()->json(['message' => $response->error]);
}

}
