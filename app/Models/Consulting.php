<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consulting extends Model
{
    use HasFactory;
    public function expert_con()
    {
        return $this->belongsToMany('Expert' , 'Expert_con');
    }
}
