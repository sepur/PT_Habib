<?php

namespace App\Http\Controllers;

use App\Mail\RegistrasiEmail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;


class RegistrasiController extends Controller
{
    public function save_registrasi(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required',
            'username' => 'required',
            'password' => 'required|confirmed',
            'password_confirmation' => 'required',
        ]);
        $CekEmailDanUserName = User::where('email', $request->input('email'))
            ->orWhere('username', $request->input('username'))
            ->first();
        if ($CekEmailDanUserName) {
            return response()->json(['status' => 422,'error' => 'Email atau username sudah ada'], 422);
        }

        $model = new User;
        $model->name = $request->input('name');
        $model->username = $request->input('username');
        $model->email = $request->input('email');
        $model->password = Hash::make($request->input('password'));
        #$model->token = Str::random(40) . $request->input('email');
        $model->active = 'N';
        $save = $model->save();

        if ($save) {
             $data = array(
                'status'  => 200,
                'success' => true,
                'message' => 'Registration successfull',
             );
        } else {
            $data = array(
                'status'  => 422,
                'success' => false,
                'message' => 'Registration failed',
            );
        }
        return $data;
    }

    public function listuser()
    {
        $data = User::all();
        $response = [
            'status' => 'success',
            'data' => $data,
        ];
        return response()->json($response, 200);
    }


      public function checkToken()
    {
        try {
            // Coba memeriksa token
            JWTAuth::parseToken()->authenticate();
        } catch (TokenExpiredException $e) {
            // Token sudah kedaluwarsa
            return response()->json(['error' => 'Token has expired','statusToken'=>"expired"], 401);
        } catch (TokenInvalidException $e) {
            // Token tidak valid
            return response()->json(['error' => 'Token is invalid','statusToken'=>"invalid"], 401);
        }
        // Token valid, lanjutkan eksekusi metode yang diinginkan di sini
        return response()->json(['message' => 'Token is valid','statusToken'=>"valid"]);
    }

}
