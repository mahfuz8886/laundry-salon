<?php

namespace App\Http\Controllers\Superadmin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use App\Role;
use App\User;
use DB;

class UserController extends Controller
{
	public function add()
	{
		$user_role = Role::all();
		return view('backEnd.user.add', compact('user_role'));
	}
	public function save(Request $request)
	{
		// dd($request->all());
		$this->validate($request, [
			'name' => 'required',
			'username' => 'required',
			'email' => 'required',
			'phone' => 'required|numeric|digits:11',
			'designation' => 'required',
			'branch_id' => 'required',
			'image' => 'required',
			'status' => 'required',
			'password' => 'required|min:6|confirmed',
		]);

		$branches = str_replace(array("[","]",'"'),'',json_encode($request->branch_id));

		// image upload
		$file = $request->file('image');
		$name = time() . $file->getClientOriginalName();
		$uploadPath = 'public/uploads/user/';
		$file->move($uploadPath, $name);
		$fileUrl = $uploadPath . $name;

		$store_data					=	new User();
		$store_data->name 			=	$request->name;
		$store_data->username 		=	$request->username;
		$store_data->email  		= 	$request->email;
		$store_data->phone  		= 	$request->phone;
		$store_data->designation 	= 	$request->designation;
		$store_data->role_id 	= 	1;
		$store_data->branches 		= 	$branches;
		$store_data->image 			= 	$fileUrl;
		$store_data->password 		= 	bcrypt(request('password'));
		$store_data->status 		= 	$request->status;
		$store_data->save();

		// Permission Save
		$store_data->syncPermissions($request->permission);

		Toastr::success('message', 'User  add successfully!');
		return redirect('/superadmin/user/manage');
	}

	public function manage()
	{

		$show_datas = DB::table('users')
			->join('roles', 'users.role_id', '=', 'roles.id')
			->whereNotIn('users.id', [1])
			->select('users.*', 'roles.name')
			->orderBy('id', 'DESC')
			->get();
		return view('backEnd.user.manage', compact('show_datas'));
	}

	public function edit($id)
	{
		$user = User::find($id);
		$user_role = Role::all();
		return view('backEnd.user.edit', compact('user', 'user_role'));
	}

	public function update(Request $request)
	{
		// dd($request->all());
		$this->validate($request, [
			'name' => 'required',
			'username' => 'required',
			'email' => 'required',
			'phone' => 'required|numeric|digits:11',
			'designation' => 'required',
			'branch_id' => 'required',
			'image' => 'nullable',
			'status' => 'required',
			'password' => 'nullable|min:6|confirmed',
		]);
		$update_data = User::find($request->hidden_id);
		// image upload
		$update_file = $request->file('image');
		if ($update_file) {
			$name = time() . $update_file->getClientOriginalName();
			$uploadPath = 'public/uploads/user/';
			$update_file->move($uploadPath, $name);
			$fileUrl = $uploadPath . $name;
			$update_data->image 		= 	$fileUrl;
		}

		if($request->password) {
			$update_data->password = bcrypt($request->password);
		}

		$branches = str_replace(array("[","]",'"'),'',json_encode($request->branch_id));

		$update_data->name 			=	$request->name;
		$update_data->username 		=	$request->username;
		$update_data->email  		= 	$request->email;
		$update_data->phone  		= 	$request->phone;
		$update_data->designation 	= 	$request->designation;

		$update_data->branches 		= 	$branches;
		$update_data->status 		= 	$request->status;
		$update_data->save();

		// Permission save
		$update_data->syncPermissions($request->permission);

		Toastr::success('message', 'User  update successfully!');
		return redirect('/superadmin/user/manage');
	}

	public function inactive(Request $request)
	{
		$inactive_data = User::find($request->hidden_id);
		$inactive_data->status = 0;
		$inactive_data->save();
		Toastr::success('message', 'User  inactive successfully!');
		return redirect('/superadmin/user/manage');
	}

	public function active(Request $request)
	{
		$inactive_data = User::find($request->hidden_id);
		$inactive_data->status = 1;
		$inactive_data->save();
		Toastr::success('message', 'User  active successfully!');
		return redirect('/superadmin/user/manage');
	}

	public function destroy(Request $request)
	{
		$destroy_id = User::find($request->hidden_id);
		$destroy_id->delete();
		Toastr::success('message', 'User  delete successfully!');
		return redirect('/superadmin/user/manage');
	}
}
