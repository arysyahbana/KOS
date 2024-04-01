<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function show()
    {
        $page = 'users';
        $users = User::get();
        return view('admin.users.index', compact('page', 'users'));
    }

    public function add()
    {
        $page = 'users';
        return view('admin.users.add', compact('page'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required'
        ]);

        $store = new User();
        $store->name = $request->name;
        $store->email = $request->email;
        $store->hp = $request->hp;
        $store->alamat = $request->alamat;
        $store->role = $request->role;
        $store->password = Hash::make($request->password);
        $store->save();
        return redirect()->route('user-show');
    }

    public function edit($id)
    {
        $page = 'users';
        $edit = User::where('id', $id)->first();
        return view('admin.users.edit', compact('page', 'edit'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
        ]);

        $update = User::where('id', $id)->first();
        $update->name = $request->name;
        $update->email = $request->email;
        $update->hp = $request->hp;
        $update->alamat = $request->alamat;
        $update->role = $request->role;
        $update->password = Hash::make($request->password);
        $update->update();
        // dd($update);
        // die;
        return redirect()->route('user-show');
    }

    public function destroy($id)
    {
        User::where('id', $id)->delete();
        return redirect()->route('user-show');
    }
}
