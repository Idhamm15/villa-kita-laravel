<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController\UploadImageController;
use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ManageBlogController extends UploadImageController
{
    public function index()
    {
        $data = Blog::paginate(5);
        return view(
            'pages.dashboard.blog.index',
            get_defined_vars()
        );
    }
    public function create()
    {
        return view('pages.dashboard.blog.create');
    }

    public function store(Request $request)
    {
        // Validasi input
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'content' => 'required|string',
            'is_published' => 'required|boolean',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Simpan thumbnail jika ada
        $thumbnailPath = null;

        if ($request->hasFile('thumbnail')) {

            $thumbnail = $request->file('thumbnail');

            $nameThumbnail = time()
                . '_'
                . uniqid()
                . '_thumbnail.'
                . $thumbnail->getClientOriginalExtension();

            $destinationPath = public_path($this->uploadPath);

            $thumbnail->move(
                $destinationPath,
                $nameThumbnail
            );

            $thumbnailPath = $this->updatePath . $nameThumbnail;
        }

        // Buat blog baru
        Blog::create([
            'title' => $validatedData['title'],
            'category' => $validatedData['category'],
            'content' => $validatedData['content'],
            'is_published' => $validatedData['is_published'],
            'thumbnail' => $thumbnailPath,
        ]);

        return redirect()->route('dashboard.blog.index')->with('success', 'Blog created successfully.');
    }

    public function edit($id)
    {
        $data = Blog::findOrFail($id);
        return view('
            pages.dashboard.blog.edit', 
            get_defined_vars()
        );
    }

    public function update(Request $request, $id)
    {
        // dd($request->all());
        $data = Blog::findOrFail($id);

        // Validasi input
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'content' => 'required|string',
            'is_published' => 'required|boolean',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Update data blog
        $data->title = $validatedData['title'];
        $data->category = $validatedData['category'];
        $data->content = $validatedData['content'];
        $data->is_published = $validatedData['is_published'];

        // Jika ada thumbnail baru, simpan dan update pathnya
        if ($request->hasFile('thumbnail')) {

            $thumbnail = $request->file('thumbnail');

            $nameThumbnail = time()
                . '_'
                . uniqid()
                . '_thumbnail.'
                . $thumbnail->getClientOriginalExtension();

            $destinationPath = public_path($this->uploadPath);

            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }

            $thumbnail->move($destinationPath, $nameThumbnail);

            $data->thumbnail = $this->updatePath . $nameThumbnail;
        }

        $data->save();

        return redirect()->route('dashboard.blog.index')->with('success', 'Blog updated successfully.');
    }

    public function delete($id)
    {
        $data = Blog::findOrFail($id);

        if (!empty($data->thumbnail)) {
            Storage::disk('public')->delete($data->thumbnail);
        }

        $data->delete();

        return redirect()
            ->route('dashboard.blog.index')
            ->with('success', 'Blog deleted successfully.');
    }
}
