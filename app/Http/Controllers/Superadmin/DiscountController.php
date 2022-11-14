<?php

namespace App\Http\Controllers\Superadmin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\LaundryDiscount;
use App\LaundryProduct;
use Brian2694\Toastr\Facades\Toastr;
use App\LaundryProductCategory;
use App\LaundryProductService;
use App\LaundryProductBranch;
use App\Order;
use App\OrderBilling;
use App\OrderItem;
use App\OrderShipping;
use App\ProductService;
use App\SalonDiscount;
use App\SalonService;
use Illuminate\Support\Facades\Auth;

class DiscountController extends Controller
{
    public function addLaundryDiscount() {
        return view('backEnd.discount.add');
    }

    public function storeLaundryDiscount(Request $request) {
         //return $request->all();
        $validate = $request->validate([
            'customer_type' => 'required',
            'customer_id' => 'required',
            'product.*' => 'required',
            'service.*' => 'required',
            'discount.*' => 'required|numeric',
            'status' => 'required'
        ]);
        $length = sizeof($request->product);

        for($i = 0; $i<$length; $i++) {
            $exist = LaundryDiscount::where([
                ['customer_type', $request->customer_type],
                ['customer_id', $request->customer_id],
                ['product_id', $request->product[$i]],
                ['product_service_id', $request->service[$i]]
            ])->first();

            if(!$exist) {
                $storeData = new LaundryDiscount();
                $storeData->customer_type = $request->customer_type;
                $storeData->customer_id = $request->customer_id;
                $storeData->product_id = $request->product[$i];
                $storeData->product_service_id = $request->service[$i];
                $storeData->discount = $request->discount[$i];
                $storeData->status = $request->status;
                $storeData->save();
            }
        }

        // previous
        /*$exist = LaundryDiscount::where([
            ['customer_type', $request->customer_type],
            ['customer_id', $request->customer_id],
            ['product_id', $request->product],
            ['product_service_id', $request->service]
        ])->first();

        if($exist && $exist->id) {
            Toastr::error('Discount already added');
            return redirect()->back();
        }
        
        $storeData = new LaundryDiscount();
        $storeData->customer_type = $request->customer_type;
        $storeData->customer_id = $request->customer_id;
        $storeData->product_id = $request->product;
        $storeData->product_service_id = $request->service;
        $storeData->discount = $request->discount;
        $storeData->status = $request->status;
        $storeData->save();
        $insId = $storeData->id;
        if($insId) {
            Toastr::success('Discount added successfully');
        }else {
            Toastr::error('Something was wrong');
        }*/

        Toastr::success('Discount added successfully');
        return redirect()->back();
    }

    public function manageLaundryDiscount(Request $request) {
        $discounts = LaundryDiscount::where('status', 1)
                    ->with('customer')->with('product')->with('service');
                    if($request->status != null) {
                        $discounts = $discounts->where('laundry_discounts.status', $request->status);
                    }
                    if($request->pid != null) {
                        $discounts = $discounts->where('laundry_discounts.product_id', $request->pid);
                    }
                    if($request->cid != null) {
                        $discounts = $discounts->where('laundry_discounts.customer_id', $request->cid);
                    }
                    $discounts = $discounts->orderBy('id','desc')->paginate(15);
                    //return $discounts;

        return view('backEnd.discount.discount_list', compact('discounts'));
    }

    public function getLaundryDiscount($id) {

        $discounts = LaundryDiscount::where('customer_id', $id)->with('customer')->with('product')->with('service')->get();
        //return $discounts;
        return view('backEnd.discount.edit', compact('discounts'));
    }

    public function updateLaundryDiscount(Request $request) {
        //return $request->all();
        $validate = $request->validate([
            'customer_type' => 'required',
            'customer_id' => 'required',
            'product.*' => 'required',
            'service.*' => 'required',
            'discount.*' => 'required|numeric',
            'status' => 'required'
        ]);
        $length = sizeof($request->product);

        for($i = 0; $i<$length; $i++) {
            
            if(!empty($request->id[$i])) {
                // update
                $storeData = LaundryDiscount::where('id', $request->id[$i])->first();
                $storeData->customer_type = $request->customer_type;
                $storeData->customer_id = $request->customer_id;
                $storeData->product_id = $request->product[$i];
                $storeData->product_service_id = $request->service[$i];
                $storeData->discount = $request->discount[$i];
                $storeData->status = $request->status;
                $storeData->save();
            } else {
                // insert
                $storeData = new LaundryDiscount();
                $storeData->customer_type = $request->customer_type;
                $storeData->customer_id = $request->customer_id;
                $storeData->product_id = $request->product[$i];
                $storeData->product_service_id = $request->service[$i];
                $storeData->discount = $request->discount[$i];
                $storeData->status = $request->status;
                $storeData->save();
            }
        }
        Toastr::success('Discount updated successfully');
        return redirect()->route('superadmin.laundry.manageDiscount');


        /*$validate = $request->validate([
            'customer_type' => 'required',
            'customer_id' => 'required',
            'product' => 'required',
            'service' => 'required',
            'discount' => 'required|numeric',
            'status' => 'required'
        ]);

        $storeData = LaundryDiscount::where('id', $request->id)->first();
        $storeData->customer_type = $request->customer_type;
        $storeData->customer_id = $request->customer_id;
        $storeData->product_id = $request->product;
        $storeData->product_service_id = $request->service;
        $storeData->discount = $request->discount;
        $storeData->status = $request->status;
        $storeData->save();
        $insId = $storeData->id;
        if($insId) {
            Toastr::success('Discount updated successfully');
            return redirect()->route('superadmin.laundry.manageDiscount');
        }else {
            Toastr::error('Something was wrong');
            return redirect()->back();
        } */
    }



    /*..............salon discount.................*/
    public function addSalonDiscount() {
        $services = SalonService::where('status', 'Active')->get();
        return view('backEnd.salon.discount.add', compact('services'));
    }

    public function storeSalonDiscount(Request $request) {
        // return $request->all();
        $validate = $request->validate([
            'customer_type' => 'required',
            'customer_id' => 'required',
            'service' => 'required',
            'discount' => 'required|numeric',
            'status' => 'required'
        ]);

        $services = $request->service;
        $length = sizeof($services);
        for($i=0; $i < $length; $i++) { 
            $exist = SalonDiscount::where([
                ['customer_type', $request->customer_type],
                ['customer_id', $request->customer_id],
                ['service_id', $request->service[$i]]
            ])->first();
    
            /*if($exist && $exist->id) {
                $exist->discount = $request->discount;
                $exist->save();
            } else {
                $storeData = new SalonDiscount();
                $storeData->customer_type = $request->customer_type;
                $storeData->customer_id = $request->customer_id;
                
                $storeData->service_id = $services[$i];
                $storeData->discount = $request->discount;
                $storeData->status = $request->status;
                $storeData->save();
            }*/
            if(!$exist) {
                $storeData = new SalonDiscount();
                $storeData->customer_type = $request->customer_type;
                $storeData->customer_id = $request->customer_id;
                
                $storeData->service_id = $services[$i];
                $storeData->discount = $request->discount;
                $storeData->status = $request->status;
                $storeData->save();
            }
        }

        Toastr::success('Discount added successfully');

        return redirect()->back();
    }

    public function manageSalonDiscount(Request $request) {
        $discounts = SalonDiscount::where('status', 1)
                    ->with('customer')->with('service');
                    if($request->status != null) {
                        $discounts = $discounts->where('salon_discounts.status', $request->status);
                    }
                    
                    if($request->cid != null) {
                        $discounts = $discounts->where('salon_discounts.customer_id', $request->cid);
                    }
                    $discounts = $discounts->orderBy('id','desc')->paginate(15);

        return view('backEnd.salon.discount.discount_list', compact('discounts'));
    }

    public function getSalonDiscount($id) {
        $services = SalonService::where('status', 'Active')->get();
        $discount = SalonDiscount::where('id', $id)->with('customer')->with('service')->first();
        return view('backEnd.salon.discount.edit', compact('discount','services'));
    }

    public function updateSalonDiscount(Request $request) {
        // dd($request->all());
        $validate = $request->validate([
            'customer_type' => 'required',
            'customer_id' => 'required',
            'service' => 'required',
            'discount' => 'required|numeric',
            'status' => 'required'
        ]);

        $storeData = SalonDiscount::where('id', $request->id)->first();
        $storeData->customer_type = $request->customer_type;
        $storeData->customer_id = $request->customer_id;
        $storeData->service_id = $request->service;
        $storeData->discount = $request->discount;
        $storeData->status = $request->status;
        $storeData->save();
        $insId = $storeData->id;
        if($insId) {
            Toastr::success('Discount updated successfully');
            return redirect()->route('superadmin.salon.manageDiscount');
        }else {
            Toastr::error('Something was wrong');
            return redirect()->back();
        } 
    }

}
