<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PickupmanPayment extends Model
{
    protected $guarded = [];

    public function parcel(){
        return $this->belongsTo(Parcel::class);
    }
    
    public function pickupman(){
        return $this->belongsTo(Pickupman::class, 'pickupman_id');
    }
}
