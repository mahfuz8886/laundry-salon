<?php

namespace App\Http\Controllers\Superadmin;

use App\AccountHead;
use App\Customer;
use App\CustomerAddress;
use App\Division;
use App\helper\CustomHelper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\InventoryLog;
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
use App\SalonBooking;
use App\SalonInventoryLog;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ReportController extends Controller
{

    public function laundrySummary(Request $request) {

        $request->validate([
            'date_from' => 'required_if:type,==,datewise',
            'date_to' => 'required_if:type,==,datewise',
        ]);

        $startDate = '';
        $endDate = '';

        $pendingOrders = array();
        $forDeliveryOrders = array();
        $readyForPickOrders = array();
        $deliveredOrders = array();
        $pickedOrders = array();
        $addInventories = array();
        $usesInventories = array();

        $totalPending = 0;
        $totalForDelivery = 0;
        $totalForPick = 0;
        $totalDelivered = 0;
        $totalPicked = 0;
        $totalAddInventory = 0;
        $totalUses = 0;


        if($request->type == 'today') {
            $startDate = date('Y-m-d').' 00:00:00';
            $endDate = date('Y-m-d').' 23:59:59';
        }elseif($request->type == 'datewise') {
            $startDate = date('Y-m-d', strtotime($request->date_from)).' 00:00:00';
            $endDate = date('Y-m-d', strtotime($request->date_to)).' 23:59:59';
        }else {
            $startDate = date('Y-m-d').' 00:00:00';
            $endDate = date('Y-m-d').' 23:59:59';
        }

        $branches = CustomHelper::getUserBranch();

        // if($request->type) {
            //get order info

            /*............pending orders..............*/
            $pendingOrders = Order::where('order_datetime','>=', $startDate)->where('order_datetime','<=', $endDate);
                            if($branches != null) {
                                $pendingOrders = $pendingOrders->whereIn('branch_id', $branches);
                            }
                            $pendingOrders = $pendingOrders->where('order_status', 1)->get();

            $totalPending = $pendingOrders->count();
            /*............pending orders..............*/

            /*............ready for delivery orders..............*/
            $forDeliveryOrders = Order::where('updated_at','>=', $startDate)->where('updated_at','<=', $endDate);
                                if($branches != null) {
                                    $forDeliveryOrders = $forDeliveryOrders->whereIn('branch_id', $branches);
                                }
                                $forDeliveryOrders = $forDeliveryOrders->where('order_status', 12)->get();

            $totalForDelivery = $forDeliveryOrders->count();
            /*............ready for delivery orders..............*/

            /*............delivered orders..............*/
            $deliveredOrders = Order::where('updated_at','>=', $startDate)->where('updated_at','<=', $endDate);
            if($branches != null) {
                $deliveredOrders = $deliveredOrders->whereIn('branch_id', $branches);
            }
            $deliveredOrders = $deliveredOrders->where('order_status', 4)->get();

            $totalDelivered = $deliveredOrders->count();
            /*............delivered orders..............*/

            /*............ready for pick orders..............*/
            $readyForPickOrders = Order::where('picked_time','>=', $startDate)->where('picked_time','<=', $endDate);
            if($branches != null) {
                $readyForPickOrders = $readyForPickOrders->whereIn('branch_id', $branches);
            }
            $readyForPickOrders = $readyForPickOrders->where('order_status', 10)->get();

            $totalForPick = $readyForPickOrders->count();
            /*............ready for pick orders..............*/

            /*............picked orders..............*/
            $pickedOrders = Order::where('updated_at','>=', $startDate)->where('updated_at','<=', $endDate);
            if($branches != null) {
                $pickedOrders = $pickedOrders->whereIn('branch_id', $branches);
            }
            $pickedOrders = $pickedOrders->where('order_status', 2)->get();

            $totalPicked = $pickedOrders->count();
            /*............picked orders..............*/

            /*............add inventory..............*/
            $addInventories = InventoryLog::where('created_at','>=', $startDate)->where('created_at','<=', $endDate);
            if($branches != null) {
                $addInventories = $addInventories->whereIn('branch_id', $branches);
            }
            $addInventories = $addInventories->where('quantity','>', 0)->where('in_out', 'In')->get();

            $totalAddInventory = $addInventories->sum('quantity');
            /*............add inventory..............*/

            /*............use inventory..............*/
            $usesInventories = InventoryLog::where('created_at','>=', $startDate)->where('created_at','<=', $endDate);
            if($branches != null) {
                $usesInventories = $usesInventories->whereIn('branch_id', $branches);
            }
            $usesInventories = $usesInventories->where('quantity','>', 0)->where('in_out', 'Out')->get();

            $totalUses = $usesInventories->sum('quantity');
            /*............use inventory..............*/

        // }
        
        //return $totalPending;
        
        return view('backEnd.laundryreport.summary', compact(
            'pendingOrders','totalPending','forDeliveryOrders',
            'totalForDelivery','readyForPickOrders','totalForPick',
            'pickedOrders','totalPicked','deliveredOrders',
            'totalDelivered','addInventories', 'totalAddInventory',
            'usesInventories','totalUses'
        ));
    }

    /*..............salon report...........*/
    public function salonSummary(Request $request) {

        $request->validate([
            'date_from' => 'required_if:type,==,datewise',
            'date_to' => 'required_if:type,==,datewise',
        ]);

        $startDate = '';
        $endDate = '';

        $pendingOrders = array();
        $ongoingWorks = array();
        $completedWorks = array();
        $addInventories = array();
        $usesInventories = array();

        $totalPending = 0;
        $totalOngoingWorks = 0;
        $totalCompletedWorks = 0;
        $totalAddInventory = 0;
        $totalUses = 0;


        if($request->type == 'today') {
            $startDate = date('Y-m-d').' 00:00:00';
            $endDate = date('Y-m-d').' 23:59:59';
        }elseif($request->type == 'datewise') {
            $startDate = date('Y-m-d', strtotime($request->date_from)).' 00:00:00';
            $endDate = date('Y-m-d', strtotime($request->date_to)).' 23:59:59';
        }else {
            $startDate = date('Y-m-d').' 00:00:00';
            $endDate = date('Y-m-d').' 23:59:59';
        }
        
        $branches = CustomHelper::getUserBranch();

        $dateInfo = array($startDate, $endDate);

        // if($request->type) {
            //get order info

            /*............pending orders..............*/
            $pendingOrders = SalonBooking::where('created_at','>=', $startDate)->where('created_at','<=', $endDate);
            if($branches != null) {
                $pendingOrders = $pendingOrders->whereIn('branch_id', $branches);
            }
            $pendingOrders = $pendingOrders->where('status', 1)->get();

            $totalPending = $pendingOrders->count();
            /*............pending orders..............*/

            /*............ongoing work orders..............*/
            $ongoingWorks = SalonBooking::where('status', 10)->whereHas('bookingitem', function($q) use($dateInfo) {
                                $q->where('booking_date','>=', date('Y-m-d',strtotime($dateInfo[0])))->where('booking_date','<=', date('Y-m-d',strtotime($dateInfo[1])));
                            });
            
            if($branches != null) {
                $ongoingWorks = $ongoingWorks->whereIn('branch_id', $branches);
            }
            $ongoingWorks = $ongoingWorks->get();

            $totalOngoingWorks = $ongoingWorks->count();
            /*............ongoing work orders..............*/

            /*............completed work orders..............*/
            $completedWorks = SalonBooking::where('updated_at','>=', $startDate)->where('updated_at','<=', $endDate);
            if($branches != null) {
                $completedWorks = $completedWorks->whereIn('branch_id', $branches);
            }
            $completedWorks = $completedWorks->where('status', 12)->get();
            $totalCompletedWorks = $completedWorks->count();
            /*............ongoing work orders..............*/

            /*............add inventory..............*/
            $addInventories = SalonInventoryLog::where('created_at','>=', $startDate)->where('created_at','<=', $endDate);
            if($branches != null) {
                $addInventories = $addInventories->whereIn('branch_id', $branches);
            }
            $addInventories = $addInventories->where('quantity','>', 0)->where('in_out', 'In')->get();

            $totalAddInventory = $addInventories->sum('quantity');
            /*............add inventory..............*/

            /*............use inventory..............*/
            $usesInventories = SalonInventoryLog::where('created_at','>=', $startDate)->where('created_at','<=', $endDate);
            if($branches != null) {
                $usesInventories = $usesInventories->whereIn('branch_id', $branches);
            }
            $usesInventories = $usesInventories->where('quantity','>', 0)->where('in_out', 'Out')->get();
            $totalUses = $usesInventories->sum('quantity');
            /*............use inventory..............*/

        // }

        //return $totalUses;
        
        return view('backEnd.salonreport.summary', compact(
            'pendingOrders','totalPending','ongoingWorks','totalOngoingWorks',
            'completedWorks','totalCompletedWorks',
            'addInventories', 'totalAddInventory',
            'usesInventories','totalUses'
        ));
    }
    /*..............salon report...........*/

}
