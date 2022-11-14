<?php

namespace App\Http\Controllers\Editor;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Setting;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;

class SettingController extends Controller
{
    public function create()
    {
        $section = Session::get('section');
        if($section == 'laundry') {
            $setting = Setting::where('id', 1)->first();
        }elseif($section == 'salon') {
            $setting = Setting::where('id', 2)->first();
        }

        return view('backEnd.setting.create', compact('setting'));
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
            'delivery_charge_amount_show' => 'nullable',
            'email' => 'nullable',
            'mobile_no' => 'nullable',
            'web' => 'nullable',
            'address' => 'nullable',
            'address_bn' => 'nullable',
            'facebook' => 'nullable|max:255',
            'twitter' => 'nullable|max:255',
            'google_plus' => 'nullable|max:255',
            'instagram' => 'nullable|max:255',
        ]);

        $section = Session::get('section');
        if($section == 'laundry') {
            $store_data = Setting::where('id', 1)->first();
        }elseif($section == 'salon') {
            $store_data = Setting::where('id', 2)->first();
        }
        
        // if(empty($store_data)){
        //     $store_data = new Setting();
        // }
        
        $store_data->name = $request->name;
        $store_data->email = $request->email;
        $store_data->mobile_no = $request->mobile_no;
        $store_data->web = $request->web;
        $store_data->address = $request->address;
        $store_data->address_bn = $request->address_bn;
        $store_data->facebook = $request->facebook;
        $store_data->twitter = $request->twitter;
        $store_data->google_plus = $request->google_plus;
        $store_data->instagram = $request->instagram;
        // $store_data->delivery_charge_amount_show = $request->delivery_charge_amount_show;
        if($request->file('logo')){
            if($store_data->logo){
                File::delete($store_data->logo);
            }
            $store_data->logo = $this->fileUpload($request->file('logo'),'public/uploads/logo/', 200, 200);
        }
        $store_data->save();
        Toastr::success('message', 'Setting add successfully!');
        return redirect('editor/setting/create');
    }
}
