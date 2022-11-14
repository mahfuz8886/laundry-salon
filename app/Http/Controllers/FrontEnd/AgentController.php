<?php

namespace App\Http\Controllers\FrontEnd;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use App\Agent;
use App\AgentThana;
use App\Parcel;
use App\Pickup;
use App\Deliveryman;
use App\Merchant;
use App\Parcelnote;
use App\Parceltype;
use App\Exports\AgentParcelExport;
use App\Pickupman;
use Maatwebsite\Excel\Facades\Excel;
use Mail;
use DB;
use Illuminate\Support\Facades\Session;

class AgentController extends Controller
{
    public function loginform()
    {
        return view('frontEnd.layouts.pages.agent.login');
    }
    public function login(Request $request)
    {
        $this->validate($request, [
            'agent_user' => 'required',
            'agent_password' => 'required',
        ]);
        $checkAuth = Agent::where('email', $request->agent_user)
            ->orWhere('phone', $request->agent_user)
            ->first();
        if ($checkAuth) {
            if ($checkAuth->status == 0) {
                Toastr::warning('warning', 'Opps! your account has been suspends');
                return redirect()->back()->with('error', 'Opps! your account has been suspends');
            } else {
                if (password_verify($request->agent_password, $checkAuth->password)) {
                    $agentId = $checkAuth->id;
                    Session::put('agentId', $agentId);
                    Toastr::success('success', 'Thanks , You are login successfully');
                    return redirect('/agent/dashboard');
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
        $totalparcel = Parcel::where(['agentId' => Session::get('agentId')])->count();
        $totaldelivery = Parcel::where(['agentId' => Session::get('agentId'), 'status' => 4])->count();
        $totalhold = Parcel::where(['agentId' => Session::get('agentId'), 'status' => 5])->count();
        $totalcancel = Parcel::where(['agentId' => Session::get('agentId'), 'status' => 9])->count();
        $returnpendin = Parcel::where(['agentId' => Session::get('agentId'), 'status' => 6])->count();
        $returnmerchant = Parcel::where(['agentId' => Session::get('agentId'), 'status' => 8])->count();
        return view('frontEnd.layouts.pages.agent.dashboard', compact('totalparcel', 'totaldelivery', 'totalhold', 'totalcancel', 'returnpendin', 'returnmerchant'));
    }
    public function parcels(Request $request)
    {
        $filter = $request->filter_id;
        if ($request->trackId != NULL) {
            $allparcel = DB::table('parcels')
                ->leftJoin('merchants', 'merchants.id', '=', 'parcels.merchantId')
                ->leftJoin('divisions', 'parcels.division_id', '=', 'divisions.id')
                ->leftJoin('districts', 'parcels.district_id', '=', 'districts.id')
                ->leftJoin('thanas', 'parcels.thana_id', '=', 'thanas.id')
                ->leftJoin('areas', 'parcels.area_id', '=', 'areas.id')
                ->where('parcels.agentId', Session::get('agentId'))
                ->where('parcels.trackingCode', $request->trackId)
                ->select('parcels.*', 'divisions.name as division', 'districts.name as district', 'thanas.name as thana', 'areas.name as area', 'merchants.firstName', 'merchants.lastName', 'merchants.phoneNumber', 'merchants.emailAddress', 'merchants.companyName', 'merchants.status as mstatus', 'merchants.id as mid')
                ->orderBy('parcels.status', 'asc')->orderBy('parcels.id', 'desc')
                ->get();
        } elseif ($request->phoneNumber != NULL) {
            $allparcel = DB::table('parcels')
                ->leftJoin('merchants', 'merchants.id', '=', 'parcels.merchantId')
                ->leftJoin('divisions', 'parcels.division_id', '=', 'divisions.id')
                ->leftJoin('districts', 'parcels.district_id', '=', 'districts.id')
                ->leftJoin('thanas', 'parcels.thana_id', '=', 'thanas.id')
                ->leftJoin('areas', 'parcels.area_id', '=', 'areas.id')
                ->where('parcels.agentId', Session::get('agentId'))
                ->where('parcels.recipientPhone', $request->phoneNumber)
                ->select('parcels.*', 'divisions.name as division', 'districts.name as district', 'thanas.name as thana', 'areas.name as area', 'merchants.firstName', 'merchants.lastName', 'merchants.phoneNumber', 'merchants.emailAddress', 'merchants.companyName', 'merchants.status as mstatus', 'merchants.id as mid')
                ->orderBy('parcels.status', 'asc')->orderBy('parcels.id', 'desc')
                ->get();
        } elseif ($request->startDate != NULL && $request->endDate != NULL) {
            $allparcel = DB::table('parcels')
                ->leftJoin('merchants', 'merchants.id', '=', 'parcels.merchantId')
                ->leftJoin('divisions', 'parcels.division_id', '=', 'divisions.id')
                ->leftJoin('districts', 'parcels.district_id', '=', 'districts.id')
                ->leftJoin('thanas', 'parcels.thana_id', '=', 'thanas.id')
                ->leftJoin('areas', 'parcels.area_id', '=', 'areas.id')
                ->where('parcels.agentId', Session::get('agentId'))
                ->whereBetween('parcels.created_at', [$request->startDate, $request->endDate])
                ->select('parcels.*', 'divisions.name as division', 'districts.name as district', 'thanas.name as thana', 'areas.name as area', 'merchants.firstName', 'merchants.lastName', 'merchants.phoneNumber', 'merchants.emailAddress', 'merchants.companyName', 'merchants.status as mstatus', 'merchants.id as mid')
                ->orderBy('parcels.status', 'asc')->orderBy('parcels.id', 'desc')
                ->get();
        } elseif ($request->phoneNumber != NULL || $request->phoneNumber != NULL && $request->startDate != NULL && $request->endDate != NULL) {
            $allparcel = DB::table('parcels')
                ->leftJoin('merchants', 'merchants.id', '=', 'parcels.merchantId')
                ->leftJoin('divisions', 'parcels.division_id', '=', 'divisions.id')
                ->leftJoin('districts', 'parcels.district_id', '=', 'districts.id')
                ->leftJoin('thanas', 'parcels.thana_id', '=', 'thanas.id')
                ->leftJoin('areas', 'parcels.area_id', '=', 'areas.id')
                ->where('parcels.agentId', Session::get('agentId'))
                ->where('parcels.recipientPhone', $request->phoneNumber)
                ->whereBetween('parcels.created_at', [$request->startDate, $request->endDate])
                ->select('parcels.*', 'divisions.name as division', 'districts.name as district', 'thanas.name as thana', 'areas.name as area', 'merchants.firstName', 'merchants.lastName', 'merchants.phoneNumber', 'merchants.emailAddress', 'merchants.companyName', 'merchants.status as mstatus', 'merchants.id as mid')
                ->orderBy('parcels.status', 'asc')->orderBy('parcels.id', 'desc')
                ->get();
        } else {
            $allparcel = DB::table('parcels')
                ->leftJoin('merchants', 'merchants.id', '=', 'parcels.merchantId')
                ->leftJoin('divisions', 'parcels.division_id', '=', 'divisions.id')
                ->leftJoin('districts', 'parcels.district_id', '=', 'districts.id')
                ->leftJoin('thanas', 'parcels.thana_id', '=', 'thanas.id')
                ->leftJoin('areas', 'parcels.area_id', '=', 'areas.id')
                ->where('parcels.agentId', Session::get('agentId'))
                ->select('parcels.*', 'divisions.name as division', 'districts.name as district', 'thanas.name as thana', 'areas.name as area', 'merchants.companyName', 'merchants.firstName', 'merchants.lastName', 'merchants.phoneNumber', 'merchants.emailAddress')
                ->orderBy('parcels.status', 'asc')->orderBy('parcels.id', 'desc')
                ->get();
        }
        if ($request->parcel_type) {
            $status = Parceltype::where('slug', $request->parcel_type)->first()->id ?? '';
            $allparcel = $allparcel->where('status', $status);
        }
        $parceltypes = Parceltype::all();
        $aparceltypes = Parceltype::limit(3)->get();
        return view('frontEnd.layouts.pages.agent.parcels', compact('allparcel', 'parceltypes', 'aparceltypes'));
    }
    public function assignableParcels(Request $request)
    {
        $filter = $request->filter_id;
        $agentInfo = Agent::find(Session::get('agentId'));
        $thana_ids = AgentThana::where('agent_id', $agentInfo->id)->pluck('thana_id');
        if ($request->trackId != NULL) {
            $allparcel = DB::table('parcels')
                ->leftJoin('merchants', 'merchants.id', '=', 'parcels.merchantId')
                ->leftJoin('divisions', 'parcels.division_id', '=', 'divisions.id')
                ->leftJoin('districts', 'parcels.district_id', '=', 'districts.id')
                ->leftJoin('thanas', 'parcels.thana_id', '=', 'thanas.id')
                ->leftJoin('areas', 'parcels.area_id', '=', 'areas.id')
                ->whereNull('parcels.agentId')
                ->whereIn('parcels.thana_id', $thana_ids)
                ->where('parcels.trackingCode', $request->trackId)
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
                ->whereNull('parcels.agentId')
                ->whereIn('parcels.thana_id', $thana_ids)
                ->where('parcels.recipientPhone', $request->phoneNumber)
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
                ->whereNull('parcels.agentId')
                ->whereIn('parcels.thana_id', $thana_ids)
                ->whereBetween('parcels.created_at', [$request->startDate, $request->endDate])
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
                ->whereNull('parcels.agentId')
                ->whereIn('parcels.thana_id', $thana_ids)
                ->where('parcels.recipientPhone', $request->phoneNumber)
                ->whereBetween('parcels.created_at', [$request->startDate, $request->endDate])
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
                ->whereNull('parcels.agentId')
                ->whereIn('parcels.thana_id', $thana_ids)
                ->select('parcels.*', 'divisions.name as division', 'districts.name as district', 'thanas.name as thana', 'areas.name as area', 'merchants.companyName', 'merchants.firstName', 'merchants.lastName', 'merchants.phoneNumber', 'merchants.emailAddress')
                ->orderBy('parcels.id', 'desc')
                ->get();
        }

        $aparceltypes = Parceltype::limit(3)->get();
        return view('frontEnd.layouts.pages.agent.assignable_parcels', compact('allparcel', 'aparceltypes'));
    }

    public function assignParcel(Request $request)
    {
        $this->validate($request, [
            'hidden_id' => 'required',
        ]);
        $parcel = Parcel::find($request->hidden_id);
        $parcel->agentId = Session::get('agentId');
        $parcel->save();

        $agentInfo = Agent::find(Session::get('agentId'));
        $note = new Parcelnote();
        $note->parcelId = $parcel->id;
        $note->note = $request->note ?? 'Agent assign';
        $note->remark = $agentInfo->name . ' - ' . $agentInfo->phone;
        $note->save();

        Toastr::success('Success!', 'Agent assign successfully done.');
        return redirect()->back();
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
            ->where('parcels.id', $id)
            ->select('parcels.*', 'parceltypes.title', 'divisions.name as division', 'districts.name as district', 'thanas.name as thana', 'areas.name as area', 'merchants.firstName', 'merchants.companyName', 'merchants.phoneNumber', 'merchants.emailAddress')
            ->first();

        if ($show_data != NULL) {
            return view('frontEnd.layouts.pages.agent.invoice', compact('show_data'));
        } else {
            Toastr::error('Opps!', 'Your process wrong');
            return redirect()->back();
        }
    }

    public function pickmanasiagn(Request $request)
    {
        $this->validate($request, [
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
        $deliverymanInfo = Deliveryman::find($parcel->pickupmanId);
        $merchantinfo = Agent::find($parcel->merchantId);
        if ($merchantinfo->email) {
            $data = array(
                'contact_mail' => $merchantinfo->email,
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

    public function delivermanasiagn(Request $request)
    {
        $this->validate($request, [
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
        $merchantinfo = Agent::find($parcel->merchantId);
        if ($merchantinfo->email) {
            $data = array(
                'contact_mail' => $merchantinfo->email,
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

    public function statusupdate(Request $request)
    {
        //   return $request->all();
        $this->validate($request, [
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

            // Sends Merchant message
            $numbers = "0" . $validMerchant->phoneNumber;
            $msg = "Dear Merchant, Your Parcel Tracking ID $parcel->trackingCode for $validMerchant->companyName , $validMerchant->phoneNumber is on Deliverd. \r\n Regards,\r\n Sensor Courier";
            $this->sendSMS($numbers, $msg);

            // Sends Customer message
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
    public function logout()
    {
        Session::flush();
        Toastr::success('Success!', 'Thanks! you are logout successfully');
        return redirect('merchant/login');
    }
    public function pickup()
    {
        $show_data = DB::table('pickups')
            ->where('pickups.agent', Session::get('agentId'))
            ->orderBy('pickups.id', 'DESC')
            ->select('pickups.*')
            ->get();
        $deliverymen = Deliveryman::where('status', 1)->get();
        return view('frontEnd.layouts.pages.agent.pickup', compact('show_data', 'deliverymen'));
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
        $send = Mail::send('frontEnd.emails.percelassign', $data, function ($textmsg) use ($data) {
            $textmsg->from('info@sensorbd.com');
            $textmsg->to($data['contact_mail']);
            $textmsg->subject('Pickup Assign Notification');
        });
    }

    public function pickupstatus(Request $request)
    {
        $this->validate($request, [
            'status' => 'required',
        ]);
        $pickup = Pickup::find($request->hidden_id);
        $pickup->status = $request->status;
        $pickup->save();

        if ($request->status == 2) {
            $deliverymanInfo = Deliveryman::where(['id' => $pickup->deliveryman])->first();
            // $data = array(
            //  'name' => $deliverymanInfo->name,
            //  'companyname' => $merchantInfo->companyName,
            //  'phone' => $deliverymanInfo->phone,
            //  'address' => $merchantInfo->pickLocation,
            // );
            // $send = Mail::send('frontEnd.emails.pickupdeliveryman', $data, function($textmsg) use ($data){
            //  $textmsg->from('info@sensorbd.com');
            //  $textmsg->to($data['contact_mail']);
            //  $textmsg->subject('Pickup request update');
            // });
        }
        Toastr::success('message', 'Pickup status update successfully!');
        return redirect()->back();
    }
    public function passreset()
    {
        return view('frontEnd.layouts.pages.agent.passreset');
    }
    public function passfromreset(Request $request)
    {
        $this->validate($request, [
            'email' => 'required',
        ]);
        $validAgent = Agent::Where('email', $request->email)
            ->first();
        if ($validAgent) {
            $verifyToken = rand(111111, 999999);
            $validAgent->passwordReset  = $verifyToken;
            $validAgent->save();
            Session::put('resetAgentId', $validAgent->id);

            $data = array(
                'contact_mail' => $validAgent->email,
                'verifyToken' => $verifyToken,
            );
            $send = Mail::send('frontEnd.layouts.pages.agent.forgetemail', $data, function ($textmsg) use ($data) {
                $textmsg->from('info@sensorbd.com');
                $textmsg->to($data['contact_mail']);
                $textmsg->subject('Forget password token');
            });
            return redirect('agent/resetpassword/verify');
        } else {
            Toastr::error('Sorry! You have no account', 'warning!');
            return redirect()->back();
        }
    }
    public function saveResetPassword(Request $request)
    {
        $validAgent = Agent::find(Session::get('resetAgentId'));
        if ($validAgent->passwordReset == $request->verifyPin) {
            $validAgent->password   = bcrypt(request('newPassword'));
            $validAgent->passwordReset  = NULL;
            $validAgent->save();

            Session::forget('resetAgentId');
            Session::put('agentId', $validAgent->id);
            Toastr::success('Wow! Your password reset successfully', 'success!');
            return redirect('agent/dashboard');
        } else {
            Toastr::error('Sorry! Your process something wrong', 'warning!');
            return redirect()->back();
        }
    }
    public function resetpasswordverify()
    {
        if (Session::get('resetAgentId')) {
            return view('frontEnd.layouts.pages.agent.passwordresetverify');
        } else {
            Toastr::error('Sorry! Your process something wrong', 'warning!');
            return redirect('forget/password');
        }
    }
    public function export(Request $request)
    {
        return Excel::download(new AgentParcelExport(), 'parcel.xlsx');
    }
}
