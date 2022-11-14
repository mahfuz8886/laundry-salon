<?php

namespace App;

use Employe;
use Illuminate\Database\Eloquent\Model;

class Salary extends Model
{
    protected $guarded = [];

    public function employee() {
        return $this->belongsTo(Employee::class)->with('account_head');
    }
}
