<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kost;
use App\Models\Reservation;
use App\Models\Room;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    public function show()
    {
        $page = 'res';
        $reservations = Reservation::get();
        return view('admin.reservation.index', compact('page', 'reservations'));
    }

    public function destroy($id)
    {
        $res = Reservation::findOrFail($id);

        $room_id = $res->room_id;

        $room = Room::findOrFail($room_id);
        $room->status = 'Kosong';
        $room->save();

        $kost_id = $room->kost_id;
        $kost = Kost::findOrFail($kost_id);
        $kost->increment('rooms');

        $res->delete();
        return redirect()->route('res-show');
    }
}
