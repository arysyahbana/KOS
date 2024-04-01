<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\Kost;
use App\Models\Room;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

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

        if ($kamar < $jumlah_kamar) {
            return back();
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'kost_id' => 'required',
            'roomNumber' => 'required',
            'price' => 'required',
            'status' => 'required'
        ]);

        $store = new Room();
        $store->kost_id = $request->kost_id;
        $store->room_number = $request->roomNumber;
        $store->price = $request->price;
        $store->status = $request->status;
        // dd($request->kost_id);
        $this->checkRooms($request->kost_id);
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
        $update->price = $request->price;
        $update->status = $request->status;
        $update->update();
        return redirect()->route('kostOwner-show');
    }

    public function destroy($id)
    {
        Room::where('id', $id)->delete();
        return redirect()->route('kostOwner-show');
    }
}
