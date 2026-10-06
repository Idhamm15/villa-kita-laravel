<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController\UploadImageController;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class ManageSettingController extends UploadImageController
{
    public function index()
    {
        $data = User::where('id', auth()->id())->first();

        return view('pages.dashboard.setting.index', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

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

}