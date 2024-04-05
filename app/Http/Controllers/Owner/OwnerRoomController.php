<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\Kost;
use App\Models\Room;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class OwnerRoomController extends Controller
{
    public function add()
    {
        $page = 'kost-owner';
        $kosts = Kost::where('user_id', Auth::user()->id)->get();
        return view('owner.room.add', compact('page', 'kosts'));
    }

    private function checkRooms($id)
    {
        $kamar = Kost::where('id', $id)->value('rooms');;
        $jumlah_kamar = Room::where('kost_id', $id)->count();

        return $jumlah_kamar >= $kamar;
    }

    public function store(Request $request)
    {
        $request->validate([
            'kost_id' => 'required',
            'roomNumber' => 'required',
            'price' => 'required',
            'status' => 'required',
            'file' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $kost_id = $request->kost_id;
        if ($this->checkRooms($kost_id)) {
            return redirect()->route('kostOwner-show')->with('error', 'Jumlah kamar sudah mencapai batas');
        }
        $store = new Room();
        $store->kost_id = $kost_id;
        $store->room_number = $request->roomNumber;
        $store->fasilitas = $request->fasilitas;
        $store->price = $request->price;
        $store->status = $request->status;
        if ($request->file('file')) {
            $ext = $request->file('file')->getClientOriginalExtension();
            if ($ext == 'png' || $ext == 'jpg' || $ext == 'jpeg') {
                $ext = $request->file('file')->extension();
                $final = 'photo' . time() . '.' . $ext;

                // menyimpan gambar asli
                $request->file('file')->storeAs('public/images/rooms', $final);
                $store->file = $final;
            }
        }
        $store->save();
        return redirect()->route('kostOwner-show');
    }

    public function edit($id)
    {
        $page = 'kost-owner';
        $kosts = Kost::where('user_id', Auth::user()->id)->get();
        $edit = Room::where('id', $id)->first();
        return view('owner.room.edit', compact('page', 'edit', 'kosts'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'kost_id' => 'required',
            'roomNumber' => 'required',
            'price' => 'required',
            'status' => 'required'
        ]);

        $update = Room::where('id', $id)->first();
        $update->kost_id = $request->kost_id;
        $update->room_number = $request->roomNumber;
        $update->fasilitas = $request->fasilitas;
        $update->price = $request->price;
        $update->status = $request->status;

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $ext = $file->getClientOriginalExtension();
            if (in_array($ext, ['png', 'jpg', 'jpeg'])) {
                $final = 'photo' . time() . '.' . $ext;
                $file->storeAs('public/images/rooms', $final);
                if (!empty($update->file)) {
                    // Hapus file gambar sebelumnya jika ada
                    Storage::delete('public/images/rooms/' . $update->file);
                }
                $update->file = $final;
            }
        }

        $update->update();
        return redirect()->route('kostOwner-show');
    }

    public function destroy($id)
    {
        $room = Room::findOrFail($id);

        if (!empty($room->file)) {
            Storage::delete('public/images/rooms/' . $room->file);
        }

        $room->delete();
        return redirect()->route('kostOwner-show');
    }
}
