<?php

namespace App\Http\Controllers\Admin;

use App\AccountHead;
use App\Agent;
use App\Area;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use App\Nearestzone;
use App\Deliveryman;
use App\DeliverymanAgent;
use App\DeliverymanArea;
use App\DeliverymanEducation;
use App\DeliverymanExperience;
use App\Division;
use Illuminate\Support\Str;
use DB;
use App\helper\CustomHelper;
use App\Hub;

class DeliverymanManageController extends Controller
{
	public function add()
	{
		$branches = CustomHelper::getUserBranch();
        if($branches) {
            $allBranch = Hub::where('status', 1)->whereIn('id', $branches)->get();
        }else {
            $allBranch = Hub::where('status', 1)->get();
        }

		$divisions = Division::orderBy('name')->where('status', 1)->get();
		$agents = Agent::where('status', 1)->get();
		return view('backEnd.deliveryman.add', compact('divisions', 'agents','allBranch'));
	}
	public function save(Request $request) {	
		// dd($request->all());
		$this->validate($request, [
			'name' => 'required',
			'email' => 'nullable|email|unique:deliverymen',
			'phone' => 'required|unique:deliverymen',
			'branch_id' => 'required',
			'designation' => 'nullable',
			'identification_type' => 'required',
			'nid_photo' => 'image|required_if:identification_type,=,1',
            'nid_photo_back' => 'image|required_if:identification_type,=,1',
            'birth_certificate_photo' => 'image|required_if:identification_type,=,2',
			'per_parcel_amount' => 'required|numeric',
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
		$uploadPath = 'public/uploads/deliveryman/';
		$file->move($uploadPath, $name);
		$fileUrl = $uploadPath . $name;

		$store_data					=	new Deliveryman();

		if($request->identification_type == 1) {
			if($request->file('nid_photo')){
				$store_data->nid_front = $this->fileUpload($request->file('nid_photo'),'public/uploads/deliveryman/', 400, 250);
			}
			if($request->file('nid_photo_back')){
				$store_data->nid_back = $this->fileUpload($request->file('nid_photo_back'),'public/uploads/deliveryman/', 400, 250);
			}
		}elseif($request->identification_type == 2) {
			if($request->file('birth_certificate_photo')){
				$store_data->birth_certificate = $this->fileUpload($request->file('birth_certificate_photo'),'public/uploads/deliveryman/', 400, 250);
			}
		}


		$store_data->name 			=	$request->name;
		$store_data->email  		= 	$request->email;
		$store_data->phone  		= 	$request->phone;
		$store_data->alternative_phone  		= 	$request->alternative_phone;
		$store_data->nid_no  		= 	$request->nid_no;
		$store_data->designation 	= 	$request->designation;
		$store_data->branch_id 	= 	$request->branch_id;
		$store_data->fathers_name 	= 	$request->fathers_name;
		
		$store_data->mothers_name 	= 	$request->mothers_name;
		$store_data->identification_type 	= 	$request->identification_type;
		
		$store_data->birth_date 	= 	$request->birth_date;
		$store_data->religion 	= 	$request->religion;
		$store_data->marital_status 	= 	$request->marital_status;
		$store_data->present_address 	= 	$request->present_address;
		$store_data->permanent_address = 	$request->permanent_address;
		
		$store_data->guaranteer_name 	= 	$request->guaranteer_name;
		$store_data->fathers_name 	= 	$request->fathers_name;
		$store_data->guaranteer_relation 	= 	$request->guaranteer_relation;
		$store_data->guaranteer_nid_no 	= 	$request->guaranteer_nid_no;
		$store_data->guaranteer_mobile_no 	= 	$request->guaranteer_mobile_no;
		$store_data->guaranteer_present_address 	= 	$request->guaranteer_present_address;
		$store_data->guaranteer_permanent_address 	= 	$request->guaranteer_permanent_address;

		$store_data->per_parcel_amount 			= 	$request->per_parcel_amount;
		$store_data->division_id 			= 	$request->division_id;
		$store_data->district_id 			= 	$request->district_id;
		$store_data->thana_id 			= 	$request->thana_id;
		// $store_data->area_id 			= 	$request->area_id;
		$store_data->api_token 		= 	Str::random(50);
		$store_data->password 		= 	bcrypt(request('password'));
		$store_data->image 			= 	$fileUrl;
		$store_data->status 		= 	$request->status;
		$store_data->save();
		$insId = $store_data->id;
		if($insId) {
			//add account head
            $storeAccount = new AccountHead();
            $storeAccount->head_type = 2;
            $storeAccount->user_id = $insId;
            $storeAccount->head_name = $insId.$request->name;
            $storeAccount->status = 1;
            $storeAccount->save();

			// Save Deliveryman Education 
			foreach ($request->exam_name ?? [] as $i => $exam_name) {
				DeliverymanEducation::create([
					'deliveryman_id' => $store_data->id,
					'exam_name' => $exam_name,
					'group' => $request->group[$i] ?? '',
					'gpa' => $request->gpa[$i] ?? '',
					'year' => $request->year[$i] ?? '',
					'board' => $request->board[$i] ?? '',
				]);
			}

			// Save deliveryman Experience 
			foreach ($request->company_name ?? [] as $i => $company_name) {
				DeliverymanExperience::create([
					'deliveryman_id' => $store_data->id,
					'company_name' => $company_name,
					'designation' => $request->designations[$i] ?? '',
					'start_date' => $request->start_date[$i] ? date('Y-m-d', strtotime($request->start_date[$i])) : null,
					'end_date' => $request->end_date[$i] ? date('Y-m-d', strtotime($request->end_date[$i])) : null,
				]);
			}

			Toastr::success('message', 'Deliveryman add successfully!');
			return redirect('admin/deliveryman/manage');


		}else {
			Toastr::success('message', 'Something was wrong');
			return redirect()->back();
		}

		
	}

	public function manage()
	{
		$branches = CustomHelper::getUserBranch();
		$show_datas = Deliveryman::orderBy('id', 'DESC');
					if($branches) {
						$show_datas = $show_datas->whereIn('branch_id', $branches);
					}
					$show_datas = $show_datas->get();
		return view('backEnd.deliveryman.manage', compact('show_datas'));
	}

	public function details(Request $request, $deliveryman_id)
	{
		$deliveryman = Deliveryman::find($deliveryman_id);
		$divisions = Division::orderBy('name')->where('status', 1)->get();
		$agent_id = DeliverymanAgent::where('deliveryman_id', $deliveryman_id)->pluck('agent_id')->toArray();
		$area_id = DeliverymanArea::where('deliveryman_id', $deliveryman_id)->pluck('area_id')->toArray();

		return view('backEnd.deliveryman.details', compact('deliveryman', 'divisions', 'agent_id', 'area_id'));
	}

	public function locationTrack()
	{
		$delivery_mans = Deliveryman::where('status', 1)->get();
		$positions = [];
		foreach ($delivery_mans as $delivery_man) {
			$positions = [
				'lat' => $delivery_man->lat,
				'lng' => $delivery_man->lng,
				'title' => $delivery_man->name,
			];
		}
		$positions = response()->json($positions);
		$menu = 'active menu-open';
		$sub_menu = 'active';
		// dd($positions);
		return view('backEnd.deliveryman.location_track', compact('delivery_mans', 'positions', 'menu', 'sub_menu'));
	}
	public function getDeliverymans()
	{
		$delivery_mans = Deliveryman::where('status', 1)->get()->toArray();
		return response()->json($delivery_mans);
	}

	public function edit($id)
	{

		$branches = CustomHelper::getUserBranch();
        if($branches) {
            $allBranch = Hub::where('status', 1)->whereIn('id', $branches)->get();
        }else {
            $allBranch = Hub::where('status', 1)->get();
        }

		$edit_data = Deliveryman::find($id);
		$divisions = Division::orderBy('name')->where('status', 1)->get();
		$agent_id = DeliverymanAgent::where('deliveryman_id', $id)->pluck('agent_id')->toArray();
		$area_id = DeliverymanArea::where('deliveryman_id', $id)->pluck('area_id')->toArray();
		return view('backEnd.deliveryman.edit', compact('edit_data', 'divisions', 'agent_id', 'area_id','allBranch'));
	}

	public function update(Request $request)
	{
		$this->validate($request, [
			'hidden_id' => 'required',
			'name' => 'required',
			'email' => 'nullable|email|unique:deliverymen,email,' . $request->hidden_id,
			'phone' => 'required|unique:deliverymen,phone,' . $request->hidden_id,
			'designation' => 'nullable',
			'identification_type' => 'required',
			'branch_id' => 'required',
			'per_parcel_amount' => 'required|numeric',
			'division_id' => 'required',
			'district_id' => 'required',
			'thana_id' => 'required',
			'image' => 'nullable|image',
			'password' => 'nullable|same:confirm',
			'confirm' => 'nullable',
			'status' => 'required',
		]);

		$update_data = Deliveryman::find($request->hidden_id);
		// image upload
		$update_file = $request->file('image');
		if ($update_file) {
			$name = time() . $update_file->getClientOriginalName();
			$uploadPath = 'public/uploads/deliveryman/';
			$update_file->move($uploadPath, $name);
			$fileUrl = $uploadPath . $name;
		} else {
			$fileUrl = $update_data->image;
		}

		if($request->identification_type == 1) {
			if($request->file('nid_photo')){
				$update_data->nid_front = $this->fileUpload($request->file('nid_photo'),'public/uploads/deliveryman/', 400, 250);
			}
			if($request->file('nid_photo_back')){
				$update_data->nid_back = $this->fileUpload($request->file('nid_photo_back'),'public/uploads/deliveryman/', 400, 250);
			}
		}elseif($request->identification_type == 2) {
			if($request->file('birth_certificate_photo')){
				$update_data->birth_certificate = $this->fileUpload($request->file('birth_certificate_photo'),'public/uploads/deliveryman/', 400, 250);
			}
		}

		$update_data->name 			=	$request->name;
		$update_data->email  		= 	$request->email;
		$update_data->phone  		= 	$request->phone;
		$update_data->alternative_phone  		= 	$request->alternative_phone;
		$update_data->nid_no  		= 	$request->nid_no;
		$update_data->designation 	= 	$request->designation;
		$update_data->branch_id 	= 	$request->branch_id;
		$update_data->fathers_name 	= 	$request->fathers_name;
		
		$update_data->mothers_name 	= 	$request->mothers_name;
		$update_data->identification_type 	= 	$request->identification_type;
		
		$update_data->birth_date 	= 	$request->birth_date;
		$update_data->religion 	= 	$request->religion;
		$update_data->marital_status 	= 	$request->marital_status;
		$update_data->present_address 	= 	$request->present_address;
		$update_data->permanent_address = 	$request->permanent_address;
		
		$update_data->guaranteer_name 	= 	$request->guaranteer_name;
		$update_data->fathers_name 	= 	$request->fathers_name;
		$update_data->guaranteer_relation 	= 	$request->guaranteer_relation;
		$update_data->guaranteer_nid_no 	= 	$request->guaranteer_nid_no;
		$update_data->guaranteer_mobile_no 	= 	$request->guaranteer_mobile_no;
		$update_data->guaranteer_present_address 	= 	$request->guaranteer_present_address;
		$update_data->guaranteer_permanent_address 	= 	$request->guaranteer_permanent_address;
		$update_data->per_parcel_amount 			= 	$request->per_parcel_amount;
		$update_data->division_id 			= 	$request->division_id;
		$update_data->district_id 			= 	$request->district_id;
		$update_data->thana_id 			= 	$request->thana_id;
		if (request('password')) {
			$update_data->password 		= 	bcrypt(request('password'));
		}

		$update_data->image 			= 	$fileUrl;
		$update_data->status 		= 	$request->status;
		$update_data->save();
		$updId = $update_data->id;
		if($updId) {
			//update account head
            $storeAccount = AccountHead::where('user_id', $updId)->where('head_type', 2)->first();
			if($storeAccount) {
            $storeAccount->head_name = $updId.$request->name;
            $storeAccount->save();
			}


			// Ypdate Deliveryman Education 
			DeliverymanEducation::where('deliveryman_id', $update_data->id)->delete();
			if ($request->exam_name && count($request->exam_name) > 0) {
				foreach ($request->exam_name ?? [] as $i => $exam_name) {
					DeliverymanEducation::create([
						'deliveryman_id' => $update_data->id,
						'exam_name' => $exam_name,
						'group' => $request->group[$i] ?? '',
						'gpa' => $request->gpa[$i] ?? '',
						'year' => $request->year[$i] ?? '',
						'board' => $request->board[$i] ?? '',
					]);
				}
			}

			// Update Deliveryman Experience 
			DeliverymanExperience::where('deliveryman_id', $update_data->id)->delete();
			if ($request->company_name && count($request->company_name) > 0) {
				foreach ($request->company_name ?? [] as $j => $company_name) {
					DeliverymanExperience::create([
						'deliveryman_id' => $update_data->id,
						'company_name' => $company_name,
						'designation' => $request->designations[$j] ?? '',
						'start_date' => $request->start_date[$j] ? date('Y-m-d', strtotime($request->start_date[$j])) : null,
						'end_date' => $request->end_date[$j] ? date('Y-m-d', strtotime($request->end_date[$j])) : null
					]);
				}
			}

			Toastr::success('message', 'Employee update successfully!');
			return redirect('admin/deliveryman/manage');
		}else {
			Toastr::success('message', 'Update failed!');
			return redirect()->back();
		}

		
	}

	public function inactive(Request $request)
	{
		$inactive_data = Deliveryman::find($request->hidden_id);
		$inactive_data->status = 0;
		$inactive_data->save();
		Toastr::success('message', 'Employee inactive successfully!');
		return redirect('admin/deliveryman/manage');
	}

	public function active(Request $request)
	{
		$inactive_data = Deliveryman::find($request->hidden_id);
		$inactive_data->status = 1;
		$inactive_data->save();
		Toastr::success('message', 'Employee active successfully!');
		return redirect('admin/deliveryman/manage');
	}

	public function destroy(Request $request)
	{
		$destroy_id = Deliveryman::find($request->hidden_id);
		$destroy_id->delete();
		Toastr::success('message', 'Employee delete successfully!');
		return redirect('admin/deliveryman/manage');
	}
}
