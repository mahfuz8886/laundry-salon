<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    protected $guarded = [];

    public function division(){
        return $this->belongsTo(Division::class);
    }

    public function district(){
        return $this->belongsTo(District::class);
    }

    public function thana(){
        return $this->belongsTo(Thana::class);
    }

    public function deliveryman(){
        return $this->belongsTo(Deliveryman::class, 'deliverymen_id');
    }

    public function pickupman(){
        return $this->belongsTo(Pickupman::class);
    }
}
