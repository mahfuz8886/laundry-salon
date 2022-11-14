<?php

namespace App\Http\Controllers\FrontEnd;

use App\AccountHead;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Str;
use App\Merchant;
use App\Nearestzone;
use App\Deliverycharge;
use App\Codcharge;
use App\Parcel;
use App\Imports\ParcelImport;
use App\Exports\ParcelExport;
use App\Employee;
use App\Price;
use App\Pickup;
use App\Merchantpayment;
use App\Parcelnote;
use App\Deliveryman;
use App\Agent;
use App\Customer;
use App\CustomerAddress;
use App\DeliveryChargeHead;
use App\Division;
use App\Parceltype;
use App\PromotionalDiscount;
use App\Thana;
use App\Weight;
use App\Order;
use App\OrderItem;
use App\OrderShipping;
use App\OrderBilling;
use DB;
use Mail;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Facades\Excel;

class MerchantController extends Controller
{

    public function registerpage(Request $request)
    {
        $phoneNumber = $request->phoneNumber;
        $msg = '';
        if ($request->phoneNumber) {
            $this->validate($request, [
                'phoneNumber' => 'numeric|digits:11'
            ]);
            // Verify code generate
            $verifyToken = rand(111111, 999999);
            $numbers = $request->phoneNumber;
            $msg = "Welcome! Please submit your verify code. ";

            $exist = Customer::where('phoneNumber', $request->phoneNumber)->first();
            if ($exist) {
                if ($exist->verify == 1 && $exist->firstName) {
                    return redirect('merchant/register')->with('error', 'This number already taken.');
                } else {
                    $exist->update(['verify' => $verifyToken, 'status' => 0]);
                    $numbers = $request->phoneNumber;
                    $msg = "Welcome! Please submit your verify code. ";
                    $sms = "Welcome! Your verify code is " . $verifyToken;
                    $this->sendOTPSMS($numbers, $sms);
                    Session::put('merchant_id', $exist->id);
                }
            } else {
                $merchant = Customer::create([
                    'phoneNumber' => $request->phoneNumber,
                    'verify' => $verifyToken,
                    'password' => bcrypt($request->phoneNumber),
                    'status' => 0
                ]);
                $numbers = $request->phoneNumber;
                $msg = "Welcome! Please submit your verify code. ";
                $sms = "Welcome! Your verify code is " . $verifyToken;
                $this->sendOTPSMS($numbers, $sms);
                Session::put('merchant_id', $merchant->id);
            }
        }

        $verify_code = $request->verify_code;
        $form_show = false;
        if ($request->verify_code && Session::get('merchant_id')) {
            $merchant = Customer::where('phoneNumber', $request->mobile_no)->where('verify', $request->verify_code)->first();
            if ($merchant) {
                $merchant->update([
                    'verify' => 0,
                    'status' => 1,
                    'api_token' => Str::random(50)
                ]);
                $msg = "Welcome! Your account verified successfully done. The ( * ) field is required.";
                $form_show = true;
            } else {
                $phoneNumber = $request->mobile_no;
                $verify_code = null;
                $msg = "Opps! INVALID CODE.";
            }
        }
        $divisions = Division::orderBy('name')->where('status', 1)->get();
        return view('frontEnd.layouts.pages.register', compact('phoneNumber', 'verify_code', 'msg', 'divisions', 'form_show'));
    }

    public function register(Request $request)
    {
           
        $this->validate($request, [
            'firstName' => 'required|max:150',
            'emailAddress' => 'nullable|email',
            'customer_type' => 'required',
            'division_id' => 'required',
            'district_id' => 'required',
            'thana_id' => 'required',
            'address' => 'required',
            'password' => 'required|same:confirmed|min:6',
            'confirmed' => 'required',
        ]);

        $marchent = Customer::find(Session::get('merchant_id'));
        if ($request->file('logo')) {
            $marchent->logo = $this->fileUpload($request->file('logo'), 'public/uploads/merchant/', 324, 204);
        }

        $marchent->firstName     =   $request->firstName;
        $marchent->emailAddress  =   $request->emailAddress;
        $marchent->origin  =   'Laundry';
        $marchent->customer_type  = $request->customer_type;
        $marchent->verify        =   1;
        $marchent->status        =   1;
        $marchent->agree         =   1;
        $marchent->password      =    bcrypt(request('password'));
        $marchent->save();

        $merchantId = $marchent->id;

        if($merchantId) {
            $address = new CustomerAddress();
            $address->customer_id = $merchantId;
            $address->is_default = 'no';
            $address->type = 'Home';
            $address->fullname = $request->firstName;
            $address->mobile_no = $marchent->phoneNumber;
            $address->region_id = $request->division_id;
            $address->city_id = $request->district_id;
            $address->area_id = $request->thana_id;
            $address->address = $request->address;

            $address->save();

            //add account head
            $storeAccount = new AccountHead();
            $storeAccount->head_type = 1;
            $storeAccount->user_id = $merchantId;
            $storeAccount->head_name = $merchantId.$request->firstName;
            $storeAccount->status = 1;
            $storeAccount->save();
            
        }

        Session::put('merchantId', $merchantId);
        Session::put('LAST_ACTIVITY', time());
        Session::flash('success', 'Thanks for registration'); 
        return redirect('/merchant/dashboard')->with('success','Registration successful.');;
    }

    public function freeregister(Request $request)
    {
        Session::put('registerphone', $request->phoneNumber);
        return redirect('/merchant/register');
    }

    public function merchantverify()
    {
        if (Session::get('initmerchantId') != NULL) {
            return view('frontEnd.layouts.pages.merchantverify');
        } else {
            return redirect()->back();
        }
    }

    public function merchantverifysave(Request $request)
    {
        $this->validate($request, [
            'verifypin' => 'required',
        ]);
        $verified = Merchant::find(Session::get('initmerchantId'));
        $verifydbtoken = $verified->verify;
        $verifyformtoken = $request->verifypin;
        if ($verifydbtoken == $verifyformtoken) {
            $verified->verify = 1;
            $verified->Save();
            Session::forget('initmerchantId');
            Session::put('merchantId', $verified->id);
            Toastr::success('success', 'Thanks , You are login successfully');
            return redirect('merchant/dashboard');
        } else {
            Toastr::error('Opps!', 'Sorry! your code wrong');
            return redirect()->back();
        }
    }

    public function loginpage()
    {
        return view('frontEnd.layouts.pages.login');
    }
    public function login(Request $request)
    {
        $this->validate($request, [
            'merchant_user' => 'required',
            'merchant_password' => 'required',
        ]);

        $merchantChedk = Customer::where('phoneNumber', $request->merchant_user)
            ->orWhere('emailAddress', $request->merchant_user)
            ->first();
        
        if ($merchantChedk) {
            if ($merchantChedk->status == 0 || $merchantChedk->verify == 0) {
                return redirect()->back()->withInput()->with('error', 'Opps! your account has been review');
            } elseif ($merchantChedk->verify != 1) {
                Session::put('initmerchantId', $merchantChedk->id);
                return redirect('merchant/verify');
            } else {
                if (password_verify($request->merchant_password, $merchantChedk->password)) {
                    $merchantId = $merchantChedk->id;
                    Session::put('merchantId', $merchantId);
                    Session::put('LAST_ACTIVITY', time());
                    return redirect('/merchant/dashboard')->with('success','Thanks , You are login successfully');
                } else {
                    return redirect()->back()->with('error', 'Sorry! your password wrong');
                }
            }
        } else {
            return redirect()->back()->with('error', 'Opps! you have no account');
        }
    }
    // Merchant Login Function End

    public function dashboard()
    {
        return view('frontEnd.layouts.pages.merchant.dashboard');
    }
    // Merchant Dashboard

    public function profile()
    {
        $merchantInfo = Merchant::find(Session::get('merchantId'));
        return view('frontEnd.layouts.pages.merchant.profile', compact('merchantInfo'));
    }

    public function profileEdit()
    {
        $profileinfos = Merchant::all();
        $divisions = Division::orderBy('name')->where('status', 1)->get();
        $pickup_thanas = Thana::orderBy('name')->where('status', 1)->get();
        return view('frontEnd.layouts.pages.merchant.profileedit', compact('divisions', 'pickup_thanas'));
    }

    public function support()
    {
        return view('frontEnd.layouts.pages.merchant.support');
    }

    // Merchant Profile Edit
    public function profileUpdate(Request $request)
    {
        $rules = [];
        $rules['logo'] = "nullable|image";
        $rules['firstName'] = "required";
        $rules['otherphoneNumber'] = 'nullable|numeric|digits:11';
        $rules['identification_type'] = "required";
        $rules['division_id'] = "required";
        $rules['district_id'] = "required";
        $rules['pickup_thana_id'] = "required";
        $rules['pickLocation'] = "required";

        $update_merchant = Merchant::find(Session::get('merchantId'));
        if ($request->file('logo')) {
            if ($update_merchant->logo) {
                File::delete($update_merchant->logo);
            }
            $update_merchant->logo = $this->fileUpload($request->file('logo'), 'public/uploads/merchant/', 324, 204);
        }
        $update_merchant->identification_type     =   $request->identification_type;
        if ($request->identification_type == 1) {
            if (empty($update_merchant->nid_photo)) {
                $rules['nid_photo'] = "required|image";
            }
            $update_merchant->nidnumber     =   $request->nidnumber;
            if ($request->file('nid_photo')) {
                if ($update_merchant->nid_photo) {
                    File::delete($update_merchant->nid_photo);
                }
                $update_merchant->nid_photo = $this->fileUpload($request->file('nid_photo'), 'public/uploads/merchant/', 324, 204);
            }
            if ($request->file('nid_photo_back')) {
                if ($update_merchant->nid_photo_back) {
                    File::delete($update_merchant->nid_photo_back);
                }
                $update_merchant->nid_photo_back = $this->fileUpload($request->file('nid_photo_back'), 'public/uploads/merchant/', 324, 204);
            }
        } elseif ($request->identification_type == 2) {
            if (empty($update_merchant->birth_certificate_photo)) {
                $rules['birth_certificate_photo'] = "required|image";
            }
            $update_merchant->birth_certificate_no     =   $request->birth_certificate_no;
            if ($request->file('birth_certificate_photo')) {
                if ($update_merchant->birth_certificate_photo) {
                    File::delete($update_merchant->birth_certificate_photo);
                }
                $update_merchant->birth_certificate_photo = $this->fileUpload($request->file('birth_certificate_photo'), 'public/uploads/merchant/', 324, 204);
            }
        } elseif ($request->identification_type == 3) {
            if (empty($update_merchant->driving_licence_photo)) {
                $rules['driving_licence_photo'] = "required|image";
            }

            $update_merchant->driving_licence_no     =   $request->driving_licence_no;
            if ($request->file('driving_licence_photo')) {
                if ($update_merchant->driving_licence_photo) {
                    File::delete($update_merchant->driving_licence_photo);
                }
                $update_merchant->driving_licence_photo = $this->fileUpload($request->file('driving_licence_photo'), 'public/uploads/merchant/', 324, 204);
            }
        }
        $this->validate($request, $rules);
        $update_merchant->firstName = $request->firstName;
        // $update_merchant->phoneNumber = $request->phoneNumber;
        $update_merchant->emailAddress  =   $request->emailAddress;
        $update_merchant->fathers_name = $request->fathers_name;
        $update_merchant->mothers_name = $request->mothers_name;
        $update_merchant->present_address = $request->present_address;
        $update_merchant->permanent_address = $request->permanent_address;
        $update_merchant->otherphoneNumber = $request->otherphoneNumber;
        $update_merchant->mAdress = $request->mAdress;
        $update_merchant->pickup_thana_id = $request->pickup_thana_id;
        $update_merchant->pickLocation = $request->pickLocation;
        $update_merchant->division_id = $request->division_id;
        $update_merchant->district_id = $request->district_id;
        $update_merchant->thana_id = $request->thana_id;
        $update_merchant->area_id = $request->area_id;
        $update_merchant->pickupPreference = $request->pickupPreference;
        $update_merchant->paymentMethod = $request->paymentMethod;
        $update_merchant->payoption = $request->paymentMethod;
        $update_merchant->withdrawal = $request->withdrawal;
        $update_merchant->nameOfBank = $request->nameOfBank;
        $update_merchant->bankBranch = $request->bankBranch;
        $update_merchant->bankAcHolder = $request->bankAcHolder;
        $update_merchant->bankAcNo = $request->bankAcNo;
        $update_merchant->bkashNumber = $request->bkashNumber;
        $update_merchant->roketNumber = $request->roketNumber;
        $update_merchant->nogodNumber = $request->nogodNumber;
        $update_merchant->nidnumber = $request->nidnumber;
        $update_merchant->trade_licence_no = $request->trade_licence_no;
        $update_merchant->facebook_page  =   $request->facebook_page;
        $update_merchant->website  =   $request->website;
        $update_merchant->save();
        return redirect()->back()->with('success', 'Your account update successfully');
    }

    public function removeUpdateImage($update_merchant)
    {
        if ($update_merchant->nid_photo) {
            File::delete($update_merchant->nid_photo);
        }
        if ($update_merchant->birth_certificate_photo) {
            File::delete($update_merchant->birth_certificate_photo);
        }
        if ($update_merchant->driving_licence_no) {
            File::delete($update_merchant->driving_licence_no);
        }
    }

    // Merchant Profile Update
    public function logout()
    {
        Session::flush();
        Toastr::success('Success!', 'Thanks! you are logout successfully');
        return redirect('/merchant/login');
    }
    // Merchant Logout

    public function chooseservice()
    {
        $pricing = Deliverycharge::where('status', 1)->get();
        return view('frontEnd.layouts.pages.merchant.chooseservice', compact('pricing'));
    }

    public function parcelcreate(Request $request)
    {
        $delivery_charge_heads = DeliveryChargeHead::where('status', 1)->get();
        $divisions = Division::orderBy('name')->where('status', 1)->get();
        $pickup_thanas = Thana::orderBy('name')->where('status', 1)->get();
        $codcharge = Codcharge::where('status', 1)->orderBy('id', 'DESC')->first();
        $merchant = Merchant::find(Session::get('merchantId'));
        $weights = Weight::where('status', 1)->get();
        Session::forget('codpay');
        Session::forget('pcodecharge');
        Session::forget('pdeliverycharge');
        return view('frontEnd.layouts.pages.merchant.parcelcreate', compact('codcharge', 'divisions', 'pickup_thanas', 'weights', 'delivery_charge_heads', 'merchant'));
    }


    //Parcel Oparation
    public function parcelstore(Request $request)
    {
        $this->validate($request, [
            'invoiceNo' => 'nullable|unique:parcels',
            // 'pickup_thana_id' => 'required',
            // 'pickLocation' => 'required',
            'name' => 'required',
            'weight_id' => 'required|numeric',
            'division_id' => 'required',
            'district_id' => 'required',
            'thana_id' => 'nullable',
            'area_id' => 'nullable',
            'delivery_address' => 'required',
        ]);

        //clear session
        Session::forget('codpay');
        Session::forget('pcodecharge');
        Session::forget('pdeliverycharge');

        $mercharntInfo = Merchant::where('id', Session::get('merchantId'))->first();
        $weight = Weight::find($request->weight_id);
        $thana = Thana::find($request->thana_id);
        if (empty($thana->deliverycharge_id)) {
            return response()->back()->withInput()->with('error', 'This thana are currently unavailable.');
        }
        $percelType = 1;
        if ($request->productPrice > 0) {
            $percelType = 2;  // COD Collection
        }

        // get deliverycharge
        $deliveryChargeInfo = Deliverycharge::where(['id' => $thana->deliverycharge_id])->first();
        $delivery_charge = $deliveryChargeInfo->deliverycharge - (($deliveryChargeInfo->deliverycharge * $mercharntInfo->del_commission) / 100);

        // Extra charge
        $extra_weight = $weight->value - 1;
        $delivery_charge = $delivery_charge + ($extra_weight * $deliveryChargeInfo->extradeliverycharge);

        // Promotional Charge
        $promotiuonal_discount_exist = PromotionalDiscount::whereDate('start_date', '<=', date('Y-m-d'))
            ->whereDate('end_date', '>=', date('Y-m-d'))
            ->where('status', 1)->first();
        if ($promotiuonal_discount_exist) {
            $promotiuonal_discount = ($delivery_charge * $promotiuonal_discount_exist->discount) / 100;
        } else {
            $promotiuonal_discount = 0;
        }
        $delivery_charge = $delivery_charge - $promotiuonal_discount;

        // cod charge
        // $codChargeInfo = Codcharge::where(['status' => 1])->first();
        $codcharge = (floatval($deliveryChargeInfo->cod_charge) * $request->productPrice) / 100;
        $codcharge = $codcharge - (($codcharge * $mercharntInfo->cod_commission) / 100);


        $merchantAmount = (round($request->productPrice - ($delivery_charge + $codcharge), 2));
        $merchantDue = round($merchantAmount, 2);


        $tracking_code   = "SC-" . mt_rand(111111, 999999);
        $store_parcel = new Parcel;
        $store_parcel->invoiceNo = $request->invoiceNo;
        $store_parcel->merchantId = Session::get('merchantId');
        $store_parcel->cod = $request->productPrice;
        $store_parcel->percelType = $percelType;
        $store_parcel->recipientName = $request->name;
        $store_parcel->recipientAddress = $request->delivery_address;
        $store_parcel->recipientPhone = $request->phonenumber;
        $store_parcel->pickup_thana_id = $mercharntInfo->pickup_thana_id;
        $store_parcel->pickLocation = $mercharntInfo->pickLocation;
        $store_parcel->productWeight = $weight->value;
        $store_parcel->trackingCode  = $tracking_code;
        $store_parcel->note = $request->note;
        $store_parcel->deliveryCharge = round($delivery_charge, 2);
        $store_parcel->promotiuonal_discount = round($promotiuonal_discount, 2);
        $store_parcel->codCharge = round($codcharge, 2);
        $store_parcel->division_id = $request->division_id;
        $store_parcel->district_id = $request->district_id;
        $store_parcel->thana_id = $request->thana_id;
        $store_parcel->area_id = $request->area_id;
        $store_parcel->delivery_address = $request->delivery_address;
        $store_parcel->productPrice = 0;
        $store_parcel->merchantAmount = $merchantAmount;
        $store_parcel->merchantDue = 0;
        $store_parcel->orderType = $deliveryChargeInfo->id;
        $store_parcel->codType = $deliveryChargeInfo->id;
        $store_parcel->status = 1;
        $store_parcel->save();

        $note = new Parcelnote();
        $note->parcelId = $store_parcel->id;
        $note->note = 'Parcel create successfully';
        $note->save();

        // $data = array(
        //     'trackingCode' =>  $store_parcel->trackingCode,
        //     'subject' => 'New Parcel Place',
        // );

        // return $data;
        // $send = Mail::send('frontEnd.emails.parcelplace', $data, function ($textmsg) use ($data) {
        //     $textmsg->to('info@sensorbd.com');
        //     $textmsg->subject($data['subject']);
        // });

        Toastr::success('Success!', 'Thanks! your parcel add successfully and your tracking code is : ' . $tracking_code, ['timeOut' => 10000]);
        return redirect()->back();
    }

    public function pickuprequest(Request $request)
    {
        $this->validate($request, [
            'pickupAddress' => 'required',
        ]);

        $date = date('Y-m-d');
        $findpickup = Pickup::where('date', $date)->Where('merchantId', Session::get('merchantId'))->count();
        if ($findpickup) {
            Toastr::error('Opps!', 'Sorry! your pickup request already pending');
            return redirect()->back();
        } else {
            $store_pickup = new Pickup;
            $store_pickup->merchantId = Session::get('merchantId');
            $store_pickup->pickuptype = $request->pickuptype;
            $store_pickup->area  = $request->area;
            $store_pickup->pickupAddress = $request->pickupAddress;
            $store_pickup->note = $request->note;
            $store_pickup->date = $date;
            $store_pickup->estimedparcel = $request->estimedparcel;
            $store_pickup->save();
            Toastr::success('Success!', 'Thanks! your pickup request send  successfully');
            return redirect()->back();
        }
    }
    public function pickup()
    {
        $show_data = DB::table('pickups')
            ->where('pickups.merchantId', Session::get('merchantId'))
            ->orderBy('pickups.id', 'DESC')
            ->select('pickups.*')
            ->get();
        $deliverymen = Deliveryman::where('status', 1)->get();
        return view('frontEnd.layouts.pages.merchant.pickup', compact('show_data', 'deliverymen'));
    }
    public function parcels(Request $request)
    {
        $filter = $request->filter_id;
        $parceltypes = Parceltype::all();
        if ($request->trackId != NULL) {
            $allparcel = DB::table('parcels')
                ->leftJoin('merchants', 'merchants.id', '=', 'parcels.merchantId')
                ->leftJoin('divisions', 'parcels.division_id', '=', 'divisions.id')
                ->leftJoin('districts', 'parcels.district_id', '=', 'districts.id')
                ->leftJoin('thanas', 'parcels.thana_id', '=', 'thanas.id')
                ->leftJoin('areas', 'parcels.area_id', '=', 'areas.id')
                ->where('parcels.merchantId', Session::get('merchantId'))
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
                ->where('parcels.merchantId', Session::get('merchantId'))
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
                ->where('parcels.merchantId', Session::get('merchantId'))
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
                ->where('parcels.merchantId', Session::get('merchantId'))
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
                ->where('parcels.merchantId', Session::get('merchantId'))
                ->select('parcels.*', 'divisions.name as division', 'districts.name as district', 'thanas.name as thana', 'areas.name as area', 'merchants.firstName', 'merchants.lastName', 'merchants.phoneNumber', 'merchants.emailAddress', 'merchants.companyName', 'merchants.status as mstatus', 'merchants.id as mid')
                ->orderBy('parcels.status', 'asc')->orderBy('parcels.id', 'desc')
                ->get();
        }

        if ($request->invoiceNo) {
            $allparcel = $allparcel->where('invoiceNo', $request->invoiceNo);
        }

        if ($request->parcel_type) {
            $status = Parceltype::where('slug', $request->parcel_type)->first()->id ?? '';
            $allparcel = $allparcel->where('status', $status);
        }

        return view('frontEnd.layouts.pages.merchant.parcels', compact('allparcel', 'parceltypes'));
    }
    public function parceldetails($id)
    {
        $parceldetails = DB::table('parcels')
            ->leftJoin('divisions', 'parcels.division_id', '=', 'divisions.id')
            ->leftJoin('districts', 'parcels.district_id', '=', 'districts.id')
            ->leftJoin('thanas', 'parcels.thana_id', '=', 'thanas.id')
            ->leftJoin('areas', 'parcels.area_id', '=', 'areas.id')
            ->where('merchantId', Session::get('merchantId'))
            ->where('parcels.id', '=', $id)
            ->select('parcels.*', 'divisions.name as division', 'districts.name as district', 'thanas.name as thana', 'areas.name as area')
            ->first();
        // dd($parceldetails);
        $trackInfos = Parcelnote::where('parcelId', $id)->orderBy('id', 'ASC')->get();
        if ($parceldetails) {
            return view('frontEnd.layouts.pages.merchant.parceldetails', compact('parceldetails', 'trackInfos'));
        } else {
            Toastr::error('Opps!', 'Parcel not found!');
            return redirect()->back();
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
            ->where(['parcels.merchantId' => Session::get('merchantId'), 'parcels.id' => $id])
            ->where('parcels.id', $id)
            ->select('parcels.*', 'parceltypes.title', 'divisions.name as division', 'districts.name as district', 'thanas.name as thana', 'areas.name as area', 'merchants.firstName', 'merchants.companyName', 'merchants.phoneNumber', 'merchants.emailAddress', 'merchants.logo')
            ->first();
        $merchant = Merchant::find(Session::get('merchantId'));
        if ($show_data != NULL) {
            return view('frontEnd.layouts.pages.merchant.invoice', compact('show_data', 'merchant'));
        } else {
            Toastr::error('Opps!', 'Your process wrong');
            return redirect()->back();
        }
    }

    public function parceledit($id)
    {
        // return "please contact to admin for edit parcel";
        $parceledit = Parcel::where(['merchantId' => Session::get('merchantId'), 'id' => $id])->first();
        if ($parceledit != NULL) {
            $merchant = Merchant::find(Session::get('merchantId'));
            $delivery_charge_heads = DeliveryChargeHead::where('status', 1)->get();
            $ordertype = Deliverycharge::find($parceledit->orderType);
            $codcharge = Codcharge::find($parceledit->codType);
            $divisions = Division::orderBy('name')->where('status', 1)->get();
            $pickup_thanas = Thana::orderBy('name')->where('status', 1)->get();
            $weights = Weight::where('status', 1)->get();
            Session::put('codpay', $parceledit->cod);
            Session::put('pcodecharge', $parceledit->codCharge);
            Session::put('pdeliverycharge', $parceledit->deliveryCharge);
            return view('frontEnd.layouts.pages.merchant.parceledit', compact('merchant', 'weights', 'delivery_charge_heads', 'ordertype', 'codcharge', 'parceledit', 'divisions', 'pickup_thanas'));
        } else {
            Toastr::error('Opps!', 'Your process wrong');
            return redirect()->back();
        }
    }

    public function parcelupdate(Request $request)
    {
        $this->validate($request, [
            'hidden_id' => 'required',
            'invoiceNo' => 'required|unique:parcels,invoiceNo,' . $request->hidden_id,
            // 'pickup_thana_id' => 'required',
            // 'pickLocation' => 'required',
            'name' => 'required',
            'weight_id' => 'required|numeric',
            'division_id' => 'required',
            'district_id' => 'required',
            'thana_id' => 'nullable',
            'area_id' => 'nullable',
            'delivery_address' => 'required',
        ]);
        $update_parcel = Parcel::find($request->hidden_id);
        $mercharntInfo = Merchant::where('id', Session::get('merchantId'))->first();
        $weight = Weight::find($request->weight_id);
        $thana = Thana::find($request->thana_id);
        if (empty($thana->deliverycharge_id)) {
            return response()->back()->withInput()->with('error', 'This thana are currently unavailable.');
        }
        $percelType = 1;
        if ($request->productPrice > 0) {
            $percelType = 2;  // COD Collection
        }

        // get deliverycharge
        $deliveryChargeInfo = Deliverycharge::where(['id' => $thana->deliverycharge_id])->first();
        $delivery_charge = $deliveryChargeInfo->deliverycharge - (($deliveryChargeInfo->deliverycharge * $mercharntInfo->del_commission) / 100);

        // Extra charge
        $extra_weight = $weight->value - 1;
        $delivery_charge = $delivery_charge + ($extra_weight * $deliveryChargeInfo->extradeliverycharge);

        // Promotional Charge
        $promotiuonal_discount_exist = PromotionalDiscount::whereDate('start_date', '<=', date('Y-m-d'))
            ->whereDate('end_date', '>=', date('Y-m-d'))
            ->where('status', 1)->first();
        if ($promotiuonal_discount_exist) {
            $promotiuonal_discount = ($delivery_charge * $promotiuonal_discount_exist->discount) / 100;
        } else {
            $promotiuonal_discount = 0;
        }
        $delivery_charge = $delivery_charge - $promotiuonal_discount;

        // cod charge
        // $codChargeInfo = Codcharge::where(['status' => 1])->first();
        $codcharge = (floatval($deliveryChargeInfo->cod_charge) * $request->productPrice) / 100;
        $codcharge = $codcharge - (($codcharge * $mercharntInfo->cod_commission) / 100);

        $merchantAmount = (round($request->productPrice - ($delivery_charge + $codcharge), 2));
        $merchantDue = round($merchantAmount - $update_parcel->merchantPaid, 2);

        // Update parcel
        $update_parcel->invoiceNo = $request->invoiceNo;
        $update_parcel->merchantId = Session::get('merchantId');
        $update_parcel->cod = $request->productPrice;
        $update_parcel->percelType = $percelType;
        $update_parcel->recipientName = $request->name;
        $update_parcel->recipientAddress = $request->delivery_address;
        $update_parcel->recipientPhone = $request->phonenumber;
        $update_parcel->pickup_thana_id = $mercharntInfo->pickup_thana_id;
        $update_parcel->pickLocation = $mercharntInfo->pickLocation;
        $update_parcel->productWeight = $weight->value;
        $update_parcel->note = $request->note;
        $update_parcel->deliveryCharge = round($delivery_charge, 2);
        $update_parcel->promotiuonal_discount = round($promotiuonal_discount, 2);
        $update_parcel->codCharge = round($codcharge, 2);
        $update_parcel->division_id = $request->division_id;
        $update_parcel->district_id = $request->district_id;
        $update_parcel->thana_id = $request->thana_id;
        $update_parcel->area_id = $request->area_id;
        $update_parcel->delivery_address = $request->delivery_address;
        $update_parcel->productPrice = 0;
        $update_parcel->merchantAmount = $merchantAmount;
        $update_parcel->merchantDue = 0;
        $update_parcel->orderType = $deliveryChargeInfo->id;
        $update_parcel->codType = $deliveryChargeInfo->id;
        $update_parcel->status = 1;
        $update_parcel->save();

        $note = new Parcelnote();
        $note->parcelId = $update_parcel->id;
        $note->note = 'Parcel updated successfully';
        $note->save();

        Toastr::success('Success!', 'Thanks! your parcel update successfully');
        return redirect()->back();
    }
    public function singleservice(Request $request)
    {
        $data = array(
            'contact_mail' => 'info@sensorbd.com',
            'address' => $request->address,
            'area' => $request->area,
            'note' => $request->note,
            'estimate' => $request->estimate,
        );
        $send = Mail::send('frontEnd.emails.singleservice', $data, function ($textmsg) use ($data) {
            $textmsg->to($data['contact_mail']);
            $textmsg->subject('A Single Service Request');
        });
        Toastr::success('Success!', 'Thanks! your  request send successfully');
        return redirect()->back();
    }

    public function payments()
    {
        $merchantInvoice = Merchantpayment::where('merchantId', Session::get('merchantId'))->get();
        return view('frontEnd.layouts.pages.merchant.payments', compact('merchantInvoice'));
    }
    public function inovicedetails($id)
    {
        $invoiceInfo = Merchantpayment::find($id);
        $inovicedetails = Parcel::where('paymentInvoice', $id)->get();
        return view('frontEnd.layouts.pages.merchant.inovicedetails', compact('inovicedetails', 'invoiceInfo'));
    }
    public function passreset()
    {
        return view('frontEnd.layouts.pages.passreset');
    }

    public function parcelCancel($parcel_id)
    {
        $parcel = Parcel::find($parcel_id);
        if ($parcel->status < 2) {
            $parcel->cod = 0;
            $parcel->merchantAmount = 0;
            $parcel->merchantDue = 0;
            $parcel->deliveryCharge = 0;
            $parcel->codCharge = 0;
            $parcel->status = 9;
            $parcel->save();
        }
        Toastr::success('Success!', 'Parcel cancel successfull.');
        return redirect()->back();
    }



    public function passfromreset(Request $request)
    {
        $this->validate($request, [
            'phoneNumber' => 'required',
        ]);
        $validMerchant = Merchant::Where('phoneNumber', $request->phoneNumber)
            ->first();

        if ($validMerchant) {

            $verifyToken = rand(111111, 999999);
            $validMerchant->passwordReset     =    $verifyToken;
            $validMerchant->save();
            Session::put('resetCustomerId', $validMerchant->id);
            //  $data = array(
            //  'contact_mail' => $validMerchant->phoneNumber,
            //  'verifyToken' => $verifyToken,
            // );
            // $send = Mail::send('frontEnd.emails.passwordreset', $data, function($textmsg) use ($data){
            //  $textmsg->from('info@sensorbd.com');
            //  $textmsg->to($data['contact_mail']);
            //  $textmsg->subject('Forget password token');
            // });

            $msg = "Dear $validMerchant->firstName, \r\n Your password reset token is $verifyToken. Enjoy our services. If any query call us 01404477009 \r\nRegards\r\n Sensor Courier ";
            $numbers = "0" . $validMerchant->phoneNumber;
            $send_sms = $this->sendOTPSMS($numbers, $msg);

            return redirect('/merchant/resetpassword/verify');
        } else {
            Toastr::error('Sorry! You have no account', 'warning!');
            return redirect()->back();
        }
    }



    public function resetpasswordverify()
    {
        if (Session::get('resetCustomerId')) {
            return view('frontEnd.layouts.pages.passwordresetverify');
        } else {
            Toastr::error('Sorry! Your process something wrong', 'warning!');
            return redirect('forget/password');
        }
    }

    public function saveResetPassword(Request $request)
    {
        $validMerchant = Merchant::find(Session::get('resetCustomerId'));
        if ($validMerchant->passwordReset == $request->verifyPin) {
            $validMerchant->password     =    bcrypt(request('newPassword'));
            $validMerchant->passwordReset     =    NULL;
            $validMerchant->save();

            Session::forget('resetCustomerId');
            Session::put('merchantId', $validMerchant->id);
            Toastr::success('Wow! Your password reset successfully', 'success!');
            return redirect('/merchant/dashboard');
        } else {
            Toastr::error('Sorry! Your process something wrong', 'warning!');
            return redirect()->back();
        }
    }

    public function parceltrack(Request $request)
    {
        $trackparcel = DB::table('parcels')
            ->leftJoin('merchants', 'merchants.id', '=', 'parcels.merchantId')
            ->leftJoin('divisions', 'parcels.division_id', '=', 'divisions.id')
            ->leftJoin('districts', 'parcels.district_id', '=', 'districts.id')
            ->leftJoin('thanas', 'parcels.thana_id', '=', 'thanas.id')
            ->leftJoin('areas', 'parcels.area_id', '=', 'areas.id')
            ->where('parcels.trackingCode', $request->trackid)
            ->select('parcels.*', 'divisions.name as division', 'districts.name as district', 'thanas.name as thana', 'areas.name as area', 'merchants.companyName', 'merchants.phoneNumber', 'merchants.emailAddress')
            ->first();

        if ($trackparcel) {
            $trackInfos = Parcelnote::where('parcelId', $trackparcel->id)->orderBy('id', 'ASC')->get();
            return view('frontEnd.layouts.pages.merchant.trackparcel', compact('trackparcel', 'trackInfos'));
        } else {
            return redirect()->back();
        }
    }

    public function import(Request $request)
    {
        Excel::import(new ParcelImport, request()->file('excel'));
        Toastr::success('Wow! Bulk uploaded', 'success!');
        return redirect()->back();
    }
    public function export(Request $request)
    {
        return Excel::download(new ParcelExport(), 'parcel.xlsx');
    }


    /*................customer/merchant operation...................*/
    public function orders(Request $request) {
        $orders = Order::where('customer_id',Session::get('merchantId'));
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
        
                    $orders = $orders->with('getAmount')->with('statusName')->orderBy('id','desc')->paginate(20);
                    
        return view('frontEnd.layouts.pages.merchant.order_list',compact('orders'));
    }

    public function orderDetails($id) {
        $order = Order::where('id', $id)->first();
        $orderItems = OrderItem::where('order_id', $id)->with('product')->with('service')->with('package')->get();
        $shipping = OrderShipping::where('order_id', $id)->with('division')->with('district')->with('thana')->first();
        $billing = OrderBilling::where('order_id', $id)->with('division')->with('district')->with('thana')->first();

        //return $billing;
        
        return view('frontEnd.layouts.pages.merchant.order_details',compact('order','orderItems','shipping','billing'));
    }

}
