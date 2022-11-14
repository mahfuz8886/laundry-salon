<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SalonItem extends Model
{
    protected $guarded = [];

    public function unit() {
        return $this->belongsTo(Unit::class);
    }
}
