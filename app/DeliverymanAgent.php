<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DeliverymanAgent extends Model
{
    protected $guarded = [];

    public function agent(){
        return $this->belongsTo(Agent::class);
    }

    public function deliveryman(){
        return $this->belongsTo(Deliveryman::class);
    }
}
