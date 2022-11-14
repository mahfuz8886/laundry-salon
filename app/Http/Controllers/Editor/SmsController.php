<?php

namespace App\Http\Controllers\Editor;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use App\Gallery;
use App\Sms;
use File;

class SmsController extends Controller
{
    public function create()
    {

        $lists  =  Sms::orderBy('id', 'DESC')->paginate(10);
        return view('backEnd.bulksms.create', ['lists' => $lists]);
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'image' => 'required',
            'status' => 'required',
        ]);

        // image upload
        $file = $request->file('image');
        $name = $file->getClientOriginalName();
        $uploadPath = 'public/uploads/gallery/';
        $file->move($uploadPath, $name);
        $fileUrl = $uploadPath . $name;

        $store_data = new Gallery();
        $store_data->image = $fileUrl;
        $store_data->title = $request->title;
        $store_data->status = $request->status;
        $store_data->save();
        Toastr::success('message', 'Banner add successfully!');
        return redirect('editor/gallery/manage');
    }
    public function manage()
    {
        $show_data = Gallery::get();
        return view('backEnd.bulksms.manage', compact('show_data'));
    }
    public function edit($id)
    {
        $edit_data = Gallery::find($id);
        return view('backEnd.bulksms.edit', compact('edit_data'));
    }
    public function update(Request $request)
    {
        $this->validate($request, [
            'status' => 'required',
        ]);
        $update_data = Gallery::find($request->hidden_id);
        $update_image = $request->file('image');
        if ($update_image) {
            $file = $request->file('image');
            $name = $file->getClientOriginalName();
            $uploadPath = 'public/uploads/gallery/';
            File::delete(public_path() . 'public/uploads/gallery', $update_data->image);
            $file->move($uploadPath, $name);
            $fileUrl = $uploadPath . $name;
        } else {
            $fileUrl = $update_data->image;
        }

        $update_data->image = $fileUrl;
        $update_data->title = $request->title;
        $update_data->status = $request->status;
        $update_data->save();
        Toastr::success('message', 'Banner  update successfully!');
        return redirect('editor/gallery/manage');
    }

    public function inactive(Request $request)
    {
        $unpublish_data = Gallery::find($request->hidden_id);
        $unpublish_data->status = 0;
        $unpublish_data->save();
        Toastr::success('message', 'Banner  uppublished successfully!');
        return redirect('editor/gallery/manage');
    }

    public function active(Request $request)
    {
        $publishId = Gallery::find($request->hidden_id);
        $publishId->status = 1;
        $publishId->save();
        Toastr::success('message', 'Banner  uppublished successfully!');
        return redirect('editor/gallery/manage');
    }
    public function destroy(Request $request)
    {
        $delete_data = Gallery::find($request->hidden_id);
        File::delete(public_path() . 'public/uploads/gallery', $delete_data->image);
        $delete_data->delete();
        Toastr::success('message', 'Banner delete successfully!');
        return redirect('editor/gallery/manage');
    }

    public function SMSsend(Request $request)
    {
        $this->validate(
            $request,
            [
                'phonenumber' => 'required',
                'sms' => 'required',
            ],
            [
                'phonenumber.required' => "The Moblie Number is required. Please file up perfectly!",
                'sms.required' => "Message Body is required. Please file up perfectly!",

            ]
        );
        $phone_number = explode(',', $request->phonenumber);
        foreach ($phone_number as $number) {
            $smsadd =  new Sms();
            $smsadd->number =  $number;
            $smsadd->sms =  $request->sms . ' Regards,
                                 Sensor Courier,
                                 01404477009';
            $smsadd->status = 0;
            $smsadd->save();
            if ($smsadd->id) {
                $number =  $number;
                $msg =  $request->sms . " Regards,
                        Sensor Courier,
                        01404477009";
                $send_sms = $this->sendSMS($number, $msg);
                if ($send_sms) {
                    Sms::where('id', $smsadd->id)->update(['status' => '1']);
                } else {
                    Toastr::success('message', 'Some thing is wrong please contact with Developer!');
                    return back();
                }
            }
        }
        Toastr::success('message', 'Message send successfully!');
        return back();
    }


    public function resend($id)
    {
        $smsadd = Sms::find($id);
        if ($smsadd->number) {
            $number = "0" . $smsadd->number;
            $msg = "$smsadd->sms.
                        Regards,
                        Sensor Courier
                        01404477009";
            $send_sms = $this->sendSMS($number, $msg);
            if ($send_sms) {
                Sms::where('id', $id)->update(['status' => '1']);
            } else {
                Toastr::success('message', 'Some thing is wrong please contact with Developer!');
                return back();
            }
        }
        Toastr::success('message', 'Message send successfully!');
        return back();
    }

    public function DeleteSMS(Request $request)
    {
        $smsDelete = Sms::find($request->deleted_id);
        $deleted = $smsDelete->delete();
        Toastr::success('message', 'Message deleted successfully!');
        return back();
    }

    public function smsAllBalance(Request $request)
    {
        $otp_balance = substr($this->getOTPBalance(), 20);
        $otp_balance = floor($otp_balance / .3);

        $sms_balance = json_decode($this->smsBalance(), true);
        if ($sms_balance) {
            $sms_balance = $sms_balance['data'];
        }
        return view('backEnd.bulksms.balance', compact('otp_balance', 'sms_balance'));
    }
}
