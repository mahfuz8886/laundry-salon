<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Str;
use App\Agent;
use App\AgentThana;
use App\Division;
use App\Thana;
use DB;

class AgentManageController extends Controller
{
	public function add()
	{
		$divisions = Division::orderBy('name')->where('status', 1)->get();
		return view('backEnd.agent.add', compact('divisions'));
	}
	public function save(Request $request)
	{
		$this->validate($request, [
			'name' => 'required',
			'email' => 'nullable|email|unique:agents',
			'phone' => 'required|numeric|digits:11|unique:agents',
			'designation' => 'nullable',
			'division_id' => 'required',
			'district_id' => 'required',
			'thana_id' => 'required',
			'image' => 'required|image',
			'password' => 'required|same:confirm',
			'confirm' => 'required',
			'status' => 'required',
		]);


		// image upload
		$file = $request->file('image');
		$name = time() . $file->getClientOriginalName();
		$uploadPath = 'public/uploads/agent/';
		$file->move($uploadPath, $name);
		$fileUrl = $uploadPath . $name;

		$store_data					=	new Agent();
		$store_data->name 			=	$request->name;
		$store_data->email  		= 	$request->email;
		$store_data->phone  		= 	$request->phone;
		$store_data->alternative_phone  		= 	$request->alternative_phone;
		$store_data->nid_no  		= 	$request->nid_no;
		$store_data->designation 	= 	$request->designation;
		$store_data->division_id 	= 	$request->division_id;
		$store_data->district_id 	= 	$request->district_id;
		$store_data->area_id 		= 	$request->area_id;
		$store_data->address 		= 	$request->address;
		$store_data->api_token 		= 	Str::random(50);
		$store_data->password 		= 	bcrypt(request('password'));
		$store_data->image 			= 	$fileUrl;
		$store_data->status 		= 	$request->status;
		$store_data->save();

		foreach ($request->thana_id ?? [] as $thana_id) {
			$thana = Thana::find($thana_id);
			AgentThana::create([
				'agent_id' => $store_data->id,
				'district_id' => $thana->district_id,
				'thana_id' => $thana_id,
			]);
		}
		Toastr::success('message', 'Agent add successfully!');
		return redirect('admin/agent/manage');
	}

	public function manage()
	{
		$show_datas = Agent::orderBy('name')->get();
		return view('backEnd.agent.manage', compact('show_datas'));
	}

	public function details($agent_id)
	{
		$agent = Agent::find($agent_id);
		return view('backEnd.agent.details', compact('agent'));
	}

	public function edit($id)
	{
		$edit_data = Agent::find($id);
		$thana_ids = AgentThana::where('agent_id', $id)->pluck('thana_id')->toArray();
		$divisions = Division::orderBy('name')->where('status', 1)->get();
		return view('backEnd.agent.edit', compact('edit_data', 'divisions', 'thana_ids'));
	}

	public function update(Request $request)
	{
		$this->validate($request, [
			'name' => 'required',
			'email' => 'nullable|email|unique:agents,email,' . $request->hidden_id,
			'phone' => 'required|numeric|digits:11|unique:agents,phone,' . $request->hidden_id,
			'designation' => 'nullable',
			'division_id' => 'required',
			'district_id' => 'required',
			// 'thana_id'=>'required',
			'image' => 'nullable|image',
			'password' => 'nullable|same:confirm',
			'status' => 'required',
		]);
		$update_data = Agent::find($request->hidden_id);
		// image upload
		$update_file = $request->file('image');
		if ($update_file) {
			$name = time() . $update_file->getClientOriginalName();
			$uploadPath = 'public/uploads/agent/';
			$update_file->move($uploadPath, $name);
			$fileUrl = $uploadPath . $name;
		} else {
			$fileUrl = $update_data->image;
		}

		$update_data->name 			=	$request->name;
		$update_data->email  		= 	$request->email;
		$update_data->phone  		= 	$request->phone;
		$update_data->alternative_phone  		= 	$request->alternative_phone;
		$update_data->nid_no  		= 	$request->nid_no;
		$update_data->designation 	= 	$request->designation;
		$update_data->division_id 			= 	$request->division_id;
		$update_data->district_id 			= 	$request->district_id;
		// $update_data->thana_id 			= 	$request->thana_id;
		$update_data->area_id 			= 	$request->area_id;
		$update_data->address 			= 	$request->address;
		$update_data->image 		= 	$fileUrl;
		if ($request->password) {
			$update_data->password 		= 	bcrypt(request('password'));
		}
		if (empty($update_data->api_token)) {
			$update_data->api_token = Str::random(50);
		}
		$update_data->status 		= 	$request->status;
		$update_data->save();

		// Remove prev agent thana
		AgentThana::where('agent_id', $update_data->id)->whereNotIn('thana_id', $request->thana_id)->delete();
		foreach ($request->thana_id ?? [] as $thana_id) {
			$exist = AgentThana::where('agent_id', $update_data->id)->where('thana_id', $thana_id)->first();
			$thana = Thana::find($thana_id);
			if (empty($exist)) {
				AgentThana::create([
					'agent_id' => $update_data->id,
					'district_id' => $thana->district_id,
					'thana_id' => $thana_id,
				]);
			} else {
				$exist->update([
					'agent_id' => $update_data->id,
					'district_id' => $thana->district_id,
					'thana_id' => $thana_id,
				]);
			}
		}

		Toastr::success('message', 'Agent update successfully!');
		return redirect('admin/agent/manage');
	}

	public function inactive(Request $request)
	{
		$inactive_data = Agent::find($request->hidden_id);
		$inactive_data->status = 0;
		$inactive_data->save();
		Toastr::success('message', 'Employee inactive successfully!');
		return redirect('admin/agent/manage');
	}

	public function active(Request $request)
	{
		$inactive_data = Agent::find($request->hidden_id);
		$inactive_data->status = 1;
		$inactive_data->save();
		Toastr::success('message', 'Employee active successfully!');
		return redirect('admin/agent/manage');
	}

	public function destroy(Request $request)
	{
		$destroy_id = Agent::find($request->hidden_id);
		$destroy_id->delete();
		Toastr::success('message', 'Employee delete successfully!');
		return redirect('admin/agent/manage');
	}
}
