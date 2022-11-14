<?php

namespace App\Http\Controllers\Admin;

use App\AccountHead;
use App\Agent;
use App\Area;
use App\Attendance;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use App\Department;
use App\Division;
use App\Employee;
use App\EmployeeAgent;
use App\EmployeeArea;
use App\EmployeeEducation;
use App\EmployeeExperience;
use App\EmployeeService;
use App\Hub;
use App\SalonBooking;
use App\SalonBookingItem;
use App\SalonTransaction;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Str;
use DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class EmployeeController extends Controller
{
	public function add()
	{
		$departments = Department::where('status', 1)->get();
		$divisions = Division::orderBy('name')->where('status', 1)->get();
		$agents = Agent::where('status', 1)->get();

		$branches = $this->getUserBranch();
        if($branches) {
            $allBranch = Hub::where('status', 1)->whereIn('id', $branches)->get();
        }else {
            $allBranch = Hub::where('status', 1)->get();
        }

		return view('backEnd.employee.add', compact('departments', 'divisions', 'agents','allBranch'));
	}
	public function save(Request $request)
	{
		// dd($request->all());
		$this->validate($request, [
			'name' => 'required',
			'email' => 'nullable|email|unique:employees',
			'phone' => 'required|numeric|digits:11|unique:employees',
			'branch_id' => 'required',
			'department_id' => 'required',
			'gross_salary' => 'required',
			'identification_type' => 'required',
			//'nid_photo' => 'image|required_if:identification_type,=,1',
            //'nid_photo_back' => 'image|required_if:identification_type,=,1',
            //'birth_certificate_photo' => 'image|required_if:identification_type,=,2',
			'designation' => 'nullable',
			'division_id' => 'required',
			'district_id' => 'required',
			'thana_id' => 'required',
			//'image' => 'required|image',
			// 'password' => 'required|same:confirm',
			// 'confirm' => 'required',
			'status' => 'required',
		]);

		$sectionName = Session::get('section');

		// image upload
		$file = $request->file('image');
		$name = time() . $file->getClientOriginalName();
		$uploadPath = 'public/uploads/employee/';
		$file->move($uploadPath, $name);
		$fileUrl = $uploadPath . $name;

		$store_data	= new Employee();

		if($request->identification_type == 1) {
			if($request->file('nid_photo')){
				$store_data->nid_front = $this->fileUpload($request->file('nid_photo'),'public/uploads/employee/', 400, 250);
			}
			if($request->file('nid_photo_back')){
				$store_data->nid_back = $this->fileUpload($request->file('nid_photo_back'),'public/uploads/employee/', 400, 250);
			}
		}elseif($request->identification_type == 2) {
			if($request->file('birth_certificate_photo')){
				$store_data->birth_certificate = $this->fileUpload($request->file('birth_certificate_photo'),'public/uploads/employee/', 400, 250);
			}
		}


		
		$store_data->name 			=	$request->name;
		$store_data->email  		= 	$request->email;
		$store_data->phone  		= 	$request->phone;
		$store_data->nid_no  		= 	$request->nid_no;
		$store_data->department_id 	= 	$request->department_id;
		$store_data->branch_id 	= 	$request->branch_id;
		$store_data->designation 	= 	$request->designation;
		$store_data->fathers_name 	= 	$request->fathers_name;

		$store_data->gross_salary 	= 	$request->gross_salary;

		// if($sectionName == 'salon') {
		// 	$store_data->commission 	= 	$request->commission;
		// }

		$store_data->commission = $request->commission?$request->commission:0;
		
		$store_data->others_allowance 	= 	$request->others_allowance? $request->others_allowance:0;
		// $store_data->fathers_profession 	= 	$request->fathers_profession;
		// $store_data->fathers_nid_no 	= 	$request->fathers_nid_no;
		// $store_data->fathers_mobile_no 	= 	$request->fathers_mobile_no;
		$store_data->mothers_name 	= 	$request->mothers_name;
		// $store_data->mothers_profession 	= 	$request->mothers_profession;
		// $store_data->mothers_nid_no 	= 	$request->mothers_nid_no;
		// $store_data->mothers_mobile_no 	= 	$request->mothers_mobile_no;
		$store_data->birth_date 	= 	$request->birth_date;
		$store_data->religion 	= 	$request->religion;
		$store_data->marital_status 	= 	$request->marital_status;
		$store_data->present_address 	= 	$request->present_address;
		$store_data->permanent_address = 	$request->permanent_address;
		// $store_data->guaranteer_information 	= 	$request->guaranteer_information;
		$store_data->guaranteer_name 	= 	$request->guaranteer_name;
		$store_data->fathers_name 	= 	$request->fathers_name;
		$store_data->guaranteer_relation 	= 	$request->guaranteer_relation;
		$store_data->guaranteer_nid_no 	= 	$request->guaranteer_nid_no;
		$store_data->guaranteer_mobile_no 	= 	$request->guaranteer_mobile_no;
		$store_data->guaranteer_present_address 	= 	$request->guaranteer_present_address;
		$store_data->guaranteer_permanent_address 	= 	$request->guaranteer_permanent_address;

		if($sectionName == 'laundry') {
			$store_data->origin 	= 	1;
		}elseif($sectionName == 'salon') {
			$store_data->origin 	= 	2;
		}else {
			$store_data->origin 	= 	3;
		}

		$store_data->identification_type 	= 	$request->identification_type;

		// $store_data->per_parcel_amount 			= 	$request->per_parcel_amount ?? 0;
		$store_data->division_id 			= 	$request->division_id;
		$store_data->district_id 			= 	$request->district_id;
		$store_data->thana_id 			= 	$request->thana_id;
		// $store_data->area_id 			= 	$request->area_id;
		$store_data->api_token 		= 	Str::random(50);
		// $store_data->password 		= 	bcrypt(request('password'));
		$store_data->password 		= 	bcrypt('123456');
		$store_data->image 			= 	$fileUrl;
		$store_data->status 		= 	$request->status;
		$store_data->save();
		$insId = $store_data->id;
		if($insId) {
			//add account head
			$storeAccount = new AccountHead();
            $storeAccount->head_type = 7;
            $storeAccount->user_id = $insId;
            $storeAccount->head_name = $insId.$request->name;
            $storeAccount->status = 1;
            $storeAccount->save();

			// Save Employee Education 
			foreach ($request->exam_name ?? [] as $i => $exam_name) {
				EmployeeEducation::create([
					'employee_id' => $store_data->id,
					'exam_name' => $exam_name,
					'group' => $request->group[$i] ?? '',
					'gpa' => $request->gpa[$i] ?? '',
					'year' => $request->year[$i] ?? '',
					'board' => $request->board[$i] ?? '',
				]);
			}

			// Save Employee Experience 
			foreach ($request->company_name ?? [] as $i => $company_name) {
				EmployeeExperience::create([
					'employee_id' => $store_data->id,
					'company_name' => $company_name,
					'designation' => $request->designations[$i] ?? '',
					'start_date' => $request->start_date[$i] ? date('Y-m-d', strtotime($request->start_date[$i])) : null,
					'end_date' => $request->end_date[$i] ? date('Y-m-d', strtotime($request->end_date[$i])) : null,
				]);
			}

			Toastr::success('message', 'Employee add successfully!');
			return redirect('admin/employee/manage');

		}else {
			Toastr::error('message', 'Something was wrong');
			return redirect()->back();
		}
	}

	public function manage()
	{

		$origin = Session::get('section');

		$branches = $this->getUserBranch();
		$show_datas = Employee::where('status','!=', 3);
					if($branches) {
						$show_datas = $show_datas->whereIn('branch_id', $branches);
					}
					if($origin=='laundry') {
						$show_datas = $show_datas->where('origin', 1);
					}elseif($origin=='pos') {
						$show_datas = $show_datas->where('origin', 3);
					}else {
						$show_datas = $show_datas->where('origin', 2);
					}

					$show_datas = $show_datas->get();
					//$show_datas = $show_datas->with('account_head')->get();
					//return $show_datas;
		return view('backEnd.employee.manage', compact('show_datas'));
	}

	public function details($employee_id)
	{
		$employee = Employee::find($employee_id);
		$divisions = Division::orderBy('name')->where('status', 1)->get();
		$agent_id = EmployeeAgent::where('employee_id', $employee_id)->pluck('agent_id')->toArray();
		$area_id = EmployeeArea::where('employee_id', $employee_id)->pluck('area_id')->toArray();
		$service = EmployeeService::where('employee_id', $employee_id)->where('status','Active')->with('service')->get();

		return view('backEnd.employee.details', compact('employee', 'divisions', 'agent_id', 'area_id','service'));
	}

	// salon commission show 
	public function commission_show($id) {
		$employee = Employee::where('id', $id)->with('account_head')->first();
		//return $employee;
		return view('backEnd.employee.emp_commission_pay', compact('employee'));
	}

	public function commission_pay(Request $request) {
		//return $request->all();
		$request->validate([
            'hidden_id' => 'required',
            'total_commission' => 'required',
            'total_paid_commission' => 'required',
            'remaining_commission' => 'required',
            'amount' => 'required',
        ]);
		$employee_id = $request->hidden_id;
		$employee = Employee::where('id', $employee_id)->with('account_head')->first();
		//return $employee;
		$store_transection = new SalonTransaction();
		$store_transection->transaction_type = 3;
		$store_transection->account_head_id = $employee->account_head->id;
		$store_transection->amount = $request->amount;
		$store_transection->in_out = 2;//out
		$store_transection->status = 1;
		$store_transection->save();
		Toastr::success('message', 'Employee commission paid successfully!');
		return redirect('admin/employee/manage');
	}

	public function edit($id)
	{
		$edit_data = Employee::find($id);
		$divisions = Division::orderBy('name')->where('status', 1)->get();
		$agent_id = EmployeeAgent::where('employee_id', $id)->pluck('agent_id')->toArray();
		$area_id = EmployeeArea::where('employee_id', $id)->pluck('area_id')->toArray();
		$departments = Department::where('status', 1)->get();

		$branches = $this->getUserBranch();
        if($branches) {
            $allBranch = Hub::where('status', 1)->whereIn('id', $branches)->get();
        }else {
            $allBranch = Hub::where('status', 1)->get();
        }

		return view('backEnd.employee.edit', compact('edit_data', 'departments', 'divisions', 'agent_id', 'area_id','allBranch'));
	}

	public function update(Request $request) {

		$this->validate($request, [
			'hidden_id' => 'required',
			'name' => 'required',
			'email' => 'nullable|email|unique:employees,email,' . $request->hidden_id,
			'phone' => 'required|numeric|digits:11|unique:employees,phone,' . $request->hidden_id,
			'branch_id' => 'required',
			'identification_type' => 'required',
			'department_id' => 'required',
			'designation' => 'nullable',
			'gross_salary' => 'required',
			'division_id' => 'required',
			'district_id' => 'required',
			'thana_id' => 'required',
			'image' => 'nullable|image',
			// 'password' => 'nullable|same:confirm',
			// 'confirm' => 'nullable',
			'status' => 'required',
		]);

		$update_data = employee::find($request->hidden_id);
		// image upload
		$update_file = $request->file('image');
		if ($update_file) {
			$name = time() . $update_file->getClientOriginalName();
			$uploadPath = 'public/uploads/employee/';
			$update_file->move($uploadPath, $name);
			$fileUrl = $uploadPath . $name;
		} else {
			$fileUrl = $update_data->image;
		}

		if($request->identification_type == 1) {
			if($request->file('nid_photo')){
				$update_data->nid_front = $this->fileUpload($request->file('nid_photo'),'public/uploads/employee/', 400, 250);
			}
			if($request->file('nid_photo_back')){
				$update_data->nid_back = $this->fileUpload($request->file('nid_photo_back'),'public/uploads/employee/', 400, 250);
			}
		}elseif($request->identification_type == 2) {
			if($request->file('birth_certificate_photo')){
				$update_data->birth_certificate = $this->fileUpload($request->file('birth_certificate_photo'),'public/uploads/employee/', 400, 250);
			}
		}

		$update_data->name 			=	$request->name;
		$update_data->email  		= 	$request->email;
		$update_data->phone  		= 	$request->phone;
		$update_data->alternative_phone  		= 	$request->alternative_phone;
		$update_data->nid_no  		= 	$request->nid_no;
		$update_data->department_id 	= 	$request->department_id;
		$update_data->branch_id 	= 	$request->branch_id;
		$update_data->designation 	= 	$request->designation;
		$update_data->fathers_name 	= 	$request->fathers_name;

		$update_data->gross_salary 	= 	$request->gross_salary;
		// if(Session::get('section') == 'salon') {
		// 	$update_data->commission 	= 	$request->commission;
		// }

		$update_data->commission 	= 	$request->commission?$request->commission:0;

		$update_data->others_allowance 	= 	$request->others_allowance;

		$update_data->identification_type 	= 	$request->identification_type;
		$update_data->mothers_name 	= 	$request->mothers_name;
		
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
		$update_data->per_parcel_amount 			= 	$request->per_parcel_amount ?? 0;
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
			$storeAccount = AccountHead::where('user_id', $updId)->where('head_type', 7)->first();
			if($storeAccount && $storeAccount->id) {
				$storeAccount->head_name = $updId.$request->name;
				$storeAccount->save();
			}


			// Ypdate employee Education 
			EmployeeEducation::where('employee_id', $update_data->id)->delete();
			if ($request->exam_name && count($request->exam_name) > 0) {
				foreach ($request->exam_name ?? [] as $i => $exam_name) {
					EmployeeEducation::create([
						'employee_id' => $update_data->id,
						'exam_name' => $exam_name,
						'group' => $request->group[$i] ?? '',
						'gpa' => $request->gpa[$i] ?? '',
						'year' => $request->year[$i] ?? '',
						'board' => $request->board[$i] ?? '',
					]);
				}
			}

			// Update employee Experience 
			EmployeeExperience::where('employee_id', $update_data->id)->delete();
			if ($request->company_name && count($request->company_name) > 0) {
				foreach ($request->company_name ?? [] as $j => $company_name) {
					EmployeeExperience::create([
						'employee_id' => $update_data->id,
						'company_name' => $company_name,
						'designation' => $request->designations[$j] ?? '',
						'start_date' => $request->start_date[$j] ? date('Y-m-d', strtotime($request->start_date[$j])) : null,
						'end_date' => $request->end_date[$j] ? date('Y-m-d', strtotime($request->end_date[$j])) : null
					]);
				}
			}

			Toastr::success('message', 'Employee update successfully!');
			return redirect('admin/employee/manage');

		}else {
			Toastr::error('message', 'update failed!');
			return redirect()->back();
		}
	}

	public function inactive(Request $request)
	{
		$inactive_data = Employee::find($request->hidden_id);
		$inactive_data->status = 0;
		$inactive_data->save();
		Toastr::success('message', 'Employee inactive successfully!');
		return redirect('admin/employee/manage');
	}

	public function active(Request $request)
	{
		$inactive_data = Employee::find($request->hidden_id);
		$inactive_data->status = 1;
		$inactive_data->save();
		Toastr::success('message', 'Employee active successfully!');
		return redirect('admin/employee/manage');
	}

	public function destroy(Request $request)
	{
		$destroy_id = Employee::find($request->hidden_id);
		$destroy_id->delete();
		Toastr::success('message', 'Employee delete successfully!');
		return redirect('admin/employee/manage');
	}

	// get branches
    public function getUserBranch() {
        $userInfo = User::where('id', Auth::id())->first();
        if($userInfo->branches) {
            $branches = str_split($userInfo->branches);
            return $branches;
        }else {
            return null;
        }
    }

	public function ledger(Request $request) {
		//return $request->all();
		$employees = Employee::where('origin', $this->findOrigin())->get();
		$data = array();
		$head = [];
		//return view('backEnd.employee.ledger', compact('data', 'head'));

		if($request->employee_id != null && $request->date_from != null && $request->date_to != null) {
			$startDate = new Carbon($request->date_from);
			$endDate = new Carbon($request->date_to);
			$all_dates = array();
			while ($startDate->lte($endDate)) {
				$all_dates[] = $startDate->toDateString();
				$startDate->addDay();
			}

			$employee = Employee::where('id', $request->employee_id)->with('account_head')->first();
			$head['date_from'] = $request->date_from;
			$head['date_to'] = $request->date_to;
			$head['emp_name'] = $employee->name;


			foreach($all_dates as $date) {
				$temp = [];

				// day wise employee work complet and total amount for salon
				$tot = 0;
				$salon_bookings = SalonBooking::where('status', 12)->whereBetween('updated_at', [$date. ' 00:00:00', $date. ' 23:59:59'])->get();
				foreach($salon_bookings as $item) {
					//
					$salon_booking_items = SalonBookingItem::where('employee_id', $request->employee_id)->where('booking_id', $item->id)->get();
					$salon_booking_items = $salon_booking_items->sum('total');
					$tot = $tot + $salon_booking_items;
				}


				// previous total
				$prev_tot_commission = $employee->account_head->tot_commission;
				$prev_tot_commission = $prev_tot_commission->where('created_at', '<', $date . ' 00:00:00');
				$prev_tot_commission = $prev_tot_commission->sum('amount');

				$prev_tot_paid_commission = $employee->account_head->tot_paid_commission;
				$prev_tot_paid_commission = $prev_tot_paid_commission->where('created_at', '<', $date . ' 00:00:00');
				$prev_tot_paid_commission = $prev_tot_paid_commission->sum('amount');

				$prev_due = $prev_tot_commission - $prev_tot_paid_commission;


				// date wise
				$total_commission = $employee->account_head->tot_commission;
				$total_commission = $total_commission->whereBetween('created_at', [$date. ' 00:00:00', $date. ' 23:59:59']);
				$no_of_work = $total_commission->count();
				$total_commission = $total_commission->sum('amount');

				$paid_commission = $employee->account_head->tot_paid_commission;
				$paid_commission = $paid_commission->whereBetween('created_at', [$date. ' 00:00:00', $date. ' 23:59:59']);
				$paid_commission = $paid_commission->sum('amount');

				$advance = $employee->account_head->advance;
				$advance = $advance->whereBetween('created_at', [$date. ' 00:00:00', $date. ' 23:59:59']);
				$advance = $advance->sum('amount');

				$temp['date'] = $date;
				$temp['no_of_work'] = $no_of_work;
				$temp['total_commission'] = $total_commission;
				$temp['paid_commission'] = $paid_commission;
				$temp['due_commission'] =  ($prev_due + $total_commission) - $paid_commission;
				//$temp['due_commission'] =  $prev_due;
				$temp['advance'] = $advance;
				$temp['today_total'] = $tot;

				if($temp['no_of_work'] != 0 || $temp['total_commission'] != 0 || $temp['paid_commission'] != 0 || $temp['advance'] != 0) {
					array_push($data, $temp);
				}
			}
		}
		// echo "<pre>";
		// print_r($data);
		// echo "</pre>";

		return view('backEnd.employee.ledger', compact('data', 'head', 'employees'));
	}

	public function ledger_add(Request $request) {
		//return $request->all();
		$date_from = $request->date_from;
		$date_to = $request->date_to;

		$startDate = new Carbon($request->date_from);
		$endDate = new Carbon($request->date_to);
		$all_dates = array();
		while ($startDate->lte($endDate)) {
			$all_dates[] = $startDate->toDateString();
			$startDate->addDay();
		}
		// echo "<pre>";
		// print_r($all_dates);
		// echo "</pre>";
		$employee = Employee::where('id', 1)->with('account_head')->first();
		// name & date range agei dia dibo r ekta array te, number of work, range er modde due
		$head = [];
		$head['date_from'] = $request->date_from;
		$head['date_to'] = $request->date_to;
		$head['name'] = $employee->name;
		$data = array();
		foreach($all_dates as $date) {
			$temp = [];

			// previous total
			$prev_tot_commission = $employee->account_head->tot_commission;
			$prev_tot_commission = $prev_tot_commission->where('created_at', '<', $date . ' 00:00:00');
			$prev_tot_commission = $prev_tot_commission->sum('amount');

			$prev_tot_paid_commission = $employee->account_head->tot_paid_commission;
			$prev_tot_paid_commission = $prev_tot_paid_commission->where('created_at', '<', $date . ' 00:00:00');
			$prev_tot_paid_commission = $prev_tot_paid_commission->sum('amount');

			$prev_due = $prev_tot_commission - $prev_tot_paid_commission;


			// date wise
			$total_commission = $employee->account_head->tot_commission;
			$total_commission = $total_commission->whereBetween('created_at', [$date. ' 00:00:00', $date. ' 23:59:59']);
			$no_of_work = $total_commission->count();
			$total_commission = $total_commission->sum('amount');

			$paid_commission = $employee->account_head->tot_paid_commission;
			$paid_commission = $paid_commission->whereBetween('created_at', [$date. ' 00:00:00', $date. ' 23:59:59']);
			$paid_commission = $paid_commission->sum('amount');

			$advance = $employee->account_head->advance;
			$advance = $advance->whereBetween('created_at', [$date. ' 00:00:00', $date. ' 23:59:59']);
			$advance = $advance->sum('amount');

			// $temp['date_from'] = $request->date_from;
			// $temp['date_to'] = $request->date_to;
			// $temp['name'] = $employee->name;
			$temp['date'] = $date;
			$temp['no_of_work'] = $no_of_work;
			$temp['total_commission'] = $total_commission;
			$temp['paid_commission'] = $paid_commission;
			$temp['due_commission'] =  ($prev_due + $total_commission) - $paid_commission;
			//$temp['due_commission'] =  $prev_due;
			$temp['advance'] = $advance;

			if($temp['no_of_work'] != 0 || $temp['total_commission'] != 0 || $temp['paid_commission'] != 0 || $temp['advance'] != 0) {
				array_push($data, $temp);
			}
		}
		echo "<pre>";
		print_r($data);
		echo "</pre>";


		// foreach($data as $da) {
		// 	if($da['total_commission'] != 0 || $da['paid_commission'] != 0 || $da['advance'] != 0) {
		// 		echo $da['date'] . "<br>";
		// 		echo $da['total_commission'] . "<br>";
		// 		echo $da['paid_commission'] . "<br>";
		// 		echo $da['advance'] . "<br>";
		// 		echo $da['total_commission'] - $da['paid_commission']. "<br>";
		// 	}
		// }

		//$employee = Employee::where('id', $request->employee_id)->with('account_head')->first();
		$employee = Employee::where('id', 1)->with('account_head')->first();
		//return $employee;
		//SELECT DISTINCT(`created_at`), SUM(amount) as amount FROM `salon_transactions` WHERE `transaction_type` = 3 AND `account_head_id` = 1 and `in_out` = 1  GROUP BY(`created_at`)

		//$employee = Employee ::where('id', $salary->employee_id)->where('origin', $this->findOrigin())->first();
        /* commission and advance */
        $this_month_commission = $employee->account_head->tot_commission;
        $this_month_commission = $this_month_commission->whereBetween('created_at', ['2022-09-14 00:00:00', '2022-09-14 23:59:59']);
        $this_month_commission = $this_month_commission->sum('amount');

		//return $this_month_commission;

		// echo "<pre>";
		// print_r($this_month_commission);
		// echo "</pre>";


	}


	// assign services
	public function assignService(Request $request) {
		// dd($request->all());
		$empId = $request->employee_id;
		$services = $request->service;
		$length = sizeof($services);
		if($length <= 0) {
			Toastr::success('message', 'Please select atleast one service');
			return redirect()->back();
		}

		$insId = 0;

		$oldServices = EmployeeService::where('employee_id', $empId)->get();
		if($oldServices) {
			foreach ($oldServices as $value) {
				EmployeeService::where('id', $value->id)->update(array('status'=>'Inactive'));
			}
		}

		for ($i=0; $i < $length; $i++) { 
			$exist = EmployeeService::where('employee_id', $empId)->where('service_id', $services[$i])->first();
			if(!$exist) {
				$emp_service = new EmployeeService();
				$emp_service->employee_id = $empId;
				$emp_service->service_id = $services[$i];
				$emp_service->status = 'Active';
				$emp_service->save();
				$insId = $emp_service->id;
			}else {
				$emp_service = EmployeeService::where('employee_id', $empId)->where('service_id', $services[$i])->update(array('status'=>'Active'));
			}
		}

		Toastr::success('message', 'Service assign successful');
		

		return redirect()->back();
	}

	/*..........Attendance..........*/
	public function add_attendance(Request $request) {
		$allBranch = Hub::where('status', 1)->get();
		$test = array();
		$test['origin'] = Session::get('section');
		$defaultBranch = Hub::where('status', 1)->where('is_default', 1)->first();
        if($defaultBranch && $defaultBranch->id) {
            Session::put('default_branch', $defaultBranch->id);
        }else {
            $alterDefault = Hub::where('status', 1)->first();
            if($alterDefault && $alterDefault->id) {
                Session::put('default_branch', $alterDefault->id);
            }
        }

		if(Session::get('section') == "laundry") {
			$origin = 1;
		} else if(Session::get('section') == "salon") {
			$origin = 2;
		} else if(Session::get('section') == "pos") {
			$origin = 3;
		}

		$employees = Employee::where('origin', $origin);
		if(Session::get('default_branch')) {
			$employees = $employees->where('branch_id', Session::get('default_branch'));
		}
		if($request->branch_id != null) {
			$employees = $employees->where('branch_id', $request->branch_id);
		}

		$employees = $employees->get();

		//return $employees;
		return view('backEnd.employee.attendance.add', compact('allBranch', 'employees'));
	}

	public function store_attendance(Request $request) {
		//return $request->all();
		$request->validate([
			'date' => 'required',
			'employee_id.*' => 'required',
			'present.*' => 'required',
			'in_time.*' => 'nullable',
			'out_time.*' => 'nullable',
		]);

		$length = sizeof($request->employee_id);

		if(Session::get('section') == "laundry") {
			$origin = 1;
		} else if(Session::get('section') == "salon") {
			$origin = 2;
		} else if(Session::get('section') == "pos") {
			$origin = 3;
		}

		for($i = 0; $i<$length; $i++) {
			$attendance = new Attendance();
			$attendance->employee_id = $request->employee_id[$i];
			$attendance->origin = $origin;
			$attendance->present = $request->present[$i];
			$attendance->date = date('Y-m-d', strtotime($request->date));
			$attendance->in_time = $request->in_time[$i];
			$attendance->out_time = $request->out_time[$i];
			$attendance->user_id = Auth::id();
			$attendance->status = 1;
			$attendance->save();
		}
		Toastr::success('Attendance Added');
		return redirect('admin/employee/attendance/add');
	}

	public function attendance_manage(Request $request) {
		if(Session::get('section') == "laundry") {
			$origin = 1;
		} else if(Session::get('section') == "salon") {
			$origin = 2;
		} else if(Session::get('section') == "pos") {
			$origin = 3;
		}
		$employees = Employee::where('origin', $origin)->get();
		$attendances = Attendance::where('origin', $origin);
		if($request->employee_id != NULL) {
			$attendances = $attendances->where('employee_id', $request->employee_id);
		}
		if($request->date_from != null) {
            $attendances = $attendances->where('date','>=', date('Y-m-d', strtotime($request->date_from)));
        }
        if($request->date_to != null) {
            $attendances = $attendances->where('date','<=', date('Y-m-d', strtotime($request->date_to)));
        }
		//$attendances = Attendance::where('origin', $origin)->orderBy('date', 'desc')->with('employee')->get();
		$attendances = $attendances->orderBy('date', 'desc')->with('employee')->get();
		//return $employees;
		return view('backEnd.employee.attendance.manage', compact('employees', 'attendances'));

		/*if($request->date_from != null) {
            $bookings = $bookings->where('created_at','>=', date('Y-m-d', strtotime($request->date_from)).' 00:00:00');
        }
        if($request->date_to != null) {
            $bookings = $bookings->where('created_at','<=', date('Y-m-d', strtotime($request->date_to)).' 23:59:59');
        }*/
	}
	/*..........Attendance..........*/
}
