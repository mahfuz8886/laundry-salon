<?php

namespace App;
use App\Parcel;
use Illuminate\Database\Eloquent\Model;

class Deliverycharge extends Model
{
    public function parcels()
    {
        return $this->hasMany(Parcel::class,'orderType','id');
    }

    public function deliveryChargeHead(){
        return $this->belongsTo(DeliveryChargeHead::class);
    }
}
