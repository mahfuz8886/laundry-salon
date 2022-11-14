<?php

namespace App;

use Employe;
use Illuminate\Database\Eloquent\Model;
use ReflectionFunctionAbstract;

class LaundryOrderEmployee extends Model
{
    protected $guarded = [];

    public function employee() {
        return $this->belongsTo(Employee::class);
    }

}
