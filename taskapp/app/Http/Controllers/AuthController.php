<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
class AuthController extends Controller
{
    public function index()
    {
        #$users = User::paginate(2);
        $users = User::all();
        return response()->json(['status' => 200, 'data'=>$users], 200);
    }
    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
            'wktulogin' => 'nullable',
        ]);
        $now = Carbon::now();
        $waktulogin = $now->format('Y-m-d H:i:s');
        $credentials = $request->only('email', 'password', $waktulogin);
        $new_token = $credentials;
       try {
            $token = JWTAuth::attempt($new_token);
            if (!$token) {
                // Tambahkan log atau echo pesan kesalahan
                return response()->json([
                    'error' => 'Invalid credentials',
                    'status' => 401,
                    'message' =>  'Silahkan Cek Inputan Anda'],
			 401);
            }
            } catch (\Exception $e) {
                // Tambahkan log atau echo pesan kesalahan
                return response()->json([
                'error' => 'Could not create token',
                'status' => 500,
                'message' =>  'Silahkan Cek Inputan Anda'],
                500);
            }
        return $this->respondWithToken($token);
    }

    public function edituser(Request $request, $id)
    {
         $validator = Validator::make($request->all(), [
               'name' => 'required',
               'email'      => 'required',
               'username'   => 'required',
	        ]);
	if ($validator->fails()){
	    return response()->json($validator->errors(),422);
	}
         try {
            $post = User::findOrFail($id);
            $post->name   =  $request->name;
            $post->email        =  $request->email;
            $post->username     =  $request->username;

            if ($post->save()) {
                return response()->json(['status' => 'Success', 'message' => 'User Update successfully'], 200);
            }
         } catch (\Exception $e) {
             return response()->json(['status' => 'Error', 'message' => $e->getMessage()], 403);
         }
    }
        public function hapus($id)
        {
            try {
                $post = User::findOrFail($id);
                $post->delete();
                return response()->json(['status' => 'Success', 'message' => 'User Update successfully'], 200);
            } catch (\Exception $e) {
                return response()->json(['status' => 'Error', 'message' => 'Data Doesnt Exist'], 403);
            }
        }

        public function getuser($id)
        {
            try {
                // $post = User::select('id','first_name','last_name','email','username','password')->findOrFail($id);
                $post = User::findOrFail($id);
                return response()->json(['status' => '200', 'data' => $post], 200);
            } catch (\Exception $e) {
                return response()->json(['status' => 'Error', 'message' => 'Data Doesnt Exist'], 403);
            }
        }
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'status' => 200,
            'email' => Auth::user()->email,
            'isLoggedIn' => true,
            #'expires_in' => JWTAuth::factory()->getTTL() * 60,
        ]);
    }

    public function me()
    {
        return response()->json(auth()->user());
    }

    public function logout()
    {
        $token = JWTAuth::parseToken();
        $token->invalidate();
        return response()->json(['status'=> 200,'message' => 'Successfully logged out']);
    }
    public function refresh()
    {
        return $this->respondWithToken(JWTAuth::refresh());
    }
}