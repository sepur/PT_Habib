<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Aplikasi;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
class AplikasiController extends Controller
{

     public function index()
    {
        $apl = Aplikasi::all();
        return response()->json(['status' => 200, 'data'=>$apl], 200);
    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama'        => 'required',
            'keterangan'  => 'nullable',
            'gambar'      => 'required|mimes:png,jpg,jpeg|max:5048',
            'link'        => 'required',
        ]);

	if ($validator->fails()){
	    return response()->json($validator->errors(),422);
	}
        DB::beginTransaction();
         try {
            $image = $request->file('gambar');
            #$memberlist = $request->input('member', []);
            #$array = explode(",", $memberlist);
            $post = new Aplikasi();
            $post->nama         = $request->nama;
            $post->keterangan   = $request->keterangan;
            $post->link         = $request->link;
            if ($image) {
                $filename = date('Y-m-d') . $image->getClientOriginalName();
                $image->move('aplikasi', $filename);
                $post->gambar = $filename;
            }
            $post->save();
            DB::commit();
            return response()->json(['status_code'=>200,'status' => 'Success', 'message' => 'Aplikasi created successfully'], 200);
         } catch (\Exception $e) {
             return response()->json(['status_code'=>404,'status' => 'Error', 'message' => $e->getMessage()], 403);
         }
    }

    public function getaplikasi($id)
    {
        try {
            $post = Aplikasi::findOrFail($id);
            return response()->json(['status' => '200', 'data' => $post], 200);
        } catch (\Exception $e) {
            return response()->json(['status' => 'Error', 'message' => 'Data Doesnt Exist'], 403);
        }
    }

    public function editaplikasi(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nama'        => 'required',
            'keterangan'  => 'nullable',
            'gambar'      => 'nullable|mimes:png,jpg,jpeg|max:5048',
            'link'        => 'required',
        ]);
        if ($validator->fails()){
            return response()->json($validator->errors(),422);
        }
        DB::beginTransaction();
        try {
            $image = $request->file('gambar');
            $post = Aplikasi::findOrFail($id);
            $post->nama         = $request->nama;
            $post->keterangan   = $request->keterangan;
            $post->link         = $request->link;
            if ($image) {
                $filename = date('Y-m-d') . $image->getClientOriginalName();
                $image->move('aplikasi', $filename);
                $post->gambar = $filename;
            }
            $post->save();
            DB::commit();
            return response()->json(['status_code'=>200,'status' => 'Success', 'message' => 'Aplikasi Update successfully'], 200);
        } catch (\Exception $e) {
             return response()->json(['status_code'=>402,'status' => 'Error', 'message' => $e->getMessage()], 403);
        }
    }
        public function hapus($id)
        {
            try {
                $post = Aplikasi::findOrFail($id);
                $post->delete();
                return response()->json(['status' => 'Success', 'message' => 'Aplikasi Deleted successfully'], 200);
            } catch (\Exception $e) {
                return response()->json(['status' => 'Error', 'message' => 'Data Doesnt Exist'], 403);
            }
        }

}
