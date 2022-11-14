<?php

namespace App;

use Employe;
use Illuminate\Database\Eloquent\Model;

class SalonBookingItem extends Model
{
    protected $guarded = [];

    public function statusName() {
        return $this->belongsTo(Parceltype::class, 'status', 'id');
    }

    public function customer() {
        return $this->belongsTo(Customer::class);
    }

    public function service() {
        return $this->belongsTo(SalonService::class)->with('category');
    }

    public function address() {
        return $this->belongsTo(CustomerAddress::class, 'customer_address_id', 'id')->with('division')->with('district')->with('thana');
    }

    public function booking() {
        return $this->belongsTo(SalonBooking::class,'booking_id', 'id');
    }

    public function servicename() {
        return $this->belongsTo(SalonService::class,'service_id', 'id');
    }

    public function employee() {
        return $this->belongsTo(Employee::class);
    }

}
