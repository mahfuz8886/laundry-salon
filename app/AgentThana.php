<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AgentThana extends Model
{
    protected $guarded = [];

    public function agent(){
        return $this->belongsTo(Agent::class);
    }

    public function thana(){
        return $this->belongsTo(Thana::class);
    }
}
