<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmployeeAgent extends Model
{
    protected $guarded = [];

    public function agent(){
        return $this->belongsTo(Agent::class);
    }

    public function employee(){
        return $this->belongsTo(Employee::class);
    }
}
