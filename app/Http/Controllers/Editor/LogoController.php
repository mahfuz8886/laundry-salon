<?php

namespace App\Http\Controllers\editor;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use App\Logo;
use File;
class LogoController extends Controller
{
    
    public function create(){
    	return view('backEnd.logo.create');
    }
    public function store(Request $request){
    	$this->validate($request,[
    		'image'=>'required',
    		'type'=>'required',
    		'status'=>'required',
    	]);

    	// image upload
    	// $file = $request->file('image');
    	// $name = $file->getClientOriginalName();
    	// $uploadPath = 'public/uploads/logo/';
    	// $file->move($uploadPath,$name);
    	// $fileUrl =$uploadPath.$name;

    	$store_data = new Logo();
    	$store_data->type = $request->type;
        // if($request->file('image')){
        //     if($request->type==4){
        //         $store_data->image = $this->fileUpload($request->file('image'),'public/uploads/logo/',400, 250);
        //     }else{
        //         $store_data->image = $this->fileUpload($request->file('image'),'public/uploads/logo/');
        //     }
        // }
    	// $store_data->image = $fileUrl;

        if($request->file('image')){
            
            $store_data->image = $this->fileUpload($request->file('image'),'public/uploads/logo/', 400, 250);
        }


    	$store_data->status = $request->status;
    	$store_data->save();
        Toastr::success('message', 'Logo add successfully!');
    	return redirect('/editor/logo/manage');
    }
    public function manage(){
    	$show_data = Logo::get();
        return view('backEnd.logo.manage',compact('show_data'));
    }
    public function edit($id){
        $edit_data = Logo::find($id);
        return view('backEnd.logo.edit',compact('edit_data'));
    }
     public function update(Request $request){
        $this->validate($request,[
            'status'=>'required',
        ]);

        $update_data = Logo::find($request->hidden_id);

        if($request->file('image')){
            if($update_data->image){
                File::delete($update_data->image);
            }
            if($request->type==4){
                $update_data->image = $this->fileUpload($request->file('image'),'public/uploads/logo/',400, 250);
            }else{
                $update_data->image = $this->fileUpload($request->file('image'),'public/uploads/logo/');
            }
        }
        $update_data->type = $request->type;
        $update_data->status = $request->status;
        $update_data->save();
        Toastr::success('message', 'Logo  update successfully!');
        return redirect('/editor/logo/manage');
    }

    public function inactive(Request $request){
        $unpublish_data = Logo::find($request->hidden_id);
        $unpublish_data->status=0;
        $unpublish_data->save();
        Toastr::success('message', 'Logo  uppublished successfully!');
        return redirect('/editor/logo/manage');
    }

    public function active(Request $request){
        $publishId = Logo::find($request->hidden_id);
        $publishId->status=1;
        $publishId->save();
        Toastr::success('message', 'Logo  uppublished successfully!');
        return redirect('/editor/logo/manage');
    }
     public function destroy(Request $request){
        $delete_data = Logo::find($request->hidden_id);
        File::delete(public_path() . 'public/uploads/logo', $delete_data->image);  
        $delete_data->delete();
        Toastr::success('message', 'Logo delete successfully!');
        return redirect('/editor/logo/manage');
    }
}
