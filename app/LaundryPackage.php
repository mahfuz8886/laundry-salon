<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LaundryPackage extends Model {

    protected $guarded = [];

    public function items() {
        return $this->hasMany(LaundryPackageItem::class, 'package_id', 'id');
    }

    public function branch() {
        return $this->belongsTo(Hub::class, 'branch_id', 'id');
    }

}
