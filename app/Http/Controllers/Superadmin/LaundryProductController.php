<?php

namespace App\Http\Controllers\Superadmin;

use App\AccountHead;
use App\CorporateCustomerProduct;
use App\Customer;
use App\CustomerAddress;
use App\Employee;
use App\helper\CustomHelper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Hub;
use App\InventoryLog;
use App\LaundryDiscount;
use App\LaundryItem;
use App\LaundryPackage;
use App\LaundryPackageItem;
use App\LaundryOrderEmployee;
use App\LaundryPkgOrderItem;
use App\LaundryProduct;
use App\LaundryServiceCost;
use Brian2694\Toastr\Facades\Toastr;
use App\LaundryProductCategory;
use App\LaundryProductService;
use App\LaundryProductBranch;
use App\LaundryProductUse;
use App\LaundryTransaction;
use App\Order;
use App\OrderBilling;
use App\OrderItem;
use App\OrderShipping;
use App\OrderView;
use App\ProductService;
use App\SalonBooking;
use App\SalonCategory;
use App\SalonService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use PHPUnit\Util\Json;
use Illuminate\Support\Facades\Session;

class LaundryProductController extends Controller
{
    public function addCategory() {
        $categories = LaundryProductCategory::where('status','!=','Deleted')->orderBy('id','desc')->get();
        return view('backEnd.laundry.add_category',compact('categories'));
    }

    public function storeCategory(Request $request) {

        $validated = $request->validate([
            'cat_name' => 'required|max:255',
            'status' => 'required',
        ]);

        $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $request->cat_name)));

        $store_data = new LaundryProductCategory();

        if($request->file('image')){
            $store_data->image = $this->fileUpload($request->file('image'),'public/uploads/londryproduct/',350, 300);
        }else {
            Toastr::error('Product image required');
            return redirect()->back();
        }


        $store_data->cat_name = $request->cat_name;
        $store_data->slug = $slug;
        $store_data->status = $request->status;
        $store_data->save();

        $ins = $store_data->id;
        if($ins) {
            Toastr::success('Category added successfully');
            return redirect()->back();
        }else {
            Toastr::error('Something was wrong');
            return redirect()->back();
        }
    }

    public function getCategory($id) {
        $category = LaundryProductCategory::where('id', $id)->first();
        $categories = LaundryProductCategory::where('status','!=','Deleted')->orderBy('id','desc')->get();
        return view('backEnd.laundry.update_category',compact('category','categories'));
    }

    public function updateCategory(Request $request) {

        $validated = $request->validate([
            'cat_name' => 'required|max:255',
            'status' => 'required',
        ]);

        $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $request->cat_name)));
        $update_data = LaundryProductCategory::where('id', $request->id)->first();

        if($request->file('image')){
            $update_data->image = $this->fileUpload($request->file('image'),'public/uploads/londryproduct/',350, 300);
        }

        $update_data->cat_name = $request->cat_name;
        $update_data->slug = $slug;
        $update_data->status = $request->status;

        $updres = $update_data->save();
        if($updres) {
            Toastr::success('Category updated successfully');
            return redirect('superadmin/laundry/add_category');
        }else {
            Toastr::error('Update fail');
            return redirect()->back();
        }
    }



    /*.............service.............*/
    public function addService() {
        $services = LaundryProductService::where('status','!=','Deleted')->orderBy('id','desc')->get();
        return view('backEnd.laundry.add_service',compact('services'));
    }

    public function storeService(Request $request) {

        $validated = $request->validate([
            'service_name' => 'required|max:255',
            'status' => 'required',
        ]);

        $ins = LaundryProductService::create($request->all());
        if($ins) {
            Toastr::success('Service added successfully');
            return redirect()->back();
        }else {
            Toastr::error('Something was wrong');
            return redirect()->back();
        }
    }

    public function getService($id) {
        $service = LaundryProductService::where('id', $id)->first();
        $services = LaundryProductService::where('status','!=','Deleted')->orderBy('id','desc')->get();
        return view('backEnd.laundry.update_service',compact('service','services'));
    }

    public function updateService(Request $request) {

        $validated = $request->validate([
            'service_name' => 'required|max:255',
            'status' => 'required',
        ]);

        $updres = LaundryProductService::where('id', $request->id)->update(['service_name'=>$request->service_name,'status'=>$request->status,'updated_at'=>date('Y-m-d H:i:s')]);
        if($updres) {
            Toastr::success('Service updated successfully');
            return redirect('superadmin/laundry/add_service');
        }else {
            Toastr::error('Update fail');
            return redirect()->back();
        }
    }

    /*................product.................*/
    public function addProduct() {

        $branches = CustomHelper::getUserBranch();
        if($branches) {
            $allBranch = Hub::where('status', 1)->whereIn('id', $branches)->get();
        }else {
            $allBranch = Hub::where('status', 1)->get();
        }

        $services = LaundryProductService::where('status','Active')->orderBy('id','desc')->get();
        $categories = LaundryProductCategory::where('status','Active')->orderBy('id','desc')->get();
        return view('backEnd.laundry.add_product',compact('services','categories','allBranch'));
    }

    public function storeProduct(Request $request) {
        // dd($request->all());
        $validated = $request->validate([
            'product_name' => 'required|max:255',
            'sku' => 'required',
            'status' => 'required',
            'category' => 'required',
            'price_range' => 'required',
            'shipping_charge' => 'nullable',
            'product_show_id' => 'required',
            'branch_id' => 'required',
            'service' => 'required',
            'amount' => 'required',
            'item' => 'required',
            'qty' => 'required'
        ]);
        
        $store_data = new LaundryProduct();

        /*...........upload section..........*/
        if($request->file('filename')){
            $store_data->image = $this->fileUpload($request->file('filename'),'public/uploads/londryproduct/',520, 500);
        }else {
            Toastr::error('Product image required');
            return redirect()->back();
        }
        /*...........upload section..........*/

        $prices = explode('-', $request->price_range);
        $min_price = $prices[0];
        $max_price = $prices[1];


        $store_data->product_name = $request->product_name;
        $store_data->category_id = $request->category;
        $store_data->sku = $request->sku;
        $store_data->slug = $this->slugify($request->product_name);
        $store_data->description = $request->description;

        $store_data->status = $request->status;
        $store_data->price_range = $request->price_range;
        $store_data->min_price = $min_price;
        $store_data->max_price = $max_price;
        $store_data->shipping_charge = $request->shipping_charge?$request->shipping_charge:0;
        $store_data->product_show_id = $request->product_show_id;
    
        $store_data->created_by = Auth::id();
        $store_data->created_at = date('Y-m-d H:i:s');

        $store_data->save();
        $insid = $store_data->id;

        //insert service
        $length = sizeof($request->service);
      
        $services = $request->service;
        $amounts = $request->amount;
        
        for($i = 0; $i < $length; $i++) {
            $pservice = new ProductService();
            $pservice->laundry_product_id = $insid;
            $pservice->laundry_service_id = $services[$i];
            $pservice->amount = $amounts[$i];
            $pservice->save();
        }

        //insert branch
        $blength = sizeof($request->branch_id);
        $branches = $request->branch_id;
        for($i = 0; $i < $blength; $i++) {
            $pbranch = new LaundryProductBranch();
            $pbranch->laundry_product_id = $insid;
            $pbranch->laundry_branch_id = $branches[$i];
            $pbranch->save();
        }

        //insert product service cost
        $itemLength = sizeof($request->item);
        $items = $request->item;
        $qtys = $request->qty;

        for ($i=0; $i < $itemLength; $i++) { 
            $cost_store = new LaundryServiceCost();
            $temItem = explode(',', $items[$i]);

            $cost_store->product_id = $insid;
            $cost_store->item_id = $temItem[0];
            $cost_store->branch_id = $temItem[1];
            $cost_store->qty = $qtys[$i];
            $cost_store->status = 1;
            $cost_store->save();
        }
        
        if($insid) {
            Toastr::success('Product added successfully');
        }else {
            Toastr::error('Something was wrong');
        }
        return redirect()->back(); 
    }

    public function listProduct(Request $request) {

        $branches = CustomHelper::getUserBranch();

        $products = LaundryProduct::where('status','Active');
                    if($branches) {
                        $products = $products->whereHas('branchPermission', function ($query) use($branches) {
                            $query->whereIn('laundry_branch_id', $branches);
                        });
                    }
                    if($request->status != null) {
                        $products = $products->where('status', $request->status);
                    }
                    if($request->name != null) {
                        $products = $products->where('product_name', 'like', '%'. $request->name .'%');
                    }
        
                    $products = $products->with('service')->with('category')->orderBy('id','desc')->paginate(15);

        return view('backEnd.laundry.product_list',compact('products'));
    }

    public function getProduct($id) {

        $branches = CustomHelper::getUserBranch();
        if($branches) {
            $allBranch = Hub::where('status', 1)->whereIn('id', $branches)->get();
        }else {
            $allBranch = Hub::where('status', 1)->get();
        }

        $product = LaundryProduct::where('id',$id)->with('service')->with('category')->with('branch')->first();
        $categories = LaundryProductCategory::where('status','Active')->orderBy('id','desc')->get();
        $services = LaundryProductService::where('status','Active')->orderBy('id','desc')->get();
        $costs = LaundryServiceCost::where('product_id', $id)->where('status', 1)->get();
        //return $product;
        
        return view('backEnd.laundry.update_product',compact('product','categories','services','allBranch','costs'));
    }

    public function updateProduct(Request $request) {
        $validated = $request->validate([
            'product_name' => 'required|max:255',
            'sku' => 'required',
            'status' => 'required',
            'category' => 'required',
            'price_range' => 'required',
            'shipping_charge' => 'nullable',
            'product_show_id' => 'required',
            'branch_id' => 'required',
            'service' => 'required',
            'amount' => 'required',
            'item' => 'required',
            'qty' => 'required'
        ]);

        $update_data = LaundryProduct::find($request->row_id);

        /*...........upload section..........*/
        if($request->file('filename')){
            $update_data->image = $this->fileUpload($request->file('filename'),'public/uploads/londryproduct/',520, 500);
        }
        /*...........upload section..........*/

        $prices = explode('-', $request->price_range);
        $min_price = $prices[0];
        $max_price = $prices[1];

        $update_data->product_name = $request->product_name;
        $update_data->category_id = $request->category;
        $update_data->sku = $request->sku;
        $update_data->slug = $this->slugify($request->product_name);
        $update_data->description = $request->description;

        $update_data->status = $request->status;
        $update_data->price_range = $request->price_range;
        $update_data->min_price = $min_price;
        $update_data->max_price = $max_price;
        $update_data->shipping_charge = $request->shipping_charge;
        $update_data->product_show_id = $request->product_show_id;
        $update_data->created_by = Auth::id();
        $update_data->created_at = date('Y-m-d H:i:s');

        $update_data->save();
        $insid = $update_data->id;

        //delete existing service
        $services = ProductService::where('laundry_product_id',$request->row_id)->delete();

        //insert service
        $length = sizeof($request->service);
      
        $services = $request->service;
        $amounts = $request->amount;
        
        for($i = 0; $i < $length; $i++) {
            $pservice = new ProductService();
            $pservice->laundry_product_id = $insid;
            $pservice->laundry_service_id = $services[$i];
            $pservice->amount = $amounts[$i];
            $pservice->save();
        }

        //delete existing branch
        $bdeletes = LaundryProductBranch::where('laundry_product_id',$request->row_id)->delete();
        //insert branch
        $blength = sizeof($request->branch_id);
        $branches = $request->branch_id;
        for($i = 0; $i < $blength; $i++) {
            $pbranch = new LaundryProductBranch();
            $pbranch->laundry_product_id = $insid;
            $pbranch->laundry_branch_id = $branches[$i];
            $pbranch->save();
        }


        //insert product service cost
        //inactive all cost item first
        $oldItems = LaundryServiceCost::where('product_id', $request->row_id)->where('status', 1)->get();
        if($oldItems) {
            foreach ($oldItems as $key => $value) {
                LaundryServiceCost::where('item_id', $value->item_id)->where('product_id', $request->row_id)->update(['status'=> 0]);
            }
        }

        $itemLength = sizeof($request->item);
        $items = $request->item;
        $qtys = $request->qty;

        for ($i=0; $i < $itemLength; $i++) { 
            
            $temItem = explode(',', $items[$i]);

            $check = LaundryServiceCost::where('item_id', $temItem[0])->where('product_id', $request->row_id)->first();
            if($check) {
                $check->status = 1;
                $check->save();
            }else {
                $cost_store = new LaundryServiceCost();
                $cost_store->product_id = $insid;
                $cost_store->item_id = $temItem[0];
                $cost_store->branch_id = $temItem[1];
                $cost_store->qty = $qtys[$i];
                $cost_store->status = 1;
                $cost_store->save();
            }  
        }
        
        if($insid) {
            Toastr::success('Product updated successfully');
            return redirect()->route('superadmin.laundry.listProduct');
        }else {
            Toastr::error('Something was wrong');
            return redirect()->back();
        }
        
    }


    public function detailsProduct($id) {
        $product = LaundryProduct::where('id',$id)->with('service')->with('category')->first();
        $services = ProductService::where('laundry_product_id',$id)->with('serviceName')->get();
        $branches = LaundryProductBranch::where('laundry_product_id',$id)->with('hub')->get();
        return view('backEnd.laundry.product_details',compact('product','services','branches'));
    }

    //order section
    public function orders(Request $request) {

        // return $this->sendSMS('01719056533', 'hello user');

        $branches = CustomHelper::getUserBranch();
        
        $orders = Order::where('order_status','!=', 8)->where('origin', 'Online');
        /*$orders = Order::where('order_status','!=', 8)->where('origin', 'Online')
                         ->whereHas('product_order', function($q) {
                            $q->whereNotNull('product_id');
                         });*/
                if($branches) {
                    $orders = $orders->whereIn('branch_id', $branches);
                }
                
                if($request->status != null) {
                    $orders = $orders->where('order_status', $request->status);
                }
                if($request->payment_status != null) {
                    $orders = $orders->where('pay_status', $request->payment_status);
                }
                if($request->order_id != null) {
                    $orders = $orders->where('id', $request->order_id);
                }
                if($request->date_from != null) {
                    $orders = $orders->where('created_at','>=', date('Y-m-d', strtotime($request->date_from)).' 00:00:00');
                }
                if($request->date_to != null) {
                    $orders = $orders->where('created_at','<=', date('Y-m-d', strtotime($request->date_to)).' 23:59:59');
                }
                if($request->is_package_order != null) {
                    $orders = $orders->where('is_package_order', $request->is_package_order);
                }
        
                $orders = $orders->with('getAmount')->with('package_order')->with('statusName')->with('product_order')->orderBy('id','desc')->paginate(20);

                // why, do not understand yet.
                if($orders) {
                    foreach ($orders as $order) {
                        $checkExist = OrderView::where('order_id', $order->id)->where('user_id', Auth::id())->where('user_type_id', 1)->first();
                        if(!$checkExist) {
                            $orderView = new OrderView();
                            $orderView->order_id = $order->id;
                            $orderView->user_id = Auth::id();
                            $orderView->user_type_id = 1;
                            $orderView->save();
                        }
                    }
                }
                //return $orders;

        return view('backEnd.laundry.orders',compact('orders'));
    }

    public function orderDetails($id) {
        $order = Order::where('id', $id)->first();
        $orderItems = OrderItem::where('order_id', $id)->with('product')->with('service')->with('package')->get();
        $shipping = OrderShipping::where('order_id', $id)->with('division')->with('district')->with('thana')->first();
        $billing = OrderBilling::where('order_id', $id)->with('division')->with('district')->with('thana')->first();

        // $branches = CustomHelper::getUserBranch();
        // $items = InventoryLog::groupBy('item_id')
        //     ->selectRaw('sum(quantity) as sum, item_id, branch_id')->where('quantity', '>', 0)
        //     ->where('in_out', 'In');
        //     if($branches != null) {
        //         $items = $items->whereIn('branch_id', $branches);
        //     }
        // $items = $items->with('item')->with('unit')->get();
        //return $orderItems;
        //return view('backEnd.laundry.order_details',compact('order','orderItems','shipping','billing'));
        return view('backEnd.laundry.pkg_order_details',compact('order','orderItems','shipping','billing'));
    }

    public function orderUpdate(Request $request,$orderId) {
        $validate = $request->validate([
            'status' => 'required'
        ]);

        $orderInfo = Order::where('id', $orderId)->first();

        switch($request->status) {
            case 10: 
                if($request->pman) {
                    $orderInfo->pman_id = $request->pman;
                }
                $orderInfo->order_status = $request->status;
                $orderInfo->save();
                $this->addLog(Auth::id(), 1, 'Order confirm', $orderId);
                break;
            case 11: 
                if(!$request->employee) {
                    Toastr::error('Please select at least one employee');
                    return redirect()->back();
                }

                $length = sizeof($request->employee);
                $employees = $request->employee;
                for($i = 0; $i < $length; $i++) {
                    $storOrderEmp = new LaundryOrderEmployee();
                    $storOrderEmp->order_id = $orderId;
                    $storOrderEmp->employee_id = $employees[$i];
                    $storOrderEmp->save();
                }

                $orderInfo->order_status = $request->status;
                $orderInfo->save();
                $this->addLog(Auth::id(), 1, 'Processing order', $orderId);
                break;
            case 2:
                $orderInfo->pman_id = $request->pman;
                $orderInfo->order_status = $request->status;
                $orderInfo->save();
                $this->addLog(Auth::id(), 1, 'Order picked', $orderId);
                break;
            case 12:

                $orderItems = OrderItem::where('order_id', $orderId)->get();

                if($orderItems) {
                    foreach($orderItems as $oitem) {
                        $costItem = LaundryServiceCost::where('product_id', $oitem->product_id)->where('status', 1)->get();
                        if($costItem) {
                        
                            foreach($costItem as $citem) {

                                $itemInfo = InventoryLog::where('item_id', $citem->item_id)->where('branch_id', $citem->branch_id)->first();
                                //insert inventory logs
                                $store_inventory = new InventoryLog();
                                
                                $store_inventory->item_id = $citem->item_id;
                                $store_inventory->branch_id = $citem->branch_id;
                                $store_inventory->unit_id = $itemInfo->unit_id;
                                $store_inventory->buy_price = $itemInfo->buy_price;
                                $store_inventory->sale_price = $itemInfo->sale_price;
                                $store_inventory->quantity = $citem->qty;
                                $store_inventory->subtotal = $itemInfo->buy_price * $citem->qty;
                                $store_inventory->in_out = 'Out';
                                $store_inventory->save();


                                //insert product use
                                $storeUses = new LaundryProductUse();
                                $storeUses->order_id = $orderId;
                                $storeUses->item_id = $citem->item_id;
                                $storeUses->branch_id = $citem->branch_id;
                                $storeUses->quantity = $citem->qty;
                                $storeUses->uses_date = date('Y-m-d H:i:s');
                                $storeUses->save();
                            }
                        }
                    }
                }// order complete hole 
                // if order exist package: then 
                $pkg_order_items = LaundryPkgOrderItem::where('order_id', $orderId)->get();
                if($pkg_order_items) {
                    foreach($pkg_order_items as $oitem) {
                        $costItem = LaundryServiceCost::where('product_id', $oitem->product_id)->where('status', 1)->get();
                        if($costItem) {
                        
                            foreach($costItem as $citem) {

                                $itemInfo = InventoryLog::where('item_id', $citem->item_id)->where('branch_id', $citem->branch_id)->first();
                                //insert inventory logs
                                $store_inventory = new InventoryLog();
                                
                                $store_inventory->item_id = $citem->item_id;
                                $store_inventory->branch_id = $citem->branch_id;
                                $store_inventory->unit_id = $itemInfo->unit_id;
                                $store_inventory->buy_price = $itemInfo->buy_price;
                                $store_inventory->sale_price = $itemInfo->sale_price;
                                $store_inventory->quantity = $citem->qty;
                                $store_inventory->subtotal = $itemInfo->buy_price * $citem->qty;
                                $store_inventory->in_out = 'Out';
                                $store_inventory->save();


                                //insert product use
                                $storeUses = new LaundryProductUse();
                                $storeUses->order_id = $orderId;
                                $storeUses->item_id = $citem->item_id;
                                $storeUses->branch_id = $citem->branch_id;
                                $storeUses->quantity = $citem->qty;
                                $storeUses->uses_date = date('Y-m-d H:i:s');
                                $storeUses->save();
                            }
                        }
                    }
                }
                // if order exist package: then end


                if($request->dman) {
                    $orderInfo->dman_id = $request->dman;
                }
                
                $orderInfo->order_status = $request->status;
                $orderInfo->save();
                $this->addLog(Auth::id(), 1, 'Work complete', $orderId);
                break;
            case 4: 
                $orderInfo->dman_id = $request->dman;
                $orderInfo->order_status = $request->status;
                $orderInfo->pay_status = 'Paid';
                $orderInfo->save();
                $this->addLog(Auth::id(), 1, 'Order delivered', $orderId);

                //account transactions
                $orditems = OrderItem::where('order_id', $orderId)->get();
                $totalCost = $orditems->sum('total');

                $acHead = AccountHead::where('user_id', $orderInfo->customer_id)->where('head_type', 1)->first();

                $storeTrans = new LaundryTransaction();
                $storeTrans->account_head_id = $acHead->id;
                $storeTrans->transaction_type = 1;
                $storeTrans->amount = $totalCost;
                $storeTrans->in_out  = 2;
                $storeTrans->status  = 1;
                $storeTrans->ref_table_id = $orderId;
                $storeTrans->save();

                break;
        }

        Toastr::success('Status update successful');
        return redirect()->back();

    }


    public function orderCancel($orderId) {
        $order = Order::where('id', $orderId)->update([
            'order_status' => 9
        ]);

        $customer = Customer::where('id', $order->customer_id)->first();
        
        if($order) {
            $this->addLog(Auth::id(), 1, 'Order cancelled', $orderId);
            // sent sms
            $number = $customer->phoneNumber;
            $msg = 'Welcome to laundry express. Your has been cancelled';
            $this->sendSMS($number, $msg);

            Toastr::success('Order cancel successful');
        }else {
            Toastr::error('Something was wrong');
        }
        
        return redirect()->back();
    }

    public function orderHold($orderId) {
        $order = Order::where('id', $orderId)->update([
            'order_status' => 5
        ]);
        
        if($order) {
            Toastr::success('Order hold successful');
        }else {
            Toastr::error('Something was wrong');
        }
        
        return redirect()->back();
    }


    /*............offline order.............*/

    public function addOrders() {
        $customers = Customer::where('status', 1)->get();
        $categories = LaundryProductCategory::where('status', 'Active')->get();

        $branches = CustomHelper::getUserBranch();
        if($branches) {
            $allBranch = Hub::where('status', 1)->whereIn('id', $branches)->get();
        }else {
            $allBranch = Hub::where('status', 1)->get();
        }

        return view('backEnd.laundry.offline_order_add', compact('customers', 'categories','allBranch'));
    }

    public function storeOrders(Request $request) {
        
        $request->validate([
            'customer' => 'required',
            'category' => 'required',
            'product' => 'required',
            'branch_id' => 'required',
            'service' => 'required',
            'shipping' => 'required',
            'pick_time' => 'required',
            'quantity' => 'required'
        ]);

        $order = new Order();
        $order->order_datetime = date('Y-m-d H:i:s');
        $order->customer_id = $request->customer;
        $order->branch_id = $request->branch_id;
        $order->payment_method_id = 1;
        $order->origin = 'Offline';
        $order->picked_time = date('Y-m-d H:i:s', strtotime($request->pick_time));
        $order->save();
        $orderId = $order->id;
        if($orderId) {

            //product service
            $productService = ProductService::where('id', $request->service)->first();

            //product
            $product = LaundryProduct::where('id', $request->product)->first();

            //get discount
            $discount = 0;
            $discountInfo = LaundryDiscount::where('product_id', $request->product)
                                                ->where('customer_id', $request->customer)
                                                ->where('status', 1)
                                                ->where('product_service_id', $request->service)
                                                ->first();
            if($discountInfo) {
                $discount = (($productService->amount * $request->quantity) * $discountInfo->discount) / 100;
            }

            $orderItem = new OrderItem();
            $orderItem->order_id = $orderId;
            $orderItem->customer_id = $request->customer;
            $orderItem->product_id = $request->product;
            $orderItem->qty = $request->quantity;
            $orderItem->shipping_charge = $product->shipping_charge;
            $orderItem->service_id = $request->service;
            $orderItem->service_amount = $productService->amount;
            $orderItem->service_discount = $discount;
            $orderItem->total = ($productService->amount * $request->quantity) + $product->shipping_charge - $discount;
            $orderItem->save();

            //shipping
            $shipping = CustomerAddress::where('id', $request->shipping)->first();

            //order shipping
            $storeShipping = new OrderShipping();
            $storeShipping->order_id = $orderId;
            $storeShipping->type = $shipping->type;
            $storeShipping->fullname = $shipping->fullname;
            $storeShipping->mobile_no = $shipping->mobile_no;
            $storeShipping->region_id = $shipping->region_id;
            $storeShipping->city_id = $shipping->city_id;
            $storeShipping->area_id = $shipping->area_id;
            $storeShipping->address = $shipping->address;
            $storeShipping->save();

            if($request->billing) {
                //billing
                $billing = CustomerAddress::where('id', $request->billing)->first();

                //order billing
                $storeBilling = new OrderBilling();
                $storeBilling->order_id = $orderId;
                $storeBilling->type = $billing->type;
                $storeBilling->fullname = $billing->fullname;
                $storeBilling->mobile_no = $billing->mobile_no;
                $storeBilling->region_id = $billing->region_id;
                $storeBilling->city_id = $billing->city_id;
                $storeBilling->area_id = $billing->area_id;
                $storeBilling->address = $billing->address;
                $storeBilling->save();
            }

            $this->addLog(Auth::id(), 1, 'Offline order add', $orderId);
            Toastr::success('Order placed successful');
        }else {
            Toastr::error('Something was wrong');
        }
        return redirect()->back();
    }


    public function manageOfflineOrders(Request $request) {
        $branches = CustomHelper::getUserBranch();
        $orders = Order::where('order_status','!=', 8)->where('origin', 'Offline')->orWhere('origin', 'Quick');
                    if($request->status != null) {
                        $orders = $orders->where('order_status', $request->status);
                    }
                    if($request->payment_status != null) {
                        $orders = $orders->where('pay_status', $request->payment_status);
                    }
                    if($request->order_id != null) {
                        $orders = $orders->where('id', $request->order_id);
                    }
                    if($request->date_from != null) {
                        $orders = $orders->where('created_at','>=', date('Y-m-d', strtotime($request->date_from)).' 00:00:00');
                    }
                    if($request->date_to != null) {
                        $orders = $orders->where('created_at','<=', date('Y-m-d', strtotime($request->date_to)).' 23:59:59');
                    }
                    if($branches) {
                        $orders = $orders->whereIn('branch_id', $branches);
                    }
        
        
                    $orders = $orders->with('customer', 'getAmount')->with('statusName')->orderBy('id','desc')->paginate(20);
                    //return $orders;
        return view('backEnd.laundry.offline_orders',compact('orders'));
    }


    public function getCustomerAddress(Request $request) {
        $customerAddress = CustomerAddress::where('customer_id', $request->customerId)->with('division')->with('district')->with('thana')->get();
    
        if($customerAddress) {
            
            return $customerAddress;
        }
    }

    public function getProducts(Request $request) {
        $products = LaundryProduct::where('category_id', $request->categoryId)->where('status', 'Active')->orderBy('id', 'desc')->get();
    
        if($products) {
            
            return $products;
        }
    }

    // order edit page
    public function getProducts_for_edit(Request $request) {
        $products = LaundryProduct::where('category_id', $request->categoryId)->where('status', 'Active')->orderBy('id', 'desc')->get();
    
        if($products) {
            
            return response()->json($products);
        }
    }

    // order edit page
    public function getProductServices_for_edit(Request $request) {
        $services = ProductService::where('laundry_product_id', $request->productId)->with('serviceName')->get();
    
        if($services) {
            
            return $services;
        }
    }

    public function getProductServices(Request $request) {
        $services = ProductService::where('laundry_product_id', $request->productId)->with('serviceName')->get();
    
        if($services) {
            
            return $services;
        }
    }

    public function getItemPrices(Request $request) {
        $prices = InventoryLog::where('item_id', $request->itemId)->latest('buy_price')->first();
        if($prices) {
            return $prices;
        }
    }

    /*............offline order.............*/


    /*...........ajax............*/
    public function getTotalNewOrder() {
        $userID = Auth::id();
        $orders = Order::where('order_status', 1)->get();
        $count = 0;
        foreach($orders as $order) {
            $item = OrderView::where('order_id', $order->id)
                    ->where('user_id', $userID)
                    ->where('user_type_id', 1)->first();
            if(!$item) {
                $count ++;
            }
        }
    
        return response()->json(['total' => $count]);
    }

    /*.........ajax...........*/

    public function getOrderItems($id) {
        $orderId = $id;
        $orderItems = OrderItem::where('order_id', $id)->with('product')->get();
        //return $orderItems;
        //$order_items = OrderItem::where('order_id', 21)->whereNotNull('package_id')->with('package')->get();
        $order_items = LaundryPkgOrderItem::where('order_id', $id)->first();
        // pkg_order_items e hbe na
        //$order_items = OrderItem::where('order_id', $id)->whereNotNull('package_id')->with('package')->get();
        //return $order_items;
        return view('backEnd.laundry.order_edit', compact('orderItems','orderId', 'order_items'));
    }

    public function updateQty(Request $request) {
        $item = OrderItem::where('id', $request->itemId)->first();
        $item->qty = $request->qty;
        $item->total = ($item->service_amount * $request->qty) + $item->shipping_charge - $item->service_discount;
        $item->save();

        return 1;
    }
    public function orderEdit(Request $request) {

        $orderId = $request->rowId;

        $orderInfo = Order::where('id', $orderId)->first();

        $categoris = $request->category;
        $products = $request->product;
        $services = $request->service;
        $qty = $request->quantity;

        $length = sizeof($categoris);

        for ($i=0; $i < $length; $i++) { 
            
            //product service
            $productService = ProductService::where('id', $services[$i])->first();

            //product
            $product = LaundryProduct::where('id', $products[$i])->first();

            //get discount
            $discount = 0;
            $discountInfo = LaundryDiscount::where('product_id', $products[$i])
                                                ->where('customer_id', $orderInfo->customer_id)
                                                ->where('status', 1)
                                                ->where('product_service_id', $services[$i])
                                                ->first();
            if($discountInfo) {
                $discount = (($productService->amount * $qty[$i]) * $discountInfo->discount) / 100;
            }

            $orderItem = new OrderItem();
            $orderItem->order_id = $orderId;
            $orderItem->customer_id = $orderInfo->customer_id;
            $orderItem->product_id = $products[$i];
            $orderItem->qty = $qty[$i];
            $orderItem->shipping_charge = $product->shipping_charge;
            $orderItem->service_id = $services[$i];
            $orderItem->service_amount = $productService->amount;
            $orderItem->service_discount = $discount;
            $orderItem->total = ($productService->amount * $qty[$i]) + $product->shipping_charge - $discount;
            $orderItem->save();

        }

        $this->addLog(Auth::id(), 1, 'Order update', $orderId);

        Toastr::success('Order update successful');
        return redirect()->back();

    }

    public function updateOrderPackage(Request $request) {
        //return $request->all();
        $length = $request->product? sizeof($request->product):0;
        $pkg_order = LaundryPkgOrderItem::where('order_id', $request->rowId)->first();
        //return $pkg_order;

        for($i = 0; $i<$length; $i++) {
            if(!empty($request->id[$i])) {
                // update
                $pkg_order_item = LaundryPkgOrderItem::where('id', $request->id[$i])->first();
                $pkg_order_item->product_id = $request->product[$i];
                $pkg_order_item->service_id = $request->service[$i];
                $pkg_order_item->amount = $request->amount[$i];
                $pkg_order_item->max_qty = $request->qty[$i];
                $pkg_order_item->save();
            } else {
                // insert
                $pkg_order_item = new LaundryPkgOrderItem();
                $pkg_order_item->order_id = $request->rowId;
                $pkg_order_item->customer_id = $pkg_order->customer_id;
                $pkg_order_item->product_id = $request->product[$i];
                $pkg_order_item->service_id = $request->service[$i];
                $pkg_order_item->package_id = $pkg_order->package_id;
                $pkg_order_item->amount = $request->amount[$i];
                $pkg_order_item->max_qty = $request->qty[$i];
                $pkg_order_item->save();
            }
        }

        Toastr::success('Package Order update successful');
        return redirect()->back();
    }
    
    
     /*..............package................*/

    public function createPackage() {
        $branches = CustomHelper::getUserBranch();
        if($branches) {
            $allBranch = Hub::where('status', 1)->whereIn('id', $branches)->get();
        }else {
            $allBranch = Hub::where('status', 1)->get();
        }

        return view('backEnd.laundry.package.add', compact('allBranch'));
    }

    public function storePackage(Request $request) {
        //return $request->all();
        $request->validate([
            'package_name' => 'required',
            'package_amount' => 'required',
            'package_duration' => 'required',
            'image' => 'required',
            'branch_id' => 'required',
            'status' => 'required',
        ]);

        $storePackage = new LaundryPackage();
        $storePackage->package_name = $request->package_name;
        $storePackage->package_amount = $request->package_amount;
        $storePackage->duration = $request->package_duration;
        $storePackage->branch_id = $request->branch_id;
        $storePackage->package_quantity = $request->package_quantity;
        if ($request->hasFile('image')) {
            $storePackage->image = $this->fileUpload($request->image, 'public/uploads/laundry package/', 200, 200);
         }
        $storePackage->status = $request->status;
        $storePackage->save();
        $insId = $storePackage->id;
        if($insId) {
            $length = $request->product? sizeof($request->product):0;
            $products = $request->product;
            $services = $request->service;
            $amounts = $request->amount;
            $qtys = $request->qty;

            for ($i=0; $i < $length; $i++) { 
                $storeItems = new LaundryPackageItem();
                $storeItems->package_id = $insId;
                $storeItems->product_id = $products[$i];
                $storeItems->service_id = $services[$i];
                $storeItems->amount = $amounts[$i];
                $storeItems->max_qty = $qtys[$i];
                $storeItems->save();
            }

            Toastr::success('Package added successful');

        }else {
            Toastr::error('Something was wrong');
        }

        return redirect()->back();
    }

    public function managePackage(Request $request) {
        $packages = LaundryPackage::where('status', 1)->with('items');
        
                    if ($request->name != null) {
                        $packages = $packages->where('package_name','like', '%'.$request->name.'%');
                    }
                    if($request->date_from != null) {
                        $packages = $packages->where('created_at','>=', date('Y-m-d', strtotime($request->date_from)).' 00:00:00');
                    }
                    if($request->date_to != null) {
                        $packages = $packages->where('created_at','<=', date('Y-m-d', strtotime($request->date_to)).' 23:59:59');
                    }
                    $packages = $packages->paginate(15);

        return view('backEnd.laundry.package.manage', compact('packages'));
    }

    public function getPackage($id) {
        $package = LaundryPackage::where(['status'=> 1,'id'=>$id])->with('items')->first();
        $branches = CustomHelper::getUserBranch();
        if($branches) {
            $allBranch = Hub::where('status', 1)->whereIn('id', $branches)->get();
        }else {
            $allBranch = Hub::where('status', 1)->get();
        }
        
        return view('backEnd.laundry.package.edit', compact('allBranch', 'package'));
    }

    public function updatePackage(Request $request) {
        // return $request->all();
        $rowId = $request->row_id;
        $request->validate([
            'package_name' => 'required',
            'package_amount' => 'required',
            'package_duration' => 'required',
            'branch_id' => 'required',
            'image' => 'nullable|image',
            'status' => 'required',
        ]);


        $storePackage = LaundryPackage::where('id', $rowId)->first();
        $storePackage->package_name = $request->package_name;
        $storePackage->package_amount = $request->package_amount;
        $storePackage->duration = $request->package_duration;
        $storePackage->branch_id = $request->branch_id;
        $storePackage->package_quantity = $request->package_quantity;
        if($request->file('image')){
            if($storePackage->image){
                File::delete($storePackage->image);
            }
            $storePackage->image = $this->fileUpload($request->image, 'public/uploads/laundry package/', 200, 200);
        }
        $storePackage->status = $request->status;
        $storePackage->save();
        $insId = $storePackage->id;
        if($insId) {
            $length = $request->product? sizeof($request->product):0;
            $products = $request->product;
            $services = $request->service;
            $amounts = $request->amount;
            $qtys = $request->qty;


            //inactive all old data
            $checkItems = LaundryPackageItem::where(['package_id'=> $rowId])->get();
            if($checkItems) {
                foreach($checkItems as $item) {
                    $item->status = 0;
                    $item->save();
                }
            }

            for ($i=0; $i < $length; $i++) { 
                
                $exist = LaundryPackageItem::where([
                    'package_id' => $rowId,
                    'product_id' => $products[$i],
                    'service_id' => $services[$i]
                ])->first();

                if($exist) {
                    $exist->amount = $amounts[$i];
                    $exist->max_qty = $qtys[$i];
                    $exist->status = 1;
                    $exist->save();
                }else {
                    $storeItems = new LaundryPackageItem();
                    $storeItems->package_id = $insId;
                    $storeItems->product_id = $products[$i];
                    $storeItems->service_id = $services[$i];
                    $storeItems->amount = $amounts[$i];
                    $storeItems->max_qty = $qtys[$i];
                    $storeItems->save();
                }
                
            }

            Toastr::success('Package added successful');

        }else {
            Toastr::error('Something was wrong');
        }

        return redirect()->route('superadmin.laundry.managePackage');
    }

    public function detailsPackage(Request $request,$id) {
        $package = LaundryPackage::where(['status'=> 1,'id'=>$id])->with('items')->first();
        $branches = CustomHelper::getUserBranch();
        if($branches) {
            $allBranch = Hub::where('status', 1)->whereIn('id', $branches)->get();
        }else {
            $allBranch = Hub::where('status', 1)->get();
        }
        return view('backEnd.laundry.package.details', compact('allBranch', 'package'));
    }


    public function managePackageOrder(Request $request) {
        $branches = CustomHelper::getUserBranch();
        
        $orders = Order::where('order_status','!=', 8)->where('origin', 'Online')->where('is_package_order', 1);
                if($branches) {
                    $orders = $orders->whereIn('branch_id', $branches);
                }
                
                if($request->status != null) {
                    $orders = $orders->where('order_status', $request->status);
                }
                if($request->payment_status != null) {
                    $orders = $orders->where('pay_status', $request->payment_status);
                }
                if($request->order_id != null) {
                    $orders = $orders->where('id', $request->order_id);
                }
                if($request->date_from != null) {
                    $orders = $orders->where('created_at','>=', date('Y-m-d', strtotime($request->date_from)).' 00:00:00');
                }
                if($request->date_to != null) {
                    $orders = $orders->where('created_at','<=', date('Y-m-d', strtotime($request->date_to)).' 23:59:59');
                }
        
                //$orders = $orders->with('getAmount')->with('package_order')->with('statusName')->orderBy('id','desc')->paginate(20);
                $orders = $orders->with('statusName')->orderBy('id','desc')->paginate(20);

                // why, do not understand yet.
                /*if($orders) {
                    foreach ($orders as $order) {
                        $checkExist = OrderView::where('order_id', $order->id)->where('user_id', Auth::id())->where('user_type_id', 1)->first();
                        if(!$checkExist) {
                            $orderView = new OrderView();
                            $orderView->order_id = $order->id;
                            $orderView->user_id = Auth::id();
                            $orderView->user_type_id = 1;
                            $orderView->save();
                        }
                    }
                }*/
                //return $orders;

        return view('backEnd.laundry.package.order',compact('orders'));
    }

    /*..............package................*/


    /*..............Quick Sale................*/
    public function quickSaleLaundry() {
        $branches = CustomHelper::getUserBranch();
        if($branches) {
            $allBranch = Hub::where('status', 1)->whereIn('id', $branches)->get();
        }else {
            $allBranch = Hub::where('status', 1)->get();
        }

        $customers = Customer::where('status', 1)->where('origin', 'Laundry')->get();
        $employees = Employee::where('status', 1)->where('origin', 1)->get();// add more filter like branch, origin etc.
        $count = Order::count();
        $invoice_no = str_pad($count + 1, 5, 0, STR_PAD_LEFT);
        //return $invoice_no;

        $defaultBranch = Hub::where('status', 1)->where('is_default', 1)->first();
        if($defaultBranch && $defaultBranch->id) {
            Session::put('default_branch', $defaultBranch->id);
        }else {
            $alterDefault = Hub::where('status', 1)->first();
            if($alterDefault && $alterDefault->id) {
                Session::put('default_branch', $alterDefault->id);
            }
        }
        //return $defaultBranch;
        //return Session::get('default_branch');
        return view('backEnd.laundry.sale.quick.create', compact('allBranch', 'employees', 'customers', 'invoice_no'));
    }

    // product search for quick sale
    public function getLaundryProduct(Request $request) {
        // test purpose
        //$request->id = 19;
        //$request->branch_id = 1;
        //$request->branch_id = 2;
        //$request->customer_id = 1;
        //$request->search_data = 'Household';
        //$request->search_data = 'Dry Wash';
        //return response()->json($request->all());


        if($request->customer_id == '0') {
            $request->merge([
                'customer_id' => 1,
            ]);
        }
        $customer['corporate'] = NULL;

        // okk dokka
        // previous
        /*if($request->id > 0) {
            if($request->branch_id != '') {
                //$products['branch_id'] = 'Aceeeee';
                // on load product asbe
                $products = ProductService::where(function ($q) use ($request) {
                    $q->whereHas('branches', function ($sq) use ($request) {
                        $sq->where('laundry_branch_id', $request->branch_id);
                    })
                    ->whereHas('product', function ($sp) use ($request) {
                        $sp->where('product_show_id', 1)
                        ->orWhere('product_show_id', 3);
                    });
                })->where('id', '>', $request->id)->with('product', 'serviceName', 'branches')->take(9)->get();

                if($request->customer_id != '') { // $request->customer_id != ''
                    // find customer type
                    //$products['customer_id'] = 'Aceeee';
                    $customer = Customer::where('id', $request->customer_id)->first();
                    if($customer->customer_type === "Corporate") { //$customer->customer_type == "Corporate"
                        //$products['customer_type'] = 'Corportae';
                        $customer['corporate'] = true;
                        if($request->search_data != '') { //$request->search_data != ''
                            //$products['search_data'] = 'Aceeee';
                            $products = CorporateCustomerProduct::where(function ($q) use ($request) {
                                $q->where('customer_id', $request->customer_id)
                                ->whereHas('product', function ($sp) use ($request) {
                                    $sp->where('product_name', 'like', '%' . $request->search_data . '%');
                                })
                                ->orWhereHas('serviceName.serviceName', function ($ss) use ($request) {
                                    $ss->where('service_name', 'like', '%' . $request->search_data . '%');
                                });
                            })->where('id', '>', $request->id)->with('product', 'serviceName')->take(9)->get();
                        } else { //$request->search_data == ''
                            //$products['search_data'] = 'search_data Naiiii';
                            $products = CorporateCustomerProduct::where('customer_id', $request->customer_id)->where('id', '>', $request->id)->with('product', 'serviceName')->take(9)->get();
                        }
                    } else { // $customer->customer_type != "Corporate"
                        //$products['customer_type'] = 'Dhekar Dorkar Nai';
                        if($request->search_data != '') { //$request->search_data != ''
                            //$products['search_data'] = 'Aceeee';
                            $products = ProductService::where(function ($q) use ($request) {
                                $q->whereHas('branches', function ($sb) use ($request) {
                                    $sb->where('laundry_branch_id', $request->branch_id);
                                })
                                ->whereHas('product', function ($sp) use ($request) {
                                    $sp->where('product_name', 'like', '%' . $request->search_data . '%');
                                })
                                ->orWhereHas('serviceName', function ($ss) use ($request) {
                                    $ss->where('service_name', 'like', '%' . $request->search_data . '%');
                                });
                            })->where('id', '>', $request->id)->with('product', 'serviceName', 'branches')->take(9)->get();
                        } else {// $request->search_data == ''
                            //$products['search_data'] = 'search_data Naiiii';
                            $products = ProductService::where(function ($q) use ($request) {
                                $q->whereHas('branches', function ($sq) use ($request) {
                                    $sq->where('laundry_branch_id', $request->branch_id);
                                })
                                ->whereHas('product', function ($sp) use ($request) {
                                    $sp->where('product_show_id', 1)
                                    ->orWhere('product_show_id', 3);
                                });
                            })->where('id', '>', $request->id)->with('product', 'serviceName', 'branches')->take(9)->get();
                        }
                    }
                }
            }
        } else { // id null
            if($request->branch_id != '') {
                //$products['branch_id'] = 'Aceeeee';
                // on load product asbe
                $products = ProductService::where(function ($q) use ($request) {
                    $q->whereHas('branches', function ($sq) use ($request) {
                        $sq->where('laundry_branch_id', $request->branch_id);
                    })
                    ->whereHas('product', function ($sp) use ($request) {
                        $sp->where('product_show_id', 1)
                        ->orWhere('product_show_id', 3);
                    });
                })->with('product', 'serviceName', 'branches')->take(9)->get();

                if($request->customer_id != '') { // $request->customer_id != ''
                    // find customer type
                    //$products['customer_id'] = 'Aceeee';
                    $customer = Customer::where('id', $request->customer_id)->first();
                    if($customer->customer_type === "Corporate") { //$customer->customer_type == "Corporate"
                        //$products['customer_type'] = 'Corportae';
                        $customer['corporate'] = true;
                        if($request->search_data != '') { //$request->search_data != ''
                            $products['search_data'] = 'Aceeee';
                            $products = CorporateCustomerProduct::where(function ($q) use ($request) {
                                $q->where('customer_id', $request->customer_id)
                                ->whereHas('product', function ($sp) use ($request) {
                                    $sp->where('product_name', 'like', '%' . $request->search_data . '%');
                                })
                                ->orWhereHas('serviceName.serviceName', function ($ss) use ($request) {
                                    $ss->where('service_name', 'like', '%' . $request->search_data . '%');
                                });
                            })->with('product', 'serviceName')->take(9)->get();
                        } else { //$request->search_data == ''
                            //$products['search_data'] = 'search_data Naiiii';
                            $products = CorporateCustomerProduct::where('customer_id', $request->customer_id)->with('product', 'serviceName')->take(9)->get();
                        }
                    } else { // $customer->customer_type != "Corporate"
                        //$products['customer_type'] = 'Dhekar Dorkar Nai';
                        if($request->search_data != '') { //$request->search_data != ''
                            //$products['search_data'] = 'Aceeee';
                            $products = ProductService::where(function ($q) use ($request) {
                                $q->whereHas('branches', function ($sb) use ($request) {
                                    $sb->where('laundry_branch_id', $request->branch_id);
                                })
                                ->whereHas('product', function ($sp) use ($request) {
                                    $sp->where('product_name', 'like', '%' . $request->search_data . '%');
                                })
                                ->orWhereHas('serviceName', function ($ss) use ($request) {
                                    $ss->where('service_name', 'like', '%' . $request->search_data . '%');
                                });
                            })->with('product', 'serviceName', 'branches')->take(9)->get();
                        } else {// $request->search_data == ''
                            //$products['search_data'] = 'search_data Naiiii';
                            $products = ProductService::where(function ($q) use ($request) {
                                $q->whereHas('branches', function ($sq) use ($request) {
                                    $sq->where('laundry_branch_id', $request->branch_id);
                                })
                                ->whereHas('product', function ($sp) use ($request) {
                                    $sp->where('product_show_id', 1)
                                    ->orWhere('product_show_id', 3);
                                });
                            })->with('product', 'serviceName', 'branches')->take(9)->get();
                        }
                    }
                }
            }
        }*/
        // previous
        // okk dokka
        //return response()->json($products);



        // okk dokka
        if($request->id > 0) {
            if($request->branch_id != '') {
                //$products['branch_id'] = 'Aceeeee';
                // on load product asbe
                $products = ProductService::where(function ($q) use ($request) {
                    $q->whereHas('branches', function ($sq) use ($request) {
                        $sq->where('laundry_branch_id', $request->branch_id);
                    })
                    ->whereHas('product', function ($sp) use ($request) {
                        $sp->where('product_show_id', 1)
                        ->orWhere('product_show_id', 3);
                    });
                })->where('id', '>', $request->id)->with('product', 'serviceName', 'branches')->take(9)->get();

                if($request->customer_id != '') { // $request->customer_id != ''
                    // find customer type
                    //$products['customer_id'] = 'Aceeee';
                    $customer = Customer::where('id', $request->customer_id)->first();
                    if($customer->customer_type === "Corporate") { //$customer->customer_type == "Corporate"
                        //$products['customer_type'] = 'Corportae';
                        $customer['corporate'] = true;
                        if($request->search_data != '') { //$request->search_data != ''
                            //$products['search_data'] = 'Aceeee';
                            $products = ProductService::where(function ($q) use ($request) {
                                $q->whereHas('branches', function ($sb) use ($request) {
                                    $sb->where('laundry_branch_id', $request->branch_id);
                                })
                                ->whereHas('product', function ($sp) use ($request) {
                                    $sp->where('product_name', 'like', '%' . $request->search_data . '%')
                                       ->where('product_show_id', 2)
                                       ->orWhere('product_show_id', 3)
                                       ->orWhereHas('category', function($sc) use ($request) {
                                        $sc->where('slug', 'like', '%' . $request->search_data . '%');
                                       });
                                })
                                ->orWhereHas('serviceName', function ($ss) use ($request) {
                                    $ss->where('service_name', 'like', '%' . $request->search_data . '%');
                                });
                            })->where('id', '>', $request->id)->with('product', 'serviceName', 'branches')->take(9)->get();
                        } else { //$request->search_data == ''
                            //$products['search_data'] = 'search_data Naiiii';
                            $products = ProductService::where(function ($q) use ($request) {
                                $q->whereHas('branches', function ($sq) use ($request) {
                                    $sq->where('laundry_branch_id', $request->branch_id);
                                })
                                ->whereHas('product', function ($sp) use ($request) {
                                    $sp->where('product_show_id', 2)
                                    ->orWhere('product_show_id', 3);
                                });
                            })->where('id', '>', $request->id)->with('product', 'serviceName', 'branches')->take(9)->get();
                        }
                    } else { // $customer->customer_type != "Corporate"
                        //$products['customer_type'] = 'Dhekar Dorkar Nai';
                        if($request->search_data != '') { //$request->search_data != ''
                            //$products['search_data'] = 'Aceeee';
                            $products = ProductService::where(function ($q) use ($request) {
                                $q->whereHas('branches', function ($sb) use ($request) {
                                    $sb->where('laundry_branch_id', $request->branch_id);
                                })
                                ->whereHas('product', function ($sp) use ($request) {
                                    $sp->where('product_name', 'like', '%' . $request->search_data . '%')
                                       ->where('product_show_id', 1)
                                       ->orWhere('product_show_id', 3)
                                       ->orWhereHas('category', function($sc) use ($request) {
                                        $sc->where('slug', 'like', '%' . $request->search_data . '%');
                                       });
                                })
                                ->orWhereHas('serviceName', function ($ss) use ($request) {
                                    $ss->where('service_name', 'like', '%' . $request->search_data . '%');
                                });
                            })->where('id', '>', $request->id)->with('product', 'serviceName', 'branches')->take(9)->get();
                        } else {// $request->search_data == ''
                            //$products['search_data'] = 'search_data Naiiii';
                            $products = ProductService::where(function ($q) use ($request) {
                                $q->whereHas('branches', function ($sq) use ($request) {
                                    $sq->where('laundry_branch_id', $request->branch_id);
                                })
                                ->whereHas('product', function ($sp) use ($request) {
                                    $sp->where('product_show_id', 1)
                                    ->orWhere('product_show_id', 3);
                                });
                            })->where('id', '>', $request->id)->with('product', 'serviceName', 'branches')->take(9)->get();
                        }
                    }
                }
            }
        } else { // id null
            if($request->branch_id != '') {
                //$products['branch_id'] = 'Aceeeee';
                // on load product asbe
                $products = ProductService::where(function ($q) use ($request) {
                    $q->whereHas('branches', function ($sq) use ($request) {
                        $sq->where('laundry_branch_id', $request->branch_id);
                    })
                    ->whereHas('product', function ($sp) use ($request) {
                        $sp->where('product_show_id', 1)
                        ->orWhere('product_show_id', 3);
                    });
                })->with('product', 'serviceName', 'branches')->take(9)->get();

                if($request->customer_id != '') { // $request->customer_id != ''
                    // find customer type
                    //$products['customer_id'] = 'Aceeee';
                    $customer = Customer::where('id', $request->customer_id)->first();
                    if($customer->customer_type === "Corporate") { //$customer->customer_type == "Corporate"
                        //$products['customer_type'] = 'Corportae';
                        $customer['corporate'] = true;
                        if($request->search_data != '') { //$request->search_data != ''
                            //$products['search_data'] = 'Aceeee';
                            $products = ProductService::where(function ($q) use ($request) {
                                $q->whereHas('branches', function ($sb) use ($request) {
                                    $sb->where('laundry_branch_id', $request->branch_id);
                                })
                                ->whereHas('product', function ($sp) use ($request) {
                                    $sp->where('product_name', 'like', '%' . $request->search_data . '%')
                                       ->where('product_show_id', 2)
                                       ->orWhere('product_show_id', 3)
                                       ->orWhereHas('category', function($sc) use ($request) {
                                        $sc->where('slug', 'like', '%' . $request->search_data . '%');
                                       });
                                })
                                ->orWhereHas('serviceName', function ($ss) use ($request) {
                                    $ss->where('service_name', 'like', '%' . $request->search_data . '%');
                                });
                            })->with('product', 'serviceName', 'branches')->take(9)->get();
                        } else { //$request->search_data == ''
                            //$products['search_data'] = 'search_data Naiiii';
                            $products = ProductService::where(function ($q) use ($request) {
                                $q->whereHas('branches', function ($sq) use ($request) {
                                    $sq->where('laundry_branch_id', $request->branch_id);
                                })
                                ->whereHas('product', function ($sp) use ($request) {
                                    $sp->where('product_show_id', 2)
                                    ->orWhere('product_show_id', 3);
                                });
                            })->with('product', 'serviceName', 'branches')->take(9)->get();
                        }
                    } else { // $customer->customer_type != "Corporate"
                        //$products['customer_type'] = 'Dhekar Dorkar Nai';
                        if($request->search_data != '') { //$request->search_data != ''
                            //$products['search_data'] = 'Aceeee';
                            $products = ProductService::where(function ($q) use ($request) {
                                $q->whereHas('branches', function ($sb) use ($request) {
                                    $sb->where('laundry_branch_id', $request->branch_id);
                                })
                                ->whereHas('product', function ($sp) use ($request) {
                                    $sp->where('product_name', 'like', '%' . $request->search_data . '%')
                                       ->where('product_show_id', 1)
                                       ->orWhere('product_show_id', 3)
                                       ->orWhereHas('category', function($sc) use ($request) {
                                        $sc->where('slug', 'like', '%' . $request->search_data . '%');
                                       });
                                })
                                ->orWhereHas('serviceName', function ($ss) use ($request) {
                                    $ss->where('service_name', 'like', '%' . $request->search_data . '%');
                                });
                            })->with('product', 'serviceName', 'branches')->take(9)->get();
                        } else {// $request->search_data == ''
                            //$products['search_data'] = 'search_data Naiiii';
                            $products = ProductService::where(function ($q) use ($request) {
                                $q->whereHas('branches', function ($sq) use ($request) {
                                    $sq->where('laundry_branch_id', $request->branch_id);
                                })
                                ->whereHas('product', function ($sp) use ($request) {
                                    $sp->where('product_show_id', 1)
                                    ->orWhere('product_show_id', 3);
                                });
                            })->with('product', 'serviceName', 'branches')->take(9)->get();
                        }
                    }
                }
            }
        }
        // okk dokka
        //return response()->json($products);




        $last_id = '';
        $output = '<div class="row">';
        foreach($products as $product) {
            $product_name = $product->product->product_name ?? '';
            $product_image = $product->product->image ?? 'public/avatar/avatar.png';
            $service_name  = $product->serviceName->service_name ?? '';

            $output .= '<div class="col-md-4 mb-3">
                <div class="border border-success rounded" style="height: 170px;">
                    <div class="p-1">
                        <div class="product-name">
                            <b>'. $product_name .'</b> - '. $service_name .'
                        </div>
                        <div class="">
                            <div class="product_img">
                                <img class="" src="'. URL($product_image) .'"
                                alt="" height="60" width="80">
                            </div>
                            <div class="text-center product_btn">
                                <button type="button" class="btn btn-sm btn-success add_to_sale"
                                    data-id="'. $product->id .'" id="add-to-cart">
                                    <i class="fa fa-plus" aria-hidden="true"></i>
                                    Add to Cart
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>';
            $last_id = $product->id;
        }
        $output .= '</div>';

        if(count($products) >= 8) {
            $output .= '<div class="col-md-11 load-more text-center mt-4 mb-2">
                            <div class="">
                                <button type="button" name="load_more_btn" class="btn-sm btn btn-link"
                                    data-lid="'. $last_id .'" id="load_more_btn">Load
                                    More</button>
                            </div>
                        </div>';
        }

        return $output;

        /*if($request->branch_id != '') {
            $products['branch_id'] = 'Aceeeee';
            if($request->customer_id != '') { // $request->customer_id != ''
                // find customer type
                $products['customer_id'] = 'Aceeee';
                $customer = Customer::where('id', $request->customer_id)->first();
                if($customer->customer_type === "Corporate") { //$customer->customer_type == "Corporate"
                    $products['customer_type'] = 'Corportae';
                    if($request->search_data != '') { //$request->search_data != ''
                        $products['search_data'] = 'Aceeee';
                    } else { //$request->search_data == ''
                        $products['search_data'] = 'search_data Naiiii';
                    }
                } else { // $customer->customer_type != "Corporate"
                    $products['customer_type'] = 'Dhekar Dorkar Nai';
                    if($request->search_data != '') { //$request->search_data != ''
                        $products['search_data'] = 'Aceeee';
                    } else {// $request->search_data == ''
                        $products['search_data'] = 'search_data Naiiii';
                    }
                }
            }
        }*/
    }

    public function product_details(Request $request) {
        if($request->customer_id == '0') {
            $request->merge([
                'customer_id' => 1,
            ]);
        }
        $customer_bool = false;

        $customer = Customer::where('id', $request->customer_id)->first();

        if($customer->customer_type === "Corporate") {
            /*$product = CorporateCustomerProduct::where('id', $request->id)->with('product', 'serviceName')->first();
            $customer = true;*/
            $product = ProductService::where('id', $request->id)->first();
            $discount = CorporateCustomerProduct::where('customer_id', $request->customer_id)->where('product_id', $product->laundry_product_id)->where('service_id', $product->laundry_service_id)->with('product', 'serviceName')->first();

            if($discount) {
                $product = $discount;
                $customer_bool = true;
            } else {
                $product = ProductService::where('id', $request->id)->with('branches', 'product', 'serviceName')->first();
            }
        } else {
            $product = ProductService::where('id', $request->id)->with('branches', 'product', 'serviceName')->first();
        }

        return response()->json(['customer' => $customer_bool, 'data' => $product]);
    }

    public function quickSaleLaundryStore(Request $request) {
        //return $request->all();

        $request->validate([
            'branch_id' => 'required',
            'customer_id' => 'required',
            'booking_date' => 'required',
            'invoice_no' => 'required',
            'service_id.*' => 'required',
            'product_id.*' => 'required',
            'space.*' => 'required',
            'price_per_space.*' => 'required',
            'payment_method' => 'required',
            'grand_total' => 'required',
        ]);

        $length = sizeof($request->service_id);
        //return $length;

        $order = new Order();
        $order->order_datetime = date('Y-m-d', strtotime($request->booking_date));
        $order->customer_id = $request->customer_id;
        $order->branch_id = $request->branch_id;
        $order->payment_method_id = 1;
        $order->picked_time = date('Y-m-d H:i:s');
        $order->origin = 'Quick';       
        $order->order_status = 10;       
        $order->payment_method_info = $request->payment_method;       
        $order->invoice_no = $request->invoice_no;
        $order->save();
        $orderId = $order->id;

    if($orderId) {
        for($i = 0; $i<$length; $i++) {
        
                //product service
                $productService = ProductService::where('laundry_product_id', $request->product_id[$i])->where('laundry_service_id', $request->service_id[$i])->first();
    
                //product
                $product = LaundryProduct::where('id', $request->product_id[$i])->first();
    
                //get discount
                $discount = 0;
                $discountInfo = LaundryDiscount::where('product_id', $request->product_id[$i])
                                                    ->where('customer_id', $request->customer_id)
                                                    ->where('status', 1)
                                                    ->where('product_service_id', $request->service_id[$i])
                                                    ->first();
                if($discountInfo) {
                    $discount = (($productService->amount * $request->space[$i]) * $discountInfo->discount) / 100;
                }
    
                $orderItem = new OrderItem();
                $orderItem->order_id = $orderId;
                $orderItem->customer_id = $request->customer_id;
                $orderItem->product_id = $request->product_id[$i];
                $orderItem->qty = $request->space[$i];
                $orderItem->shipping_charge = $product->shipping_charge ? $product->shipping_charge : 0;
                $orderItem->service_id = $request->service_id[$i];
                $orderItem->service_amount = $request->price_per_space[$i];
                $orderItem->service_discount = $discount;
                $orderItem->total = ($request->price_per_space[$i] * $request->space[$i]) + ($product->shipping_charge ? $product->shipping_charge : 0) - $discount;
                $orderItem->save();
    
                //shipping
                $shipping = CustomerAddress::where('customer_id', $request->customer_id)->first();
    
                //order shipping
                if($shipping) {
                    $storeShipping = new OrderShipping();
                    $storeShipping->order_id = $orderId;
                    $storeShipping->type = $shipping->type;
                    $storeShipping->fullname = $shipping->fullname;
                    $storeShipping->mobile_no = $shipping->mobile_no;
                    $storeShipping->region_id = $shipping->region_id;
                    $storeShipping->city_id = $shipping->city_id;
                    $storeShipping->area_id = $shipping->area_id;
                    $storeShipping->address = $shipping->address;
                    $storeShipping->save();
                }

                //billing
                $billing = CustomerAddress::where('customer_id', $request->customer_id)->first();
    
                if($billing) {
                    //order billing
                    $storeBilling = new OrderBilling();
                    $storeBilling->order_id = $orderId;
                    $storeBilling->type = $billing->type;
                    $storeBilling->fullname = $billing->fullname;
                    $storeBilling->mobile_no = $billing->mobile_no;
                    $storeBilling->region_id = $billing->region_id;
                    $storeBilling->city_id = $billing->city_id;
                    $storeBilling->area_id = $billing->area_id;
                    $storeBilling->address = $billing->address;
                    $storeBilling->save();
                }
    
                $this->addLog(Auth::id(), 1, 'Quick order add', $orderId);
                // Toastr::success('Order placed successful');
            } 
          Toastr::success('Order placed successful');
        } else {
            Toastr::error('Something was wrong');
        }
        return redirect()->back();
    }

    /*..............Quick Sale................*/
    
}
