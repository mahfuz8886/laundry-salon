<?php

namespace App\Http\Controllers\Superadmin;

use App\AccountHead;
use App\Customer;
use App\CustomerAddress;
use App\Division;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\LaundryProduct;
use App\Supplier;
use Brian2694\Toastr\Facades\Toastr;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class SupplierController extends Controller
{
    public function add() {
        $divisions = Division::where('status', 1)->get();
        return view('backEnd.supplier.add', compact('divisions'));
    }

    public function store(Request $request) {
        
        $request->validate([
            'name' => 'required',
            'phone' => 'required|unique:suppliers,phone',
            'email' => 'nullable|unique:suppliers,email',
            'image' => 'required | mimes:jpeg,jpg,png | max:1000',
            'division_id' => 'required',
            'district_id' => 'required',
            'thana_id' => 'required',
            'address' => 'required',
            'status' => 'required'
        ]);

        $supplier = new Supplier();

        if ($request->file('image')) {
            $supplier->image = $this->fileUpload($request->file('image'), 'public/uploads/supplier/', 324, 204);
        }


        $supplier->name = $request->name;
        $supplier->email = $request->email;
        $supplier->phone = $request->phone;
        $supplier->prev_due = $request->prev_due? $request->prev_due:0;
        $supplier->nid_no = $request->nid_no;
        $supplier->fathers_name = $request->fathers_name;
        $supplier->mothers_name = $request->mothers_name;
        $supplier->address = $request->address;
        $supplier->division_id = $request->division_id;
        $supplier->district_id = $request->district_id;
        $supplier->thana_id = $request->thana_id;
        $supplier->api_token = Str::random(50);
        $supplier->status = $request->status;
        $supplier->save();
        $insId = $supplier->id;
        if($insId) {
            //create account head
            $storeAccount = new AccountHead();
            $storeAccount->head_type = 5;
            $storeAccount->user_id = $insId;
            $storeAccount->head_name = $insId.$request->name;
            $storeAccount->status = 1;
            $storeAccount->save();

            Toastr::success('supplier added successfully');
        }else {
            Toastr::success('Something was wrong');
        }

        return redirect()->back();
    }

    public function manage(Request $request) {
        $suppliers = Supplier::where('status', 1);
                    if($request->status != null) {
                        $suppliers = $suppliers->where('status', $request->status);
                    }
                    if($request->mobile != null) {
                        $suppliers = $suppliers->where('phone', $request->mobile);
                    }
                    if($request->name != null) {
                        $suppliers = $suppliers->where('name','like','%'.$request->name.'%');
                    }
                    
                    $suppliers = $suppliers->orderBy('id', 'desc')->paginate(15);

        return view('backEnd.supplier.manage', compact('suppliers'));
    }

    public function getsupplier($id) {
        $divisions = Division::where('status', 1)->get();
        $supplier = Supplier::where('id', $id)->first();
        return view('backEnd.supplier.edit', compact('supplier','divisions'));
    }

    public function update(Request $request) {
        // dd($request->all());
        $request->validate([
            'name' => 'required',
            'phone' => 'required|unique:suppliers,phone, '.$request->rowId,
            'email' => 'nullable|unique:suppliers,email, '.$request->rowId,
            'image' => 'nullable | mimes:jpeg,jpg,png | max:1000',
            'division_id' => 'required',
            'district_id' => 'required',
            'thana_id' => 'required',
            'address' => 'required',
            'status' => 'required'
        ]);

        $supplier = Supplier::where('id', $request->rowId)->first();

        if ($request->file('image')) {
            $supplier->image = $this->fileUpload($request->file('image'), 'public/uploads/supplier/', 324, 204);
        }


        $supplier->name = $request->name;
        $supplier->email = $request->email;
        $supplier->phone = $request->phone;
        // $supplier->prev_due = $request->prev_due? $request->prev_due:0;
        $supplier->nid_no = $request->nid_no;
        $supplier->fathers_name = $request->fathers_name;
        $supplier->mothers_name = $request->mothers_name;
        $supplier->address = $request->address;
        $supplier->division_id = $request->division_id;
        $supplier->district_id = $request->district_id;
        $supplier->thana_id = $request->thana_id;

        $supplier->status = $request->status;
        $supplier->save();
        $insId = $supplier->id;
        if($insId) {
            //update account head
            $storeAccount = AccountHead::where('head_type', 5)->where('user_id', $insId)->first();
            $storeAccount->head_name = $insId.$request->name;
            $storeAccount->save();

            Toastr::success('supplier updated successfully');
            return redirect()->route('superadmin.manageSupplier');
        }else {
            Toastr::success('Something was wrong');
            return redirect()->back();
        }
    }

    public function details($id) {
        $supplier = Supplier::where('id', $id)->with('division')->with('district')->with('thana')->first();

        return view('backEnd.supplier.details', compact('supplier'));
    }

    // supplier ledger
    public function supplierLedger() {
        return view('backEnd.supplier.ledger');
    }


}
