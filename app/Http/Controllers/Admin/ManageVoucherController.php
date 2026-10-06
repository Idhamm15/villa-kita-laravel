<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Voucher;
use Illuminate\Http\Request;

class ManageVoucherController extends Controller
{
    public function index()
    {
        $data = Voucher::paginate(5);
        return view(
            'pages.dashboard.voucher.index',
            get_defined_vars()
        );
    }
    public function create()
    {
        return view('pages.dashboard.voucher.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'code' => 'required|string|max:255',
            'description' => 'nullable|string|max:255',
            'discount' => 'required|integer|min:0',
            'min_purchase' => 'nullable|integer|min:0',
            'date_expired' => 'nullable|date',
            'status' => 'boolean',
        ]);

        Voucher::create($validatedData);

        return redirect()->route('dashboard.voucher.index')->with('success', 'Voucher created successfully.');
    }
    public function edit($id)
    {
        $data = Voucher::findOrFail($id);
        return view(
            'pages.dashboard.voucher.edit',
            get_defined_vars()
        );
    }

    public function update(Request $request, $id)
    {
        $data = Voucher::findOrFail($id);

        $validatedData = $request->validate([
            'code' => 'required|string|max:255',
            'description' => 'nullable|string|max:255',
            'discount' => 'required|integer|min:0',
            'min_purchase' => 'nullable|integer|min:0',
            'date_expired' => 'nullable|date',
            'status' => 'boolean',
        ]);

        $data->update($validatedData);

        return redirect()->route('dashboard.voucher.index')->with('success', 'Voucher updated successfully.');
    }
}
