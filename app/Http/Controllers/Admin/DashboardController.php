<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $total_booking = Booking::count();
        $total_owner = User::where('role', 'OWNER')->count();
        $total_property = Product::count();
        $total_revenue = Booking::sum('total_price');

        $latest_bookings = Booking::with('user', 'product')->latest()->paginate(5);
        return view('pages.dashboard.index', get_defined_vars());
    }


    public function show()
    {
        return view('pages.dashboard.product.show');
    }

    public function export_pdf()
    {
        return view('pages.dashboard.product.export-pdf');
    }

    public function export_excel()
    {
        return view('pages.dashboard.product.export-excel');
    }
}
