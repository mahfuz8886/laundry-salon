<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $guarded = [];

    public function product() {
        return $this->belongsTo(LaundryProduct::class,'product_id','id');
    }

    public function service() {
        return $this->belongsTo(ProductService::class,'service_id', 'id')->with('serviceName');
    }

    public function package() {
        return $this->belongsTo(LaundryPackage::class, 'package_id', 'id')->with('items');
    }
}
