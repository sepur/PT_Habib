<?php

namespace App\Http\Controllers;

use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ExportReport;

class ReportController extends Controller
{
    public function export()
    {
        return Excel::download(new ExportReport, 'User.xlsx');
    }
}