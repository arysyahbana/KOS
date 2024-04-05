<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;
    public function rKost()
    {
        return $this->belongsTo(Kost::class, 'kost_id', 'id');
    }

    public function rRoom()
    {
        return $this->belongsTo(Room::class, 'room_id', 'id');
    }

    public function rUser()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
