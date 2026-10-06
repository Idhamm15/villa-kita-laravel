<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ManageReportController extends Controller
{
    public function index()
    {
        return view('pages.dashboard.report.index');
    }

    public function show()
    {
        return view('pages.dashboard.report.show');
    }

    public function export_pdf()
    {
        return view('pages.dashboard.report.export_pdf');
    }

    public function export_excel()
    {
        return view('pages.dashboard.report.export_excel');
    }
}
