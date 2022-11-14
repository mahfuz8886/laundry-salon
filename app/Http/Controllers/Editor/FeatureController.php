<?php

namespace App\Http\Controllers\editor;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use App\Feature;
use File;
class FeatureController extends Controller
{
    public function create(){
    	return view('backEnd.feature.create');
    }
    public function store(Request $request){
        
    	$this->validate($request,[
    		'title'=>'required',
            'title_bn'=>'required',
            'subtitle'=>'required',
            'subtitle_bn'=>'required',
    		'image'=>'required',
    		'status'=>'required',
    	]);
         // image upload
        $file = $request->file('image');
        $name = $file->getClientOriginalName();
        $uploadPath = 'public/uploads/feature/';
        $file->move($uploadPath,$name);
        $fileUrl =$uploadPath.$name;

    	$store_data = new Feature();
    	$store_data->title = $request->title;
        $store_data->title_bn = $request->title_bn;
        $store_data->image = $fileUrl;
        $store_data->subtitle = $request->subtitle;
        $store_data->subtitle_bn = $request->subtitle_bn;
    	$store_data->status = $request->status;
    	$store_data->save();
        Toastr::success('message', 'Featureadd successfully!');
    	return redirect('editor/feature/manage');
    }
    public function manage(){
    	$show_data = Feature::get();
        return view('backEnd.feature.manage',compact('show_data'));
    }
    public function edit($id){
        $edit_data = Feature::find($id);
        return view('backEnd.feature.edit',compact('edit_data'));
    }
     public function update(Request $request){
        $this->validate($request,[
            'title'=>'required',
            'title_bn'=>'required',
            'subtitle'=>'required',
            'subtitle_bn'=>'required',
            'status'=>'required',
        ]);
        $update_data = Feature::find($request->hidden_id);
        $update_image = $request->file('image');
        if ($update_image) {
           $file = $request->file('image');
            $name = $file->getClientOriginalName();
            $uploadPath = 'public/uploads/feature/';
            File::delete(public_path() . 'public/uploads/feature', $update_data->image);
            $file->move($uploadPath,$name);
            $fileUrl =$uploadPath.$name;
        }else{
            $fileUrl = $update_data->image;
        }

        $update_data->image = $fileUrl;
        $update_data->title = $request->title;
        $update_data->title_bn = $request->title_bn;
        $update_data->subtitle = $request->subtitle;
        $update_data->subtitle_bn = $request->subtitle_bn;
        $update_data->status = $request->status;
        $update_data->save();
        Toastr::success('message', 'Feature update successfully!');
        return redirect('editor/feature/manage');
    }

    public function inactive(Request $request){
        $unpublish_data = Feature::find($request->hidden_id);
        $unpublish_data->status=0;
        $unpublish_data->save();
        Toastr::success('message', 'Feature uppublished successfully!');
        return redirect('editor/feature/manage');
    }

    public function active(Request $request){
        $publishId = Feature::find($request->hidden_id);
        $publishId->status=1;
        $publishId->save();
        Toastr::success('message', 'Feature uppublished successfully!');
        return redirect('editor/feature/manage');
    }
     public function destroy(Request $request){
        $delete_data = Feature::find($request->hidden_id);
        File::delete(public_path() . 'public/uploads/feature', $delete_data->image);  
        $delete_data->delete();
        Toastr::success('message', 'Featuredelete successfully!');
        return redirect('editor/feature/manage');
    }
}
