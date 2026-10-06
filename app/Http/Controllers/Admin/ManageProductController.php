<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController\UploadImageController;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ProductItem;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ManageProductController extends UploadImageController
{
    public function index()
    {
        $data = Product::with('owner')->latest()->paginate(5);
        return view('pages.dashboard.product.index', get_defined_vars());
    }

    public function show()
    {
        return view('pages.dashboard.product.show');
    }
    public function create()
    {
        $owners = User::where('role', 'OWNER')->get();
        return view('pages.dashboard.product.create', get_defined_vars());
    }
    public function edit($id)
    {
        $data = Product::with([
            'owner',
            'items',
            'images',
            'createdBy'
        ])->findOrFail($id);

        $owners = User::where('role', 'OWNER')->get();
        
        return view('pages.dashboard.product.edit', get_defined_vars());
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|in:VILLA,TRIP',
            'location' => 'required|string|max:255',
            'address' => 'required|string',
            'url_maps' => 'nullable|url',

            'booking_type' => 'required|in:MENGINAP,HARIAN',

            'owner_id' => 'required|exists:users,id',

            'total_bedroom' => 'nullable|integer|min:0',
            'total_bathroom' => 'nullable|integer|min:0',
            'max_guest' => 'nullable|integer|min:1',
            'wide' => 'nullable|numeric|min:0',

            'price_start' => 'required|numeric|min:0',
            'price' => 'required|numeric|min:0',

            'description' => 'nullable|string',

            'type_unit' => 'nullable|string|max:100',

            'facility' => 'nullable|array',
            'facility.*' => 'nullable|string|max:255',

            'included' => 'nullable|array',
            'included.*' => 'nullable|string|max:255',

            'excluded' => 'nullable|array',
            'excluded.*' => 'nullable|string|max:255',

            'thumbnail' => 'required|image|mimes:jpg,jpeg,png,webp|max:10240',

            'images' => 'nullable|array',
            'images.*' => 'image|mimes:jpg,jpeg,png,webp|max:10240',
        ]);

        DB::beginTransaction();

        try {

            // =====================================================
            // PRODUCT
            // =====================================================

            $product = new Product();

            $product->name = $validated['name'];
            $product->slug = Str::slug($validated['name']);

            $product->type = $validated['type'];
            $product->location = $validated['location'];
            $product->address = $validated['address'];
            $product->url_maps = $validated['url_maps'] ?? null;

            $product->booking_type = $validated['booking_type'];

            $product->owner_id = $validated['owner_id'];

            $product->total_bedroom = $validated['total_bedroom'] ?? 0;
            $product->total_bathroom = $validated['total_bathroom'] ?? 0;
            $product->max_guest = $validated['max_guest'] ?? 0;
            $product->wide = $validated['wide'] ?? 0;

            $product->price_start = $validated['price_start'];
            $product->price = $validated['price'];

            $product->description = $validated['description'] ?? null;

            $product->type_unit = $validated['type_unit'] ?? null;

            // Sesuaikan dengan field user login kamu
            $product->created_by = auth()->id();
            // $product->created_by = 1;

            // Kalau Product punya field ini
            $product->is_active = true;

            $product->save();


            // =====================================================
            // THUMBNAIL
            // =====================================================

            // if ($request->hasFile('thumbnail')) {

            //     $thumbnail = $request->file('thumbnail');

            //     $thumbnailPath = $thumbnail->store(
            //         'products/thumbnail',
            //         'public'
            //     );

            //     ProductImage::create([
            //         'product_id' => $product->id,
            //         'image' => $thumbnailPath,
            //         'is_thumbnail' => true,
            //     ]);
            // }

            // if ($request->hasFile('thumbnail')) {

            //     $thumbnail = $request->file('thumbnail');

            //     $thumbnailPath = $thumbnail->store(
            //         'products/thumbnail',
            //         'public'
            //     );

            //     $product->thumbnail = $thumbnailPath;
            // }

            if ($request->hasFile('thumbnail')) {

                $thumbnail = $request->file('thumbnail');

                $nameThumbnail = time() . '_thumbnail.' . $thumbnail->getClientOriginalExtension();

                $destinationPath = public_path($this->uploadPath);

                $thumbnail->move($destinationPath, $nameThumbnail);

                $product->thumbnail = $this->updatePath . $nameThumbnail;
            }

            // =====================================================
            // GALLERY IMAGES
            // =====================================================

           if ($request->hasFile('images')) {

                foreach ($request->file('images') as $image) {

                    $nameImage = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();

                    $destinationPath = public_path($this->uploadPath);

                    $image->move($destinationPath, $nameImage);

                    ProductImage::create([
                        'product_id' => $product->id,
                        'image' => $this->updatePath . $nameImage,
                        'is_thumbnail' => false,
                    ]);
                }
            }

            // =====================================================
            // FACILITY
            // =====================================================

            foreach ($validated['facility'] ?? [] as $facility) {

                if (!$facility) {
                    continue;
                }

                ProductItem::create([
                    'product_id' => $product->id,
                    'type' => 'FACILITY',
                    'name' => $facility,
                ]);
            }


            // =====================================================
            // INCLUDED
            // =====================================================

            foreach ($validated['included'] ?? [] as $included) {

                if (!$included) {
                    continue;
                }

                ProductItem::create([
                    'product_id' => $product->id,
                    'type' => 'INCLUDE',
                    'name' => $included,
                ]);
            }


            // =====================================================
            // EXCLUDED
            // =====================================================

            foreach ($validated['excluded'] ?? [] as $excluded) {

                if (!$excluded) {
                    continue;
                }

                ProductItem::create([
                    'product_id' => $product->id,
                    'type' => 'EXCLUDE',
                    'name' => $excluded,
                ]);
            }


            DB::commit();

            return redirect()
                ->route('dashboard.product.index')
                ->with('success', 'Properti berhasil ditambahkan.');

        } catch (\Throwable $e) {

            DB::rollBack();

            return back()
                ->withInput()
                ->with('error', 'Gagal menambahkan properti: ' . $e->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|in:VILLA,TRIP',
            'location' => 'required|string|max:255',
            'address' => 'required|string',
            'url_maps' => 'nullable|url',

            'booking_type' => 'required|in:MENGINAP,HARIAN',

            'owner_id' => 'required|exists:users,id',

            'total_bedroom' => 'nullable|integer|min:0',
            'total_bathroom' => 'nullable|integer|min:0',
            'max_guest' => 'nullable|integer|min:1',
            'wide' => 'nullable|numeric|min:0',

            'price_start' => 'required|numeric|min:0',
            'price' => 'required|numeric|min:0',

            'description' => 'nullable|string',

            'type_unit' => 'nullable|string|max:100',

            'facility' => 'nullable|array',
            'facility.*' => 'nullable|string|max:255',

            'included' => 'nullable|array',
            'included.*' => 'nullable|string|max:255',

            'excluded' => 'nullable|array',
            'excluded.*' => 'nullable|string|max:255',

            // Thumbnail tidak wajib saat update
            'thumbnail' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:10240',

            'images' => 'nullable|array',
            'images.*' => 'image|mimes:jpg,jpeg,png,webp|max:10240',
        ]);

        DB::beginTransaction();

        try {

            // =====================================================
            // GET PRODUCT
            // =====================================================

            $product = Product::with([
                'items',
                'images',
            ])->findOrFail($id);


            // =====================================================
            // PRODUCT
            // =====================================================

            $product->name = $validated['name'];

            $product->slug = Str::slug($validated['name']);

            $product->type = $validated['type'];

            $product->location = $validated['location'];

            $product->address = $validated['address'];

            $product->url_maps = $validated['url_maps'] ?? null;

            $product->booking_type = $validated['booking_type'];

            $product->owner_id = $validated['owner_id'];

            $product->total_bedroom = $validated['total_bedroom'] ?? 0;

            $product->total_bathroom = $validated['total_bathroom'] ?? 0;

            $product->max_guest = $validated['max_guest'] ?? 0;

            $product->wide = $validated['wide'] ?? 0;

            $product->price_start = $validated['price_start'];

            $product->price = $validated['price'];

            $product->description = $validated['description'] ?? null;

            $product->type_unit = $validated['type_unit'] ?? null;


            // =====================================================
            // THUMBNAIL
            // =====================================================

            if ($request->hasFile('thumbnail')) {

                // Hapus thumbnail lama
                if ($product->thumbnail) {

                    $oldThumbnail = public_path($product->thumbnail);

                    if (file_exists($oldThumbnail)) {
                        unlink($oldThumbnail);
                    }
                }


                // Upload thumbnail baru
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

                $product->thumbnail = $this->updatePath . $nameThumbnail;
            }


            $product->save();


            // =====================================================
            // GALLERY IMAGES
            // =====================================================

            if ($request->hasFile('images')) {

                // ==========================================
                // HAPUS GALLERY LAMA
                // ==========================================

                $oldImages = ProductImage::where(
                    'product_id',
                    $product->id
                )->get();

                foreach ($oldImages as $oldImage) {

                    if (!empty($oldImage->image)) {

                        $oldImagePath = public_path($oldImage->image);

                        if (file_exists($oldImagePath)) {
                            unlink($oldImagePath);
                        }
                    }

                    $oldImage->delete();
                }


                // ==========================================
                // UPLOAD GALLERY BARU
                // ==========================================

                $destinationPath = public_path($this->uploadPath);

                if (!file_exists($destinationPath)) {
                    mkdir($destinationPath, 0755, true);
                }

                foreach ($request->file('images') as $image) {

                    $nameImage = time()
                        . '_'
                        . uniqid()
                        . '.'
                        . $image->getClientOriginalExtension();

                    $image->move(
                        $destinationPath,
                        $nameImage
                    );

                    ProductImage::create([
                        'product_id' => $product->id,
                        'image' => $this->updatePath . $nameImage,
                        'is_thumbnail' => false,
                    ]);
                }
            }

            // =====================================================
            // DELETE OLD ITEMS
            // =====================================================

            ProductItem::where(
                'product_id',
                $product->id
            )->delete();


            // =====================================================
            // FACILITY
            // =====================================================

            foreach ($validated['facility'] ?? [] as $facility) {

                if (!$facility) {
                    continue;
                }

                ProductItem::create([
                    'product_id' => $product->id,
                    'type' => 'FACILITY',
                    'name' => $facility,
                ]);
            }


            // =====================================================
            // INCLUDED
            // =====================================================

            foreach ($validated['included'] ?? [] as $included) {

                if (!$included) {
                    continue;
                }

                ProductItem::create([
                    'product_id' => $product->id,
                    'type' => 'INCLUDE',
                    'name' => $included,
                ]);
            }


            // =====================================================
            // EXCLUDED
            // =====================================================

            foreach ($validated['excluded'] ?? [] as $excluded) {

                if (!$excluded) {
                    continue;
                }

                ProductItem::create([
                    'product_id' => $product->id,
                    'type' => 'EXCLUDE',
                    'name' => $excluded,
                ]);
            }


            // =====================================================
            // COMMIT
            // =====================================================

            DB::commit();

            return redirect()
                ->route('dashboard.product.index')
                ->with('success', 'Properti berhasil diperbarui.');

        } catch (\Throwable $e) {

            DB::rollBack();

            return back()
                ->withInput()
                ->with(
                    'error',
                    'Gagal memperbarui properti: ' . $e->getMessage()
                );
        }
    }

    public function delete($id)
    {
        DB::beginTransaction();

        try {

            $product = Product::with([
                'items',
                'images'
            ])->findOrFail($id);


            // =====================================================
            // DELETE THUMBNAIL
            // =====================================================

            if ($product->thumbnail) {

                Storage::disk('public')->delete(
                    $product->thumbnail
                );
            }


            // =====================================================
            // DELETE GALLERY IMAGES
            // =====================================================

            foreach ($product->images as $image) {

                if ($image->image) {

                    Storage::disk('public')->delete(
                        $image->image
                    );
                }

                $image->delete();
            }


            // =====================================================
            // DELETE ITEMS
            // =====================================================

            foreach ($product->items as $item) {
                $item->delete();
            }


            // =====================================================
            // DELETE PRODUCT
            // =====================================================

            $product->delete();


            DB::commit();

            return redirect()
                ->route('dashboard.product.index')
                ->with('success', 'Properti berhasil dihapus.');

        } catch (\Throwable $e) {

            DB::rollBack();

            return back()
                ->with('error', 'Gagal menghapus properti: ' . $e->getMessage());
        }
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
