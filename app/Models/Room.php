<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    public function rKost()
    {
        return $this->belongsTo(Kost::class, 'kost_id', 'id');
    }
}
