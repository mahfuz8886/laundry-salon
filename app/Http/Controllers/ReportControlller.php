<?php

namespace App\Http\Controllers;

use App\Customer;
use App\CustomerAddress;
use App\Deliveryman;
use App\Employee;
use App\helper\CustomHelper;
use App\Hub;
use App\Merchant;
use App\SalonCart;
use App\SalonCartItem;
use App\Parcel;
use App\Parceltype;
use App\Pickupman;
use App\SalonBooking;
use App\SalonBookingItem;
use App\SalonCategory;
use App\SalonDiscount;
use App\SalonService;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ReportControlller extends Controller
{
    public function merchantBasedParcels(Request $request)
    {
        $per_page = $request->per_page ?? 100;
        $merchants = Merchant::orderBy('firstName')->verify()->where('status', 1)->get();
        $merchant_info = Merchant::find($request->merchant_id);
        $parcel_types = Parceltype::all();
        $parcels = [];
        $total = [];
        $query = Parcel::orderBy('id', 'desc')->with('parcelStatus');
        if ($request->merchant_id) {
            $query->where('merchantId', $request->merchant_id);

            if ($request->start_date && $request->end_date) {
                $query->whereBetween('created_at', [date('Y-m-d', strtotime($request->start_date)), date('Y-m-d', strtotime($request->end_date))]);
            }
            if ($request->status) {
                $query->where('status', $request->status);
            }

            if ($request->trackingCode) {
                $query->where('trackingCode', $request->trackingCode);
            }
            $parcels = $query->get();
            $total = [
                'parcel' => $parcels->count(),
                'cod' => $parcels->whereIn('status', [4, 6, 7, 8])->sum('cod'),
                'delivery_charge' => $parcels->whereIn('status', [4, 6, 7, 8])->sum('deliveryCharge'),
                'cod_charge' => $parcels->whereIn('status', [4, 6, 7, 8])->sum('codCharge'),
                'merchant_amount' => $parcels->whereIn('status', [4, 6, 7, 8])->sum('merchantAmount'),
                'merchant_payable' => $parcels->whereIn('status', [4, 6, 7, 8])->sum('merchantDue'),
                'merchant_paid' => $parcels->whereIn('status', [4, 6, 7, 8])->sum('merchantPaid'),
            ];
        }
        // dd($parcels);
        return view('backEnd.report.merchant_based_parcels', compact('parcels', 'total', 'parcel_types', 'merchant_info', 'merchants'));
    }

    public function pickupmanBasedParcels(Request $request)
    {
        $per_page = $request->per_page ?? 100;
        $pickupmans = Pickupman::orderBy('name')->where('status', 1)->get();
        $pickupman_info = Pickupman::find($request->pickupman_id);
        $parcel_types = Parceltype::all();
        $parcels = [];
        $query = Parcel::orderBy('id', 'desc')->with('parcelStatus');
        if ($request->pickupman_id) {
            $query->where('pickupmanId', $request->pickupman_id);

            if ($request->start_date && $request->end_date) {
                $query->whereBetween('created_at', [date('Y-m-d', strtotime($request->start_date)), date('Y-m-d', strtotime($request->end_date))]);
            }

            if ($request->status) {
                $query->where('status', $request->status);
            }

            if ($request->trackingCode) {
                $query->where('trackingCode', $request->trackingCode);
            }

            $parcels = $query->get();
        }
        // dd($parcels);
        return view('backEnd.report.pickupman_based_parcels', compact('parcels', 'pickupman_info', 'parcel_types', 'pickupmans'));
    }

    public function deliverymanBasedParcels(Request $request)
    {
        $deliverymans = Deliveryman::orderBy('name')->where('status', 1)->get();
        $deliveryman_info = Deliveryman::find($request->deliveryman_id);
        $parcel_types = Parceltype::all();
        $parcels = [];
        $query = Parcel::orderBy('id', 'desc')->with('parcelStatus');
        if ($request->deliveryman_id) {
            $query->where('deliverymanId', $request->deliveryman_id);

            if ($request->start_date && $request->end_date) {
                $query->whereBetween('created_at', [date('Y-m-d', strtotime($request->start_date)), date('Y-m-d', strtotime($request->end_date))]);
            }

            if ($request->status) {
                $query->where('status', $request->status);
            }

            if ($request->trackingCode) {
                $query->where('trackingCode', $request->trackingCode);
            }

            $parcels = $query->get();
        }
        // dd($parcels);
        return view('backEnd.report.deliveryman_based_parcels', compact('parcels', 'deliveryman_info', 'parcel_types', 'deliverymans'));
    }

    // mahfuz change
    public function saleShow() {

        $branches = CustomHelper::getUserBranch();
        if($branches) {
            $allBranch = Hub::where('status', 1)->whereIn('id', $branches)->get();
        }else {
            $allBranch = Hub::where('status', 1)->get();
        }

        // $branches = Hub::where('status', 1)->get();
        $customers = Customer::where('status', 1)->where('origin', Session::get('section'))->get();
        //$employees = Employee::where('status', 1)->get();// add more filter like branch, origin etc.
        $employees = Employee::where('status', 1)->where('origin', 2)->get();
        $categories = SalonCategory::where('status', 'Active')->get();
        //$salon_services = SalonService::where('status', 'Active')->with('employee')->get();
        $salon_services = SalonService::where('status', 'Active')->get();
        $count = SalonBooking::count();
        $invoice_no = str_pad($count + 1, 5, 0, STR_PAD_LEFT);
        //return $invoice_no;
        return view('backEnd.salon.sale.create', compact('allBranch', 'customers', 'salon_services', 'categories', 'invoice_no', 'employees'));
    }

    public function cartServiceStore(Request $request) {
         //return $request->all();
        $validate = $request->validate([
            'branch_id' => 'required',
            'customer_id' => 'required',
            'employee_id' => 'required',
            'service_id.*' => 'required',
            'space.*' => 'required',
            'price_per_space.*' => 'required',
        ]);

        // previous
        /*
        $customerAddress = CustomerAddress::where('customer_id', $request->customer_id)->where('is_default', 'yes')->first();

        $createCart = new SalonBooking();
        $createCart->customer_id = $request->customer_id;
        $createCart->customer_address_id = $customerAddress? $customerAddress->id:0;
        $createCart->branch_id = $request->branch_id;
        $createCart->payment_method_id = 1;
        $createCart->status = 11;
        $createCart->paid_status = 1;
        $createCart->payment_method = $request->payment_method;
        $createCart->origin = 'Quick';
        $createCart->invoice_no = $request->invoice_no;
        $createCart->save();
        $cartId = $createCart->id;

        $total = 0;
        foreach($request->service_id as $key => $service_id) {
            $cart_items = new SalonBookingItem();
            $cart_items->booking_id = $cartId;
            $cart_items->customer_id = $request->customer_id;
            $cart_items->category_id = $request->category_id[$key];
            $cart_items->service_id = $request->service_id[$key];
            $cart_items->employee_id = $request->employee_id;
            $cart_items->booking_date = $request->booking_date;
            $cart_items->schedule = $request->schedule;
            $cart_items->discount = 0;
            $cart_items->time_schedule = 0;
            $cart_items->space = $request->space[$key];
            $cart_items->space_amount = $request->price_per_space[$key];
            $cart_items->total = $request->price_per_space[$key] * $request->space[$key];
            $cart_items->save();
        }

        Toastr::success('Booking successful');
        return redirect()->back();
        // previous
        */


        $legth = sizeof($request->service_id);
        $check = SalonBooking::where('branch_id', $request->branch_id)
            ->whereIn('status', array(1,10,11))
            ->first();

        /*if($check) {
            for ($i=0; $i < $legth; $i++) { 
                
                //get service
                $serviceInfo = SalonService::where('id', $request->service_id[$i])->first();
                
                //check time schedul
                $item = SalonBookingItem::where('service_id', $services[$i])
                        ->where('time_schedule', $schedules[$i])
                        ->where('booking_date', date('Y-m-d', strtotime($bookingDates[$i])))
                        ->where('employee_id', $employees[$i])
                        ->first();
                if($item) {
                    //time slot is not available
                    //check multiple booking allow or not
                    if(!$serviceInfo->allow_multiple_booking) {
                        Toastr::error('Time slot is not availabe for '.$serviceInfo->service_name.' in given date. Please try another time slot.');
                        return redirect()->back();
                    }
                }
                
                //check multiple space allow or not
                if($spaces[$i] > 1) {
                    if(!$serviceInfo->allow_multiple_booking) {
                        Toastr::error('Multiple space at a time not allowed for '.$serviceInfo->service_name);
                        return redirect()->back();
                    }
                }
            }
        }*/

        $customerAddress = CustomerAddress::where('customer_id', $request->customer_id)->where('is_default', 'yes')->first();

        $createCart = new SalonBooking();
        $createCart->customer_id = $request->customer_id;
        $createCart->customer_address_id = $customerAddress? $customerAddress->id:0;
        $createCart->branch_id = $request->branch_id;
        $createCart->payment_method_id = 1;
        $createCart->status = 11;
        $createCart->paid_status = 1;
        $createCart->payment_method = $request->payment_method;
        $createCart->origin = 'Quick';
        $createCart->invoice_no = $request->invoice_no;
        $createCart->save();

        $bookingId = $createCart->id;
        if($bookingId) {

            //booking items
            for ($i=0; $i < $legth; $i++) { 
            
                //get service
                $serviceInfo = SalonService::where('id', $request->service_id[$i])->first();
                //get discount
                $discount = 0;
                $discountInfo = SalonDiscount::where('customer_id', $request->customer_id)
                                ->where('status', 1)
                                ->where('service_id', $request->service_id[$i])
                                ->first();

                if($discountInfo) {
                    $discount = (($serviceInfo->price_per_space * $request->space[$i]) * $discountInfo->discount) / 100;
                    $discount = round($discount);
                }

                $cart_items = new SalonBookingItem();
                $cart_items->booking_id = $bookingId;
                $cart_items->customer_id = $request->customer_id;
                $cart_items->category_id = $request->category_id[$i];
                $cart_items->service_id = $request->service_id[$i];
                $cart_items->employee_id = $request->employee_id;
                //$cart_items->booking_date = $request->booking_date;
                $cart_items->booking_date = date('Y-m-d', strtotime($request->booking_date));
                // $cart_items->schedule = $request->schedule;
                $cart_items->discount = $discount;
                $cart_items->time_schedule = 0;
                $cart_items->space = $request->space[$i];
                $cart_items->space_amount = $request->price_per_space[$i];
                $cart_items->total = ($request->price_per_space[$i] * $request->space[$i]) - $discount;
                $cart_items->save();
            }
            Toastr::success('Booking successful');

        }else {
            Toastr::error('Something was wrong');
        }
        return redirect()->back();
    }

    public function customerAdd(Request $request) {
        
        // $rules = [
        //     'firstName' => 'required',
        //     'phoneNumber' => 'required',
        //     //'phoneNumber' => 'required|numeric|unique:customers',
        // ];
        // $validator = Validator::make($request->all(), $rules);
        // if ($validator->fails()) {
        //     return response()->json(['success' => false, 'message' => $validator->errors()->first()]);
        // }
        /*$customer = new Customer();
        $customer->firstName = $request->firstName;
        $customer->phoneNumber = $request->phoneNumber;
        $customer->origin = 'Laundry';
        $customer->customer_type = $request->customer_type;
        $customer->password = bcrypt(request('phoneNumber'));
        $customer->agree         =   1;
        $customer->verify        =   1;
        $customer->status        =   1;
        $customer->save();*/
        $data = $request->all();
        $data['origin'] = 'Laundry';
        $data['password'] = bcrypt(request('phoneNumber'));
        $data['agree'] = 1;
        $data['verify'] = 1;
        $data['status'] = 1;
        $customer = Customer::create($data);
        return response()->json(['success' => true, 'message' => 'Customer has been added.']);
        //return response()->json(['success' => true, 'message' => $request->all()]);
    }


}
