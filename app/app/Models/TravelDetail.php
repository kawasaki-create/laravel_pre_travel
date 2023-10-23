<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TravelDetail extends Model
{
    use HasFactory;

    public function travelDetail()
    {
        return $this->hasMany(travelDetail::class);
    }
}
