<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kost;
use App\Models\Room;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    public function show()
    {
        $page = 'room';
        $rooms = Room::get();
        return view('admin.room.index', compact('page', 'rooms'));
    }

    public function add()
    {
        $page = 'room';
        $kosts = Kost::get();
        return view('admin.room.add', compact('page', 'kosts'));
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
        $store->save();
        return redirect()->route('room-show');
    }

    public function edit($id)
    {
        $page = 'room';
        $kosts = Kost::get();
        $edit = Room::where('id', $id)->first();
        return view('admin.room.edit', compact('page', 'edit', 'kosts'));
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
        return redirect()->route('room-show');
    }

    public function destroy($id)
    {
        Room::where('id', $id)->delete();
        return redirect()->route('room-show');
    }
}
