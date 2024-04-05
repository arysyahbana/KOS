<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Kost;
use App\Models\Reservation;
use App\Models\Room;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Http\Request;

class ClientHomeController extends Controller
{
    public function show(Request $request)
    {
        $page = 'home-client';
        $query = $request->input('search');
        $kosts = Kost::query()
            ->where('name', 'like', "%$query%")
            ->orWhere('alamat', 'like', "%$query%")
            ->inRandomOrder()
            ->limit(4)
            ->get();
        $rooms = Room::inRandomOrder()->limit(8)->get();
        return view('client.index', compact('kosts', 'rooms', 'page'));
    }

    public function show_kost(Request $request)
    {
        $page = 'cari-kost';
        $query = $request->input('search_kost');
        $kosts = Kost::query()
            ->where('name', 'like', "%$query%")
            ->orWhere('alamat', 'like', "%$query%")
            ->paginate(8);
        return view('client.kost.cariKos', compact('kosts', 'page'));
    }

    public function detail_kost(Request $request, $id)
    {
        $page = 'cari-kost';
        $kost = Kost::findOrFail($id);
        $query = $request->input('search_room');

        $rooms = Room::where('kost_id', $id)
            ->where(function ($queryBuilder) use ($query) {
                $queryBuilder->where('room_number', 'like', "%$query%")
                    ->orWhere('price', 'like', "%$query%")
                    ->orWhere('status', 'like', "%$query%");
            })
            ->paginate(8);
        return view('client.room.index', compact('page', 'rooms', 'kost'));
    }

    public function detail_room($id)
    {
        $page = 'cari-kost';
        $room = Room::findOrFail($id);
        $rooms = Room::where('kost_id', $room->kost_id)
            ->where('id', '<>', $id)
            ->inRandomOrder()
            ->limit(4)
            ->get();
        return view('client.room.detail', compact('page', 'room', 'rooms'));
    }

    public function show_res($id)
    {
        $page = 'show-res';
        $res = Reservation::with('rKost')->where('user_id', Auth::user()->id)->first();

        $reservations = Reservation::with('rKost')->where('user_id', Auth::user()->id)->get();
        if ($res == '') {
            $owners = [];
        } else {
            foreach ($reservations as $item) {
                $ownerIds[] = $item->rKost->user_id;
            }
            $owners = User::whereIn('id', $ownerIds)->get();
        }
        return view('client.reservasi.index', compact('page', 'reservations', 'owners', 'res'));
    }

    public function reservation($id)
    {
        $room = Room::findOrFail($id);

        if ($room->status != 'Terisi') {
            $reservation = new Reservation;
            $reservation->user_id = Auth::user()->id;
            $reservation->kost_id = $room->kost_id;
            $reservation->room_id = $room->id;
            $reservation->status = 'Pending';
            $reservation->save();

            $room->status = 'Pending';
            $room->save();

            $page = 'kost-client';
            return redirect()->route('clientShow-res', compact('page', 'room', 'id'));
        } else {
            return redirect()->back()->with('error', 'Ruangan sudah terisi.');
        }
    }

    // public function show_owner(Request $request)
    // {
    //     $page = 'owner-client';
    //     $query = $request->input('search_owner');
    //     $owner = User::where('role', 'Owner')
    //         ->where(function ($queryBuilder) use ($query) {
    //             $queryBuilder->where('name', 'like', "%$query%")
    //                 ->orWhere('email', 'like', "%$query%")
    //                 ->orWhere('alamat', 'like', "%$query%");
    //         })
    //         ->paginate(8);
    //     return view('client.owner.ownerKos', compact('owner', 'page'));
    // }
}
