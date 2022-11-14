<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DeliveryChargeHead extends Model
{
    protected $guarded = [];

    public function deliveryCharges(){
        return $this->hasMany(Deliverycharge::class)->where('status',1);
    }
}
