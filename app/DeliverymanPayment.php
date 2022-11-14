<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DeliverymanPayment extends Model
{
    protected $guarded = [];

    public function deliveryman(){
        return $this->belongsTo(Deliveryman::class);
    }

    public function parcel(){
        return $this->belongsTo(Parcel::class);
    }
}
