<?php

namespace App\Http\Controllers\FrontEnd;

use App\Agent;
use App\AgentThana;
use App\Customer;
use App\Deliveryman;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\LaundryDiscount;
use App\LaundryProduct;
use App\Merchant;
use App\Order;
use App\Parcel;
use App\Parcelnote;
use App\Parceltype;
use App\Pickup;
use App\Pickupman;
use App\PickupmanAgent;
use App\OrderItem;
use App\OrderShipping;
use App\OrderBilling;
use App\OrderView;
use App\ProductService;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class PickupmanController extends Controller
{
    public function loginform()
    {
        return view('frontEnd.layouts.pages.pickupman.login');
    }
    public function login(Request $request)
    {
        $this->validate($request, [
            'pickupman_user' => 'required',
            'pickupman_password' => 'required',
        ]);
        $checkAuth = Pickupman::where('email', $request->pickupman_user)
            ->orWhere('phone', $request->pickupman_user)
            ->first();
        if ($checkAuth) {
            if ($checkAuth->status == 0) {
                Toastr::warning('warning', 'Opps! your account has been suspends');
                return redirect()->back()->with('error', 'Opps! your account has been suspends');
            } else {
                if (password_verify($request->pickupman_password, $checkAuth->password)) {
                    $pickupmanId = $checkAuth->id;
                    Session::put('pickupmanId', $pickupmanId);
                    Toastr::success('success', 'Thanks , You are login successfully');
                    return redirect('pickupman/dashboard');
                } else {
                    Toastr::error('Opps!', 'Sorry! your password wrong');
                    return redirect()->back()->with('error', 'Sorry! your password wrong');
                }
            }
        } else {
            Toastr::error('Opps!', 'Opps! you have no account');
            return redirect()->back()->with('error', 'Opps! you have no account');
        }
    }
    public function dashboard()
    {
        $totalparcel = Parcel::where(['pickupmanId' => Session::get('pickupmanId')])->count();
        $totaldelivery = Parcel::where(['pickupmanId' => Session::get('pickupmanId'), 'status' => 4])->count();
        $totalhold = Parcel::where(['pickupmanId' => Session::get('pickupmanId'), 'status' => 5])->count();
        $totalcancel = Parcel::where(['pickupmanId' => Session::get('pickupmanId'), 'status' => 9])->count();
        $returnpendin = Parcel::where(['pickupmanId' => Session::get('pickupmanId'), 'status' => 6])->count();
        $returnmerchant = Parcel::where(['pickupmanId' => Session::get('pickupmanId'), 'status' => 8])->count();
        $total_amount = Parcel::where(['pickupmanId' => Session::get('pickupmanId')])->sum('pickupman_amount');
        $total_paid = Parcel::where(['pickupmanId' => Session::get('pickupmanId')])->sum('pickupman_paid');
        $total_due = Parcel::where(['pickupmanId' => Session::get('pickupmanId')])->sum('pickupman_due');
        return view('frontEnd.layouts.pages.pickupman.dashboard', compact(
            'totalparcel',
            'totaldelivery',
            'totalhold',
            'totalcancel',
            'returnpendin',
            'returnmerchant',
            'total_amount',
            'total_paid',
            'total_due'
        ));
    }
    // public function parcels(Request $request)
    // {
    //     $filter = $request->filter_id;
    //     if ($request->trackId != NULL) {
    //         $allparcel = DB::table('parcels')
    //             ->leftJoin('merchants', 'merchants.id', '=', 'parcels.merchantId')
    //             ->leftJoin('divisions', 'parcels.division_id', '=', 'divisions.id')
    //             ->leftJoin('districts', 'parcels.district_id', '=', 'districts.id')
    //             ->leftJoin('thanas', 'parcels.thana_id', '=', 'thanas.id')
    //             ->leftJoin('areas', 'parcels.area_id', '=', 'areas.id')
    //             ->where('parcels.pickupmanId', Session::get('pickupmanId'))
    //             ->where('parcels.trackingCode', $request->trackId)
    //             ->select('parcels.*', 'divisions.name as division', 'districts.name as district', 'thanas.name as thana', 'areas.name as area', 'merchants.firstName', 'merchants.lastName', 'merchants.phoneNumber', 'merchants.emailAddress', 'merchants.companyName', 'merchants.status as mstatus', 'merchants.id as mid')
    //             ->orderBy('parcels.status', 'asc')->orderBy('parcels.id', 'desc')
    //             ->get();
    //     } elseif ($request->phoneNumber != NULL) {
    //         $allparcel = DB::table('parcels')
    //             ->leftJoin('merchants', 'merchants.id', '=', 'parcels.merchantId')
    //             ->leftJoin('divisions', 'parcels.division_id', '=', 'divisions.id')
    //             ->leftJoin('districts', 'parcels.district_id', '=', 'districts.id')
    //             ->leftJoin('thanas', 'parcels.thana_id', '=', 'thanas.id')
    //             ->leftJoin('areas', 'parcels.area_id', '=', 'areas.id')
    //             ->where('parcels.pickupmanId', Session::get('pickupmanId'))
    //             ->where('parcels.recipientPhone', $request->phoneNumber)
    //             ->select('parcels.*', 'divisions.name as division', 'districts.name as district', 'thanas.name as thana', 'areas.name as area', 'merchants.firstName', 'merchants.lastName', 'merchants.phoneNumber', 'merchants.emailAddress', 'merchants.companyName', 'merchants.status as mstatus', 'merchants.id as mid')
    //             ->orderBy('parcels.status', 'asc')->orderBy('parcels.id', 'desc')
    //             ->get();
    //     } elseif ($request->startDate != NULL && $request->endDate != NULL) {
    //         $allparcel = DB::table('parcels')->orderBy('parcels.id', 'desc')
    //             ->leftJoin('merchants', 'merchants.id', '=', 'parcels.merchantId')
    //             ->leftJoin('divisions', 'parcels.division_id', '=', 'divisions.id')
    //             ->leftJoin('districts', 'parcels.district_id', '=', 'districts.id')
    //             ->leftJoin('thanas', 'parcels.thana_id', '=', 'thanas.id')
    //             ->leftJoin('areas', 'parcels.area_id', '=', 'areas.id')
    //             ->where('parcels.pickupmanId', Session::get('pickupmanId'))
    //             ->whereBetween('parcels.created_at', [$request->startDate, $request->endDate])
    //             ->select('parcels.*', 'divisions.name as division', 'districts.name as district', 'thanas.name as thana', 'areas.name as area', 'merchants.firstName', 'merchants.lastName', 'merchants.phoneNumber', 'merchants.emailAddress', 'merchants.companyName', 'merchants.status as mstatus', 'merchants.id as mid')
    //             ->orderBy('parcels.status', 'asc')->orderBy('parcels.id', 'desc')
    //             ->get();
    //     } elseif ($request->phoneNumber != NULL || $request->phoneNumber != NULL && $request->startDate != NULL && $request->endDate != NULL) {
    //         $allparcel = DB::table('parcels')
    //             ->leftJoin('merchants', 'merchants.id', '=', 'parcels.merchantId')
    //             ->leftJoin('divisions', 'parcels.division_id', '=', 'divisions.id')
    //             ->leftJoin('districts', 'parcels.district_id', '=', 'districts.id')
    //             ->leftJoin('thanas', 'parcels.thana_id', '=', 'thanas.id')
    //             ->leftJoin('areas', 'parcels.area_id', '=', 'areas.id')
    //             ->where('parcels.pickupmanId', Session::get('pickupmanId'))
    //             ->where('parcels.recipientPhone', $request->phoneNumber)
    //             ->whereBetween('parcels.created_at', [$request->startDate, $request->endDate])
    //             ->select('parcels.*', 'divisions.name as division', 'districts.name as district', 'thanas.name as thana', 'areas.name as area', 'merchants.firstName', 'merchants.lastName', 'merchants.phoneNumber', 'merchants.emailAddress', 'merchants.companyName', 'merchants.status as mstatus', 'merchants.id as mid')
    //             ->orderBy('parcels.status', 'asc')->orderBy('parcels.id', 'desc')
    //             ->get();
    //     } else {
    //         $allparcel = DB::table('parcels')
    //             ->leftJoin('merchants', 'merchants.id', '=', 'parcels.merchantId')
    //             ->leftJoin('divisions', 'parcels.division_id', '=', 'divisions.id')
    //             ->leftJoin('districts', 'parcels.district_id', '=', 'districts.id')
    //             ->leftJoin('thanas', 'parcels.thana_id', '=', 'thanas.id')
    //             ->leftJoin('areas', 'parcels.area_id', '=', 'areas.id')
    //             ->where('parcels.pickupmanId', Session::get('pickupmanId'))
    //             ->select('parcels.*', 'divisions.name as division', 'districts.name as district', 'thanas.name as thana', 'areas.name as area', 'merchants.companyName', 'merchants.firstName', 'merchants.lastName', 'merchants.phoneNumber', 'merchants.emailAddress')
    //             ->orderBy('parcels.status', 'asc')->orderBy('parcels.id', 'desc')
    //             ->get();
    //     }

    //     if ($request->parcel_type) {
    //         $status = Parceltype::where('slug', $request->parcel_type)->first()->id ?? '';
    //         $allparcel = $allparcel->where('status', $status);
    //     }

    //     $parceltypes = Parceltype::all();
    //     return view('frontEnd.layouts.pages.pickupman.parcels', compact('allparcel', 'parceltypes'));
    // }

    public function parcels(Request $request) {
        $orders = Order::where('pman_id','=', Session::get('pickupmanId'))->orderBy('id', 'desc');
                    if($request->status != null) {
                        $orders = $orders->where('order_status', $request->status);
                    }
                    if($request->payment_status != null) {
                        $orders = $orders->where('pay_status', $request->payment_status);
                    }
                    if($request->order_id != null) {
                        $orders = $orders->where('id', $request->order_id);
                    }
                    if($request->date_from != null) {
                        $orders = $orders->where('created_at','>=', date('Y-m-d h:i:s', strtotime($request->date_from)));
                    }
                    if($request->date_to != null) {
                        $orders = $orders->where('created_at','<=', date('Y-m-d h:i:s', strtotime($request->date_to)));
                    }
        
                    $orders = $orders->with('getAmount')->with('statusName')->paginate(20);

                    if($orders) {
                        foreach ($orders as $order) {
                            $checkExist = OrderView::where('order_id', $order->id)->where('user_id', Session::get('pickupmanId'))->where('user_type_id', 2)->first();
                            if(!$checkExist) {
                                $orderView = new OrderView();
                                $orderView->order_id = $order->id;
                                $orderView->user_id = Session::get('pickupmanId');
                                $orderView->user_type_id = 2;
                                $orderView->save();
                            }
                        }
                    }
        return view('frontEnd.layouts.pages.pickupman.order_list', compact('orders'));
    }

    public function orderDetails($id) {
        $order = Order::where('id', $id)->first();
        $orderItems = OrderItem::where('order_id', $id)->with('product')->with('service')->get();
        $shipping = OrderShipping::where('order_id', $id)->with('division')->with('district')->with('thana')->first();
        $billing = OrderBilling::where('order_id', $id)->with('division')->with('district')->with('thana')->first();
        
        return view('frontEnd.layouts.pages.pickupman.order_details',compact('order','orderItems','shipping','billing'));
    }

    public function pickedOrder($id) {
        $order = Order::where('id', $id)->first();
        $order->order_status = 2;
        $order->pman_id = Session::get('pickupmanId');
        $order->save();
        
        $orderItems = OrderItem::where('order_id', $id)->get();
        $toalItems = $orderItems->count();

        $customer = Customer::where('id', $order->customer_id)->first();

        if($order) {

            $this->addLog(Session::get('pickupmanId'), 2, 'Order picked',$order->id);

            // sent sms
            $number = $customer->phoneNumber;
            $msg = 'Welcome to laundry express. Your '.$toalItems.' items has been picked successfully';
            $this->sendSMS($number, $msg);
            
            Toastr::success('Order picked successful');
        }else {
            Toastr::error('Something was wrong');
        }
        return redirect()->back();
    }

    public function multipickupParcels(Request $request)
    {
        $allparcel = null;
        $merchants = Merchant::where('status', 1)->verify()->get();
        if ($request->merchant_id) {
            $query = DB::table('parcels')
                ->leftJoin('merchants', 'merchants.id', '=', 'parcels.merchantId')
                ->leftJoin('divisions', 'parcels.division_id', '=', 'divisions.id')
                ->leftJoin('districts', 'parcels.district_id', '=', 'districts.id')
                ->leftJoin('thanas', 'parcels.thana_id', '=', 'thanas.id')
                ->leftJoin('areas', 'parcels.area_id', '=', 'areas.id')
                ->where('parcels.merchantId', $request->merchant_id)
                ->where('parcels.pickupmanId', Session::get('pickupmanId'))
                ->where('parcels.status', 1)
                ->select('parcels.*', 'divisions.name as division', 'districts.name as district', 'thanas.name as thana', 'areas.name as area', 'merchants.companyName', 'merchants.firstName', 'merchants.lastName', 'merchants.phoneNumber', 'merchants.emailAddress')
                ->orderBy('parcels.status', 'asc')->orderBy('parcels.id', 'desc');

            if ($request->parcel_type) {
                $status = Parceltype::where('slug', $request->parcel_type)->first()->id ?? '';
                $query->where('status', $status);
            }
            $allparcel =  $query->get();
        }

        return view('frontEnd.layouts.pages.pickupman.multipickup_parcels', compact('allparcel', 'merchants'));
    }
    public function multipleParcelPicked(Request $request)
    {
        $this->validate($request, [
            'parcel_select' => 'required'
        ]);
        $total_parcel = 0;
        $tracking_codes = '';

        foreach ($request->parcel_select ?? [] as $parcel_id) {
            $parcel = Parcel::find($parcel_id);
            $merchantinfo = Merchant::find($parcel->merchantId);
            $pickupmanInfo = Pickupman::where(['id' => $parcel->pickupmanId])->first();

            if ($parcel) {
                $parcel->pickup_date = now();
                if ($pickupmanInfo) {
                    $parcel->pickupman_amount = $pickupmanInfo->per_parcel_amount;
                    $parcel->pickupman_paid = 0;
                    $parcel->pickupman_due = $pickupmanInfo->per_parcel_amount;
                }

                $parcel->status = 2;
                $parcel->save();

                $note = new Parcelnote();
                $note->parcelId = $parcel_id;
                $note->note = "Your parcel PICKED";
                $note->save();

                // Send Customer Message 
                if ($parcel->recipientPhone) {
                    $customer_numbers = $parcel->recipientPhone;
                    $customer_msg = "Dear Customer, Your Parcel Tracking ID $parcel->trackingCode for $merchantinfo->companyName , $merchantinfo->phoneNumber is PICKED. \r\n Regards,\r\n Sensor Courier ";
                    $this->sendSMS($customer_numbers, $customer_msg);
                }

                $total_parcel += 1;
                $tracking_codes .= $parcel->trackingCode . ',';
            }
        }

        $numbers = "0" . $merchantinfo->phoneNumber;
        $msg = "Dear " . $merchantinfo->companyName . ", Your Parcel Tracking ID $tracking_codes are PICKED.
                        Regards,
                        Sensor Courier";
        $this->sendSMS($numbers, $msg);

        return redirect()->back()->with('success', $total_parcel . ' parcel picked successfully done.');
    }

    public function pendingParcels(Request $request)
    {
        $pickupman = Pickupman::find(Session::get('pickupmanId'));
        $agent_ids = PickupmanAgent::where('pickupman_id', Session::get('pickupmanId'))->pluck('agent_id');
        $thana_ids = AgentThana::whereIn('agent_id', [$agent_ids])->pluck('thana_id');
        $filter = $request->filter_id;
        if ($request->trackId != NULL) {
            $allparcel = DB::table('parcels')
                ->leftJoin('merchants', 'merchants.id', '=', 'parcels.merchantId')
                ->leftJoin('divisions', 'parcels.division_id', '=', 'divisions.id')
                ->leftJoin('districts', 'parcels.district_id', '=', 'districts.id')
                ->leftJoin('thanas', 'parcels.thana_id', '=', 'thanas.id')
                ->leftJoin('areas', 'parcels.area_id', '=', 'areas.id')
                ->whereIn('parcels.pickup_thana_id', $thana_ids)
                ->whereNull('parcels.pickupmanId')
                ->where('parcels.trackingCode', $request->trackId)
                ->where('parcels.status', 1)
                ->select('parcels.*', 'divisions.name as division', 'districts.name as district', 'thanas.name as thana', 'areas.name as area', 'merchants.firstName', 'merchants.lastName', 'merchants.phoneNumber', 'merchants.emailAddress', 'merchants.companyName', 'merchants.status as mstatus', 'merchants.id as mid')
                ->orderBy('parcels.id', 'desc')
                ->get();
        } elseif ($request->phoneNumber != NULL) {
            $allparcel = DB::table('parcels')
                ->leftJoin('merchants', 'merchants.id', '=', 'parcels.merchantId')
                ->leftJoin('divisions', 'parcels.division_id', '=', 'divisions.id')
                ->leftJoin('districts', 'parcels.district_id', '=', 'districts.id')
                ->leftJoin('thanas', 'parcels.thana_id', '=', 'thanas.id')
                ->leftJoin('areas', 'parcels.area_id', '=', 'areas.id')
                ->whereIn('parcels.pickup_thana_id', $thana_ids)
                ->whereNull('parcels.pickupmanId')
                ->where('parcels.recipientPhone', $request->phoneNumber)
                ->where('parcels.status', 1)
                ->select('parcels.*', 'divisions.name as division', 'districts.name as district', 'thanas.name as thana', 'areas.name as area', 'merchants.firstName', 'merchants.lastName', 'merchants.phoneNumber', 'merchants.emailAddress', 'merchants.companyName', 'merchants.status as mstatus', 'merchants.id as mid')
                ->orderBy('parcels.id', 'desc')
                ->get();
        } elseif ($request->startDate != NULL && $request->endDate != NULL) {
            $allparcel = DB::table('parcels')
                ->leftJoin('merchants', 'merchants.id', '=', 'parcels.merchantId')
                ->leftJoin('divisions', 'parcels.division_id', '=', 'divisions.id')
                ->leftJoin('districts', 'parcels.district_id', '=', 'districts.id')
                ->leftJoin('thanas', 'parcels.thana_id', '=', 'thanas.id')
                ->leftJoin('areas', 'parcels.area_id', '=', 'areas.id')
                ->whereIn('parcels.pickup_thana_id', $thana_ids)
                ->whereNull('parcels.pickupmanId')
                ->whereBetween('parcels.created_at', [$request->startDate, $request->endDate])
                ->where('parcels.status', 1)
                ->select('parcels.*', 'divisions.name as division', 'districts.name as district', 'thanas.name as thana', 'areas.name as area', 'merchants.firstName', 'merchants.lastName', 'merchants.phoneNumber', 'merchants.emailAddress', 'merchants.companyName', 'merchants.status as mstatus', 'merchants.id as mid')
                ->orderBy('parcels.id', 'desc')
                ->get();
        } elseif ($request->phoneNumber != NULL || $request->phoneNumber != NULL && $request->startDate != NULL && $request->endDate != NULL) {
            $allparcel = DB::table('parcels')
                ->leftJoin('merchants', 'merchants.id', '=', 'parcels.merchantId')
                ->leftJoin('divisions', 'parcels.division_id', '=', 'divisions.id')
                ->leftJoin('districts', 'parcels.district_id', '=', 'districts.id')
                ->leftJoin('thanas', 'parcels.thana_id', '=', 'thanas.id')
                ->leftJoin('areas', 'parcels.area_id', '=', 'areas.id')
                ->whereIn('parcels.pickup_thana_id', $thana_ids)
                ->whereNull('parcels.pickupmanId')
                ->where('parcels.recipientPhone', $request->phoneNumber)
                ->whereBetween('parcels.created_at', [$request->startDate, $request->endDate])
                ->where('parcels.status', 1)
                ->select('parcels.*', 'divisions.name as division', 'districts.name as district', 'thanas.name as thana', 'areas.name as area', 'merchants.firstName', 'merchants.lastName', 'merchants.phoneNumber', 'merchants.emailAddress', 'merchants.companyName', 'merchants.status as mstatus', 'merchants.id as mid')
                ->orderBy('parcels.id', 'desc')
                ->get();
        } else {
            $allparcel = DB::table('parcels')
                ->leftJoin('merchants', 'merchants.id', '=', 'parcels.merchantId')
                ->leftJoin('divisions', 'parcels.division_id', '=', 'divisions.id')
                ->leftJoin('districts', 'parcels.district_id', '=', 'districts.id')
                ->leftJoin('thanas', 'parcels.thana_id', '=', 'thanas.id')
                ->leftJoin('areas', 'parcels.area_id', '=', 'areas.id')
                ->whereIn('parcels.pickup_thana_id', $thana_ids)
                ->whereNull('parcels.pickupmanId')
                ->where('parcels.status', 1)
                ->select('parcels.*', 'divisions.name as division', 'districts.name as district', 'thanas.name as thana', 'areas.name as area', 'merchants.companyName', 'merchants.firstName', 'merchants.lastName', 'merchants.phoneNumber', 'merchants.emailAddress')
                ->orderBy('parcels.id', 'desc')
                ->get();
        }
        return view('frontEnd.layouts.pages.pickupman.assignable_parcels', compact('allparcel'));
    }
    public function invoice($id)
    {
        $show_data = DB::table('parcels')
            ->leftJoin('merchants', 'merchants.id', '=', 'parcels.merchantId')
            ->leftJoin('divisions', 'parcels.division_id', '=', 'divisions.id')
            ->leftJoin('districts', 'parcels.district_id', '=', 'districts.id')
            ->leftJoin('thanas', 'parcels.thana_id', '=', 'thanas.id')
            ->leftJoin('areas', 'parcels.area_id', '=', 'areas.id')
            ->where('parcels.pickupmanId', Session::get('pickupmanId'))
            ->where('parcels.id', $id)
            ->select('parcels.*', 'divisions.name as division', 'districts.name as district', 'thanas.name as thana', 'areas.name as area', 'merchants.companyName', 'merchants.phoneNumber', 'merchants.emailAddress')
            ->first();
        if ($show_data != NULL) {
            return view('frontEnd.layouts.pages.pickupman.invoice', compact('show_data'));
        } else {
            Toastr::error('Opps!', 'Invoice not found.');
            return redirect()->back();
        }
    }

    public function pickupmanAsign(Request $request)
    {
        $this->validate($request, [
            'hidden_id' => 'required',
            'pickupmanId' => 'required',
        ]);
        $parcel = Parcel::find($request->hidden_id);
        $parcel->pickupmanId = $request->pickupmanId;
        $parcel->save();

        $pickupman = Pickupman::find($request->pickupmanId);
        $note = new Parcelnote();
        $note->parcelId = $request->hidden_id;
        $note->note = "Pickupman Asign";
        $note->remark = $pickupman->name . ' - ' . $pickupman->phone;
        $note->save();

        Toastr::success('message', 'A Pickupman asign successfully!');
        return redirect()->back();
        $pickupmanInfo = Pickupman::find($parcel->pickupmanId);
        $merchantinfo = Merchant::find($parcel->merchantId);
        // if ($merchantinfo->emailAddress) {
        //     $data = array(
        //         'contact_mail' => $merchantinfo->emailAddress,
        //         'ridername' => $pickupmanInfo->name,
        //         'riderphone' => $pickupmanInfo->phone,
        //         'codprice' => $parcel->cod,
        //         'trackingCode' => $parcel->trackingCode,
        //     );
        //     $send = Mail::send('frontEnd.emails.percelassign', $data, function ($textmsg) use ($data) {
        //         $textmsg->from('info@sensorbd.com');
        //         $textmsg->to($data['contact_mail']);
        //         $textmsg->subject('Percel Assign Notification');
        //     });
        // }

    }

    public function statusupdate(Request $request)
    {
        $this->validate($request, [
            'hidden_id' => 'required',
            'status' => 'required',
        ]);

        $parcel = Parcel::find($request->hidden_id);
        $merchantinfo = Merchant::find($parcel->merchantId);
        $deliverymanInfo = Deliveryman::where(['id' => $parcel->deliverymanId])->first();
        $pickupmanInfo = Pickupman::where(['id' => $parcel->pickupmanId])->first();

        if ($request->status == 1) {
            $parcel->merchantAmount = ($parcel->cod - $parcel->deliveryCharge - $parcel->codCharge);
            $parcel->merchantDue = ($parcel->merchantAmount - $parcel->merchantPaid);
        } elseif ($request->status == 2) {
            $parcel->pickup_date = now();
            if ($pickupmanInfo) {
                $parcel->pickupman_amount = $pickupmanInfo->per_parcel_amount;
                $parcel->pickupman_paid = 0;
                $parcel->pickupman_due = $pickupmanInfo->per_parcel_amount;
                $parcel->save();
            }

            if ($pickupmanInfo != NULL) {
                // Sens Merchant message
                $numbers = "0" . $merchantinfo->phoneNumber;
                $msg = "Dear " . $merchantinfo->companyName . ", Your Parcel Tracking ID $parcel->trackingCode for $pickupmanInfo->name , $pickupmanInfo->phone is PICKED.
                        Regards,
                        Sensor Courier";
                $this->sendSMS($numbers, $msg);
            }
            if ($parcel->recipientPhone) {
                $msg = "Dear " . $parcel->recipientName . ", Your Parcel Tracking ID $parcel->trackingCode is PICKED.
                        Regards,
                        Sensor Courier";
                $this->sendSMS($parcel->recipientPhone, $msg);
            }
        } elseif ($request->status == 3) {
            $parcel->merchantAmount = ($parcel->cod - $parcel->deliveryCharge - $parcel->codCharge);
            $parcel->merchantDue = ($parcel->merchantAmount - $parcel->merchantPaid);
        } elseif ($request->status == 4) {
            $parcel->merchantDue = $parcel->merchantAmount;
            $parcel->delivery_date = now();
            if ($deliverymanInfo) {
                $parcel->deliveryman_amount = $deliverymanInfo->per_parcel_amount;
                $parcel->deliveryman_paid = 0;
                $parcel->deliveryman_due = $deliverymanInfo->per_parcel_amount;
            }
            $parcel->save();

            $validMerchant = Merchant::find($parcel->merchantId);
            // Send Merchant message
            $numbers = "0" . $validMerchant->phoneNumber;
            $msg = "Dear Merchant, Your Parcel Tracking ID $parcel->trackingCode for $validMerchant->companyName , $validMerchant->phoneNumber is on Deliverd. \r\n Regards,\r\n Sensor Courier";
            $this->sendSMS($numbers, $msg);

            // Send Customer message
            $customer_numbers = $parcel->recipientPhone;
            $customer_msg = "Dear Customer, Your Parcel Tracking ID $parcel->trackingCode for $validMerchant->companyName , $validMerchant->phoneNumber is on Deliverd.  \r\n Regards,\r\n Sensor Courier ";
            $this->sendSMS($customer_numbers, $customer_msg);
        } elseif ($request->status == 5) {
            if ($deliverymanInfo) {
                // Send Customer message
                $customer_numbers = $parcel->recipientPhone;
                $customer_msg = "Dear Customer, Your Parcel Tracking ID $parcel->trackingCode for $deliverymanInfo->name , $deliverymanInfo->phone is on HOLD. \r\n Regards,\r\n Sensor Courier ";
                $this->sendSMS($customer_numbers, $customer_msg);
            }
        } elseif ($request->status == 9) {
            if ($parcel->status < 2) {
                $parcel->cod = 0;
                $parcel->merchantAmount = 0;
                $parcel->merchantDue = 0;
                $parcel->deliveryCharge = 0;
                $parcel->codCharge = 0;
            }
        } else {
            $parcel->cod = 0;
            $parcel->codCharge = 0;
            $parcel->merchantAmount = ($parcel->cod - $parcel->deliveryCharge);
            $parcel->merchantDue = ($parcel->merchantAmount - $parcel->merchantPaid);

            $validMerchant = Merchant::find($parcel->merchantId);
            // Send Merchant message
            $numbers = "0" . $validMerchant->phoneNumber;
            $msg = "Dear Merchant, Your Parcel Tracking ID $parcel->trackingCode for $validMerchant->companyName , $validMerchant->phoneNumber is RETURN. \r\n Regards,\r\n Sensor Courier";
            $this->sendSMS($numbers, $msg);
        }

        $parcel->status = $request->status;
        $parcel->save();

        $pnote = Parceltype::find($request->status);
        $note = new Parcelnote();
        $note->parcelId = $request->hidden_id;
        $note->note = "Your parcel " . $pnote->title;
        $note->save();

        Toastr::success('message', 'Parcel information update successfully!');
        return redirect()->back();
    }
    public function pickup()
    {
        $show_data = DB::table('pickups')
            ->where('pickups.pickupman', Session::get('pickupmanId'))
            ->orderBy('pickups.id', 'DESC')
            ->select('pickups.*')
            ->get();
        $pickupmen = pickupman::where('status', 1)->get();
        return view('frontEnd.layouts.pages.pickupman.pickup', compact('show_data', 'pickupmen'));
    }

    public function pickupmanInfo(Request $request)
    {
        $this->validate($request, [
            'pickupman' => 'required',
        ]);
        $pickup = Pickup::find($request->hidden_id);
        $pickup->pickupman = $request->pickupman;
        $pickup->save();

        Toastr::success('message', 'A pickupman asign successfully!');
        return redirect()->back();
        $pickupmanInfo = pickupman::find($parcel->pickupmanId);
        $agentInfo = Agent::find($parcel->merchantId);
        $data = array(
            'contact_mail' => $agentInfo->email,
            'ridername' => $pickupmanInfo->name,
            'riderphone' => $pickupmanInfo->phone,
            'codprice' => $pickup->cod,
        );
        if ($agentInfo->email) {
            $send = Mail::send('frontEnd.emails.percelassign', $data, function ($textmsg) use ($data) {
                $textmsg->from('info@sensorbd.com');
                $textmsg->to($data['contact_mail']);
                $textmsg->subject('Pickup Assign Notification');
            });
        }
    }
    public function pickupstatus(Request $request)
    {
        $this->validate($request, [
            'status' => 'required',
        ]);
        $pickup = Pickup::find($request->hidden_id);
        $pickup->status = $request->status;
        $pickup->save();

        Toastr::success('message', 'Pickup status update successfully!');
        return redirect()->back();
    }
    public function passreset()
    {
        return view('frontEnd.layouts.pages.pickupman.passreset');
    }
    public function passfromreset(Request $request)
    {
        $this->validate($request, [
            'email' => 'required',
        ]);
        $validpickupman = Pickupman::Where('email', $request->email)
            ->first();
        if ($validpickupman) {
            $verifyToken = rand(111111, 999999);
            $validpickupman->passwordReset  = $verifyToken;
            $validpickupman->save();
            Session::put('resetpickupmanId', $validpickupman->id);

            $data = array(
                'contact_mail' => $validpickupman->email,
                'verifyToken' => $verifyToken,
            );
            $send = Mail::send('frontEnd.layouts.pages.pickupman.forgetemail', $data, function ($textmsg) use ($data) {
                $textmsg->from('info@sensorbd.com');
                $textmsg->to($data['contact_mail']);
                $textmsg->subject('Forget password token');
            });
            return redirect('pickupman/resetpassword/verify');
        } else {
            Toastr::error('Sorry! You have no account', 'warning!');
            return redirect()->back();
        }
    }
    public function saveResetPassword(Request $request)
    {
        // return "okey";
        $validpickupman = pickupman::find(Session::get('resetpickupmanId'));
        if ($validpickupman->passwordReset == $request->verifyPin) {
            $validpickupman->password   = bcrypt(request('newPassword'));
            $validpickupman->passwordReset  = NULL;
            $validpickupman->save();

            Session::forget('resetpickupmanId');
            Session::put('pickupmanId', $validpickupman->id);
            Toastr::success('Wow! Your password reset successfully', 'success!');
            return redirect('pickupman/dashboard');
        } else {
            return $request->verifyPin;
            Toastr::error('Sorry! Your process something wrong', 'warning!');
            return redirect()->back();
        }
    }
    public function resetpasswordverify()
    {
        if (Session::get('resetpickupmanId')) {
            return view('frontEnd.layouts.pages.pickupman.passwordresetverify');
        } else {
            Toastr::error('Sorry! Your process something wrong', 'warning!');
            return redirect('forget/password');
        }
    }
    public function logout()
    {
        Session::flush();
        Toastr::success('Success!', 'Thanks! you are logout successfully');
        return redirect('/merchant/login');
    }
    public function export(Request $request)
    {
        return Excel::download(new RiderParcelExport(), 'parcel.xlsx');
    }

    public function payments(Request $request, $type)
    {
        $query = Parcel::where('pickupmanId', Session::get('pickupmanId'));
        if ($type == 'paid') {
            $query->where('pickupman_paid', '>', 0);
        }
        if ($type == 'due') {
            $query->where('pickupman_due', '>', 0);
        }

        $parcels = $query->paginate(15);
        return view('frontEnd.layouts.pages.pickupman.payments', compact('parcels'));
    }

    /*...............order................*/
    public function getOrderItems($id) {
        $orderId = $id;
        $orderItems = OrderItem::where('order_id', $id)->get();
        return view('frontEnd.layouts.pages.pickupman.order_edit', compact('orderItems','orderId'));
    }

    public function updateQty(Request $request) {
        $item = OrderItem::where('id', $request->itemId)->first();
        $item->qty = $request->qty;
        $item->total = ($item->service_amount * $request->qty) + $item->shipping_charge - $item->service_discount;
        $item->save();
        $this->addLog(Session::get('pickupmanId'), 2, 'Quantity update',$item->order_id);
        return 1;
    }

    public function getProducts(Request $request) {
        $products = LaundryProduct::where('category_id', $request->categoryId)->where('status', 'Active')->orderBy('id', 'desc')->get();
    
        if($products) {
            
            return $products;
        }
    }

    public function getProductServices(Request $request) {
        $services = ProductService::where('laundry_product_id', $request->productId)->with('serviceName')->get();
    
        if($services) {
            
            return $services;
        }
    }

    public function orderUpdate(Request $request) {

        $orderId = $request->rowId;

        $orderInfo = Order::where('id', $orderId)->first();

        $categoris = $request->category;
        $products = $request->product;
        $services = $request->service;
        $qty = $request->quantity;

        $length = sizeof($categoris);

        for ($i=0; $i < $length; $i++) { 
            
            //product service
            $productService = ProductService::where('id', $services[$i])->first();

            //product
            $product = LaundryProduct::where('id', $products[$i])->first();

            //get discount
            $discount = 0;
            $discountInfo = LaundryDiscount::where('product_id', $products[$i])
                                                ->where('customer_id', $orderInfo->customer_id)
                                                ->where('status', 1)
                                                ->where('product_service_id', $services[$i])
                                                ->first();
            if($discountInfo) {
                $discount = (($productService->amount * $qty[$i]) * $discountInfo->discount) / 100;
            }

            $orderItem = new OrderItem();
            $orderItem->order_id = $orderId;
            $orderItem->customer_id = $orderInfo->customer_id;
            $orderItem->product_id = $products[$i];
            $orderItem->qty = $qty[$i];
            $orderItem->shipping_charge = $product->shipping_charge;
            $orderItem->service_id = $services[$i];
            $orderItem->service_amount = $productService->amount;
            $orderItem->service_discount = $discount;
            $orderItem->total = ($productService->amount * $qty[$i]) + $product->shipping_charge - $discount;
            $orderItem->save();

        }

        $this->addLog(Session::get('pickupmanId'), 2, 'Order update',$orderId);

        Toastr::success('Order update successful');
        return redirect()->back();

    }

    /*...........ajax............*/
    public function getTotalNewOrder() {
        $userID = Session::get('pickupmanId');
        $orders = Order::where('order_status', 10)->where('pman_id', $userID)->get();
        $count = 0;
        foreach($orders as $order) {
            $item = OrderView::where('order_id', $order->id)
                    ->where('user_id', $userID)
                    ->where('user_type_id', 2)->first();
            if(!$item) {
                $count ++;
            }
        }
    
        return response()->json(['total' => $count]);
    }

    /*.........ajax...........*/
}
