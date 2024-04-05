<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\Kost;
use App\Models\Reservation;
use App\Models\Room;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class OwnerReservationController extends Controller
{
    public function show()
    {
        $page = 'res-owner';
        $owner_id = Auth::user()->id;
        $res = Reservation::join('rooms', 'reservations.room_id', '=', 'rooms.id')
            ->join('kosts', 'rooms.kost_id', '=', 'kosts.id')
            ->join('users as clients', 'reservations.user_id', '=', 'clients.id')
            ->where('kosts.user_id', $owner_id)
            ->with('rKost')
            ->select('reservations.*', 'clients.name as client_name') // Memilih kolom yang dibutuhkan
            ->get();
        // dd($res);
        // die;
        return view('owner.reservation.index', compact('page', 'res'));
    }

    public function status($id)
    {
        $reservation = Reservation::findOrFail($id);

        $reservation->status = 'Terisi';
        $reservation->save();

        $room = $reservation->rRoom;
        $room->status = 'Terisi';
        $room->save();

        $kost_id = $room->kost_id;
        $kost = Kost::findOrFail($kost_id);
        $kost->decrement('rooms');

        return redirect()->route('resOwner-show');
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
        return redirect()->route('resOwner-show');
    }
}
