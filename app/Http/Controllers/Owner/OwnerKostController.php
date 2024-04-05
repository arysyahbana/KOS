<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\Kost;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


class OwnerKostController extends Controller
{
    public function show()
    {
        $page = 'kost-owner';
        $user_id = Auth::user()->id;
        $kosts = Kost::where('user_id', $user_id)->get();
        $rooms = Room::whereHas('rKost', function ($query) use ($user_id) {
            $query->where('user_id', $user_id);
        })->with('rKost')->get();
        return view('owner.kosts.index', compact('page', 'kosts', 'rooms'));
    }

    public function add()
    {
        $page = 'kost-owner';
        $kosts = Kost::get();
        return view('owner.kosts.add', compact('page', 'kosts'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'file' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $store = new Kost();
        $store->user_id = Auth::user()->id;
        $store->name = $request->nama_kost;
        $store->alamat = $request->alamat;
        $store->rooms = $request->rooms;

        if ($request->file('file')) {
            $ext = $request->file('file')->getClientOriginalExtension();
            if ($ext == 'png' || $ext == 'jpg' || $ext == 'jpeg') {
                $ext = $request->file('file')->extension();
                $final = 'photo' . time() . '.' . $ext;

                // menyimpan gambar asli
                $request->file('file')->storeAs('public/images', $final);
                $store->file = $final;
            }
        }
        $store->save();
        return redirect()->route('kostOwner-show');
    }

    public function edit($id)
    {
        $page = 'kost-owner';
        $edit = Kost::where('id', $id)->first();
        return view('owner.kosts.edit', compact('page', 'edit'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'alamat' => 'required',
            'room' => 'required'
        ]);

        $update = Kost::where('id', $id)->first();
        $update->user_id = Auth::user()->id;
        $update->name = $request->name;
        $update->alamat = $request->alamat;
        $update->rooms = $request->room;

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $ext = $file->getClientOriginalExtension();
            if (in_array($ext, ['png', 'jpg', 'jpeg'])) {
                $final = 'photo' . time() . '.' . $ext;
                $file->storeAs('public/images', $final);
                if (!empty($update->file)) {
                    // Hapus file gambar sebelumnya jika ada
                    Storage::delete('public/images/' . $update->file);
                }
                $update->file = $final;
            }
        }
        $update->update();
        return redirect()->route('kostOwner-show');
    }

    public function destroy($id)
    {
        $kost = Kost::findOrFail($id);

        if (!empty($kost->file)) {
            Storage::delete('public/images/' . $kost->file);
        }

        $kost->delete();
        return redirect()->route('kostOwner-show');
    }
}
