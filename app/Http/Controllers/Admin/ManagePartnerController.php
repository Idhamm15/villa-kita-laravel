<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController\UploadImageController;
use App\Http\Controllers\Controller;
use App\Models\Partner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ManagePartnerController extends UploadImageController
{
    public function index()
    {
        $data = Partner::paginate(5);
        return view(
            'pages.dashboard.partner.index',
            get_defined_vars()
        );
    }

    public function create()
    {
        return view('pages.dashboard.partner.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'sort' => 'nullable|integer|min:0',
            'status' => 'boolean',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:5120', // 5MB
        ]);

        if ($request->hasFile('image')) {

            $image = $request->file('image');

            $nameImage = time()
                . '_'
                . uniqid()
                . '.'
                . $image->getClientOriginalExtension();

            $destinationPath = public_path($this->uploadPath);

            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }

            $image->move($destinationPath, $nameImage);

            $validatedData['image'] = $this->updatePath . $nameImage;
        }

        Partner::create($validatedData);

        return redirect()->route('dashboard.partner.index')->with('success', 'Partner created successfully.');
    }

    public function edit($id)
    {
        $data = Partner::findOrFail($id);
        return view(
            'pages.dashboard.partner.edit', 
            get_defined_vars()
        );
    }

    public function update(Request $request, $id)
    {
        $data = Partner::findOrFail($id);

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'sort' => 'nullable|integer|min:0',
            'status' => 'boolean',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Jika ada image baru
        if ($request->hasFile('image')) {

            // ==========================================
            // HAPUS IMAGE LAMA
            // ==========================================

            if (!empty($data->image)) {

                $oldImage = public_path($data->image);

                if (file_exists($oldImage)) {
                    unlink($oldImage);
                }
            }


            // ==========================================
            // UPLOAD IMAGE BARU
            // ==========================================

            $image = $request->file('image');

            $nameImage = time()
                . '_'
                . uniqid()
                . '.'
                . $image->getClientOriginalExtension();

            $destinationPath = public_path($this->uploadPath);

            // Buat folder jika belum ada
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }

            $image->move(
                $destinationPath,
                $nameImage
            );

            // Simpan path ke database
            $data->image = $this->updatePath . $nameImage;
        }

        $data->update($validatedData);

        return redirect()->route('dashboard.partner.index')->with('success', 'Partner updated successfully.');
    }
}
