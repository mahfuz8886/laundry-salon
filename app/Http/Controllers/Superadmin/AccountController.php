<?php

namespace App\Http\Controllers\Superadmin;

use App\AccountHead;
use App\Customer;
use App\CustomerAddress;
use App\Division;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\LaundryProduct;
use Brian2694\Toastr\Facades\Toastr;
use App\LaundryProductCategory;
use App\LaundryProductService;
use App\LaundryProductBranch;
use App\LaundryTransaction;
use App\LaundryTransectionInfo;
use App\Order;
use App\OrderBilling;
use App\OrderItem;
use App\OrderShipping;
use App\ProductService;
use App\SalonTransaction;
use App\SalonTransectionInfo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use PDF;


class AccountController extends Controller
{

    public function addHead() {
        $headTypes = DB::table('account_head_types')->where('status', 1)->whereIn('id', array(3,4))->get();
        
        return view('backEnd.account.add_account_head', compact('headTypes'));
    }

    public function storeHead(Request $request) {

        $request->validate([
            'head_type' => 'required',
            'head_name' => 'required|unique:account_heads,head_name',
            'status' => 'required'
        ]);

        //add account head
        $storeAccount = new AccountHead();
        $storeAccount->head_type = $request->head_type;
        $storeAccount->user_id = Auth::id();
        $storeAccount->role_id = 1;
        $storeAccount->head_name = $request->head_name;
        $storeAccount->status = $request->status;
        $storeAccount->save();
        $insId = $storeAccount->id;
        if($insId) {
            Toastr::success('Account head added successfully');
        }else {
            Toastr::error('Something was wrong');
        }
        return redirect()->back();
    }

    public function headList(Request $request) {
        $heads = AccountHead::where('status','!=', 3);
                if($request->type != null) {
                    $heads = $heads->where('head_type', $request->type);
                }
                if($request->status != null) {
                    $heads = $heads->where('status', $request->status);
                }
                if($request->name != null) {
                    $heads = $heads->where('head_name','like','%'. $request->type . '%');
                }
                $heads = $heads->paginate(15);
        $headTypes = DB::table('account_head_types')->where('status', 1)->get();
        return view('backEnd.account.manage', compact('heads','headTypes'));
    }

    public function getItem($id) {
        $head = AccountHead::where('id', $id)->first();
        $headTypes = DB::table('account_head_types')->where('status', 1)->get();
        return view('backEnd.account.edit_account_head', compact('head','headTypes')); 
    }


    public function updateHead(Request $request) {
        
        $request->validate([
            'head_type' => 'required',
            'head_name' => 'required|unique:account_heads,head_name, '.$request->id,
            'status' => 'required'
        ]);

        //add account head
        $storeAccount = AccountHead::where('id', $request->id)->first();
        $storeAccount->head_type = $request->head_type;
        $storeAccount->head_name = $request->head_name;
        $storeAccount->status = $request->status;
        $storeAccount->save();
        $insId = $storeAccount->id;
        if($insId) {
            Toastr::success('Account head updated successfully');
            return redirect()->route('superadmin.account.headList');
        }else {
            Toastr::error('Something was wrong');
            return redirect()->back();
        }
        
    }



     /*..............Customer................*/
    public function store(Request $request) {
      
        $request->validate([
            'name' => 'required',
            'phone' => 'required|unique:customers,phoneNumber',
            'email' => 'nullable|unique:customers,emailAddress',
            'origin' => 'required',
            'image' => 'required | mimes:jpeg,jpg,png | max:1000',
            'customer_type' => 'required',
            'division_id' => 'required',
            'district_id' => 'required',
            'thana_id' => 'required',
            'address' => 'required',
            'password' => 'required|confirmed',
            'status' => 'required'
        ]);

        $storeCustomer = new Customer();
        if ($request->file('image')) {
            $storeCustomer->logo = $this->fileUpload($request->file('image'), 'public/uploads/merchant/', 324, 204);
        }

        
        $storeCustomer->firstName = $request->name;
        $storeCustomer->fathers_name = $request->fathers_name;
        $storeCustomer->mothers_name = $request->mothers_name;
        $storeCustomer->phoneNumber = $request->phone;
        $storeCustomer->emailAddress = $request->email;
        $storeCustomer->origin = $request->origin;
        $storeCustomer->customer_type = $request->customer_type;
        $storeCustomer->password = bcrypt($request->password);
        $storeCustomer->api_token = Str::random(50);
        $storeCustomer->verify = 1;
        $storeCustomer->register_by = 'Offline';
        $storeCustomer->status = $request->status;
        $storeCustomer->save();
        $insId = $storeCustomer->id;

        if($insId) {
            //store customer address
            $storeAddress = new CustomerAddress();
            $storeAddress->customer_id = $insId;
            $storeAddress->is_default = 'no';
            $storeAddress->type = $request->customer_type=='Regular'? 'Home':'Office';
            $storeAddress->fullname = $request->name;
            $storeAddress->mobile_no = $request->phone;
            $storeAddress->region_id = $request->division_id;
            $storeAddress->city_id = $request->district_id;
            $storeAddress->area_id = $request->thana_id;
            $storeAddress->address = $request->address;
            $storeAddress->save();

            //add account head
            $storeAccount = new AccountHead();
            $storeAccount->head_type = 1;
            $storeAccount->user_id = $insId;
            $storeAccount->head_name = $insId.$request->name;
            $storeAccount->status = 1;
            $storeAccount->save();

            Toastr::success('Customer added successfully');
            
        }else {
            Toastr::error('Failed to add customer');
        }

        return redirect()->back();
    }

    public function manage(Request $request) {
        $customers = Customer::where('status', '!=', 3);
        
        if($request->status != null) {
            $customers = $customers->where('status', $request->status);
        }
        if($request->mobile != null) {
            $customers = $customers->where('phoneNumber', $request->mobile);
        }
        if($request->name != null) {
            $customers = $customers->where('firstName', $request->name);
        }

        $customers = $customers->with('address')->orderBy('id','desc')->paginate(15);

        return view('backEnd.customer.manage', compact('customers'));
    }

    public function getCustomer($id) {
        $customer = Customer::where('id', '=', $id)->first();
        $address = CustomerAddress::where('customer_id', $id)->first();
        $divisions = Division::where('status', 1)->get();
        return view('backEnd.customer.edit', compact('customer','address','divisions'));
    }

    public function update(Request $request) {

        $rowId = $request->row_id;
 
        $request->validate([
            'name' => 'required',
            'phone' => 'required|unique:customers,phoneNumber,'.$rowId,
            'email' => 'nullable|unique:customers,emailAddress,'.$rowId,
            'origin' => 'required',
            'image' => 'nullable | mimes:jpeg,jpg,png | max:1000',
            'customer_type' => 'required',
            'division_id' => 'required',
            'district_id' => 'required',
            'thana_id' => 'required',
            'address' => 'required',
            'password' => 'nullable|confirmed',
            'status' => 'required'
        ]);

        $storeCustomer = Customer::where('id', $rowId)->first();
        if ($request->file('image')) {
            $storeCustomer->logo = $this->fileUpload($request->file('image'), 'public/uploads/merchant/', 324, 204);
        }

        
        $storeCustomer->firstName = $request->name;
        $storeCustomer->fathers_name = $request->fathers_name;
        $storeCustomer->mothers_name = $request->mothers_name;
        $storeCustomer->phoneNumber = $request->phone;
        $storeCustomer->emailAddress = $request->email;
        $storeCustomer->origin = $request->origin;
        $storeCustomer->customer_type = $request->customer_type;

        if($request->password) {
            $storeCustomer->password = bcrypt($request->password);
        }
        
        $storeCustomer->status = $request->status;
        $storeCustomer->save();
        $insId = $storeCustomer->id;

        if($insId) {

            //update customer address
            $storeAddress = CustomerAddress::where('id', $request->address_id)->first();
            $storeAddress->type = $request->customer_type=='Regular'? 'Home':'Office';
            $storeAddress->fullname = $request->name;
            $storeAddress->mobile_no = $request->phone;
            $storeAddress->region_id = $request->division_id;
            $storeAddress->city_id = $request->district_id;
            $storeAddress->area_id = $request->thana_id;
            $storeAddress->address = $request->address;
            $storeAddress->save();

            //update account head
            $storeAccount = AccountHead::where('user_id', $rowId)->first();
            $storeAccount->head_name = $insId.$request->name;
            $storeAccount->save();

            Toastr::success('Customer updated successfully');
            return redirect()->route('superadmin.manageCustomer');
            
        }else {
            Toastr::error('Failed to add customer');
            return redirect()->back();
        }

    }

    public function details($id) {
        $customer = Customer::where('id', '=', $id)->first();
        $address = CustomerAddress::where('customer_id', $id)->with('division')->with('district')->with('thana')->first();
       
        return view('backEnd.customer.details', compact('customer','address'));
    }
    /*..............Customer................*/


    /*..............Income................*/
    public function addIncome() {
        $headTypes = DB::table('account_head_types')->where('status', 1)->whereIn('id', array(3,4))->get();
        $count = LaundryTransectionInfo::count();
        $invoice_no = str_pad($count + 1, 5, 0, STR_PAD_LEFT);
        return view('backEnd.account.income.add_income', compact('headTypes', 'invoice_no'));
    }

    public function storeIncome(Request $request) {
        //return $request->all();
        $request->validate([
            'issue_date' => 'required',
            'invoice_no' => 'required',
            'payment_method' => 'required',
            'account_head_id.*' => 'required',
            'quantity.*' => 'required',
            'amount.*' => 'required',
            'total.*' => 'required',
        ]);
        $length = sizeof($request->account_head_id);

        $store_info = new LaundryTransectionInfo();
        $store_info->issue_date = date('Y-m-d', strtotime($request->issue_date));
        $store_info->payment_method = $request->payment_method;
        $store_info->invoice_no = $request->invoice_no;
        $store_info->total = $request->sub_total;
        $store_info->status = 1;
        $store_info->type = 1;
        $store_info->save();

        for($i = 0; $i<$length; $i++) {
            $laundry_transection = new LaundryTransaction();
            $laundry_transection->transaction_type = 1;
            $laundry_transection->account_head_id = $request->account_head_id[$i];
            $laundry_transection->amount = $request->amount[$i];
            $laundry_transection->in_out = 1;
            $laundry_transection->status = 1;
            $laundry_transection->ref_table_id = $store_info->id;
            $laundry_transection->quantity = $request->quantity[$i];
            $laundry_transection->comment = 'Laundry Income';
            $laundry_transection->save();
        }

        Toastr::success('Income added successfully');
        return redirect()->back();
    }

    public function incomeList(Request $request) {

       $income_lists = LaundryTransectionInfo::where('type', 1)->where('status', 1);
       
       if($request->invoice_no != null) {
            $income_lists = $income_lists->where('invoice_no', $request->invoice_no);
       }
       if($request->date_from != null) {
            $income_lists = $income_lists->where('issue_date','>=', date('Y-m-d', strtotime($request->date_from)));
       }
       if($request->date_to != null) {
            $income_lists = $income_lists->where('issue_date','<=', date('Y-m-d', strtotime($request->date_from)));
        }
        $income_lists = $income_lists->with('income_transection')->orderBy('id','desc')->paginate(20);
        //return $income_lists;
        return view('backEnd.account.income.manage', compact('income_lists'));
    }

    public function incomeEdit($id) {
        $income = LaundryTransectionInfo::where('id', $id)->first();
        $income_lists = LaundryTransaction::where('ref_table_id', $id)->where('comment', 'Laundry Income')->get();
        //return $income_lists;
        return view('backEnd.account.income.edit_income', compact('income', 'income_lists'));
    }

    public function updateIncome(Request $request) {
        $request->validate([
            'issue_date' => 'required',
            'invoice_no' => 'required',
            'payment_method' => 'required',
            'account_head_id.*' => 'required',
            'quantity.*' => 'required',
            'amount.*' => 'required',
            'total.*' => 'required',
        ]);
        $length = sizeof($request->account_head_id);

        $store_info = LaundryTransectionInfo::where('id', $request->id)->first();
        $store_info->issue_date = date('Y-m-d', strtotime($request->issue_date));
        $store_info->payment_method = $request->payment_method;
        $store_info->invoice_no = $request->invoice_no;
        $store_info->total = $request->sub_total;
        $store_info->status = 1;
        $store_info->type = 1;
        $store_info->save();

        for($i = 0; $i<$length; $i++) {
            if(!empty($request->list_id[$i])) {
                // update
                $laundry_transection = LaundryTransaction::where('id', $request->list_id[$i])->first();
                $laundry_transection->transaction_type = 1;
                $laundry_transection->account_head_id = $request->account_head_id[$i];
                $laundry_transection->amount = $request->amount[$i];
                $laundry_transection->in_out = 1;
                $laundry_transection->status = 1;
                $laundry_transection->ref_table_id = $store_info->id;
                $laundry_transection->quantity = $request->quantity[$i];
                $laundry_transection->comment = 'Laundry Income';
                $laundry_transection->save();
            } else {
                // insert
                $laundry_transection = new LaundryTransaction();
                $laundry_transection->transaction_type = 1;
                $laundry_transection->account_head_id = $request->account_head_id[$i];
                $laundry_transection->amount = $request->amount[$i];
                $laundry_transection->in_out = 1;
                $laundry_transection->status = 1;
                $laundry_transection->ref_table_id = $store_info->id;
                $laundry_transection->quantity = $request->quantity[$i];
                $laundry_transection->comment = 'Laundry Income';
                $laundry_transection->save();
            }
        }

        Toastr::success('Income updated successfully');
        return redirect()->back();
    }

    public function incomeDelete($id) {
        $info = LaundryTransectionInfo::where('id', $id)->first();
        //return $info;
        //$delete_list = $info->income_transection->delete();

        $delete_lists = LaundryTransaction::where('ref_table_id', $info->id)->where('comment', 'Laundry Income')->get();
        //return $delete_list;

        foreach($delete_lists as $delete_list) {
            $delete_list->delete();
        }
        $info->delete();
        Toastr::success('Income deleted successfully');
        return redirect()->route('superadmin.account.incomeList');
    }
    /*..............Income................*/

     /*..............Expanse................*/
     public function addExpanse() {
        $headTypes = DB::table('account_head_types')->where('status', 1)->whereIn('id', array(3,4))->get();
        $count = LaundryTransectionInfo::count();
        $invoice_no = str_pad($count + 1, 5, 0, STR_PAD_LEFT);
        return view('backEnd.account.expanse.add_expanse', compact('headTypes', 'invoice_no'));
    }

    public function storeExpanse(Request $request) {
        //return $request->all();
        $request->validate([
            'issue_date' => 'required',
            'invoice_no' => 'required',
            'payment_method' => 'required',
            'account_head_id.*' => 'required',
            'quantity.*' => 'required',
            'amount.*' => 'required',
            'total.*' => 'required',
        ]);
        $length = sizeof($request->account_head_id);

        $store_info = new LaundryTransectionInfo();
        $store_info->issue_date = date('Y-m-d', strtotime($request->issue_date));
        $store_info->payment_method = $request->payment_method;
        $store_info->invoice_no = $request->invoice_no;
        $store_info->total = $request->sub_total;
        $store_info->status = 1;
        $store_info->type = 2;
        $store_info->save();

        for($i = 0; $i<$length; $i++) {
            $laundry_transection = new LaundryTransaction();
            $laundry_transection->transaction_type = 1;
            $laundry_transection->account_head_id = $request->account_head_id[$i];
            $laundry_transection->amount = $request->amount[$i];
            $laundry_transection->in_out = 2;
            $laundry_transection->status = 1;
            $laundry_transection->ref_table_id = $store_info->id;
            $laundry_transection->quantity = $request->quantity[$i];
            $laundry_transection->comment = 'Laundry Expanse';
            $laundry_transection->save();
        }

        Toastr::success('Expanse added successfully');
        return redirect()->back();
    }

    public function expanseList(Request $request) {

       $income_lists = LaundryTransectionInfo::where('type', 2)->where('status', 1);
       
       if($request->invoice_no != null) {
            $income_lists = $income_lists->where('invoice_no', $request->invoice_no);
       }
       if($request->date_from != null) {
            $income_lists = $income_lists->where('issue_date','>=', date('Y-m-d', strtotime($request->date_from)));
       }
       if($request->date_to != null) {
            $income_lists = $income_lists->where('issue_date','<=', date('Y-m-d', strtotime($request->date_from)));
        }
        $income_lists = $income_lists->with('expanse_transection')->orderBy('id','desc')->paginate(20);
        //return $income_lists;
        return view('backEnd.account.expanse.manage', compact('income_lists'));
    }

    public function expanseEdit($id) {
        $income = LaundryTransectionInfo::where('id', $id)->first();
        $income_lists = LaundryTransaction::where('ref_table_id', $id)->where('comment', 'Laundry Expanse')->get();
        //return $income_lists;
        return view('backEnd.account.expanse.edit_expanse', compact('income', 'income_lists'));
    }

    public function updateExpanse(Request $request) {
        $request->validate([
            'issue_date' => 'required',
            'invoice_no' => 'required',
            'payment_method' => 'required',
            'account_head_id.*' => 'required',
            'quantity.*' => 'required',
            'amount.*' => 'required',
            'total.*' => 'required',
        ]);
        $length = sizeof($request->account_head_id);

        $store_info = LaundryTransectionInfo::where('id', $request->id)->first();
        $store_info->issue_date = date('Y-m-d', strtotime($request->issue_date));
        $store_info->payment_method = $request->payment_method;
        $store_info->invoice_no = $request->invoice_no;
        $store_info->total = $request->sub_total;
        $store_info->status = 1;
        $store_info->type = 2;
        $store_info->save();

        for($i = 0; $i<$length; $i++) {
            if(!empty($request->list_id[$i])) {
                // update
                $laundry_transection = LaundryTransaction::where('id', $request->list_id[$i])->first();
                $laundry_transection->transaction_type = 1;
                $laundry_transection->account_head_id = $request->account_head_id[$i];
                $laundry_transection->amount = $request->amount[$i];
                $laundry_transection->in_out = 1;
                $laundry_transection->status = 1;
                $laundry_transection->ref_table_id = $store_info->id;
                $laundry_transection->quantity = $request->quantity[$i];
                $laundry_transection->comment = 'Laundry Expanse';
                $laundry_transection->save();
            } else {
                // insert
                $laundry_transection = new LaundryTransaction();
                $laundry_transection->transaction_type = 1;
                $laundry_transection->account_head_id = $request->account_head_id[$i];
                $laundry_transection->amount = $request->amount[$i];
                $laundry_transection->in_out = 1;
                $laundry_transection->status = 1;
                $laundry_transection->ref_table_id = $store_info->id;
                $laundry_transection->quantity = $request->quantity[$i];
                $laundry_transection->comment = 'Laundry Expanse';
                $laundry_transection->save();
            }
        }

        Toastr::success('Expanse updated successfully');
        return redirect()->back();
    }

    public function expanseDelete($id) {
        $info = LaundryTransectionInfo::where('id', $id)->first();
        $delete_lists = LaundryTransaction::where('ref_table_id', $info->id)->where('comment', 'Laundry Expanse')->get();
        foreach($delete_lists as $delete_list) {
            $delete_list->delete();
        }
        $info->delete();
        Toastr::success('Expanse deleted successfully');
        return redirect()->route('superadmin.account.expanseList');
    }
    /*..............Expanse................*/


    /*..............Salon Income................*/
    public function addSalonIncome() {
        $headTypes = DB::table('account_head_types')->where('status', 1)->whereIn('id', array(3,4))->get();
        $count = SalonTransectionInfo::count();
        $invoice_no = str_pad($count + 1, 5, 0, STR_PAD_LEFT);
        return view('backEnd.salon.account.income.add_income', compact('headTypes', 'invoice_no'));
    }

    public function storeSalonIncome(Request $request) {
        //return $request->all();
        $request->validate([
            'issue_date' => 'required',
            'invoice_no' => 'required',
            'payment_method' => 'required',
            'account_head_id.*' => 'required',
            'quantity.*' => 'required',
            'amount.*' => 'required',
            'total.*' => 'required',
        ]);
        $length = sizeof($request->account_head_id);

        $store_info = new SalonTransectionInfo();
        $store_info->issue_date = date('Y-m-d', strtotime($request->issue_date));
        $store_info->payment_method = $request->payment_method;
        $store_info->invoice_no = $request->invoice_no;
        $store_info->total = $request->sub_total;
        $store_info->status = 1;
        $store_info->type = 1;
        $store_info->save();

        for($i = 0; $i<$length; $i++) {
            $salon_transection = new SalonTransaction();
            $salon_transection->transaction_type = 1;
            $salon_transection->account_head_id = $request->account_head_id[$i];
            $salon_transection->amount = $request->amount[$i];
            $salon_transection->in_out = 1;
            $salon_transection->status = 1;
            $salon_transection->ref_table_id = $store_info->id;
            $salon_transection->quantity = $request->quantity[$i];
            $salon_transection->comment = 'Salon Income';
            $salon_transection->save();
        }

        Toastr::success('Income added successfully');
        return redirect()->back();
    }

    public function incomeSalonList(Request $request) {

       $income_lists = SalonTransectionInfo::where('type', 1)->where('status', 1);
       
       if($request->invoice_no != null) {
            $income_lists = $income_lists->where('invoice_no', $request->invoice_no);
       }
       if($request->date_from != null) {
            $income_lists = $income_lists->where('issue_date','>=', date('Y-m-d', strtotime($request->date_from)));
       }
       if($request->date_to != null) {
            $income_lists = $income_lists->where('issue_date','<=', date('Y-m-d', strtotime($request->date_from)));
        }
        $income_lists = $income_lists->with('income_salon_transection')->orderBy('id','desc')->paginate(20);
        //return $income_lists;
        return view('backEnd.salon.account.income.manage', compact('income_lists'));
    }

    public function incomeSalonEdit($id) {
        $income = SalonTransectionInfo::where('id', $id)->first();
        $income_lists = SalonTransaction::where('ref_table_id', $id)->where('comment', 'Salon Income')->get();
        //return $income_lists;
        return view('backEnd.salon.account.income.edit_income', compact('income', 'income_lists'));
    }

    public function updateSalonIncome(Request $request) {
        $request->validate([
            'issue_date' => 'required',
            'invoice_no' => 'required',
            'payment_method' => 'required',
            'account_head_id.*' => 'required',
            'quantity.*' => 'required',
            'amount.*' => 'required',
            'total.*' => 'required',
        ]);
        $length = sizeof($request->account_head_id);

        $store_info = SalonTransectionInfo::where('id', $request->id)->first();
        $store_info->issue_date = date('Y-m-d', strtotime($request->issue_date));
        $store_info->payment_method = $request->payment_method;
        $store_info->invoice_no = $request->invoice_no;
        $store_info->total = $request->sub_total;
        $store_info->status = 1;
        $store_info->type = 1;
        $store_info->save();

        for($i = 0; $i<$length; $i++) {
            if(!empty($request->list_id[$i])) {
                // update
                $salon_transection = SalonTransaction::where('id', $request->list_id[$i])->first();
                $salon_transection->transaction_type = 1;
                $salon_transection->account_head_id = $request->account_head_id[$i];
                $salon_transection->amount = $request->amount[$i];
                $salon_transection->in_out = 1;
                $salon_transection->status = 1;
                $salon_transection->ref_table_id = $store_info->id;
                $salon_transection->quantity = $request->quantity[$i];
                $salon_transection->comment = 'Salon Income';
                $salon_transection->save();
            } else {
                // insert
                $salon_transection = new SalonTransaction();
                $salon_transection->transaction_type = 1;
                $salon_transection->account_head_id = $request->account_head_id[$i];
                $salon_transection->amount = $request->amount[$i];
                $salon_transection->in_out = 1;
                $salon_transection->status = 1;
                $salon_transection->ref_table_id = $store_info->id;
                $salon_transection->quantity = $request->quantity[$i];
                $salon_transection->comment = 'Salon Income';
                $salon_transection->save();
            }
        }

        Toastr::success('Income updated successfully');
        return redirect()->back();
    }

    public function incomeSalonDelete($id) {
        $info = SalonTransectionInfo::where('id', $id)->first();
        $delete_lists = SalonTransaction::where('ref_table_id', $info->id)->where('comment', 'Salon Income')->get();
        foreach($delete_lists as $delete_list) {
            $delete_list->delete();
        }
        $info->delete();
        Toastr::success('Income deleted successfully');
        return redirect()->route('superadmin.account.incomeSalonList');
    }

    public function incomeSalonPDF($id) {
        $income = SalonTransectionInfo::where('id', $id)->first();
        $income_lists = SalonTransaction::where('ref_table_id', $id)->where('comment', 'Salon Income')->get();
        //return $income_lists;
        //return view('backEnd.salon.account.income.edit_income', compact('income', 'income_lists'));
        //return view('backEnd.salon.account.income.income_det_pdf', compact('income_lists'));
        //$pdf = PDF::loadView('pdf.document', $data);
        $income_lists = [
            'income_lists' => $income_lists
        ];
        //$pdf = PDF::loadView('pdf.document', $data);
        $pdf = PDF::loadView('backEnd.salon.account.income.income_det_pdf', $income_lists);
        return $pdf->stream('document.pdf');
    }
    /*..............Salon Income................*/



    /*..............Salon Expanse................*/
    public function addSalonExpanse() {
        $headTypes = DB::table('account_head_types')->where('status', 1)->whereIn('id', array(3,4))->get();
        $count = SalonTransectionInfo::count();
        $invoice_no = str_pad($count + 1, 5, 0, STR_PAD_LEFT);
        return view('backEnd.salon.account.expanse.add_expanse', compact('headTypes', 'invoice_no'));
    }

    public function storeSalonExpanse(Request $request) {
        //return $request->all();
        $request->validate([
            'issue_date' => 'required',
            'invoice_no' => 'required',
            'payment_method' => 'required',
            'account_head_id.*' => 'required',
            'quantity.*' => 'required',
            'amount.*' => 'required',
            'total.*' => 'required',
        ]);
        $length = sizeof($request->account_head_id);

        $store_info = new SalonTransectionInfo();
        $store_info->issue_date = date('Y-m-d', strtotime($request->issue_date));
        $store_info->payment_method = $request->payment_method;
        $store_info->invoice_no = $request->invoice_no;
        $store_info->total = $request->sub_total;
        $store_info->status = 1;
        $store_info->type = 2;
        $store_info->save();

        for($i = 0; $i<$length; $i++) {
            $salon_transection = new SalonTransaction();
            $salon_transection->transaction_type = 1;
            $salon_transection->account_head_id = $request->account_head_id[$i];
            $salon_transection->amount = $request->amount[$i];
            $salon_transection->in_out = 2;
            $salon_transection->status = 1;
            $salon_transection->ref_table_id = $store_info->id;
            $salon_transection->quantity = $request->quantity[$i];
            $salon_transection->comment = 'Salon Expanse';
            $salon_transection->save();
        }

        Toastr::success('Expanse added successfully');
        return redirect()->back();
    }

    public function expanseSalonList(Request $request) {

       $income_lists = SalonTransectionInfo::where('type', 2)->where('status', 1);
       
       if($request->invoice_no != null) {
            $income_lists = $income_lists->where('invoice_no', $request->invoice_no);
       }
       if($request->date_from != null) {
            $income_lists = $income_lists->where('issue_date','>=', date('Y-m-d', strtotime($request->date_from)));
       }
       if($request->date_to != null) {
            $income_lists = $income_lists->where('issue_date','<=', date('Y-m-d', strtotime($request->date_from)));
        }
        $income_lists = $income_lists->with('expanse_salon_transection')->orderBy('id','desc')->paginate(20);
        //return $income_lists;
        return view('backEnd.salon.account.expanse.manage', compact('income_lists'));
    }

    public function expanseSalonEdit($id) {
        $income = SalonTransectionInfo::where('id', $id)->first();
        $income_lists = SalonTransaction::where('ref_table_id', $id)->where('comment', 'Salon Expanse')->get();
        //return $income_lists;
        return view('backEnd.salon.account.expanse.edit_expanse', compact('income', 'income_lists'));
    }

    public function updateSalonExpanse(Request $request) {
        $request->validate([
            'issue_date' => 'required',
            'invoice_no' => 'required',
            'payment_method' => 'required',
            'account_head_id.*' => 'required',
            'quantity.*' => 'required',
            'amount.*' => 'required',
            'total.*' => 'required',
        ]);
        $length = sizeof($request->account_head_id);

        $store_info = SalonTransectionInfo::where('id', $request->id)->first();
        $store_info->issue_date = date('Y-m-d', strtotime($request->issue_date));
        $store_info->payment_method = $request->payment_method;
        $store_info->invoice_no = $request->invoice_no;
        $store_info->total = $request->sub_total;
        $store_info->status = 1;
        $store_info->type = 2;
        $store_info->save();

        for($i = 0; $i<$length; $i++) {
            if(!empty($request->list_id[$i])) {
                // update
                $salon_transection = SalonTransaction::where('id', $request->list_id[$i])->first();
                $salon_transection->transaction_type = 1;
                $salon_transection->account_head_id = $request->account_head_id[$i];
                $salon_transection->amount = $request->amount[$i];
                $salon_transection->in_out = 2;
                $salon_transection->status = 1;
                $salon_transection->ref_table_id = $store_info->id;
                $salon_transection->quantity = $request->quantity[$i];
                $salon_transection->comment = 'Salon Expanse';
                $salon_transection->save();
            } else {
                // insert
                $salon_transection = new SalonTransaction();
                $salon_transection->transaction_type = 1;
                $salon_transection->account_head_id = $request->account_head_id[$i];
                $salon_transection->amount = $request->amount[$i];
                $salon_transection->in_out = 2;
                $salon_transection->status = 1;
                $salon_transection->ref_table_id = $store_info->id;
                $salon_transection->quantity = $request->quantity[$i];
                $salon_transection->comment = 'Salon Expanse';
                $salon_transection->save();
            }
        }

        Toastr::success('Expanse updated successfully');
        return redirect()->back();
    }

    public function expanseSalonDelete($id) {
        $info = SalonTransectionInfo::where('id', $id)->first();
        $delete_lists = SalonTransaction::where('ref_table_id', $info->id)->where('comment', 'Salon Expanse')->get();
        foreach($delete_lists as $delete_list) {
            $delete_list->delete();
        }
        $info->delete();
        Toastr::success('Expanse deleted successfully');
        return redirect()->route('superadmin.account.expanseSalonList');
    }
    /*..............Salon Expanse................*/

}
