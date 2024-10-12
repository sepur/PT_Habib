<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
class TaskController extends Controller
{

     public function index()
    {
        $apl = Task::all();
        return response()->json(['status' => 200, 'data'=>$apl], 200);
    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title'        => 'required',
            'description'  => 'required',
            'status'       => 'required',
            'due_date'     => 'required',
        ]);

	if ($validator->fails()){
	    return response()->json($validator->errors(),422);
	}
        DB::beginTransaction();
         try {
            $post = new Task();
            $post->title         = $request->title;
            $post->description   = $request->description;
            $post->status        = $request->status;
            $post->due_date      = $request->due_date;
         
            $post->save();
            DB::commit();
            return response()->json(['status_code'=>200,'status' => 'Success', 'message' => 'Task created successfully'], 200);
         } catch (\Exception $e) {
             return response()->json(['status_code'=>404,'status' => 'Error', 'message' => $e->getMessage()], 403);
         }
    }

    public function gettask($id)
    {
        try {
            $post = Task::findOrFail($id);
            return response()->json(['status' => '200', 'data' => $post], 200);
        } catch (\Exception $e) {
            return response()->json(['status' => 'Error', 'message' => 'Data Doesnt Exist'], 403);
        }
    }

    public function edittask(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'title'        => 'required',
            'description'  => 'required',
            'status'       => 'required',
            'due_date'     => 'required',
        ]);
        if ($validator->fails()){
            return response()->json($validator->errors(),422);
        }
        DB::beginTransaction();
        try {
            $image = $request->file('gambar');
            $post = Task::findOrFail($id);
            $post->title         = $request->title;
            $post->description   = $request->description;
            $post->status        = $request->status;
            $post->due_date      = $request->due_date;
            $post->save();
            DB::commit();
            return response()->json(['status_code'=>200,'status' => 'Success', 'message' => 'Task Update successfully'], 200);
        } catch (\Exception $e) {
             return response()->json(['status_code'=>402,'status' => 'Error', 'message' => $e->getMessage()], 403);
        }
    }
        public function hapus($id)
        {
            try {
                $post = Task::findOrFail($id);
                $post->delete();
                return response()->json(['status' => 'Success', 'message' => 'Task Deleted successfully'], 200);
            } catch (\Exception $e) {
                return response()->json(['status' => 'Error', 'message' => 'Data Doesnt Exist'], 403);
            }
        }

}
