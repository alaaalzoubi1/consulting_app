<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Laravel\Sanctum\HasApiTokens;

class Expert extends Model
{
    use HasFactory, HasApiTokens;
    protected $table = "experts";
    protected $fillable = [
        "img",
        "address",
        "description",
        "rate",
        "user_id"
    ];
    public $timestamps = true;
    public function user1() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }
        public function user()
    {
        return $this->belongsToMany(User::class,'favourites');
    }
    public function expert_con()
    {
        return $this->belongsToMany('Consulting' , 'Expert_con');
    }
    public function expert_days()
    {
        return $this->belongsTo('Days');
    }
}
