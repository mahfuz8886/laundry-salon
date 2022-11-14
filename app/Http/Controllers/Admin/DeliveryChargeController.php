<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use App\Deliverycharge;
use App\DeliveryChargeHead;
use File;

class DeliveryChargeController extends Controller
{
    public function add()
    {
        $delivery_charge_heads = DeliveryChargeHead::where('status', 1)->get();
        return view('backEnd.deliverycharge.add', compact('delivery_charge_heads'));
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'delivery_charge_head_id' => 'required',
            'deliverycharge' => 'required|numeric',
            'extradeliverycharge' => 'required|numeric',
            'cod_charge' => 'required|numeric',
            'status' => 'required',
        ]);


        $store_data                    = new Deliverycharge();
        $store_data->delivery_charge_head_id          = $request->delivery_charge_head_id;
        // $store_data->weight= $request->weight;
        $store_data->deliverycharge = $request->deliverycharge;
        $store_data->extradeliverycharge = $request->extradeliverycharge ?? 0;
        $store_data->description   = $request->description;
        $store_data->status        = $request->status;
        $store_data->save();
        Toastr::success('message', 'Delivery charge add successfully!');
        return redirect('/admin/deliverycharge/manage');
    }
    public function manage()
    {
        $show_data = Deliverycharge::orderBy('id', 'DESC')
            ->get();
        return view('backEnd.deliverycharge.manage', compact('show_data'));
    }
    public function edit($id)
    {
        $edit_data = Deliverycharge::find($id);
        $delivery_charge_heads = DeliveryChargeHead::where('status', 1)->get();
        return view('backEnd.deliverycharge.edit', compact('edit_data', 'delivery_charge_heads'));
    }
    public function update(Request $request)
    {
        $this->validate($request, [
            'delivery_charge_head_id' => 'required',
            'deliverycharge' => 'required|numeric',
            'extradeliverycharge' => 'required|numeric',
            'cod_charge' => 'required|numeric',
            'status' => 'required',
        ]);

        $update_data = Deliverycharge::find($request->hidden_id);
        $update_data->delivery_charge_head_id = $request->delivery_charge_head_id;
        $update_data->cod_charge = $request->cod_charge;
        $update_data->deliverycharge = $request->deliverycharge;
        $update_data->extradeliverycharge = $request->extradeliverycharge ?? 0;
        $update_data->description   = $request->description;
        $update_data->status        = $request->status;
        $update_data->save();
        Toastr::success('message', 'Delivery charge Update successfully!');
        return redirect('admin/deliverycharge/manage');
    }

    public function inactive(Request $request)
    {
        $unpublish_data = Deliverycharge::find($request->hidden_id);
        $unpublish_data->status = 0;
        $unpublish_data->save();
        Toastr::success('message', 'Delivery charge active successfully!');
        return redirect('/admin/deliverycharge/manage');
    }

    public function active(Request $request)
    {
        $publishId = Deliverycharge::find($request->hidden_id);
        $publishId->status = 1;
        $publishId->save();
        Toastr::success('message', 'Delivery charge active successfully!');
        return redirect('/admin/deliverycharge/manage');
    }

    public function destroy(Request $request)
    {
        $destroy_id = Deliverycharge::find($request->hidden_id);
        $destroy_id->delete();
        Toastr::success('message', 'Delivery charge  delete successfully!');
        return redirect('/admin/deliverycharge/manage');
    }
}
