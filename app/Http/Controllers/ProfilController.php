<?php

namespace App\Http\Controllers;

use App\Http\Controllers\BaseController\UploadImageController;
use App\Models\Booking;
use App\Models\User;
use Illuminate\Http\Request;

class ProfilController extends UploadImageController
{
    public function index()
    {
        $data = User::where('id', auth()->user()->id)->first();
        return view(
            'pages.profil.index',
            get_defined_vars()
        );
    }

    public function profil_update (Request $request)
    {
        // dd($request->all());
        $user = User::findOrFail(auth()->user()->id);

        $validatedData = $request->validate([
            'fullname' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username,' . $user->id,
            'email' => 'required|email|unique:users,email,' . $user->id,
            'phone' => 'nullable|string|max:20',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5048',
        ]);

        if ($request->hasFile('avatar')) {

            // ==========================================
            // HAPUS AVATAR LAMA
            // ==========================================

            if (!empty($user->avatar)) {

                $oldAvatarPath = public_path($user->avatar);

                if (file_exists($oldAvatarPath)) {
                    unlink($oldAvatarPath);
                }
            }


            // ==========================================
            // UPLOAD AVATAR BARU
            // ==========================================

            $avatar = $request->file('avatar');

            $nameAvatar = time()
                . '_'
                . uniqid()
                . '.'
                . $avatar->getClientOriginalExtension();

            $destinationPath = public_path($this->uploadPath);

            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }

            $avatar->move(
                $destinationPath,
                $nameAvatar
            );

            $validatedData['avatar'] = $this->updatePath . $nameAvatar;
        }

        $user->update($validatedData);

        return redirect()->back()->with('success', 'Profil berhasil diperbarui.');
    }

    public function my_booking()
    {
        $data = User::where('id', auth()->user()->id)->first();
        $bookings = Booking::where('user_id', auth()->user()->id)->where('status', 'PENDING')->get();
        return view(
            'pages.profil.my-booking', 
            get_defined_vars()
        );
    }

    public function purchase_list()
    {
        $data = User::where('id', auth()->user()->id)->first();
        $bookings = Booking::where('user_id', auth()->user()->id)->where('status', 'PAID')->get();
        return view(
            'pages.profil.purchase-list',
            get_defined_vars()
        );
    }
}
