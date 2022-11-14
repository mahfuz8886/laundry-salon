<?php

namespace App\Http\Controllers\Superadmin;

use App\AccountHead;
use App\CorporateCustomerProduct;
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
use App\Order;
use App\OrderBilling;
use App\OrderItem;
use App\OrderShipping;
use App\ProductService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class CustomerController extends Controller
{

    public function add() {
        $divisions = Division::where('status', 1)->get();
        return view('backEnd.customer.add', compact('divisions'));
    }

    public function store(Request $request) {
      
        $request->validate([
            'name' => 'required',
            'phone' => 'required|unique:customers,phoneNumber',
            'email' => 'nullable|unique:customers,emailAddress',
            'origin' => 'required',
            //'image' => 'required | mimes:jpeg,jpg,png | max:1000',
            'image' => 'required',
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
        if($request->customer_type != null) {
            $customers = $customers->where('customer_type', $request->customer_type);
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
            $storeAccount = AccountHead::where('user_id', $rowId)->where('head_type', 1)->first();
            $storeAccount->head_name = $insId.$request->name;
            $storeAccount->save();

            Toastr::success('Customer updated successfully');
            return redirect()->route('superadmin.manageCustomer');
            
        } else {
            Toastr::error('Failed to add customer');
            return redirect()->back();
        }

    }

    public function details($id) {
        $customer = Customer::where('id', '=', $id)->first();
        $address = CustomerAddress::where('customer_id', $id)->with('division')->with('district')->with('thana')->first();
       
        return view('backEnd.customer.details', compact('customer','address'));
    }

    public function add_corporate_customer_product($id) {
        $corporate_products = CorporateCustomerProduct::where('customer_id', $id)->get();
        //return $corporate_products;
        $date = $corporate_products;
        return view('backEnd.customer.corporate_customer_product', compact('id', 'corporate_products', 'date'));
    }

    public function store_corporate_customer_product(Request $request, $customer_id) {
        //return $request->all();
        //return $customer_id;
        $request->validate([
            'issue_date' => 'required',
            'validate_date' => 'required',
            'product.*' => 'required',
            'service.*' => 'required',
            'amount.*' => 'required',
        ]);
        $length = sizeof($request->product);

        for($i = 0; $i<$length; $i++) {
            
            if(!empty($request->id[$i])) {
                // update
                $store_product = CorporateCustomerProduct::where('id', $request->id[$i])->first();
                $store_product->customer_id = $customer_id;
                $store_product->product_id = $request->product[$i];
                $store_product->service_id = $request->service[$i];
                $store_product->amount = $request->amount[$i];
                $store_product->issue_date = date('Y-m-d', strtotime($request->issue_date));
                $store_product->validate_date = date('Y-m-d', strtotime($request->validate_date));
                $store_product->save();
            } else {
                //insert
                $store_product = new CorporateCustomerProduct();
                $store_product->customer_id = $customer_id;
                $store_product->product_id = $request->product[$i];
                $store_product->service_id = $request->service[$i];
                $store_product->amount = $request->amount[$i];
                $store_product->issue_date = date('Y-m-d', strtotime($request->issue_date));
                $store_product->validate_date = date('Y-m-d', strtotime($request->validate_date));
                $store_product->save();
            }
        }

        Toastr::success('Corporate customer product added successfully');
        return redirect()->back();
    }

}
