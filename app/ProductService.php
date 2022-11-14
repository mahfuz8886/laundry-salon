<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductService extends Model
{
    protected $guarded = [];

    public function product()
    {
        return $this->belongsTo(LaundryProduct::class,'laundry_product_id', 'id')->with('category');
    }

    public function serviceName() {
        return $this->belongsTo(LaundryProductService::class,'laundry_service_id','id');
    }

    public function branches() {
        //return $this->hasMany(LaundryProductBranch::class, 'laundry_product_id', 'laundry_product_id')->with('hub');
        return $this->hasMany(LaundryProductBranch::class, 'laundry_product_id', 'laundry_product_id');
    }
}
