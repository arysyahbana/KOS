<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Kost;
use App\Models\Room;
use Illuminate\Http\Request;

class ClientKostController extends Controller
{
    public function show()
    {
        $page = 'kost-client';
        $kosts = Kost::get();
        return view('client.kost.index', compact('page', 'kosts'));
    }

    public function detail($id)
    {
        $page = 'kost-client';
        $rooms = Room::where('kost_id', $id)->get();
        return view('client.room.index', compact('page', 'rooms'));
    }
}
