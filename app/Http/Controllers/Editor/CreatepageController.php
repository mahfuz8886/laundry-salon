<?php

namespace App\Http\Controllers\editor;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use App\Createpage;
use File;

class CreatepageController extends Controller
{
    public function create(){
        return view('backEnd.createpage.create');
    }
    public function store(Request $request){
        $this->validate($request,[
            'page_area'=>'required',
            'pageName'=>'required',
            'pageName_bn'=>'required',
            'title'=>'required',
            'title_bn'=>'required',
            'text'=>'required',
            'text_bn'=>'required',
            'status'=>'required',
        ]);
         
        $store_data = new Createpage();
        $store_data->page_area = $request->page_area;
        $store_data->pageName = $request->pageName;
        $store_data->pageName_bn = $request->pageName_bn;
        $store_data->slug =   preg_replace('/\s+/u', '-', trim($request->pageName));
        $store_data->title = $request->title;
        $store_data->title_bn = $request->title_bn;
        $store_data->text = $request->text;
        $store_data->text_bn = $request->text_bn;
        $store_data->status = $request->status;
        $store_data->save();
        Toastr::success('message', 'Create Page successfully!');
        return redirect('editor/createpage/manage');
    }
    public function manage(){
        $show_data = Createpage::get();
        return view('backEnd.createpage.manage',compact('show_data'));
    }
    public function edit($id){
        $edit_data = Createpage::find($id);
        return view('backEnd.createpage.edit',compact('edit_data'));
    }
     public function update(Request $request){
        $this->validate($request,[
            'page_area'=>'required',
            'pageName'=>'required',
            'pageName_bn'=>'required',
            'title'=>'required',
            'title_bn'=>'required',
            'text'=>'required',
            'text_bn'=>'required',
            'status'=>'required',
        ]);
        $update_data = Createpage::find($request->hidden_id);
        $update_data->page_area = $request->page_area;
        $update_data->pageName = $request->pageName;
        $update_data->pageName_bn = $request->pageName_bn;
        $update_data->slug =   preg_replace('/\s+/u', '-', trim($request->pageName));
        $update_data->title = $request->title;
        $update_data->title_bn = $request->title_bn;
        $update_data->text = $request->text;
        $update_data->text_bn = $request->text_bn;
        $update_data->status = $request->status;

        $update_data->save();
        Toastr::success('message', 'Create Page update successfully!');
        return redirect('editor/createpage/manage');
    }

    public function inactive(Request $request){
        $unpublish_data = Createpage::find($request->hidden_id);
        $unpublish_data->status=0;
        $unpublish_data->save();
        Toastr::success('message', 'Create Page uppublished successfully!');
        return redirect('editor/createpage/manage');
    }

    public function active(Request $request){
        $publishId = Createpage::find($request->hidden_id);
        $publishId->status=1;
        $publishId->save();
        Toastr::success('message', 'Create Page uppublished successfully!');
        return redirect('editor/createpage/manage');
    }
     public function destroy(Request $request){
        $delete_data = Createpage::find($request->hidden_id);
        $delete_data->delete();
        Toastr::success('message', 'Create Pagedelete successfully!');
        return redirect('editor/createpage/manage');
    }
}
