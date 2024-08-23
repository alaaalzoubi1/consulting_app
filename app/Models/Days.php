<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Days extends Model
{
    use HasFactory;
    public function expert_days()
    {
        return $this->hasMany('Expert');
    }
    public function days_time()
    {
        return $this->belongsTo('Times');
    }
}
