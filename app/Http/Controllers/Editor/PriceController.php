<?php

namespace App\Http\Controllers\editor;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use App\Price;
use App\Pricetype;
use File;
use DB;
class PriceController extends Controller
{
    
    public function create(){
        $pricetype = Pricetype::where('status',1)->get();
        return view('backEnd.price.create',compact('pricetype'));
    }
    public function store(Request $request){
        $this->validate($request,[
            'pricetype_id'=>'required',
            'price'=>'required',
            // 'price_bn'=>'required',
            'name'=>'required',
            // 'name_bn'=>'required',
            'status'=>'required',
        ]);

        $store_data = new Price();
        $store_data->pricetype_id = $request->pricetype_id;
        $store_data->name = $request->name;
        $store_data->name_bn = $request->name;
        $store_data->price = $request->price;
        $store_data->price_bn = $request->price;
        $store_data->status = $request->status;
        $store_data->save();
        Toastr::success('message', 'Price add successfully!');
        return redirect('editor/price/manage');
    }
    public function manage(){
        $show_data = DB::table('prices')
        ->join('pricetypes','prices.pricetype_id','=','pricetypes.id')
        ->select('prices.*','pricetypes.pricetypeName')
        ->get();
        return view('backEnd.price.manage',compact('show_data'));
    }
    public function edit($id){
        $pricetype = Pricetype::where('status',1)->get();
        $edit_data = Price::find($id);
        return view('backEnd.price.edit',compact('edit_data','pricetype'));
    }
     public function update(Request $request){
        $this->validate($request,[
            'pricetype_id'=>'required',
            'price'=>'required',
            // 'price_bn'=>'required',
            'name'=>'required',
            // 'name_bn'=>'required',
            'status'=>'required',
        ]);

        $update_data = Price::find($request->hidden_id);
        $update_data->pricetype_id = $request->pricetype_id;
        $update_data->name = $request->name;
        $update_data->name_bn = $request->name;
        $update_data->price = $request->price;
        $update_data->price_bn = $request->price;
        $update_data->status = $request->status;
        $update_data->save();
        Toastr::success('message', 'Price update successfully!');
        return redirect('editor/price/manage');
    }

    public function inactive(Request $request){
        $unpublish_data = Price::find($request->hidden_id);
        $unpublish_data->status=0;
        $unpublish_data->save();
        Toastr::success('message', 'Price uppublished successfully!');
        return redirect('editor/price/manage');
    }

    public function active(Request $request){
        $publishId = Price::find($request->hidden_id);
        $publishId->status=1;
        $publishId->save();
        Toastr::success('message', 'Price uppublished successfully!');
        return redirect('editor/price/manage');
    }
     public function destroy(Request $request){
        $delete_data = Price::find($request->hidden_id);
        $delete_data->delete();
        Toastr::success('message', 'Price delete successfully!');
        return redirect('editor/price/manage');
    }


}
