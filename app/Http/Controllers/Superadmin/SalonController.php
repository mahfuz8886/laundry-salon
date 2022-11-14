<?php

namespace App\Http\Controllers\Superadmin;

use Illuminate\Support\Facades\File;
use App\AccountHead;
use App\Customer;
use App\CustomerAddress;
use App\Employee;
use App\EmployeeService;
use App\helper\CustomHelper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Hub;
use App\InventoryLog;
use App\LaundryDiscount;
use App\LaundryItem;
use App\LaundryProduct;
use Brian2694\Toastr\Facades\Toastr;
use App\LaundryProductCategory;
use App\LaundryProductService;
use App\LaundryProductBranch;
use App\LaundryProductUse;
use App\Order;
use App\OrderBilling;
use App\OrderItem;
use App\OrderShipping;
use App\ProductService;
use App\SalonBooking;
use App\SalonBookingItem;
use App\SalonServiceCost;
use App\SalonCategory;
use App\SalonDiscount;
use App\SalonInventoryLog;
use App\SalonItem;
use App\SalonOrderEmployee;
use App\SalonParentService;
use App\SalonProductUse;
use App\SalonService;
use App\SalonTransaction;
use App\SalonTransactions;
use Employe;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class SalonController extends Controller
{
    public function addCategory() {
        $categories = SalonCategory::where('status','!=','Deleted')->orderBy('id','desc')->get();
        return view('backEnd.salon.add_category',compact('categories'));
    }

    public function storeCategory(Request $request) {

        $validated = $request->validate([
            'cat_name' => 'required|max:255',
            'status' => 'required',
        ]);

        $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $request->cat_name)));

        $store_data = new SalonCategory();

        if($request->file('image')){
            $store_data->image = $this->fileUpload($request->file('image'),'public/uploads/salonproduct/',350, 300);
        }else {
            Toastr::error('Image required');
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
        $category = SalonCategory::where('id', $id)->first();
        $categories = SalonCategory::where('status','!=','Deleted')->orderBy('id','desc')->get();
        return view('backEnd.salon.update_category',compact('category','categories'));
    }

    public function updateCategory(Request $request) {

        $validated = $request->validate([
            'cat_name' => 'required|max:255',
            'status' => 'required',
        ]);

        $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $request->cat_name)));
        $update_data = SalonCategory::where('id', $request->id)->first();

        if($request->file('image')){
            $update_data->image = $this->fileUpload($request->file('image'),'public/uploads/salonproduct/',350, 300);
        }

        $update_data->cat_name = $request->cat_name;
        $update_data->slug = $slug;
        $update_data->status = $request->status;

        $updres = $update_data->save();
        if($updres) {
            Toastr::success('Category updated successfully');
            return redirect('superadmin/salon/add_category');
        }else {
            Toastr::error('Update fail');
            return redirect()->back();
        }
    }


    /*...........parent service.............*/
    public function addParentService() {
        $parentServices = SalonParentService::where('status','!=',3)->orderBy('id','desc')->with('category')->get();
        
        return view('backEnd.salon.add_parent_service',compact('parentServices'));
    }

    public function storeParentService(Request $request) {

        $validated = $request->validate([
            'service_name' => 'required|max:255| unique:salon_parent_services,service_name',
            'category_id' => 'required',
            'status' => 'required',
        ]);

        $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $request->service_name)));

        $store_data = new SalonParentService();

        if($request->file('image')){
            $store_data->image = $this->fileUpload($request->file('image'),'public/uploads/salonproduct/',350, 300);
        }else {
            Toastr::error('Image required');
            return redirect()->back();
        }


        $store_data->service_name = $request->service_name;
        $store_data->category_id = $request->category_id;
        $store_data->slug = $slug;
        $store_data->status = $request->status;
        $store_data->save();

        $ins = $store_data->id;
        if($ins) {
            Toastr::success('Parent service added successfully');
            return redirect()->back();
        }else {
            Toastr::error('Something was wrong');
            return redirect()->back();
        }
    }

    public function getParentService($id) {
        $pservice = SalonParentService::where('id', $id)->with('category')->first();
        $pservices = SalonParentService::where('status','!=',3)->orderBy('id','desc')->get();
        return view('backEnd.salon.update_parent_service',compact('pservice','pservices'));
    }

    public function updateParentService(Request $request) {

        $validated = $request->validate([
            'service_name' => 'required|max:255| unique:salon_parent_services,service_name,'.$request->id,
            'category_id' => 'required',
            'status' => 'required',
        ]);

        $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $request->service_name)));
        $update_data = SalonParentService::where('id', $request->id)->first();

        if($request->file('image')){
            $update_data->image = $this->fileUpload($request->file('image'),'public/uploads/salonproduct/',350, 300);
        }

        $update_data->service_name = $request->service_name;
        $update_data->category_id = $request->category_id;
        $update_data->slug = $slug;
        $update_data->status = $request->status;
        $update_data->save();
        $updres = $update_data->id;
        if($updres) {
            Toastr::success('Parent service updated successfully');
            return redirect('superadmin/salon/add_parent_service');
        }else {
            Toastr::error('Update fail');
            return redirect()->back();
        }
    }



    /*.............service.............*/
    public function addService() {
        $categories = SalonCategory::where('status', 'Active')->get();
        return view('backEnd.salon.add_service', compact('categories'));
    }

    public function storeService(Request $request) {
        // dd($request->all());
        $validated = $request->validate([
            'service_name' => 'required|max:255 | unique:salon_services,service_name',
            'category_id' => 'required',
            'parent_service_id' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',
            'duration' => 'required | numeric',
            'price_per_space' => 'required | numeric',
            'allow_multiple_booking' => 'required',
            'description' => 'required | max:500',
            'status' => 'required',
            'image' => 'required|image',
            'item' => 'required',
            'qty' => 'required'
        ]);

        $schedule = array();
        $temp = date('H:i:s', strtotime($request->start_time));
        $start = date('H:i:s', strtotime($request->start_time));
        $end = date('H:i:s', strtotime($request->end_time));

        while($temp < $end) {
            $temp = date('H:i:s', strtotime($temp."+ ".$request->duration." minutes"));
            $schedule[] = $start.'-'.$temp;
            $start = $temp;
        } 

        $replaceString = str_replace(array('[',']','"'),'', json_encode($schedule));

        $storeService = new SalonService();
        $storeService->category_id = $request->category_id;
        $storeService->parent_service_id = $request->parent_service_id;
        $storeService->service_name = $request->service_name;
        $storeService->start_time = date('H:i:s', strtotime($request->start_time));
        $storeService->end_time = date('H:i:s', strtotime($request->end_time));
        $storeService->duration = $request->duration;
        $storeService->schedule = $replaceString;
        $storeService->price_per_space = $request->price_per_space;
        $storeService->allow_multiple_booking = $request->allow_multiple_booking;
        $storeService->description = $request->description;
        $storeService->status = $request->status;
        if ($request->hasFile('image')) {
            $storeService->image = $this->fileUpload($request->image, 'public/uploads/salon service/', 200, 200);
         }
        $storeService->save();
        $ins = $storeService->id;
        if($ins) {

            //insert service cost
            $itemLength = sizeof($request->item);
            $items = $request->item;
            $qtys = $request->qty;

            for ($i=0; $i < $itemLength; $i++) { 
                $cost_store = new SalonServiceCost();
                $temItem = explode(',', $items[$i]);

                $cost_store->service_id = $ins;
                $cost_store->item_id = $temItem[0];
                $cost_store->branch_id = $temItem[1];
                $cost_store->qty = $qtys[$i];
                $cost_store->status = 1;
                $cost_store->save();
            }



            Toastr::success('Service added successfully');
            return redirect()->back();
        }else {
            Toastr::error('Something was wrong');
            return redirect()->back();
        }
    }

    public function manageService(Request $request) {
        $services = SalonService::orderBy('id', 'desc')->with('category')->paginate(10);
        return view('backEnd.salon.manage_service', compact('services'));
    }

    public function getService($id) {
        $service = SalonService::where('id', $id)->with('category')->first();
        $categories = SalonCategory::where('status', 'Active')->get();
        $costs = SalonServiceCost::where('service_id', $id)->where('status', 1)->get();
        return view('backEnd.salon.update_service',compact('service', 'categories','costs'));
    }

    public function updateService(Request $request) {

        $validated = $request->validate([
            'service_name' => 'required|max:255 | unique:salon_services,service_name,'.$request->id,
            'category_id' => 'required',
            'parent_service_id' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',
            'duration' => 'required | numeric',
            'price_per_space' => 'required | numeric',
            'allow_multiple_booking' => 'required',
            'description' => 'required | max:500',
            'status' => 'nullable',
            'image' => 'required|image',
            'item' => 'required',
            'qty' => 'required'
        ]);

        $schedule = array();
        $temp = date('H:i:s', strtotime($request->start_time));
        $start = date('H:i:s', strtotime($request->start_time));
        $end = date('H:i:s', strtotime($request->end_time));

        while($temp < $end) {
            $temp = date('H:i:s', strtotime($temp."+ ".$request->duration." minutes"));
            $schedule[] = $start.'-'.$temp;
            $start = $temp;
        } 

        $replaceString = str_replace(array('[',']','"'),'', json_encode($schedule));

        $storeService = SalonService::where('id', $request->id)->first();
        $storeService->category_id = $request->category_id;
        $storeService->parent_service_id = $request->parent_service_id;
        $storeService->service_name = $request->service_name;
        $storeService->start_time = date('H:i:s', strtotime($request->start_time));
        $storeService->end_time = date('H:i:s', strtotime($request->end_time));
        $storeService->duration = $request->duration;
        $storeService->schedule = $replaceString;
        $storeService->price_per_space = $request->price_per_space;
        $storeService->allow_multiple_booking = $request->allow_multiple_booking;
        $storeService->description = $request->description;
        $storeService->status = $request->status;
        if($request->file('image')){
            if($storeService->image){
                File::delete($storeService->image);
            }
            $storeService->image = $this->fileUpload($request->file('image'),'public/uploads/salom service/', 200, 200);
        }
        $storeService->save();
        $ins = $storeService->id;

        if($ins) {

            //insert product service cost
            //inactive all cost item first
            $oldItems = SalonServiceCost::where('service_id', $request->id)->where('status', 1)->get();
            if($oldItems) {
                foreach ($oldItems as $key => $value) {
                    SalonServiceCost::where('item_id', $value->item_id)->where('service_id', $request->id)->update(['status'=> 0]);
                }
            }

            $itemLength = sizeof($request->item);
            $items = $request->item;
            $qtys = $request->qty;

            for ($i=0; $i < $itemLength; $i++) { 
                
                $temItem = explode(',', $items[$i]);

                $check = SalonServiceCost::where('item_id', $temItem[0])->where('service_id', $request->id)->first();
                if($check) {
                    $check->status = 1;
                    $check->save();
                    
                }else {
                    $cost_store = new SalonServiceCost();
                    $cost_store->service_id = $ins;
                    $cost_store->item_id = $temItem[0];
                    $cost_store->branch_id = $temItem[1];
                    $cost_store->qty = $qtys[$i];
                    $cost_store->status = 1;
                    $cost_store->save();
                }  
            }

            Toastr::success('Service updated successfully');
            return redirect('superadmin/salon/manage_service');
        }else {
            Toastr::error('Update fail');
            return redirect()->back();
        }
    }

    // order section
    public function orders(Request $request) {
        $branches = CustomHelper::getUserBranch();
        $bookings = SalonBooking::orderBy('id','desc')->where('origin', 'Online');
                    if($request->status != null) {
                        $bookings = $bookings->where('status', $request->status);
                    }
                    if($request->payment_status != null) {
                        $bookings = $bookings->where('paid_status', $request->payment_status);
                    }
                    if($request->order_id != null) {
                        $bookings = $bookings->where('id', $request->order_id);
                    }
                    if($request->date_from != null) {
                        $bookings = $bookings->where('created_at','>=', date('Y-m-d', strtotime($request->date_from)).' 00:00:00');
                    }
                    if($request->date_to != null) {
                        $bookings = $bookings->where('created_at','<=', date('Y-m-d', strtotime($request->date_to)).' 23:59:59');
                    }
                    if($branches) {
                        $bookings = $bookings->whereIn('branch_id', $branches);
                    }
        
        
                    $bookings = $bookings->with('statusName')->paginate(20);
        return view('backEnd.salon.booking.online_booking_list',compact('bookings'));
    }

    public function orderDetails($id) {
        
        $branches = CustomHelper::getUserBranch();
        $items = SalonInventoryLog::select('salon_inventory_logs.*')->groupBy(['item_id','branch_id'])->selectRaw('sum(quantity) as sum, item_id')->where('quantity', '>', 0)->where('in_out','In');
                if($branches != null) {
                    $items = $items->whereIn('branch_id', $branches);
                }
                $items = $items->with('item')->with('unit')->get();

        $booking = SalonBooking::where('id', $id)
                ->with('customer')
                ->with('address')
                ->first();

        $bookingItems = SalonBookingItem::where('booking_id', $id)->with('service')->get();
        //return $bookingItems;
        
        //return view('backEnd.salon.booking.booking_details',compact('booking','bookingItems', 'bookings'));
        return view('backEnd.salon.booking.booking_details',compact('booking','bookingItems'));
    }

    public function orderUpdate(Request $request,$orderId) {
        $validate = $request->validate([
            'status' => 'required'
        ]);
        
        $orderInfo = SalonBooking::where('id', $orderId)->first();

        switch($request->status) {
            case 10: 
                $orderInfo->status = $request->status;
                $orderInfo->save();
                break;
            case 11: 
                // if(!$request->employee) {
                //     Toastr::error('Please select at least one employee');
                //     return redirect()->back();
                // }

                // $length = sizeof($request->employee);
                // $employees = $request->employee;
                // for($i = 0; $i < $length; $i++) {
                //     $storOrderEmp = new SalonOrderEmployee();
                //     $storOrderEmp->order_id = $orderId;
                //     $storOrderEmp->employee_id = $employees[$i];
                //     $storOrderEmp->save();
                // }

                $orderInfo->status = $request->status;
                $orderInfo->save();
                break;
            case 12:
                
                $orderItems = SalonBookingItem::where('booking_id', $orderId)->get();
                //return $orderItems;

                if($orderItems) {
                    foreach($orderItems as $oitem) {
                        $costItem = SalonServiceCost::where('service_id', $oitem->service_id)->where('status', 1)->get();
                        //$costItem = SalonServiceCost::where('service_id', 4)->where('status', 1)->get();
                        //return $costItem;
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
                
                $orderInfo->status = $request->status;
                $orderInfo->save();

                //account transactions
                $bitems = SalonBookingItem::where('booking_id', $orderId)->get();
                $totalCost = $bitems->sum('total');

                $acHead = AccountHead::where('user_id', $orderInfo->customer_id)->where('head_type', 1)->first();

                if($acHead) {
                    $storeTrans = new SalonTransaction();
                    $storeTrans->account_head_id = $acHead->id;
                    $storeTrans->transaction_type = 2;
                    $storeTrans->amount = $totalCost;
                    $storeTrans->in_out  = 2;//out for customer(jeheto service book kortece)
                    $storeTrans->status  = 1;
                    $storeTrans->ref_table_id = $orderId;
                    $storeTrans->save();
                }

                foreach($bitems as $bitem) {
                    $employeeInfo = Employee::where('id', $bitem->employee_id)->first();
                    $acHead = AccountHead::where('user_id', $bitem->employee_id)->where('head_type', 7)->first();

                    $empAmount = 0;
                    $empAmount = ($bitem->total * $employeeInfo->commission) / 100;

                    $storeETrans = new SalonTransaction();
                    $storeETrans->account_head_id = $acHead->id;
                    $storeETrans->transaction_type = 3;
                    $storeETrans->amount = $empAmount;
                    $storeETrans->in_out  = 1;// in for employee(jeheto commission add hocce)
                    $storeETrans->status  = 1;
                    $storeETrans->ref_table_id = $bitem->id;
                    $storeETrans->save();
                }

                break; // case 12 end
        }

        Toastr::success('Status update successful');
        return redirect()->back();

    }


    public function orderCancel($orderId) {
        $order = SalonBooking::where('id', $orderId)->update([
            'status' => 9
        ]);
        
        if($order) {
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
        $categories = SalonCategory::where('status', 'Active')->get();

        $branches = CustomHelper::getUserBranch();
        if($branches) {
            $allBranch = Hub::where('status', 1)->whereIn('id', $branches)->get();
        }else {
            $allBranch = Hub::where('status', 1)->get();
        }

        return view('backEnd.salon.booking.booking_add', compact('customers', 'categories','allBranch'));
    }

    public function storeOrders(Request $request) {
        
        $request->validate([
            'customer' => 'required',
            'category' => 'required',
            'branch_id' => 'required',
            'service' => 'required',
            'customer_address' => 'required',
            'booking_date' => 'required',
            'employee' => 'required',
            'time_schedule' => 'required',
            'space' => 'required'
        ]);

        $categories = $request->category;
        $legth = sizeof($categories);
        $services = $request->service;
        $schedules = $request->time_schedule;
        $spaces = $request->space;
        $employees = $request->employee;
        $bookingDates = $request->booking_date;
    
        //time slot is available now isert booking

        //check some validation
        //check service is available or not
        $check = SalonBooking::where('branch_id', $request->branch_id)
            ->whereIn('status', array(1,10,11))
            ->first();

        if($check) {
            for ($i=0; $i < $legth; $i++) { 
                
                //get service
                $serviceInfo = SalonService::where('id', $services[$i])->first();
                
                //check time schedul
                $item = SalonBookingItem::where('service_id', $services[$i])
                        ->where('time_schedule', $schedules[$i])
                        ->where('booking_date', date('Y-m-d', strtotime($bookingDates[$i])))
                        ->where('employee_id', $employees[$i])
                        ->first();
                if($item) {
                    //time slot is not available
                    //check multiple booking allow or not
                    if(!$serviceInfo->allow_multiple_booking) {
                        Toastr::error('Time slot is not availabe for '.$serviceInfo->service_name.' in given date. Please try another time slot.');
                        return redirect()->back();
                    }
                }
                
                //check multiple space allow or not
                if($spaces[$i] > 1) {
                    if(!$serviceInfo->allow_multiple_booking) {
                        Toastr::error('Multiple space at a time not allowed for '.$serviceInfo->service_name);
                        return redirect()->back();
                    }
                }
            }
        }

        $booking = new SalonBooking();
        $booking->customer_id = $request->customer;
        $booking->customer_address_id = $request->customer_address;
        $booking->branch_id = $request->branch_id;
        $booking->origin = 'Offline';
        $booking->status = 1;
        $booking->save();
        $bookingId = $booking->id;
        if($bookingId) {

            //booking items
            for ($i=0; $i < $legth; $i++) { 
            
                //get service
                $serviceInfo = SalonService::where('id', $services[$i])->first();
                //get discount
                $discount = 0;
                $discountInfo = SalonDiscount::where('customer_id', $request->customer)
                                ->where('status', 1)
                                ->where('service_id', $services[$i])
                                ->first();

                if($discountInfo) {
                    $discount = (($serviceInfo->price_per_space * $spaces[$i]) * $discountInfo->discount) / 100;
                    $discount = round($discount);
                }


                $storeItem = new SalonBookingItem();
                $storeItem->booking_id = $bookingId;
                $storeItem->category_id = $serviceInfo->category_id;
                $storeItem->booking_date = date('Y-m-d', strtotime($bookingDates[$i]));
                $storeItem->customer_id = $request->customer;
                $storeItem->service_id = $services[$i];
                $storeItem->space = $spaces[$i];
                $storeItem->space_amount = $serviceInfo->price_per_space;
                $storeItem->discount = $discount;
                $storeItem->time_schedule = $schedules[$i];
                $storeItem->total = ($serviceInfo->price_per_space * $spaces[$i]) - $discount;
                $storeItem->employee_id = $employees[$i];
                $storeItem->save();
            }
            Toastr::success('Booking successful');

        }else {
            Toastr::error('Something was wrong');
        }
        return redirect()->back();
    }


    public function manageOfflineOrders(Request $request) {
        $branches = CustomHelper::getUserBranch();
        $bookings = SalonBooking::orderBy('id','desc')->where('origin', 'Offline');
                    if($request->status != null) {
                        $bookings = $bookings->where('status', $request->status);
                    }
                    if($request->payment_status != null) {
                        $bookings = $bookings->where('paid_status', $request->payment_status);
                    }
                    if($request->order_id != null) {
                        $bookings = $bookings->where('id', $request->order_id);
                    }
                    if($request->date_from != null) {
                        $bookings = $bookings->where('created_at','>=', date('Y-m-d', strtotime($request->date_from)).' 00:00:00');
                    }
                    if($request->date_to != null) {
                        $bookings = $bookings->where('created_at','<=', date('Y-m-d', strtotime($request->date_to)).' 23:59:59');
                    }
                    if($branches) {
                        $bookings = $bookings->whereIn('branch_id', $branches);
                    }
        
        
                    $bookings = $bookings->with('statusName')->paginate(20);
        return view('backEnd.salon.booking.booking_list',compact('bookings'));
    }

    public function manageQuickOrders(Request $request) {
        $branches = CustomHelper::getUserBranch();
        $bookings = SalonBooking::orderBy('id','desc')->where('origin', 'Quick');
        //$bookings = SalonBooking::orderBy('id','desc')->where('origin', 'Quick')->where('paid_status', 0);
        // return $request->all();
        if($request->status != null) {
            $bookings = $bookings->where('status', $request->status);
        }
        if($request->payment_status != null) {
            $bookings = $bookings->where('paid_status', $request->payment_status);
        }
        if($request->order_id != null) {
            $bookings = $bookings->where('id', $request->order_id);
        }
        if($request->date_from != null) {
            $bookings = $bookings->where('created_at','>=', date('Y-m-d', strtotime($request->date_from)).' 00:00:00');
        }
        if($request->date_to != null) {
            $bookings = $bookings->where('created_at','<=', date('Y-m-d', strtotime($request->date_to)).' 23:59:59');
        }
        if($branches) {
            $bookings = $bookings->whereIn('branch_id', $branches);
        }
        
        $bookings = $bookings->with('statusName')->paginate(10);
        //$bookings = $bookings->with('statusName')->get();
        return view('backEnd.salon.sale.sale_list',compact('bookings'));
    }


    //ajax function

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

    public function getSalonServices(Request $request) {
        $services = SalonService::where('category_id', $request->categoryId)->with('category')->get();
    
        if($services) {
            
            return $services;
        }
    }

    public function getServicesSchedule(Request $request) {
        $schedule = SalonService::where('id', $request->serviceId)->first();
        if($schedule) {
            $splitSchedule = explode(',', $schedule->schedule);
            $finalSchedule = array();
            foreach($splitSchedule as $item) {
                $exp = explode('-', $item);
                $finalSchedule[] = date('h:i a', strtotime($exp[0])).'-'.date('h:i a', strtotime($exp[1]));
            }
            return $finalSchedule;
        }
    }

    public function getServiceEmployee(Request $request) {
        $employees = EmployeeService::where('service_id', $request->serviceId)->where('status', 'Active')->with('employee')->get();
        return $employees;
    }

    public function getItemPrices(Request $request) {
        $prices = SalonInventoryLog::where('item_id', $request->itemId)->latest('buy_price')->first();
        if($prices) {
            return $prices;
        }
    }

    /*............offline order.............*/

    /*..............package................*/

    public function createPackage() {
        $branches = CustomHelper::getUserBranch();
        if($branches) {
            $allBranch = Hub::where('status', 1)->whereIn('id', $branches)->get();
        }else {
            $allBranch = Hub::where('status', 1)->get();
        }

        return view('backEnd.salon.package.add', compact('allBranch'));
    }

    public function storePackage(Request $request) {
        return 'store package';
    }

    public function managePackage(Request $request) {
        return 'manage package';
    }

    public function getPackage($id) {
        return 'get package';
    }

    public function updatePackage(Request $request) {
        return 'update package';
    }

    /*..............package................*/

    // ajax
    public function getParentServices(Request $request) {
        return SalonParentService::where('category_id', $request->cat_id)->get();
    }
}
