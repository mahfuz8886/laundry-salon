<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PickupmanAgent extends Model
{
    protected $guarded = [];

    public function agent(){
        return $this->belongsTo(Agent::class);
    }

    public function pickupman(){
        return $this->belongsTo(Pickupman::class);
    }
}
