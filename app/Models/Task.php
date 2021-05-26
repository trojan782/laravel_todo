<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;
    //the relationship for the task and the user
    public function user() {
        return $this->belongsTo(User::class);
    }

    // protected $filliable = ['description'];
}