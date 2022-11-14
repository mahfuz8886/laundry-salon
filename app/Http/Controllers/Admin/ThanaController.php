<?php

namespace App\Http\Controllers\Admin;

use App\Deliverycharge;
use App\Division;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Thana;
use Brian2694\Toastr\Facades\Toastr;

class ThanaController extends Controller
{
    public function index(){
        $divisions = Division::orderBy('name')->where('status',1)->get();
        $delivery_charges = Deliverycharge::orderBy('id')->where('status',1)->get();
        return view('backEnd.thana.add', compact('divisions','delivery_charges'));
    }
    
    public function store(Request $request){
        $this->validate($request,[
            'division_id'=>'required',
            'district_id'=>'required',
            'name'=>'required|string|max:191',
            'deliverycharge_id'=>'required',
            'status'=>'required',
        ]);

        $store_data            = new Thana();
        $store_data->name      = $request->name;
        $store_data->division_id      = $request->division_id;
        $store_data->district_id      = $request->district_id;
        $store_data->deliverycharge_id      = $request->deliverycharge_id;
        $store_data->status    = $request->status;
        $store_data->save();
        Toastr::success('message', 'Thana add successfully!');
        return redirect('/admin/thana/manage');
    }
    
    public function manage(){
        $show_data =Thana::orderBy('name')->get();
        return view('backEnd.thana.manage',['show_data'=>$show_data]);
    }
    
    public function edit($id){
        $divisions = Division::orderBy('name')->where('status',1)->get();
        $delivery_charges = Deliverycharge::orderBy('id')->where('status',1)->get();
        $edit_data =  Thana::find($id);
        return view('backEnd.thana.edit',[
            'edit_data'=>$edit_data,
            'divisions'=>$divisions,
            'delivery_charges'=>$delivery_charges
        ]);
    }

    public function update(Request $request){
        $this->validate($request, [
            'division_id'=>'required',
            'district_id'=>'required',
            'name'=>'required|string|max:191',
            'deliverycharge_id'=>'required',
            'status'=>'required',
        ]);

        $update_data           =  Thana::find($request->hidden_id);
        $update_data->division_id      = $request->division_id;
        $update_data->district_id      = $request->district_id;
        $update_data->name     =    $request->name;
        $update_data->deliverycharge_id     =    $request->deliverycharge_id;
        $update_data->status   =    $request->status;
        $update_data->save();
        Toastr::success('message', 'Thana Update successfully!');
        return redirect('admin/thana/manage');
    }

    public function inactive(Request $request){
        $Unpublished_data = Thana::find($request->hidden_id);
        $Unpublished_data->status = 0;
        $Unpublished_data->save();
        Toastr::success('message', 'Thana inactive successfully!');
        return redirect('admin/thana/manage');   
    }

    public function active(Request $request){
        $published_data         =  Thana::find($request->hidden_id);
        $published_data->status =   1;
        $published_data->save();
        Toastr::success('message', 'Thana active successfully!');
        return redirect('admin/thana/manage');   
    }
     
    public function destroy(Request $request){
        $destroy_id =Thana::find($request->hidden_id);
        $destroy_id->delete();
        Toastr::success('message', 'Thana  delete successfully!');
        return redirect('/admin/thana/manage');         
    }
}
