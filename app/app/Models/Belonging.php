<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Belonging extends Model
{
    use HasFactory;

    public function TravelPlan()
    {
        return $this->belongsTo(TravelPlan::class, 'travel_plan_id');
    }
}
