<?php

namespace App\Http\Controllers\Editor;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Slogan;
use Brian2694\Toastr\Facades\Toastr;

class SloganController extends Controller
{
    public function create()
    {
        $slogan = Slogan::first();
        return view('backEnd.slogan.create', compact('slogan'));
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|max:255',
            'title_bn' => 'required|max:255',
            'description' => 'required',
            'description_bn' => 'required',
        ]);
        $store_data = Slogan::first();
        if(empty($store_data)){
            $store_data = new Slogan();
        }
        
        $store_data->title = $request->title;
        $store_data->title_bn = $request->title_bn;
        $store_data->description = $request->description;
        $store_data->description_bn = $request->description_bn;
        $store_data->status = $request->status;
        $store_data->save();
        Toastr::success('message', 'Slogan add successfully!');
        return redirect('editor/slogan/create');
    }
}
