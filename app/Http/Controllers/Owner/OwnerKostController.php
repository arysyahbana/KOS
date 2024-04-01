<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\Kost;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


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
        $store = new Kost();
        $store->user_id = Auth::user()->id;
        $store->name = $request->nama_kost;
        $store->alamat = $request->alamat;
        $store->rooms = $request->rooms;
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
        $update->update();
        return redirect()->route('kostOwner-show');
    }

    public function destroy($id)
    {
        Kost::where('id', $id)->delete();
        return redirect()->route('kostOwner-show');
    }
}
