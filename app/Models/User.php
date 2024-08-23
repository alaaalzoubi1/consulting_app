<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Laravel\Sanctum\HasApiTokens;

class User extends Model
{
    use HasFactory, HasApiTokens;
    protected $table = "users";
    protected $fillable = [
        "name",
        "phone_num",
        "password"
    ];
    public $timestamps = true;
    public function expert1():HasOne
    {
        return $this->hasOne(Expert::class,'user_id');
    }
//    public function favourate()
//    {
//        return $this->hasMany(favourite::class,'user_id');
//    }
    public function expert()
    {
        return $this->belongsToMany(Expert::class,'favourites');
    }
    public function user_times()
    {
        return $this->belongsToMany('Times' , 'Reservation');
    }
}
