<?php

namespace App\Http\Controllers\Admin;

use App\Area;
use App\Division;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Thana;
use Brian2694\Toastr\Facades\Toastr;
use DataTables;

class AreaController extends Controller
{
    public function index(){
        $divisions = Division::orderBy('name')->where('status',1)->get();
        $thanas = Thana::where('status', 1)->get();
        return view('backEnd.area.add', compact('divisions','thanas'));
    }

    public function store(Request $request){
        $this->validate($request,[
            'division_id'=>'required',
            'district_id'=>'required',
            'thana_id'=>'required',
            'name'=>'required|string|max:191',
            'coverage'=>'required',
            'delivery_type'=>'required',
            'pickup'=>'required',
            'status'=>'required',
        ]);

        $thana =  Thana::find($request->thana_id);

        $store_data = new Area();
        $store_data->name        = $request->name;
        $store_data->division_id = $thana->division_id;
        $store_data->district_id = $thana->district_id;
        $store_data->thana_id    = $request->thana_id;
        $store_data->deliverymen_id    = $request->deliverymen_id;
        $store_data->pickupman_id    = $request->pickupman_id;
        $store_data->coverage      = $request->coverage;
        $store_data->delivery_type      = $request->delivery_type;
        $store_data->pickup      = $request->pickup;
        $store_data->status      = $request->status;
        $store_data->save();
        Toastr::success('message', 'Area add successfully!');
        return redirect()->back();
    }
    
    public function manage(){
        $show_data =Area::orderBy('name')->get();
        return view('backEnd.area.manage',['show_data'=>$show_data]);
        // return view('backEnd.area.manage');
    }
    
    public function edit($id){
        $divisions = Division::orderBy('name')->where('status',1)->get();
        $edit_data =  Area::find($id);
        return view('backEnd.area.edit',[
            'edit_data'=>$edit_data,
            'divisions'=>$divisions
        ]);
    }

    public function update(Request $request){
        $this->validate($request,[
            'division_id'=>'required',
            'district_id'=>'required',
            'thana_id'=>'required',
            'name'=>'required|string|max:191',
            'coverage'=>'required',
            'delivery_type'=>'required',
            'pickup'=>'required',
            'status'=>'required',
        ]);

        $thana =  Thana::find($request->thana_id);
        $update_data           =  Area::find($request->hidden_id);
        $update_data->division_id      = $thana->division_id;
        $update_data->district_id      = $thana->district_id;
        $update_data->thana_id      = $request->thana_id;
        $update_data->deliverymen_id    = $request->deliverymen_id;
        $update_data->pickupman_id    = $request->pickupman_id;
        $update_data->name     =    $request->name;
        $update_data->coverage      = $request->coverage;
        $update_data->delivery_type      = $request->delivery_type;
        $update_data->pickup      = $request->pickup;
        $update_data->status   =    $request->status;
        $update_data->save();
        Toastr::success('message', 'Area Update successfully!');
        return redirect()->back();
    }

    public function inactive(Request $request){
        $Unpublished_data           =  Area::find($request->hidden_id);
        $Unpublished_data->status   =   0;
        $Unpublished_data->save();
        Toastr::success('message', 'Area inactive successfully!');
        return redirect('admin/area/manage');   
    }

    public function active(Request $request){
        $published_data         =  Area::find($request->hidden_id);
        $published_data->status =   1;
        $published_data->save();
        Toastr::success('message', 'Area active successfully!');
        return redirect('admin/area/manage');   
    }

    public function destroy(Request $request){
        $destroy_id =Area::find($request->hidden_id);
        $destroy_id->delete();
        Toastr::success('message', 'Area  delete successfully!');
        return redirect('/admin/area/manage');         
    }

    public function areaDatatable(Request $request){
        $query = Area::with('division','district','thana');
        return datatables()->eloquent($query)
	        ->addIndexColumn()
            ->addColumn('division_name', function (Area $area) {
                return $area->division->name??'';
            })
            ->addColumn('district_name', function (Area $area) {
                return $area->district->name??'';
            })
            ->addColumn('thana_name', function (Area $area) {
                return $area->thana->name??'';
            })
            ->editColumn('coverage', function (Area $area) {
                if ($area->coverage=1) {
                    return 'Yes';
                }else{
                    return 'No';
                }
            })
            ->editColumn('delivery_type', function (Area $area) {
                if ($area->delivery_type=1) {
                    return 'Home Delivery';
                }else{
                    return 'Point Delivery';
                }
            })
            ->editColumn('pickup', function (Area $area) {
                if ($area->pickup=1) {
                    return 'Yes';
                }else{
                    return 'No';
                }
            })
            ->editColumn('status', function (Area $area) {
                if ($area->pickup=1) {
                    return 'Active';
                }else{
                    return 'Inactive';
                }
            })
            ->addColumn('action', function (Area $area) {
                $btn = '';
                if ($area->status == 1) {
                    $btn .= '<a href="'.url("admin/area/inactive/'.$area->id.'").'" class="btn btn-info btn-sm"> Active </a>';
                }
                
                return $btn;
            })
            ->rawColumns(['action'])
            ->toJson();
    }
}
