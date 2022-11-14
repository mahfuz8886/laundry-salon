<?php

namespace App\Http\Controllers\editor;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use App\Hub;
use File;

class HubController extends Controller
{
    public function create(){
        return view('backEnd.hub.create');
    }
    public function store(Request $request){
        $this->validate($request,[
            'title'=>'required',
            'title_bn'=>'required',
            // 'subtitle'=>'required',
            // 'subtitle_bn'=>'required',
            'text'=>'required',
            'text_bn'=>'required',
            'status'=>'required',
        ]);
         

        $store_data = new Hub();
        $store_data->title = $request->title;
        $store_data->title_bn = $request->title_bn;
        // $store_data->subtitle = $request->subtitle;
        // $store_data->subtitle_bn = $request->subtitle;
        $store_data->text = $request->text;
        $store_data->text_bn = $request->text_bn;
        $store_data->status = $request->status;
        $store_data->save();
        Toastr::success('message', 'Hub successfully!');
        return redirect('editor/hub/manage');
    }
    public function manage(){
        $show_data = Hub::get();
        return view('backEnd.hub.manage',compact('show_data'));
    }
    public function edit($id){
        $edit_data = Hub::find($id);
        return view('backEnd.hub.edit',compact('edit_data'));
    }
     public function update(Request $request){
        $this->validate($request,[
            'title'=>'required',
            'title_bn'=>'required',
            // 'subtitle'=>'required',
            // 'subtitle_bn'=>'required',
            'text'=>'required',
            'text_bn'=>'required',
            'status'=>'required',
        ]);
        $update_data = Hub::find($request->hidden_id);
        
        $update_data->title = $request->title;
        $update_data->title_bn = $request->title_bn;
        // $update_data->subtitle = $request->subtitle;
        // $update_data->subtitle_bn = $request->subtitle;
        $update_data->text = $request->text;
        $update_data->text_bn = $request->text_bn;
        $update_data->status = $request->status;
        $update_data->save();

        Toastr::success('message', 'Hub update successfully!');
        return redirect('editor/hub/manage');
    }

    public function inactive(Request $request){
        $unpublish_data = Hub::find($request->hidden_id);
        $unpublish_data->status=0;
        $unpublish_data->save();
        Toastr::success('message', 'Hub uppublished successfully!');
        return redirect('editor/hub/manage');
    }

    public function active(Request $request){
        $publishId = Hub::find($request->hidden_id);
        $publishId->status=1;
        $publishId->save();
        Toastr::success('message', 'Hub uppublished successfully!');
        return redirect('editor/hub/manage');
    }
     public function destroy(Request $request){
        $delete_data = Hub::find($request->hidden_id);
        File::delete(public_path() . 'public/uploads/hub', $delete_data->image);  
        $delete_data->delete();
        Toastr::success('message', 'Hubdelete successfully!');
        return redirect('editor/hub/manage');
    }

    //set default
    public function setDefault(Request $request) {
        $hub = Hub::where('id', $request->hidden_id)->first();
        $hub->is_default=1;
        $hub->save();
        Toastr::success('message', 'Hub has been set as default successfully!');
        return redirect('editor/hub/manage');
    }

    //set default
    public function setNonDefault(Request $request) {
        $hub = Hub::where('id', $request->hidden_id)->first();
        $hub->is_default=0;
        $hub->save();
        Toastr::success('message', 'Hub has been set as non default successfully!');
        return redirect('editor/hub/manage');
    }
}
