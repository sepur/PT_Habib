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
class Taskcontroller extends Controller
{

    public function indextask()
    {

            return view('task.index');
    }

    public function listtask()
{
    try {
        $endpoint = api_url('tasks');
        $response = requestGetAPI($endpoint);

        if ($response->status == 200 && $response->data != null) {
            return view('task.datatasks', ['list' => $response->data]);
        }
    } catch (\Exception $e) {
        return response()->json(['error' => $e->getMessage()], 500);
    }
}


    public function dasboardportal()
    {
            $endpoint = api_url('dasboard');
            $response = requestGetAPI($endpoint);
            return view('task.dahsboardportal', ['list' => $response->data]);    
    }
    public function createtask()
    {
        return view('task.modalcreate');
    }

    public function addtask(Request $request)
    {
    $endpoint = api_url('tasks');
    $browser = Agent::browser();
    $os = Agent::platform();
    $clientIP = request()->ip();
    $validator = Validator::make($request->all(), [
        'title'        => 'required',
        'description'  => 'required',
        'status'       => 'required',
        'due_date'     => 'required',
    ]);

    if ($validator->fails()) {
        return response()->json(['error' => $validator->errors()], 422);
    }

    $method = 'POST';
    $array = [
        'title' 	=> $request->input('title'),
        'description'	=> $request->input('description'),
        'status'	=> $request->input('status'),
        'due_date' 	=> $request->input('due_date'),
        'browser' 	=> $browser,
        'os' 		=> $os,
        'ip' 		=> $clientIP
    ];

    try {
        $response = requestPostImageAPI($method, $endpoint, $array);
        if ($response->status_code == 200) {
            Alert::success($response->message);
            return redirect()->intended('/indextask')->with('message', 'Task Is successfull');
        }
    } catch (\Exception $e) {
        return response()->json(['error' => $e->getMessage()], 422);
    }
}

    public function showupdatetask($id)
    {
      try {
        $endpoint = api_url('tasks/'.$id);
        $response = requestGetAPI($endpoint);

        // dd(($response->data));
        if ($response->status == 200 && $response->data != null) {
            return view('task.modalupdate', ['task' => $response->data]);
        }
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function storeupdatetask(Request $request,$id)
    {

    $endpoint = api_url('tasks/'.$id);
    $browser = Agent::browser();
    $os = Agent::platform();
    $clientIP = request()->ip();
    $validator = Validator::make($request->all(), [
        'title'        => 'required',
        'description'  => 'required',
        'status'       => 'required',
        'due_date'     => 'required',
    ]);

    if ($validator->fails()) {
        return response()->json(['error' => $validator->errors()], 422);
    }

    $method = 'POST';
    $array = [
        'title' 	=> $request->input('title'),
        'description'	=> $request->input('description'),
        'status' 	=> $request->input('status'),  // Menggunakan $request->file() untuk mendapatkan file
        'due_date' 	=> $request->input('due_date'),
        'browser' 	=> $browser,
        'os' 		=> $os,
        'ip' 		=> $clientIP,
        '_method' 	=> "PUT"
    ];

    try {
        $response = requestPostImageAPI($method, $endpoint, $array);
        if ($response->status_code == 200) {
            Alert::success($response->message);
            #return redirect()->intended('/listaplikasi')->with('message', 'Registration Is successfull, Please Login');
        }
    } catch (\Exception $e) {
        return response()->json(['error' => $e->getMessage()], 422);
    }

    }

    public function deletetask($id)
    {
        $endpoint = api_url('tasks/'.$id);
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
