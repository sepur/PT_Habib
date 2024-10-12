<?php

use GuzzleHttp\Psr7;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Session;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Exception\RequestException;

date_default_timezone_set("Asia/Jakarta");

function clientDate($date)
{
    $timestamp = strtotime($date);
    return date("d-m-Y", $timestamp);
}

function serverDate($date)
{
    $timestamp = strtotime($date);
    return date("Y-m-d", $timestamp);
}

function api_url($end_point)
{
     $auth_url = "http://127.0.0.1:8000/api/" . $end_point;
    #$auth_url = "http://192.168.4.106:8000/api/" . $end_point;
    return $auth_url;
}

function api_url_getimage($end_point)
{
    $auth_url = "http://127.0.0.1:8000/" . $end_point;
    #$auth_url = "http://192.168.4.106:8000/" . $end_point;
    return $auth_url;
}

function bulan($bln)
{
    switch ($bln) {
        case 1:
            return "Januari";
            break;
        case 2:
            return "Februari";
            break;
        case 3:
            return "Maret";
            break;
        case 4:
            return "April";
            break;
        case 5:
            return "Mei";
            break;
        case 6:
            return "Juni";
            break;
        case 7:
            return "Juli";
            break;
        case 8:
            return "Agustus";
            break;
        case 9:
            return "September";
            break;
        case 10:
            return "Oktober";
            break;
        case 11:
            return "November";
            break;
        case 12:
            return "Desember";
            break;
    }
}

function changeDate($tgl)
{
    $date = date('Y-m-d', strtotime($tgl));

    $ubah = gmdate($date, time() + 60 * 60 * 8);
    $pecah = explode("-", $ubah);
    $tanggal = $pecah[2];
    $bulan = bulan($pecah[1]);
    $tahun = $pecah[0];
    return $tanggal . ' ' . $bulan . ' ' . $tahun;
}
function changeDateTime($tgl)
{

    $date = date('Y-m-d', strtotime($tgl));
    $time = date('H:i:s', strtotime($tgl));

    $ubah = gmdate($date, time() + 60 * 60 * 8);
    $pecah = explode("-", $ubah);
    $tanggal = $pecah[2];
    $bulan = bulan($pecah[1]);
    $tahun = $pecah[0];
    return $tanggal . ' ' . $bulan . ' ' . $tahun . ' ' . $time;
}
function changeDateForHome()
{

    $date = date('Y-m-d');

    $ubah = gmdate($date, time() + 60 * 60 * 8);
    $pecah = explode("-", $ubah);
    $tanggal = $pecah[2];
    $bulan = bulan($pecah[1]);
    $tahun = $pecah[0];
    return $tanggal . ' ' . $bulan . ' ' . $tahun;
}


function doAuthHeader()
{
    $token = Session::get('token');
    return $token ? "Bearer {$token}" : "";
}


function requestGetAPI($url)
{
    $client = new Client();
    $checkToken = Session::get('token');
    try {
        $result = $client->request(
            'GET',
            $url,
            [
                'verify' => false,
                'headers' => ['Authorization' => "Bearer {$checkToken}"]
            ]
        );
        return json_decode($result->getBody());
    } catch (ClientException $e) {
        $response = $e->getResponse();
        $res = $response->getBody()->getContents();
        return json_decode($res);
    }
}


function  requestDeleteAPI($method, $url)
{
    $client = new Client();
    $checkToken = Session::get('token');
    try {
        $result = $client->request(
            $method,
            $url,
            [
                'verify' => false,
                'headers' => ['Authorization' => "Bearer {$checkToken}"]
            ]
        );

        return json_decode($result->getBody());
    } catch (ClientException $e) {
        $response = $e->getResponse();

        $res = $response->getBody()->getContents();

        return json_decode($res);
    }
}

function hari_ini()
{
    $hari = date("D");

    switch ($hari) {
        case 'Sun':
            $hari_ini = "Minggu";
            break;

        case 'Mon':
            $hari_ini = "Senin";
            break;

        case 'Tue':
            $hari_ini = "Selasa";
            break;

        case 'Wed':
            $hari_ini = "Rabu";
            break;

        case 'Thu':
            $hari_ini = "Kamis";
            break;

        case 'Fri':
            $hari_ini = "Jumat";
            break;

        case 'Sat':
            $hari_ini = "Sabtu";
            break;

        default:
            $hari_ini = "Tidak di ketahui";
            break;
    }

    return "<b>" . $hari_ini . "</b>";
}

function  requestPostAPI($method, $url, $array)
{
    $client = new Client();
    $checkToken = Session::get('token');
    try {
        $result = $client->request(
            $method,
            $url,
            [
                'form_params' => $array,
                'verify' => false,
                'headers' => ['Authorization' => "Bearer {$checkToken}"]
            ]
        );
        return json_decode($result->getBody());
    } catch (ClientException $e) {
        $response = $e->getResponse();

        $res = $response->getBody()->getContents();

        return json_decode($res);
    }
}

function requestPostImageAPI($method, $url, $data)
{
    $client = new Client();
    $checkToken = Session::get('token');
    try {
        $options = [
            'verify' => false,
            'headers' => [
                'Authorization' => "Bearer {$checkToken}",
            ],
        ];
        $multipart = [];
        // Tambahkan data teks (username, nip, fullname, dll.)
        foreach ($data as $key => $value) {
            if (!is_a($value, 'Illuminate\Http\UploadedFile')) {
                $multipart[] = [
                    'name' => $key,
                    'contents' => $value,
                ];
            }
        }
        // Tambahkan file gambar ke dalam multipart
        if (isset($data['gambar']) && $data['gambar'] instanceof \Illuminate\Http\UploadedFile) {
            $multipart[] = [
                'name' => 'gambar',
                'contents' => fopen($data['gambar']->getPathname(), 'r'),
                'filename' => $data['gambar']->getClientOriginalName(),
            ];
        }
        $options['multipart'] = $multipart;
        $response = $client->request($method, $url, $options);
        return json_decode($response->getBody());
    } catch (ClientException $e) {
        $response = $e->getResponse();
        $res = $response->getBody()->getContents();
        return json_decode($res);
    }


function cekyaah()
    {
        $endpoint = api_url('checkToken');
        return requestGetAPI($endpoint);
    }
}
