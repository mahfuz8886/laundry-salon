<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\PromotionalDiscount;
use Brian2694\Toastr\Facades\Toastr;

class PromotionalDiscountController extends Controller
{
    public function add(Request $request){
        $discount = PromotionalDiscount::first();
        return view('backEnd.promotional_discount.add', compact('discount'));
    }

    public function store(Request $request){
        $discount = PromotionalDiscount::first();
        if ($discount) {
            $discount->update([
                'start_date' => date('Y-m-d', strtotime($request->start_date)),
                'end_date' => date('Y-m-d', strtotime($request->end_date)),
                'discount' => $request->discount,
                'status' => $request->status
            ]);
        }else{
            PromotionalDiscount::create([
                'start_date' => date('Y-m-d', strtotime($request->start_date)),
                'end_date' => date('Y-m-d', strtotime($request->end_date)),
                'discount' => $request->discount,
                'status' => $request->status
            ]);
        }
        Toastr::success('message', 'Promotional discount added successfully done.');
        return redirect()->back();
    }

    public function inactive(Request $request){
        $discount = PromotionalDiscount::first();
        if ($discount) {
            $discount->update([
                'status' => 0
            ]);
        }
        return redirect()->back();
    }

    public function active(Request $request){
        $discount = PromotionalDiscount::first();
        if ($discount) {
            $discount->update([
                'status' => 1
            ]);
        }
        return redirect()->back();
    }
}
