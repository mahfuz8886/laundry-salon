<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SalonDiscount extends Model {

    protected $guarded = [];

    public function customer() {
        return $this->belongsTo(Customer::class,'customer_id','id');
    }


    public function service() {
        return $this->belongsTo(SalonService::class,'service_id','id');
    }
}
