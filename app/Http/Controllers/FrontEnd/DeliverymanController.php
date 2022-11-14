<?php

namespace App\Http\Controllers\FrontEnd;

use App\Agent;
use App\AgentThana;
use App\Customer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use App\Deliveryman;
use App\DeliverymanAgent;
use App\Merchant;
use App\Parcel;
use App\Parcelnote;
use App\Order;
use App\OrderItem;
use App\OrderShipping;
use App\OrderBilling;
use App\Exports\RiderParcelExport;
use App\OrderView;
use App\Parceltype;
use App\Pickupman;
use Maatwebsite\Excel\Facades\Excel;
// use Session;
use DB;
use Mail;
use Illuminate\Support\Facades\Session;

class DeliverymanController extends Controller
{
    public function loginform()
    {
        return view('frontEnd.layouts.pages.deliveryman.login');
    }
    public function login(Request $request)
    {
        $this->validate($request, [
            'deliveryman_user' => 'required',
            'deliveryman_password' => 'required',
        ]);
        $checkAuth = Deliveryman::where('email', $request->deliveryman_user)
            ->orWhere('phone', $request->deliveryman_user)
            ->first();
        if ($checkAuth) {
            if ($checkAuth->status == 0) {
                Toastr::warning('warning', 'Opps! your account has been suspends');
                return redirect()->back()->with('error', 'Opps! your account has been suspends');
            } else {
                if (password_verify($request->deliveryman_password, $checkAuth->password)) {
                    $deliverymanId = $checkAuth->id;
                    Session::put('deliverymanId', $deliverymanId);
                    Toastr::success('success', 'Thanks , You are login successfully');
                    return redirect('deliveryman/dashboard');
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
        $totalparcel = Parcel::where(['deliverymanId' => Session::get('deliverymanId')])->count();
        $totaldelivery = Parcel::where(['deliverymanId' => Session::get('deliverymanId'), 'status' => 4])->count();
        $totalhold = Parcel::where(['deliverymanId' => Session::get('deliverymanId'), 'status' => 5])->count();
        $totalcancel = Parcel::where(['deliverymanId' => Session::get('deliverymanId'), 'status' => 9])->count();
        $returnpendin = Parcel::where(['deliverymanId' => Session::get('deliverymanId'), 'status' => 6])->count();
        $returnmerchant = Parcel::where(['deliverymanId' => Session::get('deliverymanId'), 'status' => 8])->count();
        $total_amount = Parcel::where(['deliverymanId' => Session::get('deliverymanId')])->sum('deliveryman_amount');
        $total_paid = Parcel::where(['deliverymanId' => Session::get('deliverymanId')])->sum('deliveryman_paid');
        $total_due = Parcel::where(['deliverymanId' => Session::get('deliverymanId')])->sum('deliveryman_due');
        return view('frontEnd.layouts.pages.deliveryman.dashboard', compact('totalparcel', 'totaldelivery', 'totalhold', 'totalcancel', 'returnpendin', 'returnmerchant', 'total_amount', 'total_paid', 'total_due'));
    }

    public function parcels(Request $request) {
        $orders = Order::where('dman_id','=', Session::get('deliverymanId'))->orderBy('id', 'desc');
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
                            $checkExist = OrderView::where('order_id', $order->id)->where('user_id', Session::get('deliverymanId'))->where('user_type_id', 3)->first();
                            if(!$checkExist) {
                                $orderView = new OrderView();
                                $orderView->order_id = $order->id;
                                $orderView->user_id = Session::get('deliverymanId');
                                $orderView->user_type_id = 3;
                                $orderView->save();
                            }
                        }
                    }

        return view('frontEnd.layouts.pages.deliveryman.order_list', compact('orders'));
    }

    public function orderDetails($id) {
        $order = Order::where('id', $id)->first();
        $orderItems = OrderItem::where('order_id', $id)->with('product')->with('service')->get();
        $shipping = OrderShipping::where('order_id', $id)->with('division')->with('district')->with('thana')->first();
        $billing = OrderBilling::where('order_id', $id)->with('division')->with('district')->with('thana')->first();
        
        return view('frontEnd.layouts.pages.deliveryman.order_details',compact('order','orderItems','shipping','billing'));
    }

    public function deliveredOrder(Request $request) {

        $request->validate([
            'order_id' => 'required',
            'payment_method_info' => 'required',
            'paid_amount' => 'required'
        ]);

        $id = $request->order_id;
        $order = Order::where('id', $id)->first();
        $order->order_status = 4;
        $order->payment_method_info = $request->payment_method_info;
        $order->paid = $request->paid_amount;
        $order->pay_status = 'Paid';
        $order->dman_id = Session::get('deliverymanId');
        $order->save();
            
        $orderItems = OrderItem::where('order_id', $id)->get();
        $toalItems = $orderItems->count();
        $paidamount = $order->paid;

        $customer = Customer::where('id', $order->customer_id)->first();

        if($order) {

            $this->addLog(Session::get('deliverymanId'), 3, 'Order delivered',$id);

            // sent sms
            $number = $customer->phoneNumber;
            $msg = 'Welcome to laundry express. Your '.$toalItems.' items has been delivered successfully and you have paid '.$paidamount.' Tk.';
            $this->sendSMS($number, $msg);

            Toastr::success('Order delivered successful');
        }else {
            Toastr::error('Something was wrong');
        }
        return redirect()->back();
    }












    public function pendingParcels(Request $request)
    {
        $deliveryman = Deliveryman::find(Session::get('deliverymanId'));
        $agent_ids = DeliverymanAgent::where('deliveryman_id', Session::get('deliverymanId'))->pluck('agent_id');
        $thana_ids = AgentThana::whereIn('agent_id', [$agent_ids])->pluck('thana_id');
        $parceltypes = Parceltype::all();
        $filter = $request->filter_id;
        if ($request->trackId != NULL) {
            $allparcel = DB::table('parcels')
                ->leftJoin('merchants', 'merchants.id', '=', 'parcels.merchantId')
                ->leftJoin('divisions', 'parcels.division_id', '=', 'divisions.id')
                ->leftJoin('districts', 'parcels.district_id', '=', 'districts.id')
                ->leftJoin('thanas', 'parcels.thana_id', '=', 'thanas.id')
                ->leftJoin('areas', 'parcels.area_id', '=', 'areas.id')
                ->whereIn('parcels.thana_id', $thana_ids)
                ->whereNull('parcels.deliverymanId')
                ->where('parcels.trackingCode', $request->trackId)
                ->where('parcels.status', 2)
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
                ->whereIn('parcels.thana_id', $thana_ids)
                ->whereNull('parcels.deliverymanId')
                ->where('parcels.recipientPhone', $request->phoneNumber)
                ->where('parcels.status', 2)
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
                ->whereIn('parcels.thana_id', $thana_ids)
                ->whereNull('parcels.deliverymanId')
                ->whereBetween('parcels.created_at', [$request->startDate, $request->endDate])
                ->where('parcels.status', 2)
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
                ->whereIn('parcels.thana_id', $thana_ids)
                ->whereNull('parcels.deliverymanId')
                ->where('parcels.recipientPhone', $request->phoneNumber)
                ->whereBetween('parcels.created_at', [$request->startDate, $request->endDate])
                ->where('parcels.status', 2)
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
                ->whereIn('parcels.thana_id', $thana_ids)
                ->whereNull('parcels.deliverymanId')
                ->where('parcels.status', 2)
                ->select('parcels.*', 'divisions.name as division', 'districts.name as district', 'thanas.name as thana', 'areas.name as area', 'merchants.companyName', 'merchants.firstName', 'merchants.lastName', 'merchants.phoneNumber', 'merchants.emailAddress')
                ->orderBy('parcels.id', 'desc')
                ->get();
        }

        if ($request->parcel_type) {
            $status = Parceltype::where('slug', $request->parcel_type)->first()->id ?? '';
            $allparcel = $allparcel->where('status', $status);
        }

        return view('frontEnd.layouts.pages.deliveryman.assignable_parcels', compact('allparcel', 'parceltypes'));
    }

    public function deliverymanAsign(Request $request)
    {
        $this->validate($request, [
            'hidden_id' => 'required',
            'deliverymanId' => 'required',
        ]);
        $parcel = Parcel::find($request->hidden_id);
        $parcel->deliverymanId = $request->deliverymanId;
        $parcel->save();

        $deliveryman = Deliveryman::find($request->deliverymanId);
        $note = new Parcelnote();
        $note->parcelId = $request->hidden_id;
        $note->note = "Deliveryman Asign";
        $note->remark = $deliveryman->name . ' - ' . $deliveryman->phone;
        $note->save();

        Toastr::success('message', 'A deliveryman asign successfully!');
        return redirect()->back();
        $deliverymanInfo = Deliveryman::find($parcel->deliverymanId);
        $merchantinfo = Merchant::find($parcel->merchantId);
        if ($merchantinfo->emailAddress) {
            $data = array(
                'contact_mail' => $merchantinfo->emailAddress,
                'ridername' => $deliverymanInfo->name,
                'riderphone' => $deliverymanInfo->phone,
                'codprice' => $parcel->cod,
                'trackingCode' => $parcel->trackingCode,
            );
            $send = Mail::send('frontEnd.emails.percelassign', $data, function ($textmsg) use ($data) {
                $textmsg->from('info@sensorbd.com');
                $textmsg->to($data['contact_mail']);
                $textmsg->subject('Percel Assign Notification');
            });
        }
    }

    public function invoice($id)
    {
        $show_data = DB::table('parcels')
            ->leftJoin('merchants', 'merchants.id', '=', 'parcels.merchantId')
            ->leftJoin('divisions', 'parcels.division_id', '=', 'divisions.id')
            ->leftJoin('districts', 'parcels.district_id', '=', 'districts.id')
            ->leftJoin('thanas', 'parcels.thana_id', '=', 'thanas.id')
            ->leftJoin('areas', 'parcels.area_id', '=', 'areas.id')
            ->leftJoin('parceltypes', 'parcels.status', '=', 'parceltypes.id')
            ->where('parcels.deliverymanId', Session::get('deliverymanId'))
            ->where('parcels.id', $id)
            ->select('parcels.*', 'divisions.name as division', 'districts.name as district', 'thanas.name as thana', 'areas.name as area', 'merchants.companyName', 'merchants.phoneNumber', 'merchants.emailAddress')
            ->first();
        if ($show_data != NULL) {
            return view('frontEnd.layouts.pages.deliveryman.invoice', compact('show_data'));
        } else {
            Toastr::error('Opps!', 'Invoice not found.');
            return redirect()->back();
        }
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

            // Sens Merchant message
            $numbers = "0" . $validMerchant->phoneNumber;
            $msg = "Dear Merchant, Your Parcel Tracking ID $parcel->trackingCode for $validMerchant->companyName , $validMerchant->phoneNumber is on Deliverd. \r\n Regards,\r\n Sensor Courier";
            $this->sendSMS($numbers, $msg);

            // Send Customer message
            $customer_numbers = $parcel->recipientPhone;
            $customer_msg = "Dear Customer, Your Parcel Tracking ID $parcel->trackingCode for $validMerchant->companyName , $validMerchant->phoneNumber is on Deliverd. \r\n Regards,\r\n Sensor Courier ";
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
            ->where('pickups.deliveryman', Session::get('deliverymanId'))
            ->orderBy('pickups.id', 'DESC')
            ->select('pickups.*')
            ->get();
        $deliverymen = Deliveryman::where('status', 1)->get();
        return view('frontEnd.layouts.pages.deliveryman.pickup', compact('show_data', 'deliverymen'));
    }

    public function pickupdeliverman(Request $request)
    {
        $this->validate($request, [
            'deliveryman' => 'required',
        ]);
        $pickup = Pickup::find($request->hidden_id);
        $pickup->deliveryman = $request->deliveryman;
        $pickup->save();

        Toastr::success('message', 'A deliveryman asign successfully!');
        return redirect()->back();
        $deliverymanInfo = Deliveryman::find($parcel->deliverymanId);
        $agentInfo = Agent::find($parcel->merchantId);
        $data = array(
            'contact_mail' => $agentInfo->email,
            'ridername' => $deliverymanInfo->name,
            'riderphone' => $deliverymanInfo->phone,
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
        return view('frontEnd.layouts.pages.deliveryman.passreset');
    }
    public function passfromreset(Request $request)
    {
        $this->validate($request, [
            'email' => 'required',
        ]);
        $validDeliveryman = Deliveryman::Where('email', $request->email)
            ->first();
        if ($validDeliveryman) {
            $verifyToken = rand(111111, 999999);
            $validDeliveryman->passwordReset  = $verifyToken;
            $validDeliveryman->save();
            Session::put('resetDeliverymanId', $validDeliveryman->id);

            $data = array(
                'contact_mail' => $validDeliveryman->email,
                'verifyToken' => $verifyToken,
            );
            $send = Mail::send('frontEnd.layouts.pages.deliveryman.forgetemail', $data, function ($textmsg) use ($data) {
                $textmsg->from('info@sensorbd.com');
                $textmsg->to($data['contact_mail']);
                $textmsg->subject('Forget password token');
            });
            return redirect('deliveryman/resetpassword/verify');
        } else {
            Toastr::error('Sorry! You have no account', 'warning!');
            return redirect()->back();
        }
    }
    public function saveResetPassword(Request $request)
    {
        // return "okey";
        $validDeliveryman = Deliveryman::find(Session::get('deliverymanId'));
        if ($validDeliveryman->passwordReset == $request->verifyPin) {
            $validDeliveryman->password   = bcrypt(request('newPassword'));
            $validDeliveryman->passwordReset  = NULL;
            $validDeliveryman->save();

            Session::forget('resetDeliverymanId');
            Session::put('deliverymanId', $validDeliveryman->id);
            Toastr::success('Wow! Your password reset successfully', 'success!');
            return redirect('deliveryman/dashboard');
        } else {
            return $request->verifyPin;
            Toastr::error('Sorry! Your process something wrong', 'warning!');
            return redirect()->back();
        }
    }
    public function resetpasswordverify()
    {
        if (Session::get('resetDeliverymanId')) {
            return view('frontEnd.layouts.pages.deliveryman.passwordresetverify');
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
        $query = Parcel::where('deliverymanId', Session::get('deliverymanId'));
        if ($type == 'paid') {
            $query->where('deliveryman_paid', '>', 0);
        }
        if ($type == 'due') {
            $query->where('deliveryman_due', '>', 0);
        }

        $parcels = $query->paginate(15);
        return view('frontEnd.layouts.pages.deliveryman.payments', compact('parcels'));
    }

    /*...........ajax............*/
    public function getTotalNewOrder() {
        $userID = Session::get('deliverymanId');
        $orders = Order::where('order_status','!=', 4)->where('dman_id', $userID)->get();
        $count = 0;
        foreach($orders as $order) {
            $item = OrderView::where('order_id', $order->id)
                    ->where('user_id', $userID)
                    ->where('user_type_id', 3)->first();
            if(!$item) {
                $count ++;
            }
        }
    
        return response()->json(['total' => $count]);
    }
}
