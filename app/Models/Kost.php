<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kost extends Model
{
    use HasFactory;

    public function rUser()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function rRoom()
    {
        return $this->hasMany(Room::class);
    }
}
