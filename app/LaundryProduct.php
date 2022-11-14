<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LaundryProduct extends Model
{
    protected $guarded = [];

    public function service() {
        return $this->hasMany(ProductService::class, 'laundry_product_id')->with('serviceName');
    }

    public function category() {
        return $this->belongsTo(LaundryProductCategory::class,'category_id','id');
    }

    public function branch() {
        return $this->hasMany(LaundryProductBranch::class, 'laundry_product_id')->with('hub');
    }

    public function branchPermission() {
        return $this->hasMany(LaundryProductBranch::class, 'laundry_product_id','id');
    }



}
