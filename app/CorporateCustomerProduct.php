<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CorporateCustomerProduct extends Model
{
    protected $guarded = [];

    public function product()
    {
        return $this->belongsTo(LaundryProduct::class,'product_id');
    }

    public function serviceName() {
        //return $this->belongsTo(ProductService::class,'service_id')->with('serviceName');
        return $this->belongsTo(LaundryProductService::class,'service_id');
    }
}
