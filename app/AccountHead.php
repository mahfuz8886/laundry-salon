<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class AccountHead extends Model
{
    protected $guarded = [];

    public function employee() {
        return $this->belongsTo(Employee::class, 'user_id', 'id')->where('head_type', 7);
    }

    public function tot_commission() {
        //return $this->hasMany(SalonTransaction::class, 'account_head_id', 'id')->where('transaction_type', 3)->where('in_out', 1);
        return $this->hasMany(SalonTransaction::class, 'account_head_id', 'id')->where('transaction_type', 3)->where('in_out', 1);
    }

    public function tot_paid_commission() {
        return $this->hasMany(SalonTransaction::class, 'account_head_id', 'id')->where('transaction_type', 3)->where('in_out', 2);

        /*
            $ac_head = AccountHead::where('user_id', 1)->where('head_type', 7)->first();
            //return $ac_head;
            $salon_transection = SalonTransaction::where('account_head_id', $ac_head->id)->where('transaction_type', 3)->where('in_out', 1)->get();
            $total = $salon_transection->sum('amount');
            return $total;
        */
    }

    public function today_commission() {
        return $this->hasMany(SalonTransaction::class, 'account_head_id', 'id')->where('transaction_type', 3)->where('in_out', 1)->where('created_at', 'like', '%' . date('Y-m-d') . '%');
    }

    public function advance() {
        //return $this->hasMany(SalonTransaction::class, 'account_head_id', 'id')->where('transaction_type', 3)->where('in_out', 1);
        return $this->hasMany(SalonTransaction::class, 'account_head_id', 'id')->where('transaction_type', 5)->where('in_out', 2);
    }

}
