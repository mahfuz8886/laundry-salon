<?php

namespace App\Http\Controllers\Api;

use App\Agent;
use App\AgentThana;
use App\Deliveryman;
use App\DeliverymanAgent;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Merchant;
use App\Parcel;
use App\Parcelnote;
use App\Parceltype;
use App\Pickup;
use App\Pickupman;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class DeliverymanController extends Controller
{
    public function login(Request $request)
    {
        $rules = [
            'deliveryman_user' => 'required',
            'deliveryman_password' => 'required',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => $validator->errors()->first()], 200);
        }

        $checkAuth = Deliveryman::with('area')->where('email', $request->deliveryman_user)
            ->orWhere('phone', $request->deliveryman_user)
            ->first();
        if ($checkAuth) {
            if ($checkAuth->status == 0) {
                return response()->json(['success' => false, 'message' => 'Opps! your account has been suspends'], 200);
            } else {
                if (password_verify($request->deliveryman_password, $checkAuth->password)) {
                    return response()->json(['success' => true, 'data' => $checkAuth, 'message' => 'Thanks , You are login successfully']);
                } else {
                    return response()->json(['success' => false, 'message' => 'Sorry! your password wrong'], 200);
                }
            }
        } else {
            return response()->json(['success' => false, 'message' => 'Opps! you have no account'], 200);
        }
    }

    public function parcelTypes(Request $request)
    {
        $user = $this->deliveryman($request->api_token);
        if ($user) {
            $data = Parceltype::all();
            return response()->json(['success' => true, 'data' => $data], 200);
        } else {
            return response()->json(['success' => false, 'message' => 'Opps! INVALID api token.'], 200);
        }
    }
    public function dashboard(Request $request)
    {
        $user = $this->deliveryman($request->api_token);
        if ($user) {
            $data = [
                'total_parcel' => Parcel::where(['deliverymanId' => $user->id])->count(),
                'total_delivery' => Parcel::where(['deliverymanId' => $user->id, 'status' => 4])->count(),
                'total_hold' => Parcel::where(['deliverymanId' => $user->id, 'status' => 5])->count(),
                'total_cancel' => Parcel::where(['deliverymanId' => $user->id, 'status' => 9])->count(),
                'return_pending' => Parcel::where(['deliverymanId' => $user->id, 'status' => 6])->count(),
                'return_merchant' => Parcel::where(['deliverymanId' => $user->id, 'status' => 8])->count(),
                'total_amount' => Parcel::where(['deliverymanId' => $user->id])->sum('deliveryman_amount'),
                'total_paid' => Parcel::where(['deliverymanId' => $user->id])->sum('deliveryman_paid'),
                'total_due' => Parcel::where(['deliverymanId' => $user->id])->sum('deliveryman_due'),
            ];
            return response()->json(['success' => true, 'data' => $data], 200);
        } else {
            return response()->json(['success' => false, 'message' => 'Opps! INVALID api token.'], 200);
        }
    }

    public function parcels(Request $request)
    {
        $user = $this->deliveryman($request->api_token);
        if ($user) {
            $data = [];
            $filter = $request->filter_id;
            $per_page = $request->per_page ?? 20;
            $parcel_types = Parceltype::all();
            if ($request->trackId != NULL) {
                $data['all_parcel'] = DB::table('parcels')
                    ->leftJoin('merchants', 'merchants.id', '=', 'parcels.merchantId')
                    ->leftJoin('divisions', 'parcels.division_id', '=', 'divisions.id')
                    ->leftJoin('districts', 'parcels.district_id', '=', 'districts.id')
                    ->leftJoin('thanas', 'parcels.thana_id', '=', 'thanas.id')
                    ->leftJoin('areas', 'parcels.area_id', '=', 'areas.id')
                    ->leftJoin('parceltypes', 'parcels.status', '=', 'parceltypes.id')
                    ->where('parcels.deliverymanId', $user->id)
                    ->where('parcels.trackingCode', $request->trackId)
                    ->select('parcels.*', 'parceltypes.title', 'divisions.name as division', 'districts.name as district', 'thanas.name as thana', 'areas.name as area', 'merchants.firstName', 'merchants.lastName', 'merchants.phoneNumber', 'merchants.emailAddress', 'merchants.companyName', 'merchants.status as mstatus', 'merchants.id as mid')
                    ->orderBy('parcels.status', 'asc')->orderBy('parcels.id', 'desc');
            } elseif ($request->phoneNumber != NULL) {
                $data['all_parcel'] = DB::table('parcels')
                    ->leftJoin('merchants', 'merchants.id', '=', 'parcels.merchantId')
                    ->leftJoin('divisions', 'parcels.division_id', '=', 'divisions.id')
                    ->leftJoin('districts', 'parcels.district_id', '=', 'districts.id')
                    ->leftJoin('thanas', 'parcels.thana_id', '=', 'thanas.id')
                    ->leftJoin('areas', 'parcels.area_id', '=', 'areas.id')
                    ->leftJoin('parceltypes', 'parcels.status', '=', 'parceltypes.id')
                    ->where('parcels.deliverymanId', $user->id)
                    ->where('parcels.recipientPhone', $request->phoneNumber)
                    ->select('parcels.*', 'parceltypes.title', 'divisions.name as division', 'districts.name as district', 'thanas.name as thana', 'areas.name as area', 'merchants.firstName', 'merchants.lastName', 'merchants.phoneNumber', 'merchants.emailAddress', 'merchants.companyName', 'merchants.status as mstatus', 'merchants.id as mid')
                    ->orderBy('parcels.status', 'asc')->orderBy('parcels.id', 'desc');
            } elseif ($request->startDate != NULL && $request->endDate != NULL) {
                $data['all_parcel'] = DB::table('parcels')
                    ->leftJoin('merchants', 'merchants.id', '=', 'parcels.merchantId')
                    ->leftJoin('divisions', 'parcels.division_id', '=', 'divisions.id')
                    ->leftJoin('districts', 'parcels.district_id', '=', 'districts.id')
                    ->leftJoin('thanas', 'parcels.thana_id', '=', 'thanas.id')
                    ->leftJoin('areas', 'parcels.area_id', '=', 'areas.id')
                    ->leftJoin('parceltypes', 'parcels.status', '=', 'parceltypes.id')
                    ->where('parcels.deliverymanId', $user->id)
                    ->whereBetween('parcels.created_at', [$request->startDate, $request->endDate])
                    ->select('parcels.*', 'parceltypes.title', 'divisions.name as division', 'districts.name as district', 'thanas.name as thana', 'areas.name as area', 'merchants.firstName', 'merchants.lastName', 'merchants.phoneNumber', 'merchants.emailAddress', 'merchants.companyName', 'merchants.status as mstatus', 'merchants.id as mid')
                    ->orderBy('parcels.status', 'asc')->orderBy('parcels.id', 'desc');
            } elseif ($request->phoneNumber != NULL || $request->phoneNumber != NULL && $request->startDate != NULL && $request->endDate != NULL) {
                $data['all_parcel'] = DB::table('parcels')
                    ->leftJoin('merchants', 'merchants.id', '=', 'parcels.merchantId')
                    ->leftJoin('divisions', 'parcels.division_id', '=', 'divisions.id')
                    ->leftJoin('districts', 'parcels.district_id', '=', 'districts.id')
                    ->leftJoin('thanas', 'parcels.thana_id', '=', 'thanas.id')
                    ->leftJoin('areas', 'parcels.area_id', '=', 'areas.id')
                    ->leftJoin('parceltypes', 'parcels.status', '=', 'parceltypes.id')
                    ->where('parcels.deliverymanId', $user->id)
                    ->where('parcels.recipientPhone', $request->phoneNumber)
                    ->whereBetween('parcels.created_at', [$request->startDate, $request->endDate])
                    ->select('parcels.*', 'parceltypes.title', 'divisions.name as division', 'districts.name as district', 'thanas.name as thana', 'areas.name as area', 'merchants.firstName', 'merchants.lastName', 'merchants.phoneNumber', 'merchants.emailAddress', 'merchants.companyName', 'merchants.status as mstatus', 'merchants.id as mid')
                    ->orderBy('parcels.status', 'asc')->orderBy('parcels.id', 'desc');
            } else {
                $data['all_parcel'] = DB::table('parcels')
                    ->leftJoin('merchants', 'merchants.id', '=', 'parcels.merchantId')
                    ->leftJoin('divisions', 'parcels.division_id', '=', 'divisions.id')
                    ->leftJoin('districts', 'parcels.district_id', '=', 'districts.id')
                    ->leftJoin('thanas', 'parcels.thana_id', '=', 'thanas.id')
                    ->leftJoin('areas', 'parcels.area_id', '=', 'areas.id')
                    ->leftJoin('parceltypes', 'parcels.status', '=', 'parceltypes.id')
                    ->orWhere('parcels.deliverymanId', $user->id)
                    ->select('parcels.*', 'parceltypes.title', 'divisions.name as division', 'districts.name as district', 'thanas.name as thana', 'areas.name as area', 'merchants.companyName', 'merchants.firstName', 'merchants.lastName', 'merchants.phoneNumber', 'merchants.emailAddress')
                    ->orderBy('parcels.status', 'asc')->orderBy('parcels.id', 'desc');
            }
            if ($request->parcel_type) {
                $status = Parceltype::where('slug', $request->parcel_type)->first()->id ?? '';
                $data['all_parcel'] = $data['all_parcel']->where('parcels.status', '=', $request->parcel_type);
            }
            $data['all_parcel'] = $data['all_parcel']->paginate($per_page);

            return response()->json(['success' => true, 'data' => $data], 200);
        } else {
            return response()->json(['success' => false, 'message' => 'Opps! INVALID api token.'], 200);
        }
    }

    public function pendingParcels(Request $request)
    {
        $data = [];
        $filter = $request->filter_id;
        $per_page = $request->per_page ?? 20;
        $user = $this->deliveryman($request->api_token);
        if ($user) {
            $agent_ids = DeliverymanAgent::where('deliveryman_id', $user->id)->pluck('agent_id');
            $thana_ids = AgentThana::whereIn('agent_id', [$agent_ids])->pluck('thana_id');
            $filter = $request->filter_id;
            if ($request->trackId != NULL) {
                $data['all_parcel'] = DB::table('parcels')
                    ->leftJoin('merchants', 'merchants.id', '=', 'parcels.merchantId')
                    ->leftJoin('divisions', 'parcels.division_id', '=', 'divisions.id')
                    ->leftJoin('districts', 'parcels.district_id', '=', 'districts.id')
                    ->leftJoin('thanas', 'parcels.thana_id', '=', 'thanas.id')
                    ->leftJoin('areas', 'parcels.area_id', '=', 'areas.id')
                    ->whereIn('parcels.thana_id', $thana_ids)
                    ->leftJoin('parceltypes', 'parcels.status', '=', 'parceltypes.id')
                    ->whereNull('parcels.deliverymanId')
                    ->where('parcels.trackingCode', $request->trackId)
                    ->where('parcels.status', 2)
                    ->select('parcels.*', 'parceltypes.title', 'divisions.name as division', 'districts.name as district', 'thanas.name as thana', 'areas.name as area', 'merchants.firstName', 'merchants.lastName', 'merchants.phoneNumber', 'merchants.emailAddress', 'merchants.companyName', 'merchants.status as mstatus', 'merchants.id as mid')
                    ->orderBy('parcels.id', 'desc')
                    ->paginate($per_page);
            } elseif ($request->phoneNumber != NULL) {
                $data['all_parcel'] = DB::table('parcels')
                    ->leftJoin('merchants', 'merchants.id', '=', 'parcels.merchantId')
                    ->leftJoin('divisions', 'parcels.division_id', '=', 'divisions.id')
                    ->leftJoin('districts', 'parcels.district_id', '=', 'districts.id')
                    ->leftJoin('thanas', 'parcels.thana_id', '=', 'thanas.id')
                    ->leftJoin('areas', 'parcels.area_id', '=', 'areas.id')
                    ->leftJoin('parceltypes', 'parcels.status', '=', 'parceltypes.id')
                    ->whereIn('parcels.thana_id', $thana_ids)
                    ->whereNull('parcels.deliverymanId')
                    ->where('parcels.recipientPhone', $request->phoneNumber)
                    ->where('parcels.status', 2)
                    ->select('parcels.*', 'parceltypes.title', 'divisions.name as division', 'districts.name as district', 'thanas.name as thana', 'areas.name as area', 'merchants.firstName', 'merchants.lastName', 'merchants.phoneNumber', 'merchants.emailAddress', 'merchants.companyName', 'merchants.status as mstatus', 'merchants.id as mid')
                    ->orderBy('parcels.id', 'desc')
                    ->paginate($per_page);
            } elseif ($request->startDate != NULL && $request->endDate != NULL) {
                $data['all_parcel'] = DB::table('parcels')
                    ->leftJoin('merchants', 'merchants.id', '=', 'parcels.merchantId')
                    ->leftJoin('divisions', 'parcels.division_id', '=', 'divisions.id')
                    ->leftJoin('districts', 'parcels.district_id', '=', 'districts.id')
                    ->leftJoin('thanas', 'parcels.thana_id', '=', 'thanas.id')
                    ->leftJoin('areas', 'parcels.area_id', '=', 'areas.id')
                    ->leftJoin('parceltypes', 'parcels.status', '=', 'parceltypes.id')
                    ->whereIn('parcels.thana_id', $thana_ids)
                    ->whereNull('parcels.deliverymanId')
                    ->whereBetween('parcels.created_at', [$request->startDate, $request->endDate])
                    ->where('parcels.status', 2)
                    ->select('parcels.*', 'parceltypes.title', 'divisions.name as division', 'districts.name as district', 'thanas.name as thana', 'areas.name as area', 'merchants.firstName', 'merchants.lastName', 'merchants.phoneNumber', 'merchants.emailAddress', 'merchants.companyName', 'merchants.status as mstatus', 'merchants.id as mid')
                    ->orderBy('parcels.id', 'desc')
                    ->paginate($per_page);
            } elseif ($request->phoneNumber != NULL || $request->phoneNumber != NULL && $request->startDate != NULL && $request->endDate != NULL) {
                $data['all_parcel'] = DB::table('parcels')
                    ->leftJoin('merchants', 'merchants.id', '=', 'parcels.merchantId')
                    ->leftJoin('divisions', 'parcels.division_id', '=', 'divisions.id')
                    ->leftJoin('districts', 'parcels.district_id', '=', 'districts.id')
                    ->leftJoin('thanas', 'parcels.thana_id', '=', 'thanas.id')
                    ->leftJoin('areas', 'parcels.area_id', '=', 'areas.id')
                    ->leftJoin('parceltypes', 'parcels.status', '=', 'parceltypes.id')
                    ->whereIn('parcels.thana_id', $thana_ids)
                    ->whereNull('parcels.deliverymanId')
                    ->where('parcels.recipientPhone', $request->phoneNumber)
                    ->whereBetween('parcels.created_at', [$request->startDate, $request->endDate])
                    ->where('parcels.status', 2)
                    ->select('parcels.*', 'parceltypes.title', 'divisions.name as division', 'districts.name as district', 'thanas.name as thana', 'areas.name as area', 'merchants.firstName', 'merchants.lastName', 'merchants.phoneNumber', 'merchants.emailAddress', 'merchants.companyName', 'merchants.status as mstatus', 'merchants.id as mid')
                    ->orderBy('parcels.id', 'desc')
                    ->paginate($per_page);
            } else {
                $data['all_parcel'] = DB::table('parcels')
                    ->leftJoin('merchants', 'merchants.id', '=', 'parcels.merchantId')
                    ->leftJoin('divisions', 'parcels.division_id', '=', 'divisions.id')
                    ->leftJoin('districts', 'parcels.district_id', '=', 'districts.id')
                    ->leftJoin('thanas', 'parcels.thana_id', '=', 'thanas.id')
                    ->leftJoin('areas', 'parcels.area_id', '=', 'areas.id')
                    ->leftJoin('parceltypes', 'parcels.status', '=', 'parceltypes.id')
                    ->whereIn('parcels.thana_id', $thana_ids)
                    ->whereNull('parcels.deliverymanId')
                    ->where('parcels.status', 2)
                    ->select('parcels.*', 'parceltypes.title', 'divisions.name as division', 'districts.name as district', 'thanas.name as thana', 'areas.name as area', 'merchants.companyName', 'merchants.firstName', 'merchants.lastName', 'merchants.phoneNumber', 'merchants.emailAddress')
                    ->orderBy('parcels.id', 'desc')
                    ->paginate($per_page);
            }

            return response()->json(['success' => true, 'data' => $data], 200);
        } else {
            return response()->json(['success' => false, 'message' => 'Opps! INVALID api token.'], 200);
        }
    }

    public function deliverymanAsign(Request $request)
    {
        $rules = [
            'hidden_id' => 'required',
            'deliverymanId' => 'required',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => $validator->errors()->first()], 200);
        }

        $user = $this->deliveryman($request->api_token);
        if ($user) {
            $parcel = Parcel::find($request->hidden_id);
            $parcel->deliverymanId = $request->deliverymanId;
            $parcel->save();

            $note = new Parcelnote();
            $note->parcelId = $request->hidden_id;
            $note->note = "Deliveryman Asign";
            $note->save();
            return response()->json(['success' => true, 'message' => 'A deliveryman asign successfully!'], 200);
        } else {
            return response()->json(['success' => false, 'message' => 'Opps! INVALID api token.'], 200);
        }
    }

    public function invoice(Request $request, $id)
    {
        $user = $this->deliveryman($request->api_token);
        if ($user) {
            $data = DB::table('parcels')
                ->leftJoin('merchants', 'merchants.id', '=', 'parcels.merchantId')
                ->leftJoin('divisions', 'parcels.division_id', '=', 'divisions.id')
                ->leftJoin('districts', 'parcels.district_id', '=', 'districts.id')
                ->leftJoin('thanas', 'parcels.thana_id', '=', 'thanas.id')
                ->leftJoin('areas', 'parcels.area_id', '=', 'areas.id')
                ->leftJoin('parceltypes', 'parcels.status', '=', 'parceltypes.id')
                ->where('parcels.id', $id)
                ->select('parcels.*', 'parceltypes.title', 'divisions.name as division', 'districts.name as district', 'thanas.name as thana', 'areas.name as area', 'merchants.companyName', 'merchants.phoneNumber', 'merchants.emailAddress')
                ->first();
            if ($data != NULL) {
                return response()->json(['success' => true, 'data' => $data], 200);
            } else {
                return response()->json(['success' => false, 'message' => 'Opps! Parcel not found.'], 200);
            }
        } else {
            return response()->json(['success' => false, 'message' => 'Opps! INVALID api token.'], 200);
        }
    }

    public function statusupdate(Request $request)
    {
        $rules = [
            'hidden_id' => 'required',
            'status' => 'required',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => $validator->errors()->first()], 200);
        }
        $user = $this->deliveryman($request->api_token);
        if ($user) {
            $parcel = Parcel::find($request->hidden_id);
            $parcel->status = $request->status;
            $parcel->save();

            if ($request->note) {
                $note = new Parcelnote();
                $note->parcelId = $request->hidden_id;
                $note->note = $request->note;
                $note->save();
            }
            if ($request->status == 2) {
                $pickupmanInfo = Pickupman::where(['id' => $parcel->pickupmanId])->first();
                $parcel = Parcel::find($request->hidden_id);
                $parcel->status = $request->status;
                $parcel->pickupman_amount = $pickupmanInfo->per_parcel_amount;
                $parcel->pickupman_paid = 0;
                $parcel->pickupman_due = $pickupmanInfo->per_parcel_amount;
                $parcel->pickup_date = now();
                $parcel->save();

                $deliverymanInfo = Deliveryman::where(['id' => $parcel->pickupmanId])->first();
                $merchantinfo = Merchant::find($parcel->merchantId);
                if ($pickupmanInfo != NULL) {
                    $number = "0" . $merchantinfo->phoneNumber;
                    $msg = "Dear " . $merchantinfo->companyName . ", Your Parcel Tracking ID " . $parcel->trackingCode . " for " . $pickupmanInfo->name . " , " . $pickupmanInfo->phone . " is PICKED.
                     Regards, Sensor Courier";
                    $this->sendSMS($number, $msg);
                }
                if ($request->note != NULL) {
                    $note = new Parcelnote();
                    $note->parcelId = $request->hidden_id;
                    $note->note = 'Parcel Picked successfully';
                    $note->save();
                }
            } elseif ($request->status == 3) {
                $parcel = Parcel::find($request->hidden_id);
                $parcel->status = $request->status;
                $parcel->save();
                $parcel->merchantDue = 0;
                $parcel->save();
            } elseif ($request->status == 4) {
                $deliverymanInfo = Deliveryman::where(['id' => $parcel->deliverymanId])->first();
                $parcel = Parcel::find($request->hidden_id);
                $parcel->status = $request->status;
                $parcel->deliveryman_amount = $deliverymanInfo->per_parcel_amount;
                $parcel->deliveryman_paid = 0;
                $parcel->deliveryman_due = $deliverymanInfo->per_parcel_amount;
                $parcel->delivery_date = now();
                $parcel->save();

                if ($request->note != NULL) {
                    $note = new Parcelnote();
                    $note->parcelId = $request->hidden_id;
                    $note->note = 'Parcel delivered successfully';
                    $note->save();
                }
                $merchantinfo = Merchant::find($parcel->merchantId);
                if ($deliverymanInfo != NULL) {
                    $number = "0" . $merchantinfo->phoneNumber;
                    $msg = "Dear " . $merchantinfo->companyName . ", Your Parcel Tracking ID " . $parcel->trackingCode . " for " . $deliverymanInfo->name . " , " . $deliverymanInfo->phone . " is DELIVERED.
                     Regards, Sensor Courier";
                    $this->sendSMS($number, $msg);
                }

                // if ($merchantinfo->emailAddress) {
                //     $data = array(
                //         'contact_mail' => $merchantinfo->emailAddress,
                //         'trackingCode' => $parcel->trackingCode,
                //     );
                //     $send = Mail::send('frontEnd.emails.percelcancel', $data, function ($textmsg) use ($data) {
                //         $textmsg->from('info@sensorbd.com');
                //         $textmsg->to($data['contact_mail']);
                //         $textmsg->subject('Percel Cancelled Notification');
                //     });
                // }

            }

            return response()->json(['success' => true, 'message' => 'Parcel information update successfully!'], 200);
        } else {
            return response()->json(['success' => false, 'message' => 'Opps! INVALID api token.'], 200);
        }
    }
    public function pickup(Request $request)
    {
        $user = $this->deliveryman($request->api_token);
        if ($user) {
            $show_data = DB::table('pickups')
                ->where('pickups.deliveryman', $user->id)
                ->orderBy('pickups.id', 'DESC')
                ->select('pickups.*')
                ->get();
            $deliverymens = Deliveryman::where('status', 1)->get();
            return response()->json(['success' => true, 'data' => $show_data, 'deliverymens' => $deliverymens], 200);
        } else {
            return response()->json(['success' => false, 'message' => 'Opps! INVALID api token.'], 200);
        }
    }
    public function pickupdeliverman(Request $request)
    {
        $rules = [
            'hidden_id' => 'required',
            'deliveryman' => 'required',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => $validator->errors()->first()], 200);
        }
        $user = $this->deliveryman($request->api_token);
        if ($user) {
            $pickup = Pickup::find($request->hidden_id);
            $pickup->deliveryman = $request->deliveryman;
            $pickup->save();
            return response()->json(['success' => true, 'message' => 'A deliveryman asign successfully!'], 200);
        } else {
            return response()->json(['success' => false, 'message' => 'Opps! INVALID api token.'], 200);
        }
    }

    public function pickupstatus(Request $request)
    {
        $rules = [
            'hidden_id' => 'required',
            'status' => 'required',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => $validator->errors()->first()], 200);
        }
        $user = $this->deliveryman($request->api_token);
        if ($user) {
            $pickup = Pickup::find($request->hidden_id);
            $pickup->status = $request->status;
            $pickup->save();
            return response()->json(['success' => true, 'message' => 'Pickup status update successfully!'], 200);
        } else {
            return response()->json(['success' => false, 'message' => 'Opps! INVALID api token.'], 200);
        }
    }

    public function locationUpdate(Request $request)
    {
        $rules = [
            'latitude' => 'required',
            'longitude' => 'required',
            'location' => 'nullable',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => $validator->errors()->first()], 200);
        }

        $user = $this->deliveryman($request->api_token);
        if ($user) {
            $user->latitude = $request->latitude;
            $user->longitude = $request->longitude;
            $user->location = $request->location;
            $user->save();
            return response()->json(['success' => true, 'message' => 'Location updated successfully done.'], 200);
        } else {
            return response()->json(['success' => false, 'message' => 'Opps! INVALID api token.'], 200);
        }
    }

    public function passfromreset(Request $request)
    {
        $rules = [
            'email' => 'required|email',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => $validator->errors()->first()], 200);
        }
        $validDeliveryman = Deliveryman::Where('email', $request->email)->first();
        if ($validDeliveryman) {
            $verifyToken = rand(111111, 999999);
            $validDeliveryman->passwordReset  = $verifyToken;
            $validDeliveryman->save();

            $data = array(
                'contact_mail' => $validDeliveryman->email,
                'verifyToken' => $verifyToken,
            );
            $send = Mail::send('frontEnd.layouts.pages.deliveryman.forgetemail', $data, function ($textmsg) use ($data) {
                $textmsg->from('info@sensorbd.com');
                $textmsg->to($data['contact_mail']);
                $textmsg->subject('Forget password token');
            });
            return response()->json(['success' => true, 'data' => $validDeliveryman, 'message' => 'Forget password token send to your mail successfully.'], 200);
        } else {
            return response()->json(['success' => false, 'message' => 'Sorry! You have no account'], 200);
        }
    }

    public function saveResetPassword(Request $request)
    {
        $rules = [
            'verifyPin' => 'required',
            'deliveryman_id' => 'required',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => 'Opps, User id not found!'], 200);
        }

        $validDeliveryman = Deliveryman::find($request->deliveryman_id);
        if ($validDeliveryman->passwordReset == $request->verifyPin) {
            $validDeliveryman->password   = bcrypt(request('newPassword'));
            $validDeliveryman->passwordReset  = NULL;
            $validDeliveryman->save();

            return response()->json(['success' => true, 'data' => $validDeliveryman, 'true' => 'Wow! Your password reset successfully'], 200);
        } else {
            return response()->json(['success' => false, 'message' => 'Sorry! Your process something wrong', 'warning!'], 200);
        }
    }

    public function logout(Request $request)
    {
        $rules = [
            'deliveryman_id' => 'required',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => 'Opps, Logged user not found!'], 200);
        }
        $deliveryman = Deliveryman::find($request->deliveryman_id);
        if ($deliveryman) {
            $deliveryman->api_token = Str::random(60);
            $deliveryman->save();
            return response()->json(['success' => true, 'message' => 'Thanks! you are logout successfully'], 200);
        } else {
            return response()->json(['success' => false, 'message' => 'Opps! user not found!'], 200);
        }
    }

    public function payments(Request $request, $type = 'all')
    {
        $rules = [
            'api_token' => 'required',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => $validator->errors()->first()], 200);
        }

        $deliveryman = $this->deliveryman($request->api_token);
        if ($deliveryman) {
            $query = Parcel::where('deliverymanId', $deliveryman->id);
            if ($type == 'paid') {
                $query->where('deliveryman_paid', '>', 0);
            }
            if ($type == 'due') {
                $query->where('deliveryman_due', '>', 0);
            }
            $data = $query->orderBy('status', 'asc')->orderBy('id', 'desc')->paginate(15);
            return response()->json(['success' => true, 'data' => $data], 200);
        } else {
            return response()->json(['success' => false, 'message' => 'Opps! user not found!'], 200);
        }
    }
}
