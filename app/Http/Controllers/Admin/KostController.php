<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kost;
use App\Models\User;
use Illuminate\Http\Request;

class KostController extends Controller
{
    public function show()
    {
        $page = 'kost';
        $kosts = Kost::get();
        return view('admin.kosts.index', compact('page', 'kosts'));
    }

    public function add()
    {
        $page = 'kost';
        $users = User::get();
        return view('admin.kosts.add', compact('page', 'users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'name' => 'required',
            'alamat' => 'required',
            'room' => 'required'
        ]);

        $store = new Kost();
        $store->user_id = $request->user_id;
        $store->name = $request->name;
        $store->alamat = $request->alamat;
        $store->rooms = $request->room;
        $store->save();
        return redirect()->route('kost-show');
    }

    public function edit($id)
    {
        $page = 'kost';
        $users = User::get();
        $edit = Kost::where('id', $id)->first();
        return view('admin.kosts.edit', compact('page', 'edit', 'users'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'user_id' => 'required',
            'name' => 'required',
            'alamat' => 'required',
            'room' => 'required'
        ]);

        $update = Kost::where('id', $id)->first();
        $update->user_id = $request->user_id;
        $update->name = $request->name;
        $update->alamat = $request->alamat;
        $update->rooms = $request->room;
        $update->update();
        return redirect()->route('kost-show');
    }

    public function destroy($id)
    {
        Kost::where('id', $id)->delete();
        return redirect()->route('kost-show');
    }
}
