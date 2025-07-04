<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    public function Contact()
    {
        return $this->belongsTo(Contact::class, 'user_id');
    }
}

