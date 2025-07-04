<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TravelPlan extends Model
{
    use HasFactory;

    public function tweet()
    {
        return $this->hasMany(Tweet::class);
    }

    public function belonging()
    {
        return $this->hasMany(Belonging::class);
    }

    public function travelDetail()
    {
        return $this->hasMany(TravelDetail::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
