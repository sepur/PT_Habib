<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Session;
use Jenssegers\Agent\Facades\Agent;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ReportExport;
class ReportController extends Controller
{

    public function index()
    {
        $endpoint = api_url('checkToken');
        $cek = requestGetAPI($endpoint);
        if($cek->statusToken == "valid")
        {
            return view('report.index');
        }else{
            return redirect('/login');
        }
    }


    public function eksekusireport(Request $request)
    {
        $client = new Client();
        $endpoint = api_url('export-excel');
        $checkToken = Session::get('token');
        try {
            // Lakukan permintaan ke endpoint yang diinginkan
            $response = $client->request('GET', $endpoint, [
                'verify' => false, // Nonaktifkan verifikasi SSL jika diperlukan
                'headers' => [
                    'Authorization' => 'Bearer ' .$checkToken // Tambahkan header otorisasi jika diperlukan
                ]
            ]);
            // Ambil body dari respons (berisi file Excel)
            $excelFile = $response->getBody()->getContents();
            // Tentukan nama file yang akan di-download
            $filename = 'report.xlsx';
            // Kembalikan file Excel sebagai respons untuk di-download
            return response()->streamDownload(function () use ($excelFile) {
                echo $excelFile;
            }, $filename);
        } catch (\Exception $e) {
            // Tangani kesalahan jika terjadi
            return response()->json(['error' => $e->getMessage()], 500);
        }
   }
}