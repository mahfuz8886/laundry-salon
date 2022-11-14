<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use App\District;
use App\Division;

class DistrictController extends Controller
{
    public function index(){
        $divisions = Division::orderBy('name')->where('status',1)->get();
        return view('backEnd.district.add', compact('divisions'));
    }
    public function store(Request $request){
        $this->validate($request,[
            'division_id'=>'required',
            'name'=>'required|string|max:191',
            'status'=>'required',
        ]);

        $store_data            = new District();
        $store_data->name      = $request->name;
        $store_data->division_id      = $request->division_id;
        $store_data->status    = $request->status;
        $store_data->save();
        Toastr::success('message', 'District add successfully!');
        return redirect('/admin/district/manage');
    }
    public function manage(){
        $show_data =District::orderBy('name')->get();
        return view('backEnd.district.manage',['show_data'=>$show_data]);
    }
    public function edit($id){
        $divisions = Division::orderBy('name')->where('status',1)->get();
        $edit_data =  District::find($id);
        return view('backEnd.district.edit',[
            'edit_data'=>$edit_data,
            'divisions'=>$divisions
        ]);
    }

    public function update(Request $request){
        $update_data           =  District::find($request->hidden_id);
        $update_data->division_id      = $request->division_id;
        $update_data->name     =    $request->name;
        $update_data->status   =    $request->status;
        $update_data->save();
        Toastr::success('message', 'District Update successfully!');
        return redirect('admin/district/manage');
    }
    public function inactive(Request $request){
        $Unpublished_data           =  District::find($request->hidden_id);
        $Unpublished_data->status   =   0;
        $Unpublished_data->save();
        Toastr::success('message', 'District inactive successfully!');
        return redirect('admin/district/manage');   
    }
    public function active(Request $request){
        $published_data         =  District::find($request->hidden_id);
        $published_data->status =   1;
        $published_data->save();
        Toastr::success('message', 'District active successfully!');
        return redirect('admin/district/manage');   
    }
     public function destroy(Request $request){
        $destroy_id =District::find($request->hidden_id);
        $destroy_id->delete();
        Toastr::success('message', 'District  delete successfully!');
        return redirect('/admin/district/manage');         
    }
}
