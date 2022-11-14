<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LaundryDiscount extends Model {

    protected $guarded = [];

    public function customer() {
        return $this->belongsTo(Customer::class,'customer_id','id');
    }

    public function product() {
        return $this->belongsTo(LaundryProduct::class,'product_id','id');
    }

    public function service() {
        return $this->belongsTo(ProductService::class,'product_service_id','id');
    }
}
