<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        $page = 'profile';
        return view('admin.profile.index', [
            'user' => $request->user(),

        ], compact('page'));
    }

    /**
     * Update the user's profile information.
     */
    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'hp' => 'required',
            'foto' => 'mimes:png,jpg,jpeg',
        ]);

        $update = User::where('id', Auth::user()->id)->first();
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $ext = $file->getClientOriginalExtension();

            if ($update->foto == '') {
                if (storage_path('app/public/images/profile/')) {
                    if ($ext == 'png' || $ext == 'jpg' || $ext == 'jpeg') {
                        $ext = $file->extension();
                        $final = 'profile' . time() . '.' . $ext;

                        $request->file('foto')->move(storage_path('app/public/images/profile/'), $final);
                        $update->foto = $final;
                    }
                }
            } elseif ($update->foto) {
                unlink(storage_path('app/public/images/profile/' . $update->foto));
                if ($ext == 'png' || $ext == 'jpg' || $ext == 'jpeg') {
                    $ext = $file->extension();
                    $final = 'profile' . time() . '.' . $ext;

                    $request->file('foto')->move(storage_path('app/public/images/profile/'), $final);
                    $update->foto = $final;
                }
            }
        }
        $hp = $request->input('hp');

        if (substr($hp, 0, 1) === '0') {
            $hp = '+62' . substr($hp, 1);
        }
        $update->name = $request->name;
        $update->email = $request->email;
        $update->hp = $hp;
        $update->alamat = $request->alamat;
        $update->password = Hash::make($request->password);
        $update->save();
        return redirect()->route('owner-panel');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request)
    {
        $delete = User::findOrFail(Auth::user()->id);
        $delete->delete();

        return redirect()->route('client-panel');
    }

    public function edit_client(Request $request)
    {
        $page = 'profile-client';
        return view('client.profile.index', [
            'user' => $request->user(),

        ], compact('page'));
    }

    public function update_client(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'hp' => 'required',
            'foto' => 'mimes:png,jpg,jpeg',
        ]);

        $update = User::where('id', Auth::user()->id)->first();
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $ext = $file->getClientOriginalExtension();

            if ($update->foto == '') {
                if (storage_path('app/public/images/profile/')) {
                    if ($ext == 'png' || $ext == 'jpg' || $ext == 'jpeg') {
                        $ext = $file->extension();
                        $final = 'profile' . time() . '.' . $ext;

                        $request->file('foto')->move(storage_path('app/public/images/profile/'), $final);
                        $update->foto = $final;
                    }
                }
            } elseif ($update->foto) {
                unlink(storage_path('app/public/images/profile/' . $update->foto));
                if ($ext == 'png' || $ext == 'jpg' || $ext == 'jpeg') {
                    $ext = $file->extension();
                    $final = 'profile' . time() . '.' . $ext;

                    $request->file('foto')->move(storage_path('app/public/images/profile/'), $final);
                    $update->foto = $final;
                }
            }
        }
        $hp = $request->input('hp');

        if (substr($hp, 0, 1) === '0') {
            $hp = '+62' . substr($hp, 1);
        }
        $update->name = $request->name;
        $update->email = $request->email;
        $update->hp = $hp;
        $update->alamat = $request->alamat;
        $update->password = Hash::make($request->password);
        $update->save();
        return redirect()->route('profileClient-show');
    }
}
