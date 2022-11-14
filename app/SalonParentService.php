<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SalonParentService extends Model {

    protected $guarded = [];

    public function category() {
        return $this->belongsTo(SalonCategory::class);
    }

}
