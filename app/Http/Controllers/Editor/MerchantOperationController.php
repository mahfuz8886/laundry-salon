<?php

namespace App\Http\Controllers\editor;

use App\Division;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Str;
use App\Merchant;
use App\Parcel;
use App\User;
use App\Nearestzone;
use DB;
use Auth;
use App\Post;
use App\Merchantpayment;
use App\Thana;
use Mail;
use Exception;
use Illuminate\Support\Facades\File;
use Session;

class MerchantOperationController extends Controller
{
    public function add()
    {
        $divisions = Division::where('status', 1)->get();
        $thanas = Thana::where('status', 1)->get();
        return view('backEnd.merchant.add', compact('divisions', 'thanas'));
    }

    public function register(Request $request)
    {
        $this->validate($request, [
            'companyName' => 'required',
            'logo' => 'nullable|image',
            'phoneNumber' => 'required|numeric|digits:11|unique:merchants',
            'emailAddress' => 'nullable|unique:merchants',
            'pickup_thana_id' => 'required',
            'pickLocation' => 'required',
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
            'password' => 'required|same:confirmed',
            'confirmed' => 'required',
        ]);

        $store_data =    new Merchant();
        if ($request->file('logo')) {
            $store_data->logo = $this->fileUpload($request->file('logo'), 'public/uploads/merchant/', 324, 204);
        }

        $store_data->identification_type     =   $request->identification_type;
        if ($request->identification_type == 1) {
            $store_data->nidnumber     =   $request->nidnumber;
            if ($request->file('nid_photo')) {
                $store_data->nid_photo = $this->fileUpload($request->file('nid_photo'), 'public/uploads/merchant/', 324, 204);
            }
            if ($request->file('nid_photo_back')) {
                $store_data->nid_photo_back = $this->fileUpload($request->file('nid_photo'), 'public/uploads/merchant/', 324, 204);
            }
        } elseif ($request->identification_type == 2) {
            $store_data->birth_certificate_no     =   $request->birth_certificate_no;
            if ($request->file('birth_certificate_photo')) {
                $store_data->birth_certificate_photo = $this->fileUpload($request->file('birth_certificate_photo'), 'public/uploads/merchant/', 324, 204);
            }
        } elseif ($request->identification_type == 3) {
            $store_data->driving_licence_no     =   $request->driving_licence_no;
            if ($request->file('driving_licence_photo')) {
                $store_data->driving_licence_photo = $this->fileUpload($request->file('driving_licence_photo'), 'public/uploads/merchant/', 324, 204);
            }
        }

        $store_data->companyName     =   $request->companyName;
        $store_data->firstName       =   $request->firstName;
        $store_data->phoneNumber     =   $request->phoneNumber;
        $store_data->emailAddress    =   $request->emailAddress;
        $store_data->username        =   $request->username;
        $store_data->fathers_name       =   $request->fathers_name;
        $store_data->mothers_name       =   $request->mothers_name;
        $store_data->trade_licence_no       =   $request->trade_licence_no;
        $store_data->pickup_thana_id       =   $request->pickup_thana_id;
        $store_data->pickLocation       =   $request->pickLocation;
        $store_data->website       =   $request->website;
        $store_data->facebook_page       =   $request->facebook_page;
        $store_data->nidnumber       =   $request->nidnumber;
        $store_data->division_id       =   $request->division_id;
        $store_data->district_id       =   $request->district_id;
        $store_data->thana_id       =   $request->thana_id;
        $store_data->area_id       =   $request->area_id;
        $store_data->present_address    =   $request->present_address;
        $store_data->permanent_address         =   $request->permanent_address;
        $store_data->payoption   =   $request->paymentMethod;
        $store_data->paymentMethod   =   $request->paymentMethod;
        $store_data->socialLink      =   $request->socialLink;

        if ($request->paymentMethod == 1) {
            $store_data->nameOfBank = $request->bank_name;
            $store_data->bankBranch = $request->branch_name;
            $store_data->bankAcHolder = $request->ac_holder_name;
            $store_data->bankAcNo = $request->bank_ac_no;
        } elseif ($request->paymentMethod == 2) {
            $store_data->bkashNumber = $request->bkashNumber;
        } elseif ($request->paymentMethod == 3) {
            $store_data->nogodNumber = $request->nogodNumber;
        }
        //   else if($request->paymentMethod == 1) {
        //       $store_data->bkashNumber = $request->paymentmode;
        //   }

        $store_data->agree           =    1;
        $store_data->password        =    bcrypt(request('password'));
        $store_data->verify          =    1;
        $store_data->status          =    1;
        $store_data->api_token  =    Str::random(50);
        $store_data->save();
        Toastr::success('message', 'Merchant  info add successfully!');
        return redirect('editor/merchant/manage');
    }

    public function manage()
    {
        $merchants = Merchant::verify()->orderBy('firstName')->paginate(2000);
        return view('backEnd.merchant.manage', compact('merchants'));
    }
    public function merchantrequest()
    {
        $merchants = Merchant::where('verify', 0)->orderBy('id', 'DESC')->get();
        return view('backEnd.merchant.merchantrequest', compact('merchants'));
    }
    public function profileedit($id)
    {
        $merchantInfo = Merchant::find($id);
        $nearestzones = Nearestzone::where('status', 1)->get();
        $acqs = User::where('designation', 'Admin')->get();
        $role = Auth::user()->role->id;
        $divisions = Division::where('status', 1)->get();
        $thanas = Thana::where('status', 1)->get();
        return view('backEnd.merchant.edit', compact('merchantInfo', 'divisions', 'thanas', 'acqs', 'role'));
    }
    // Merchant Profile Edit
    public function profileUpdate(Request $request)
    {
        $rules = [];
        $rules['firstName'] = "required";
        $rules['companyName'] = "required";
        $rules['logo'] = "nullable|image";
        $rules['pickup_thana_id'] = "required";
        $rules['pickLocation'] = "required";
        $rules['identification_type'] = "required";
        $rules['nidnumber'] = "required_if:identification_type,=,1";
        $rules['birth_certificate_no'] = "required_if:identification_type,=,2";
        $rules['driving_licence_no'] = "required_if:identification_type,=,3";
        $rules['division_id'] = "required";
        $rules['district_id'] = "required";

        $update_merchant = Merchant::find($request->hidden_id);
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
            if (empty($update_merchant->nid_photo_back)) {
                $rules['nid_photo_back'] = "required|image";
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

        $update_merchant->phoneNumber   = $request->phoneNumber;
        $update_merchant->firstName     = $request->firstName;
        $update_merchant->companyName     = $request->companyName;
        $update_merchant->fathers_name       =   $request->fathers_name;
        $update_merchant->mothers_name       =   $request->mothers_name;
        $update_merchant->trade_licence_no       =   $request->trade_licence_no;
        $update_merchant->website       =   $request->website;
        $update_merchant->facebook_page       =   $request->facebook_page;
        $update_merchant->pickup_thana_id = $request->pickup_thana_id;
        $update_merchant->pickLocation = $request->pickLocation;
        $update_merchant->pickupPreference = $request->pickupPreference;
        $update_merchant->nidnumber       =   $request->nidnumber;
        $update_merchant->division_id       =   $request->division_id;
        $update_merchant->district_id       =   $request->district_id;
        $update_merchant->thana_id       =   $request->thana_id;
        $update_merchant->area_id       =   $request->area_id;
        $update_merchant->present_address  = $request->present_address;
        $update_merchant->permanent_address       = $request->permanent_address;
        $update_merchant->acqm_id       = $request->acq_manager;
        $update_merchant->del_commission = $request->del_commission;
        $update_merchant->cod_commission = $request->cod_commission;
        $update_merchant->nearestZone   = $request->nearestZone;
        $update_merchant->paymentMethod = $request->paymentMethod;
        $update_merchant->payoption = $request->paymentMethod;
        $update_merchant->withdrawal    = $request->withdrawal;
        $update_merchant->nameOfBank    = $request->bank_name;
        $update_merchant->bankBranch    = $request->branch_name;
        $update_merchant->bankAcHolder  = $request->ac_holder_name;
        $update_merchant->bankAcNo      = $request->bank_ac_no;
        $update_merchant->bkashNumber   = $request->bkashNumber;
        $update_merchant->roketNumber   = $request->roketNumber;
        $update_merchant->nogodNumber   = $request->nogodNumber;

        if ($request->password) {
            $update_merchant->password   = bcrypt($request->password);
        }

        if ($request->paymentMethod == 1) {
            $update_merchant->nameOfBank = $request->bank_name;
            $update_merchant->bankBranch = $request->branch_name;
            $update_merchant->bankAcHolder = $request->ac_holder_name;
            $update_merchant->bankAcNo = $request->bank_ac_no;
        } elseif ($request->paymentMethod == 2) {
            $update_merchant->bkashNumber = $request->bkashNumber;
        } elseif ($request->paymentMethod == 3) {
            $update_merchant->nogodNumber = $request->nogodNumber;
        }

        $update_merchant->save();
        Toastr::success('message', 'Merchant  info update successfully!');
        return redirect()->back();
    }

    public function removeUpdateImage($update_merchant)
    {
        if ($update_merchant->nid_photo) {
            File::delete($update_merchant->nid_photo);
        }
        if ($update_merchant->nid_photo_back) {
            File::delete($update_merchant->nid_photo_back);
        }
        if ($update_merchant->birth_certificate_photo) {
            File::delete($update_merchant->birth_certificate_photo);
        }
        if ($update_merchant->driving_licence_no) {
            File::delete($update_merchant->driving_licence_no);
        }
    }

    public function inactive(Request $request)
    {
        $inactive_merchant = Merchant::find($request->hidden_id);
        $inactive_merchant->status = 0;
        $inactive_merchant->save();
        Toastr::success('message', 'Merchant  inactive successfully!');
        return redirect('/editor/merchant/manage');
    }

    public function active(Request $request)
    {
        $active_merchant = Merchant::find($request->hidden_id);
        $active_merchant->status = 1;
        $active_merchant->verify = 1;
        $active_merchant->save();
        Toastr::success('message', 'Merchant active successfully!');
        return redirect()->back();
    }
    public function view($id)
    {
        $merchantInfo = Merchant::find($id);
        // $parcels = DB::table('parcels')
        //     ->join('merchants', 'merchants.id', '=', 'parcels.merchantId')
        //     ->where('parcels.merchantId', $id)
        //     ->orderBy('parcels.id', 'DESC')
        //     ->select('parcels.*', 'merchants.firstName', 'merchants.lastName', 'merchants.phoneNumber', 'merchants.emailAddress', 'merchants.companyName', 'merchants.status as mstatus', 'merchants.id as mid')
        //     ->get();

        return view('backEnd.merchant.view', compact('merchantInfo'));
    }
    public function paymentinvoice($id)
    {
        $merchantInvoice = Merchantpayment::where('merchantId', $id)->get();
        return view('backEnd.merchant.paymentinvoice', compact('merchantInvoice'));
    }
    public function inovicedetails($id)
    {
        $invoiceInfo = Merchantpayment::find($id);
        $inovicedetails = Parcel::where('paymentInvoice', $id)->get();

        $merchantInfo = Merchant::find($invoiceInfo->merchantId);
        return view('backEnd.merchant.inovicedetails', compact('inovicedetails', 'invoiceInfo', 'merchantInfo'));
    }
}
