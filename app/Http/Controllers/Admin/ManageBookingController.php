<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;

class ManageBookingController extends Controller
{
    public function index()
    {
        $data = Booking::with('product', 'user')->paginate(5);
        return view(
            'pages.dashboard.booking.index', 
            get_defined_vars()
        );
    }

    public function show($id)
    {
        $data = Booking::with([
            'product',
            'user'
        ])->findOrFail($id);
        return view(
            'pages.dashboard.booking.show',
            get_defined_vars()
        );
    }

    public function export_pdf()
    {
        return view('pages.dashboard.booking.export-pdf');
    }

    public function export_excel()
    {
        return view('pages.dashboard.booking.export-excel');
    }   
}
