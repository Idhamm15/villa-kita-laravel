<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Product;
use Illuminate\Http\Request;

class LandingPageController extends Controller
{
    public function index()
    {
        $data = Product::with('owner')->paginate(5);
        return view(
            'pages.Home',
            get_defined_vars()
        );
    }

    public function rent_villa()
    {
        $data = Product::where('type', 'VILLA')->with('owner')->paginate(10);
        return view(
            'pages.sewa-villla.index',
            get_defined_vars()
        );
    }

    public function detail_rent_villa($id)
    {
        $data = Product::with([
            'owner',
            'items',
            'images',
            'createdBy'
        ])->findOrFail($id);
        return view(
            'pages.sewa-villla.detail',
            get_defined_vars()
        );
    }

    public function saved()
    {
        return view('pages.Saved');
    }

    public function trip()
    {
        $data = Product::where('type', 'TRIP')->with('owner')->paginate(10);
        return view(
            'pages.trip.index',
            get_defined_vars()
        );
    }

    public function detail_trip()
    {
        return view('pages.trip.detail');
    }

    public function blog()
    {
        $data = Blog::paginate(10);
        return view(
            'pages.blog.index', 
            get_defined_vars()
        );
    }

    public function detailBlog($slug)
    {
        $data = Blog::where('slug', $slug)->firstOrFail();
        $relatedBlogs = Blog::where('id', '!=', $data->id)
            ->inRandomOrder()
            ->limit(3)
            ->get();
        return view(
            'pages.blog.detail',
            get_defined_vars()
        );
    }

    public function contact()
    {
        return view('pages.Contact');
    }

    public function booking($id)
    {
        $data = Product::with([
            'owner',
            'items',
            'images',
            'createdBy'
        ])->findOrFail($id);
        return view(
            'pages.booking.index',
            get_defined_vars()
        );
    }

    public function bookingProcess()
    {
        return view('pages.booking.Process');
    }
    public function bookingPayment()
    {
        return view('pages.booking.Payment');
    }
}
