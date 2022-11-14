<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use ReflectionFunctionAbstract;

class Order extends Model
{
    protected $guarded = [];

    public function getAmount() {
        return $this->hasMany(OrderItem::class,'order_id','id');
    }

    public function statusName() {
        return $this->belongsTo(Parceltype::class,'order_status','id');
    }

    public function orderview() {
        return $this->belongsTo(OrderView::class);
    }

    public function package_order() {
        return $this->hasMany(OrderItem::class)->whereNotNull('package_id');
    }

    public function product_order() {
        return $this->hasMany(OrderItem::class)->whereNotNull('product_id');
    }
    public function customer() {
        return $this->belongsTo(Customer::class);
    }

}
