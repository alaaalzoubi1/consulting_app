<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Times extends Model
{
    use HasFactory;
    public function days_time()
    {
        return $this->hasMany('Days');
    }
    public function user_times()
    {
        return $this->belongsToMany('User' , 'Reservation');
    }
}
