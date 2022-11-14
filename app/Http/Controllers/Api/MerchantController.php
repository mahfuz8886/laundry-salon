<?php

namespace App\Http\Controllers\Api;

use App\Area;
use App\Codcharge;
use App\Deliverycharge;
use App\DeliveryChargeHead;
use App\District;
use App\Division;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use App\Merchant;
use App\Merchantpayment;
use App\Parcel;
use App\Parcelnote;
use App\Parceltype;
use App\PromotionalDiscount;
use App\Thana;
use App\Weight;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class MerchantController extends Controller
{
    public function login(Request $request)
    {
        $rules = [
            'merchant_user' => 'required',
            'merchant_password' => 'required',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => $validator->errors()->first()], 200);
        }

        $checkAuth = Merchant::where('emailAddress', $request->merchant_user)
            ->orWhere('phoneNumber', $request->merchant_user)
            ->first();
        if ($checkAuth) {
            if ($checkAuth->status == 0) {
                return response()->json(['success' => false, 'message' => 'Opps! your account has been suspends'], 200);
            } else {
                if (password_verify($request->merchant_password, $checkAuth->password)) {
                    return response()->json(['success' => true, 'data' => $checkAuth, 'message' => 'Thanks , You are login successfully']);
                } else {
                    return response()->json(['success' => false, 'message' => 'Sorry! your password wrong'], 200);
                }
            }
        } else {
            return response()->json(['success' => false, 'message' => 'Opps! you have no account'], 200);
        }
    }

    public function sendOTP(Request $request)
    {
        $rules = [
            'phoneNumber' => 'numeric|digits:11'
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => $validator->errors()->first()], 200);
        }

        $verifyToken = rand(111111, 999999);
        $exist = Merchant::where('phoneNumber', $request->phoneNumber)->first();
        if ($exist) {
            if ($exist->verify == 1 && $exist->firstName) {
                return response()->json(['success' => false, 'message' => 'This number already taken.'], 200);
            } else {
                $exist->update(['verify' => $verifyToken]);
                $number = $request->phoneNumber;
                $sms = "Welcome! Your verify code is " . $verifyToken;
                $this->sendOTPSMS($number, $sms);
                return response()->json(['success' => true, 'message' => 'Welcome! Please submit your verify code.'], 200);
            }
        } else {
            $merchant = Merchant::create([
                'phoneNumber' => $request->phoneNumber,
                'verify' => $verifyToken,
                'password' => bcrypt($request->phoneNumber),
            ]);
            $number = $request->phoneNumber;
            $sms = "Welcome! Your verify code is " . $verifyToken;
            $this->sendOTPSMS($number, $sms);
            return response()->json(['success' => true, 'message' => 'Welcome! Please submit your verify code.'], 200);
        }
    }

    public function verifyOTP(Request $request)
    {
        $rules = [
            'verify_code' => 'required',
            'phoneNumber' => 'required',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => $validator->errors()->first()], 200);
        }

        $merchant = Merchant::where('phoneNumber', $request->phoneNumber)->where('verify', $request->verify_code)->first();
        if ($merchant) {
            $merchant->update([
                'verify' => 0,
                'status' => 0,
                'api_token' => Str::random(50)
            ]);
            $msg = "Welcome! Your account verified successfully done.";
            return response()->json(['success' => true, 'message' => $msg], 200);
        } else {
            $msg = "Opps! INVALID CODE.";
            return response()->json(['success' => false, 'message' => $msg], 200);
        }
    }

    public function registration(Request $request)
    {

        $rules = [
            'phoneNumber' => 'required|numeric|digits:11',
            'firstName' => 'required|max:150',
            'companyName' => 'required|max:150',
            'logo' => 'nullable|image',
            'emailAddress' => 'nullable|email',
            'identification_type' => 'required|numeric',
            'nidnumber' => 'required_if:identification_type,=,1',
            'nid_photo' => 'image|required_if:identification_type,=,1',
            'nid_photo_back' => 'image|required_if:identification_type,=,1',
            'birth_certificate_no' => 'required_if:identification_type,=,2',
            'birth_certificate_photo' => 'image|required_if:identification_type,=,2',
            'driving_licence_no' => 'required_if:identification_type,=,3',
            'driving_licence_photo' => 'image|required_if:identification_type,=,3',
            'division_id' => 'required',
            'district_id' => 'required',
            'payoption' => 'required',
            'password' => 'required|same:confirmed|min:6',
            'confirmed' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => $validator->errors()->first()], 200);
        }

        $marchent = Merchant::where('phoneNumber', $request->phoneNumber)->first();

        if ($marchent) {
            if ($request->file('logo')) {
                $marchent->logo = $this->fileUpload($request->file('logo'), 'public/uploads/merchant/', 324, 204);
            }
            $marchent->identification_type     =   $request->identification_type;
            if ($request->identification_type == 1) {
                $marchent->nidnumber     =   $request->nidnumber;
                if ($request->file('nid_photo')) {
                    $marchent->nid_photo = $this->fileUpload($request->file('nid_photo'), 'public/uploads/merchant/', 324, 204);
                }
                if ($request->file('nid_photo_back')) {
                    $marchent->nid_photo_back = $this->fileUpload($request->file('nid_photo_back'), 'public/uploads/merchant/', 324, 204);
                }
            } elseif ($request->identification_type == 2) {
                $marchent->birth_certificate_no     =   $request->birth_certificate_no;
                if ($request->file('birth_certificate_photo')) {
                    $marchent->birth_certificate_photo = $this->fileUpload($request->file('birth_certificate_photo'), 'public/uploads/merchant/', 324, 204);
                }
            } elseif ($request->identification_type == 3) {
                $marchent->driving_licence_no     =   $request->driving_licence_no;
                if ($request->file('driving_licence_no')) {
                    $marchent->driving_licence_no = $this->fileUpload($request->file('driving_licence_no'), 'public/uploads/merchant/', 324, 204);
                }
            }

            $marchent->payoption     =   $request->payoption;
            if ($request->payoption == 1) {
                $marchent->nameOfBank   =   $request->bank_name;
                $marchent->bankBranch   =   $request->branch_name;
                $marchent->bankAcHolder   =   $request->ac_holder_name;
                $marchent->bankAcNo   =   $request->bank_ac_no;
            } elseif ($request->payoption == 2) {
                $marchent->bkashNumber   =   $request->bNumber;
            } elseif ($request->payoption == 3) {
                $marchent->nogodNumber  =   $request->nNumber;
            } elseif ($request->payoption == 4) {
                //
            } else {
                return response()->json(['success' => false, 'message' => 'Opps! Some thing is wrong'], 200);
            }

            $marchent->companyName   =   $request->companyName;
            $marchent->firstName     =   $request->firstName;
            // $marchent->phoneNumber   =   $request->phoneNumber;
            $marchent->emailAddress  =   $request->emailAddress;
            $marchent->username      =   $request->username;
            $marchent->fathers_name     =   $request->fathers_name;
            $marchent->mothers_name     =   $request->mothers_name;
            $marchent->mothers_name     =   $request->mothers_name;
            $marchent->date_of_birth     =   $request->date_of_birth ? date('Y-m-d', strtotime($request->date_of_birth)) : null;
            $marchent->trade_licence_no  =   $request->trade_licence_no;
            $marchent->facebook_page  =   $request->facebook_page;
            $marchent->website  =   $request->website;
            $marchent->division_id  =   $request->division_id;
            $marchent->district_id  =   $request->district_id;
            $marchent->thana_id  =   $request->thana_id;
            $marchent->area_id  =   $request->area_id;
            $marchent->present_address  =   $request->present_address;
            $marchent->permanent_address  =   $request->permanent_address;
            $marchent->pickLocation  =   $request->pickup_address;
            $marchent->pickupPreference  =   $request->pickupPreference;
            $marchent->facebook_page  =   $request->facebook_page;
            $marchent->paymentMethod =   $request->payoption;
            $marchent->verify        =   1;
            $marchent->status        =   1;
            $marchent->agree         =   1;
            $marchent->password      =    bcrypt(request('password'));
            $marchent->api_token  =    Str::random(50);
            $marchent->save();
            return response()->json(['success' => true, 'message' => 'Thanks , You are successfully registered.'], 200);
        } else {
            $msg = "Opps, There are no merchant for this phone number.";
            return response()->json(['success' => false, 'message' => $msg], 200);
        }
    }

    public function profileUpdate(Request $request)
    {

        $rules = [];
        $rules['logo'] = "nullable|image";
        $rules['firstName'] = "required";
        $rules['identification_type'] = "required";
        $rules['division_id'] = "required";
        $rules['district_id'] = "required";


        try {
            // return response()->json(['success' => false, 'message' => "on developement"], 200);
            $update_merchant = $this->merchant($request->api_token);

            if ($update_merchant) {
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

                $validator = Validator::make($request->all(), $rules);
                if ($validator->fails()) {
                    return response()->json(['success' => false, 'message' => $validator->errors()->first()], 200);
                }

                $update_merchant->firstName = $request->firstName;
                // $update_merchant->phoneNumber = $request->phoneNumber;
                $update_merchant->emailAddress  =   $request->emailAddress;
                $update_merchant->fathers_name = $request->fathers_name;
                $update_merchant->mothers_name = $request->mothers_name;
                $update_merchant->present_address = $request->present_address;
                $update_merchant->permanent_address = $request->permanent_address;
                $update_merchant->otherphoneNumber = $request->otherphoneNumber;
                // $update_merchant->mAdress = $request->mAdress;
                $update_merchant->pickLocation = $request->pickLocation;
                $update_merchant->division_id = $request->division_id;
                $update_merchant->district_id = $request->district_id;
                $update_merchant->thana_id = $request->thana_id;
                $update_merchant->area_id = $request->area_id;
                // $update_merchant->pickupPreference = $request->pickupPreference;
                // $update_merchant->paymentMethod = $request->paymentMethod;
                // $update_merchant->withdrawal = $request->withdrawal;
                // $update_merchant->nameOfBank = $request->nameOfBank;
                // $update_merchant->bankBranch = $request->bankBranch;
                // $update_merchant->bankAcHolder = $request->bankAcHolder;
                // $update_merchant->bankAcNo = $request->bankAcNo;
                // $update_merchant->bkashNumber = $request->bkashNumber;
                // $update_merchant->roketNumber = $request->roketNumber;
                // $update_merchant->nogodNumber = $request->nogodNumber;
                // $update_merchant->nidnumber = $request->nidnumber;
                // $update_merchant->trade_licence_no = $request->trade_licence_no;
                // $update_merchant->facebook_page  =   $request->facebook_page;
                // $update_merchant->website  =   $request->website;
                $update_merchant->save();
                return response()->json(['success' => true, 'message' => 'Thanks , Your profile successfully updated.'], 200);
            } else {
                $msg = "Opps, There are no merchant for this phone number.";
                return response()->json(['success' => false, 'message' => $msg], 200);
            }
        } catch (Exception $e) {
            return response()->json(['success' => false, 'message' => $e->message], 200);
        }
    }


    // Merchant Profile Edit
    // public function profileUpdate(Request $request)
    // {
    //     $rules = [];
    //     $rules['firstName'] = "required";
    //     $rules['identification_type'] = "required";
    //     $rules['division_id'] = "required";
    //     $rules['district_id'] = "required";

    //     $update_merchant = Merchant::find(Session::get('merchantId'));
    //     $update_merchant->identification_type     =   $request->identification_type;
    //     if ($request->identification_type == 1) {
    //         if (empty($update_merchant->nid_photo)) {
    //             $rules['nid_photo'] = "required|image";
    //         }
    //         $update_merchant->nidnumber     =   $request->nidnumber;
    //         if ($request->file('nid_photo')) {
    //             if ($update_merchant->nid_photo) {
    //                 File::delete($update_merchant->nid_photo);
    //             }
    //             $update_merchant->nid_photo = $this->fileUpload($request->file('nid_photo'), 'public/uploads/merchant/', 324, 204);
    //         }
    //         if ($request->file('nid_photo_back')) {
    //             if ($update_merchant->nid_photo_back) {
    //                 File::delete($update_merchant->nid_photo_back);
    //             }
    //             $update_merchant->nid_photo_back = $this->fileUpload($request->file('nid_photo_back'), 'public/uploads/merchant/', 324, 204);
    //         }
    //     } elseif ($request->identification_type == 2) {
    //         if (empty($update_merchant->birth_certificate_photo)) {
    //             $rules['birth_certificate_photo'] = "required|image";
    //         }
    //         $update_merchant->birth_certificate_no     =   $request->birth_certificate_no;
    //         if ($request->file('birth_certificate_photo')) {
    //             if ($update_merchant->birth_certificate_photo) {
    //                 File::delete($update_merchant->birth_certificate_photo);
    //             }
    //             $update_merchant->birth_certificate_photo = $this->fileUpload($request->file('birth_certificate_photo'), 'public/uploads/merchant/', 324, 204);
    //         }
    //     } elseif ($request->identification_type == 3) {
    //         if (empty($update_merchant->driving_licence_photo)) {
    //             $rules['driving_licence_photo'] = "required|image";
    //         }

    //         $update_merchant->driving_licence_no     =   $request->driving_licence_no;
    //         if ($request->file('driving_licence_photo')) {
    //             if ($update_merchant->driving_licence_photo) {
    //                 File::delete($update_merchant->driving_licence_photo);
    //             }
    //             $update_merchant->driving_licence_photo = $this->fileUpload($request->file('driving_licence_photo'), 'public/uploads/merchant/', 324, 204);
    //         }
    //     }
    //     $this->validate($request, $rules);
    //     $update_merchant->firstName = $request->firstName;
    //     // $update_merchant->phoneNumber = $request->phoneNumber;
    //     $update_merchant->fathers_name = $request->fathers_name;
    //     $update_merchant->mothers_name = $request->mothers_name;
    //     $update_merchant->present_address = $request->present_address;
    //     $update_merchant->permanent_address = $request->permanent_address;
    //     $update_merchant->otherphoneNumber = $request->otherphoneNumber;
    //     $update_merchant->mAdress = $request->mAdress;
    //     $update_merchant->pickLocation = $request->pickLocation;
    //     $update_merchant->division_id = $request->division_id;
    //     $update_merchant->district_id = $request->district_id;
    //     $update_merchant->thana_id = $request->thana_id;
    //     $update_merchant->area_id = $request->area_id;
    //     $update_merchant->pickupPreference = $request->pickupPreference;
    //     $update_merchant->paymentMethod = $request->paymentMethod;
    //     $update_merchant->withdrawal = $request->withdrawal;
    //     $update_merchant->nameOfBank = $request->nameOfBank;
    //     $update_merchant->bankBranch = $request->bankBranch;
    //     $update_merchant->bankAcHolder = $request->bankAcHolder;
    //     $update_merchant->bankAcNo = $request->bankAcNo;
    //     $update_merchant->bkashNumber = $request->bkashNumber;
    //     $update_merchant->roketNumber = $request->roketNumber;
    //     $update_merchant->nogodNumber = $request->nogodNumber;
    //     $update_merchant->nidnumber = $request->nidnumber;
    //     $update_merchant->trade_licence_no = $request->trade_licence_no;
    //     $update_merchant->facebook_page  =   $request->facebook_page;
    //     $update_merchant->website  =   $request->website;
    //     $update_merchant->save();
    //     return redirect()->back()->with('success', 'Your account update successfully');
    // }




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

    public function dashboard(Request $request)
    {
        $user = $this->merchant($request->api_token);
        if ($user) {
            $returnDelCharge = DB::table('parcels')->where([
                ['merchantId', '=', $user->id],
                ['status', '>', '5'],
                ['status', '<', '9'],
            ])->sum('deliveryCharge');

            $prepDelAmount = Parcel::where(['merchantId' => $user->id, 'status' => 4, 'percelType' => 1])->sum('deliveryCharge');
            $allPaidParcels = Parcel::where(['merchantId' => $user->id, 'merchantpayStatus' => 1])->get();

            $total = 0;
            $totalDel = 0;
            foreach ($allPaidParcels as $key => $parcel) {
                if (($parcel->status > 5 && $parcel->status < 9) || (($parcel->percelType == 1) && ($parcel->status == 4))) {
                    $totalDel += $parcel->deliveryCharge;
                } else {
                    if (($parcel->status == 4) && ($parcel->percelType == 2)) {
                        $total += $parcel->merchantPaid;
                    }
                }
            }
            $return = [8];
            $placepercel = Parcel::where(['merchantId' => $user->id])->count();
            $pendingparcel = Parcel::where(['merchantId' => $user->id, 'status' => 1])->count();
            $deliverd = Parcel::where(['merchantId' => $user->id, 'status' => 4])->count();
            $cancelparcel = Parcel::where(['merchantId' => $user->id, 'status' => 9])->count();
            //   $parcelreturn=Parcel::where(['merchantId'=>$user->id,'status'=>8])->count();
            $parcelreturn = Parcel::where('merchantId', '=', $user->id)
                ->where(function ($query) use ($return) {
                    $query->whereIn('status', $return);
                })->count();
            $totalhold = Parcel::where(['merchantId' => $user->id, 'status' => 5])->count();
            $totalamount = Parcel::where(['merchantId' => $user->id, 'status' => 4])->sum('merchantAmount') - ($returnDelCharge + $prepDelAmount);
            //   $merchantUnPaid=Parcel::where(['merchantId'=>$user->id,'status'=>4])->whereNull('merchantpayStatus')->sum('merchantAmount');
            $merchantPaid = $total - $totalDel;
            $merchantUnPaid = $totalamount - $merchantPaid;
            $data = [
                'placepercel' => $placepercel,
                'pendingparcel' => $pendingparcel,
                'deliverd' => $deliverd,
                'parcelreturn' => $parcelreturn,
                'cancelparcel' => $cancelparcel,
                'totalhold' => $totalhold,
                'totalamount' => $totalamount,
                'merchantUnPaid' => $merchantUnPaid,
                'merchantPaid' => $merchantPaid
            ];
            return response()->json(['success' => true, 'data' => $data], 200);
        } else {
            return response()->json(['success' => false, 'message' => 'Opps! INVALID api token.'], 200);
        }
    }

    public function profile(Request $request)
    {
        $user = $this->merchant($request->api_token);
        if ($user) {
            return response()->json(['success' => true, 'data' => $user], 200);
        } else {
            return response()->json(['success' => false, 'message' => 'Opps! INVALID api token.'], 200);
        }
    }

    public function getDivision(Request $request)
    {
        $data = Division::orderBy('name')->where('status', 1)->get();
        return response()->json(['success' => true, 'data' => $data], 200);
    }

    public function getDistrictByDivision(Request $request)
    {
        $rules = [
            'division_id' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => $validator->errors()->first()], 200);
        }
        $data = District::orderBy('name')->where('division_id', $request->division_id)->where('status', 1)->get();
        return response()->json(['success' => true, 'data' => $data], 200);
    }

    public function getThanaByDistrict(Request $request)
    {
        $rules = [
            'district_id' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => $validator->errors()->first()], 200);
        }
        $data = Thana::orderBy('name')->where('district_id', $request->district_id)->where('status', 1)->get();
        return response()->json(['success' => true, 'data' => $data], 200);
    }

    public function getAreaByThana(Request $request)
    {
        $rules = [
            'thana_id' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => $validator->errors()->first()], 200);
        }
        $data = Area::orderBy('name')->where('thana_id', $request->thana_id)->where('status', 1)->get();
        return response()->json(['success' => true, 'data' => $data], 200);
    }

    public function parcelcreate(Request $request)
    {
        $user = $this->merchant($request->api_token);
        if ($user) {
            $delivery_charge_heads = DeliveryChargeHead::where('status', 1)->get();
            $divisions = Division::orderBy('name')->where('status', 1)->get();
            $codcharge = Codcharge::where('status', 1)->orderBy('id', 'DESC')->first();
            $merchant = Merchant::find($user->id);
            $weights = Weight::where('status', 1)->get();
            $data = [
                // 'delivery_charge_heads' => $delivery_charge_heads,
                'divisions' => $divisions,
                // 'codcharge' => $codcharge,
                'merchant' => $merchant,
                'weights' => $weights,
            ];
            return response()->json(['success' => true, 'data' => $data], 200);
        } else {
            return response()->json(['success' => false, 'message' => 'Opps! INVALID api token.'], 200);
        }
    }

    public function costCalculate(Request $request)
    {
        $user = $this->merchant($request->api_token);
        if ($user) {
            $mercharntInfo = $user;
            $weight = Weight::find($request->weight_id);
            $thana = Thana::find($request->thana_id);
            if (empty($thana->deliverycharge_id)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Your selected thana is disabled.',
                ]);
            }

            // get deliverycharge
            $deliveryChargeInfo = Deliverycharge::where(['id' => $thana->deliverycharge_id])->first();
            $delivery_charge = $deliveryChargeInfo->deliverycharge - (($deliveryChargeInfo->deliverycharge * $mercharntInfo->del_commission) / 100);

            // cod charge
            // $codChargeInfo = Codcharge::where(['status' => 1])->first();
            $codcharge = (floatval($deliveryChargeInfo->cod_charge) * $request->productPrice) / 100;
            $codcharge = $codcharge - (($codcharge * $mercharntInfo->cod_commission) / 100);

            // Extra charge
            $extra_weight = $weight->value - 1;
            $delivery_charge = $delivery_charge + ($extra_weight * $deliveryChargeInfo->extradeliverycharge);

            // Promotional discount
            $promotiuonal_discount_exist = PromotionalDiscount::whereDate('start_date', '<=', date('Y-m-d'))
                ->whereDate('end_date', '>=', date('Y-m-d'))
                ->where('status', 1)->first();
            if ($promotiuonal_discount_exist) {
                $promotiuonal_discount = ($delivery_charge * $promotiuonal_discount_exist->discount) / 100;
            } else {
                $promotiuonal_discount = 0;
            }
            $delivery_charge = $delivery_charge - $promotiuonal_discount;


            $data = [
                'codpay' => $request->productPrice,
                'pdeliverycharge' => number_format($delivery_charge, 2),
                'pcodecharge' => number_format($codcharge, 2),
                'total_charge' => number_format(($delivery_charge + $codcharge), 2),
                'promotiuonal_discount' => number_format(($promotiuonal_discount), 2)
            ];

            return response()->json(['success' => true, 'data' => $data], 200);
        } else {
            return response()->json(['success' => false, 'message' => 'Opps! INVALID api token.'], 200);
        }
    }

    public function parcelstore(Request $request)
    {
        $rules = [
            'api_token' => 'required',
            'phonenumber' => 'required|numeric|digits:11',
            'pickLocation' => 'required',
            'productPrice' => 'required',
            'name' => 'required',
            'weight_id' => 'required|numeric',
            'division_id' => 'required',
            'district_id' => 'required',
            'thana_id' => 'nullable',
            'area_id' => 'nullable',
            'delivery_address' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => $validator->errors()->first()], 200);
        }

        $user = $this->merchant($request->api_token);
        if ($user) {
            $mercharntInfo = Merchant::where('id', $user->id)->first();
            $weight = Weight::find($request->weight_id);
            $thana = Thana::find($request->thana_id);
            if (empty($thana->deliverycharge_id)) {
                return response()->json(['success' => false, 'message' => 'This thana are currently unavailable.'], 200);
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
            $store_parcel->invoiceNo = $request->invoiceno;
            $store_parcel->merchantId = $user->id;
            $store_parcel->cod = $request->productPrice;
            $store_parcel->percelType = $percelType;
            $store_parcel->recipientName = $request->name;
            $store_parcel->recipientAddress = $request->pickLocation;
            $store_parcel->recipientPhone = $request->phonenumber;
            $store_parcel->pickLocation = $request->pickLocation;
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

            $msg = 'Thanks! your parcel add successfully and your tracking code is : ' . $tracking_code;
            return response()->json(['success' => true, 'message' => $msg], 200);
        } else {
            return response()->json(['success' => false, 'message' => 'Opps! INVALID api token.'], 200);
        }
    }

    public function parcels(Request $request)
    {
        $rules = [
            'api_token' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => $validator->errors()->first()], 200);
        }
        $per_page = $request->per_page ?? 20;
        $user = $this->merchant($request->api_token);
        if ($user) {
            $parceltypes = Parceltype::all();
            if ($request->trackId != NULL) {
                $allparcel = DB::table('parcels')
                    ->leftJoin('merchants', 'merchants.id', '=', 'parcels.merchantId')
                    ->leftJoin('divisions', 'parcels.division_id', '=', 'divisions.id')
                    ->leftJoin('districts', 'parcels.district_id', '=', 'districts.id')
                    ->leftJoin('thanas', 'parcels.thana_id', '=', 'thanas.id')
                    ->leftJoin('areas', 'parcels.area_id', '=', 'areas.id')
                    ->leftJoin('parceltypes', 'parcels.status', '=', 'parceltypes.id')
                    ->where('parcels.merchantId', $user->id)
                    ->where('parcels.trackingCode', $request->trackId)
                    ->select('parcels.*', 'parceltypes.title', 'divisions.name as division', 'districts.name as district', 'thanas.name as thana', 'areas.name as area', 'merchants.firstName', 'merchants.lastName', 'merchants.phoneNumber', 'merchants.emailAddress', 'merchants.companyName', 'merchants.status as mstatus', 'merchants.id as mid')
                    ->orderBy('parcels.status', 'asc')->orderBy('parcels.id', 'desc');
            } elseif ($request->phoneNumber != NULL) {
                $allparcel = DB::table('parcels')
                    ->leftJoin('merchants', 'merchants.id', '=', 'parcels.merchantId')
                    ->leftJoin('divisions', 'parcels.division_id', '=', 'divisions.id')
                    ->leftJoin('districts', 'parcels.district_id', '=', 'districts.id')
                    ->leftJoin('thanas', 'parcels.thana_id', '=', 'thanas.id')
                    ->leftJoin('areas', 'parcels.area_id', '=', 'areas.id')
                    ->leftJoin('parceltypes', 'parcels.status', '=', 'parceltypes.id')
                    ->where('parcels.merchantId', $user->id)
                    ->where('parcels.recipientPhone', $request->phoneNumber)
                    ->select('parcels.*', 'parceltypes.title', 'divisions.name as division', 'districts.name as district', 'thanas.name as thana', 'areas.name as area', 'merchants.firstName', 'merchants.lastName', 'merchants.phoneNumber', 'merchants.emailAddress', 'merchants.companyName', 'merchants.status as mstatus', 'merchants.id as mid')
                    ->orderBy('parcels.status', 'asc')->orderBy('parcels.id', 'desc');
            } elseif ($request->startDate != NULL && $request->endDate != NULL) {
                $allparcel = DB::table('parcels')
                    ->leftJoin('merchants', 'merchants.id', '=', 'parcels.merchantId')
                    ->leftJoin('divisions', 'parcels.division_id', '=', 'divisions.id')
                    ->leftJoin('districts', 'parcels.district_id', '=', 'districts.id')
                    ->leftJoin('thanas', 'parcels.thana_id', '=', 'thanas.id')
                    ->leftJoin('areas', 'parcels.area_id', '=', 'areas.id')
                    ->leftJoin('parceltypes', 'parcels.status', '=', 'parceltypes.id')
                    ->where('parcels.merchantId', $user->id)
                    ->whereBetween('parcels.created_at', [$request->startDate, $request->endDate])
                    ->select('parcels.*', 'parceltypes.title', 'divisions.name as division', 'districts.name as district', 'thanas.name as thana', 'areas.name as area', 'merchants.firstName', 'merchants.lastName', 'merchants.phoneNumber', 'merchants.emailAddress', 'merchants.companyName', 'merchants.status as mstatus', 'merchants.id as mid')
                    ->orderBy('parcels.status', 'asc')->orderBy('parcels.id', 'desc');
            } elseif ($request->phoneNumber != NULL || $request->phoneNumber != NULL && $request->startDate != NULL && $request->endDate != NULL) {
                $allparcel = DB::table('parcels')
                    ->leftJoin('merchants', 'merchants.id', '=', 'parcels.merchantId')
                    ->leftJoin('divisions', 'parcels.division_id', '=', 'divisions.id')
                    ->leftJoin('districts', 'parcels.district_id', '=', 'districts.id')
                    ->leftJoin('thanas', 'parcels.thana_id', '=', 'thanas.id')
                    ->leftJoin('areas', 'parcels.area_id', '=', 'areas.id')
                    ->leftJoin('parceltypes', 'parcels.status', '=', 'parceltypes.id')
                    ->where('parcels.merchantId', $user->id)
                    ->where('parcels.recipientPhone', $request->phoneNumber)
                    ->whereBetween('parcels.created_at', [$request->startDate, $request->endDate])
                    ->select('parcels.*', 'parceltypes.title', 'divisions.name as division', 'districts.name as district', 'thanas.name as thana', 'areas.name as area', 'merchants.firstName', 'merchants.lastName', 'merchants.phoneNumber', 'merchants.emailAddress', 'merchants.companyName', 'merchants.status as mstatus', 'merchants.id as mid')
                    ->orderBy('parcels.status', 'asc')->orderBy('parcels.id', 'desc');
            } else {
                $allparcel = DB::table('parcels')
                    ->leftJoin('merchants', 'merchants.id', '=', 'parcels.merchantId')
                    ->leftJoin('divisions', 'parcels.division_id', '=', 'divisions.id')
                    ->leftJoin('districts', 'parcels.district_id', '=', 'districts.id')
                    ->leftJoin('thanas', 'parcels.thana_id', '=', 'thanas.id')
                    ->leftJoin('areas', 'parcels.area_id', '=', 'areas.id')
                    ->leftJoin('parceltypes', 'parcels.status', '=', 'parceltypes.id')
                    ->where('parcels.merchantId', $user->id)
                    ->select('parcels.*', 'parceltypes.title', 'divisions.name as division', 'districts.name as district', 'thanas.name as thana', 'areas.name as area', 'merchants.firstName', 'merchants.lastName', 'merchants.phoneNumber', 'merchants.emailAddress', 'merchants.companyName', 'merchants.status as mstatus', 'merchants.id as mid')
                    ->orderBy('parcels.status', 'asc')->orderBy('parcels.id', 'desc');
            }

            if ($request->parcel_type) {
                // $status = Parceltype::where('slug', $request->parcel_type)->first()->id??'';
                $allparcel->where('parcels.status', $request->parcel_type);
            }
            if ($request->trackingCode) {
                $allparcel->where('parcels.trackingCode', $request->trackingCode);
            }

            $data = [
                'allparcel' => $allparcel->paginate($per_page),
                'parceltypes' => $parceltypes,
            ];

            return response()->json(['success' => true, 'data' => $data], 200);
        } else {
            return response()->json(['success' => false, 'message' => 'Opps! INVALID api token.'], 200);
        }
    }

    public function parceldetails(Request $request, $parcel_id)
    {
        $rules = [
            'api_token' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => $validator->errors()->first()], 200);
        }

        $user = $this->merchant($request->api_token);
        if ($user) {
            $parceldetails = DB::table('parcels')
                ->leftJoin('divisions', 'parcels.division_id', '=', 'divisions.id')
                ->leftJoin('districts', 'parcels.district_id', '=', 'districts.id')
                ->leftJoin('thanas', 'parcels.thana_id', '=', 'thanas.id')
                ->leftJoin('areas', 'parcels.area_id', '=', 'areas.id')
                ->leftJoin('pickupmen', 'parcels.pickupmanId', '=', 'pickupmen.id')
                ->leftJoin('deliverymen', 'parcels.deliverymanId', '=', 'deliverymen.id')
                ->leftJoin('parceltypes', 'parcels.status', '=', 'parceltypes.id')
                ->where('merchantId', $user->id)
                ->where('parcels.id', '=', $parcel_id)
                ->select('parcels.*', 'pickupmen.name as pickupman_name', 'deliverymen.name as deliveryman_name', 'parceltypes.title', 'divisions.name as division', 'districts.name as district', 'thanas.name as thana', 'areas.name as area')
                ->first();
            $trackInfos = Parcelnote::where('parcelId', $parcel_id)->orderBy('id', 'ASC')->get();
            $data = [
                'parceldetails' => $parceldetails,
                'trackInfos' => $trackInfos
            ];
            return response()->json(['success' => true, 'data' => $parceldetails], 200);
        } else {
            return response()->json(['success' => false, 'message' => 'Opps! INVALID api token.'], 200);
        }
    }

    public function invoice(Request $request, $parcel_id)
    {
        $rules = [
            'api_token' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => $validator->errors()->first()], 200);
        }

        $user = $this->merchant($request->api_token);
        if ($user) {
            $show_data = DB::table('parcels')
                ->leftJoin('divisions', 'parcels.division_id', '=', 'divisions.id')
                ->leftJoin('districts', 'parcels.district_id', '=', 'districts.id')
                ->leftJoin('thanas', 'parcels.thana_id', '=', 'thanas.id')
                ->leftJoin('areas', 'parcels.area_id', '=', 'areas.id')
                ->where('merchantId', $user->id)
                ->where('parcels.id', '=', $parcel_id)
                ->select('parcels.*', 'divisions.name as division', 'districts.name as district', 'thanas.name as thana', 'areas.name as area')
                ->first();
            $trackInfos = Parcelnote::where('parcelId', $parcel_id)->orderBy('id', 'ASC')->get();
            return response()->json(['success' => true, 'data' => $show_data], 200);
        } else {
            return response()->json(['success' => false, 'message' => 'Opps! INVALID api token.'], 200);
        }
    }

    public function parceledit(Request $request, $parcel_id)
    {
        $rules = [
            'api_token' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => $validator->errors()->first()], 200);
        }

        $user = $this->merchant($request->api_token);
        if ($user) {
            $data = [
                'merchant' => $user,
                'weights' =>  Weight::where('status', 1)->get(),
                'delivery_charge_heads' => DeliveryChargeHead::where('status', 1)->get(),
                'parceledit' => Parcel::where(['merchantId' => $user->id, 'id' => $parcel_id])->first(),
                'divisions' => Division::orderBy('name')->orderBy('name')->where('status', 1)->get(),
            ];
            return response()->json(['success' => true, 'message' => $data], 200);
        } else {
            return response()->json(['success' => false, 'message' => 'Opps! INVALID api token.'], 200);
        }
    }
    public function parcelupdate(Request $request)
    {
        $rules = [
            'api_token' => 'required',
            'hidden_id' => 'required',
            'phonenumber' => 'required|numeric|digits:11',
            'pickLocation' => 'required',
            'name' => 'required',
            'weight_id' => 'required|numeric',
            'division_id' => 'required',
            'district_id' => 'required',
            'thana_id' => 'nullable',
            'area_id' => 'nullable',
            'delivery_address' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => $validator->errors()->first()], 200);
        }

        $user = $this->merchant($request->api_token);
        if ($user) {
            $update_parcel = Parcel::find($request->hidden_id);
            $mercharntInfo = Merchant::where('id', $user->id)->first();
            $weight = Weight::find($request->weight_id);
            $thana = Thana::find($request->thana_id);
            if (empty($thana->deliverycharge_id)) {
                return response()->json(['success' => false, 'message' => 'This thana are currently unavailable.'], 200);
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
            $update_parcel->invoiceNo = $request->invoiceno;
            $update_parcel->merchantId = $user->id;
            $update_parcel->cod = $request->productPrice;
            $update_parcel->percelType = $percelType;
            $update_parcel->recipientName = $request->name;
            $update_parcel->recipientAddress = $request->pickLocation;
            $update_parcel->recipientPhone = $request->phonenumber;
            $update_parcel->pickLocation = $request->pickLocation;
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
            $data = 'Thanks! your parcel update successfully';

            return response()->json(['success' => true, 'message' => $data], 200);
        } else {
            return response()->json(['success' => false, 'message' => 'Opps! INVALID api token.'], 200);
        }
    }

    public function singleservice(Request $request)
    {
        $rules = [
            'api_token' => 'required',
            'contact_mail' => 'support@deliveryjhotpot.com',
            'address' => $request->address,
            'area' => $request->area,
            'note' => $request->note,
            'estimate' => $request->estimate,
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => $validator->errors()->first()], 200);
        }

        $user = $this->merchant($request->api_token);
        if ($user) {
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

            $msg = 'Thanks! your  request send successfully';
            return response()->json(['success' => true, 'message' => $msg], 200);
        } else {
            return response()->json(['success' => false, 'message' => 'Opps! INVALID api token.'], 200);
        }
    }

    public function payments(Request $request)
    {
        $rules = [
            'api_token' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => $validator->errors()->first()], 200);
        }
        $per_page = $request->per_page ?? 20;

        $user = $this->merchant($request->api_token);
        if ($user) {
            $data = Merchantpayment::where('merchantId', $user->id)->paginate($per_page);
            return response()->json(['success' => true, 'data' => $data], 200);
        } else {
            return response()->json(['success' => false, 'message' => 'Opps! INVALID api token.'], 200);
        }
    }

    public function inovicedetails(Request $request, $merchantpayment_id)
    {
        $rules = [
            'api_token' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => $validator->errors()->first()], 200);
        }
        $user = $this->merchant($request->api_token);
        if ($user) {
            $data = [
                'inovicedetails' => Merchantpayment::find($merchantpayment_id),
                'invoiceInfo' => Parcel::where('paymentInvoice', $merchantpayment_id)->get()
            ];
            return response()->json(['success' => true, 'data' => $data], 200);
        } else {
            return response()->json(['success' => false, 'message' => 'Opps! INVALID api token.'], 200);
        }
    }

    public function passfromreset(Request $request)
    {
        $rules = [
            'phoneNumber' => 'required'
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => $validator->errors()->first()], 200);
        }
        $validMerchant = Merchant::Where('phoneNumber', $request->phoneNumber)->first();
        if ($validMerchant) {
            $verifyToken = rand(111111, 999999);
            $validMerchant->passwordReset     =    $verifyToken;
            $validMerchant->save();
            $msg = "Dear $validMerchant->firstName, \r\n Your password reset token is $verifyToken. Enjoy our services. If any query call us 01404477009 \r\nRegards\r\n Sensor Courier ";
            $numbers = "0" . $validMerchant->phoneNumber;
            $send_sms = $this->sendOTPSMS($numbers, $msg);
            return response()->json(['success' => true, 'message' => 'Your password reset token send successfully done.'], 200);
        } else {
            return response()->json(['success' => false, 'message' => 'Sorry! You have no account'], 200);
        }
    }

    public function saveResetPassword(Request $request)
    {
        $rules = [
            'phoneNumber' => 'required',
            'verifyPin' => 'required',
            'newPassword' => 'required'
        ];

        $validMerchant = Merchant::where('phoneNumber', $request->phoneNumber)->first();
        if ($validMerchant->passwordReset == $request->verifyPin) {
            $validMerchant->password     =    bcrypt(request('newPassword'));
            $validMerchant->passwordReset     =    NULL;
            $validMerchant->save();
            return response()->json(['success' => true, 'message' => 'Wow! Your password reset successfully.'], 200);
        } else {
            return response()->json(['success' => false, 'message' => 'Opps! Invalid reset code !'], 200);
        }
    }

    public function parceltrack(Request $request)
    {
        $rules = [
            'api_token' => 'required',
            'trackid' => 'required'
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => $validator->errors()->first()], 200);
        }
        $user = $this->merchant($request->api_token);
        if ($user) {
            $trackparcel = DB::table('parcels')
                ->leftJoin('merchants', 'merchants.id', '=', 'parcels.merchantId')
                ->leftJoin('divisions', 'parcels.division_id', '=', 'divisions.id')
                ->leftJoin('districts', 'parcels.district_id', '=', 'districts.id')
                ->leftJoin('thanas', 'parcels.thana_id', '=', 'thanas.id')
                ->leftJoin('areas', 'parcels.area_id', '=', 'areas.id')
                ->where('parcels.trackingCode', $request->trackid)
                ->select('parcels.*', 'divisions.name as division', 'districts.name as district', 'thanas.name as thana', 'areas.name as area', 'merchants.companyName', 'merchants.phoneNumber', 'merchants.emailAddress')
                ->first();
            $trackInfos = Parcelnote::where('parcelId', $trackparcel->id)->orderBy('id', 'ASC')->get();

            $data = [
                'trackparcel' => $trackparcel,
                'trackInfos' => $trackInfos
            ];
            return response()->json(['success' => true, 'data' => $data], 200);
        } else {
            return response()->json(['success' => false, 'message' => 'Opps! INVALID api token.'], 200);
        }
    }

    public function parcelTypes(Request $request)
    {
        $rules = [
            'api_token' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => $validator->errors()->first()], 200);
        }

        $user = $this->merchant($request->api_token);
        if ($user) {
            $data = Parceltype::all();
            return response()->json(['success' => true, 'data' => $data], 200);
        } else {
            return response()->json(['success' => false, 'message' => 'Opps! INVALID api token.'], 200);
        }
    }
}
