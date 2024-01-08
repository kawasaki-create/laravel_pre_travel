<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tweet extends Model
{
    use HasFactory;

    public function travelPlan()
    {
        return $this->belongsTo(TravelPlan::class, 'travel_plan_id');
    }
}

