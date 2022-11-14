<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LaundryPkgOrderItem extends Model
{
    protected $guarded = [];
    
    public function package() {
        //return $this->belongsTo(LaundryPackage::class, 'package_id', 'id')->with('items');
        return $this->belongsTo(LaundryPackage::class, 'package_id', 'id');
    }

    public function service() {
        return $this->belongsTo(LaundryProductService::class, 'service_id', 'id');
    }

    public function product() {
        return $this->belongsTo(LaundryProduct::class, 'product_id', 'id');
    }
}
