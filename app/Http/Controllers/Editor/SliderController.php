<?php

namespace App\Http\Controllers\Editor;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Slider;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;

class SliderController extends Controller
{

    public function create()
    {
        $last_short = Slider::count();
        return view('backEnd.slider.create', compact('last_short'));
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'image' => 'required',
            'name' => 'required',
            'slider_sdesc' => 'required',
            'sort' => 'required',
            'status' => 'required',
        ]);
        

        $store_data = new Slider();
        $store_data->name = $request->name;
        $store_data->slider_sdesc = $request->slider_sdesc;
        $store_data->sort = $request->sort;
        if($request->file('image')){
            $store_data->image = $this->fileUpload($request->file('image'),'public/uploads/slider/',1315, 450);
        }
        $store_data->status = $request->status;
        $store_data->save();
        Toastr::success('message', 'Slider add successfully!');
        return redirect('editor/slider/manage');
    }
    public function manage()
    {
        $show_data = Slider::get();
        return view('backEnd.slider.manage', compact('show_data'));
    }
    public function edit($id)
    {
        $edit_data = Slider::find($id);
        return view('backEnd.slider.edit', compact('edit_data'));
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'status' => 'required',
        ]);

        $update_data = Slider::find($request->hidden_id);

        if($request->file('image')){
            if($update_data->image){
                File::delete($update_data->image);
            }
            $update_data->image = $this->fileUpload($request->file('image'),'public/uploads/slider/',1315, 450);
        }
        $update_data->name = $request->name;
        $update_data->slider_sdesc = $request->slider_sdesc;
        $update_data->sort = $request->sort;
        $update_data->status = $request->status;
        $update_data->save();
        Toastr::success('message', 'Slider  update successfully!');
        return redirect('editor/slider/manage');
    }

    public function inactive(Request $request)
    {
        $unpublish_data = Slider::find($request->hidden_id);
        $unpublish_data->status = 0;
        $unpublish_data->save();
        Toastr::success('message', 'slider  uppublished successfully!');
        return redirect('editor/slider/manage');
    }

    public function active(Request $request)
    {
        $publishId = Slider::find($request->hidden_id);
        $publishId->status = 1;
        $publishId->save();
        Toastr::success('message', 'slider  uppublished successfully!');
        return redirect('editor/slider/manage');
    }
    public function destroy(Request $request)
    {
        $delete_data = Slider::find($request->hidden_id);
        File::delete(public_path() . 'public/uploads/slider', $delete_data->image);
        $delete_data->delete();
        Toastr::success('message', 'slider delete successfully!');
        return redirect('editor/slider/manage');
    }
}
