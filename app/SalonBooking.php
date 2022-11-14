<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SalonBooking extends Model
{
    protected $guarded = [];

    public function statusName() {
        return $this->belongsTo(Parceltype::class, 'status', 'id');
    }

    public function customer() {
        return $this->belongsTo(Customer::class);
    }

    public function address() {
        return $this->belongsTo(CustomerAddress::class, 'customer_address_id', 'id')->with('division')->with('district')->with('thana');
    }

    public function bookingitem() {
        //return $this->hasMany(SalonBookingItem::class,'booking_id', 'id')->with('servicename', 'employee');
        return $this->hasMany(SalonBookingItem::class,'booking_id', 'id')->with('employee');
    }

    // public function work_completed() {
        
    // }

}
