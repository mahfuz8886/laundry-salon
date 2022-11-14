<?php

namespace App\Http\Controllers\superadmin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use App\Customer;
use App\Parceltype;
use App\Deliverycharge;
use DB;
use App\Parcel;
use App\Merchant;
use App\Setting;
use App\Merchantpayment;
use App\Order;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;

class DashboardController extends Controller
{
    public function mainDashboard() {

        $setting = Setting::where('id',1)->first();
        return view('backEnd.superadmin.maindashboard',compact('setting'));
    }

    /*..........pos.............*/
    public function posDashboard() {

        Session::put('section','pos');
        $setting = Setting::where('id',1)->first();
        return view('backEnd.pos.posdashboard',compact('setting'));
    }
    /*..........laundry.............*/
    public function laundryDashboard() {

        $startDate = date('Y-m-d').' 00:00:00';
        $endDate = date('Y-m-d').' 23:59:59';

        Session::put('section','laundry');
        $setting = Setting::where('id',1)->first();
        $parcelTypes = Parceltype::whereIn('id', array(1,2,4,9,10,11,12))->get();

        //ready for picked
        $readyForPickOrders = Order::where('picked_time','>=', $startDate)->where('picked_time','<=', $endDate)->where('order_status', 10)->get();
        $totalForPick = $readyForPickOrders->count();

        //ready for delivery
        $forDeliveryOrders = Order::where('updated_at','>=', $startDate)->where('updated_at','<=', $endDate)->where('order_status', 12)->get();
        $totalForDelivery = $forDeliveryOrders->count();

        return view('backEnd.laundry.laundrydashboard',compact('setting','parcelTypes','totalForPick','totalForDelivery'));
    }
    /*..........salon.............*/
    public function salonDashboard() {

        Session::put('section','salon');
        $setting = Setting::where('id',1)->first();
        return view('backEnd.salon.salondashboard',compact('setting'));
    }
    
    public function index()
    {
        return view('backEnd.superadmin.dashboard');
    }
    public function cinactive(Request $request)
    {
        $active_data         =   Customer::find($request->hidden_id);
        $active_data->status =  0;
        $active_data->save();
        Toastr::success('message', 'customer inactive successfully!');
        return redirect()->back();
    }

    public function cactive(Request $request)
    {
        $active_data         =   Customer::find($request->hidden_id);
        $active_data->status =  1;
        $active_data->save();
        Toastr::success('message', 'customer active successfully!');
        return redirect()->back();
    }

    public function destroy(Request $request)
    {
        $deleteId = Customer::find($request->hidden_id);
        $deleteId->delete();
        Toastr::success('message', 'customer  delete successfully!');
        return redirect()->back();
    }





    public function summary(Request $request)
    {
        $parcel_types = Parceltype::all();
        $start_date = $request->start_date ?? date('Y-m-d');
        $end_date = $request->end_date ?? date('Y-m-d');
        $parcel = array();
        foreach ($parcel_types as $parcel_type) {
            $date_column = 'created_at';
            if ($parcel_type->id == 2) {
                $date_column = 'pickup_date';
            }
            if ($parcel_type->id == 4) {
                $date_column = 'delivery_date';
            }

            $parcel['today_' . $parcel_type->slug . '_quantity'] = Parcel::whereDate($date_column, '>=', $start_date)->whereDate($date_column, '<=', $end_date)->where('status', $parcel_type->id)->count();
            $parcel['today_' . $parcel_type->slug . '_collection'] = Parcel::whereDate($date_column, '>=', $start_date)->whereDate($date_column, '<=', $end_date)->where('status', $parcel_type->id)->sum('cod');
            $parcel['today_' . $parcel_type->slug . '_delivery_charge'] = Parcel::whereDate($date_column, '>=', $start_date)->whereDate($date_column, '<=', $end_date)->where('status', $parcel_type->id)->sum('deliveryCharge');
            $parcel['today_' . $parcel_type->slug . '_codCharge'] = Parcel::whereDate($date_column, '>=', $start_date)->whereDate($date_column, '<=', $end_date)->where('status', $parcel_type->id)->sum('codCharge');
            $parcel['today_' . $parcel_type->slug . '_merchant_payable'] = Parcel::whereDate($date_column, '>=', $start_date)->whereDate($date_column, '<=', $end_date)->where('status', $parcel_type->id)->sum('merchantDue');
            $parcel['today_' . $parcel_type->slug . '_merchant_paid'] = Parcel::whereDate('merchantpayDate', '>=', $start_date)->whereDate('merchantpayDate', '<=', $end_date)->where('status', $parcel_type->id)->sum('merchantPaid');
        }
        $total_parcel = array();
        foreach ($parcel_types as $parcel_type) {
            $parcel['total_' . $parcel_type->slug . '_quantity'] = Parcel::where('status', $parcel_type->id)->count();
            $parcel['total_' . $parcel_type->slug . '_collection'] = Parcel::where('status', $parcel_type->id)->sum('cod');
            $parcel['total_' . $parcel_type->slug . '_delivery_charge'] = Parcel::where('status', $parcel_type->id)->sum('deliveryCharge');
            $parcel['total_' . $parcel_type->slug . '_codCharge'] = Parcel::where('status', $parcel_type->id)->sum('codCharge');
            $parcel['total_' . $parcel_type->slug . '_merchant_payable'] = Parcel::where('status', $parcel_type->id)->sum('merchantDue');
            $parcel['total_' . $parcel_type->slug . '_merchant_paid'] = Parcel::where('status', $parcel_type->id)->sum('merchantPaid');
        }

        return view('backEnd.superadmin.summary', compact('parcel_types', 'parcel', 'total_parcel', 'start_date', 'end_date'));
    }




    public function date_to_date_reports(Request $request)
    {

        $date = Carbon::today()->toDateString();
        $startDate = $request->start_date;
        $endDate = $request->end_date;

        if ($request->priceId) {
            $date = Carbon::today()->toDateString();
            $show_data =  Deliverycharge::with(['parcels' => function ($query) use ($startDate, $endDate) {
                $query->whereBetween('created_at', [$startDate, $endDate])->OrwhereBetween('updated_at',  [$startDate, $endDate]);
            }])->where('id', $request->priceId)
                ->first();


            $result = view('tableBox', ['show_data' => $show_data->parcels])->render();
            return response()->json(['dataTable' => $result, 'mainData' => $show_data]);
        }

        if ($request->Picked_id) {
            if ($request->Picked_id == 4) {
                $show_data = Parcel::where('status', $request->Picked_id)->where(
                    function ($query) use ($startDate, $endDate) {
                        return $query->whereBetween('delivery_date', [$startDate, $endDate]);
                    }
                )->get();
                $result = view('tableBox', ['show_data' => $show_data])->render();
                return response()->json(['dataTable' => $result, 'mainData' => $show_data]);
            } else {
                $show_data = Parcel::where('status', $request->Picked_id)->where(
                    function ($query) use ($startDate, $endDate) {
                        return $query->whereDate('updated_at', [$startDate, $endDate]);
                    }
                )->get();
                $result = view('tableBox', ['show_data' => $show_data])->render();
                return response()->json(['dataTable' => $result, 'mainData' => $show_data]);
            }
        }

        if ($request->return_id) {
            $show_data = Parcel::whereIn('status', [6, 7, 8])->where(
                function ($query) use ($startDate, $endDate) {
                    return $query->whereDate('updated_at', [$startDate, $endDate]);
                }
            )->get();
            $result = view('tableBox', ['show_data' => $show_data])->render();
            return response()->json(['dataTable' => $result, 'mainData' => $show_data]);
        }


        if ($request->Paid_id) {
            $show_data = Parcel::where('merchantpayStatus', 1)->whereBetween('merchantpayDate', [$startDate, $endDate])->get();
            $result = view('tableBox', ['show_data' => $show_data])->render();
            return response()->json(['dataTable' => $result, 'mainData' => $show_data]);
        }

        $parcels =  Deliverycharge::with(['parcels' => function ($query) use ($startDate, $endDate) {
            $query->whereBetween('created_at', [$startDate, $endDate])->OrwhereBetween('updated_at',  [$startDate, $endDate]);
        }])->get();

        $delivered_parcels = Parcel::where('status', 4)->whereBetween('delivery_date', [$startDate, $endDate])->get();



        $hold_parcels = Parcel::where('status', 5)->where(
            function ($query) use ($startDate, $endDate) {
                return $query->whereDate('updated_at', [$startDate, $endDate]);
            }
        )->get();

        $return_parcels = Parcel::whereIn('status', [6, 7, 8])->where(
            function ($query) use ($startDate, $endDate) {
                return $query->whereDate('updated_at', [$startDate, $endDate]);
            }
        )->get();

        $picked_parcels = Parcel::where('status', 2)->where(
            function ($query) use ($startDate, $endDate) {
                return $query->whereDate('updated_at', [$startDate, $endDate]);
            }
        )->get();

        $pending_parcels = Parcel::where('status', 1)->where(
            function ($query) use ($startDate, $endDate) {
                return $query->whereDate('updated_at', [$startDate, $endDate]);
            }
        )->get();


        $paid_parcels =  Parcel::where('merchantpayStatus', 1)->whereBetween('merchantpayDate', [$startDate, $endDate])->get();

        return view('backEnd.superadmin.report', compact('show_data', 'parceltype', 'parcels', 'delivered_parcels', 'hold_parcels', 'return_parcels', 'picked_parcels', 'pending_parcels', 'paid_parcels'));
    }



    /*.............marchant payment.............*/

    // show due marchant
    public function show_marchant(Request $request)
    {

        $query = DB::table('merchants')
            ->whereExists(function ($query) {
                $query->select(DB::raw('parcels.merchantId'))
                    ->from('parcels')
                    ->whereRaw('parcels.merchantId = merchants.id')
                    ->whereRaw('parcels.status = 4')
                    ->whereRaw('parcels.merchantpayStatus IS NULL');
            });

        if ($request->mcompany_name) {
            $query->where('merchants.companyName', 'like', '%' . $request->mcompany_name . '%');
        }

        $results = $query->orderBy('merchants.id', 'desc')->paginate(15);

        return view('backEnd.superadmin.due_marchent', compact('results'));
    }


    // payment due marchant
    public function payment_marchant($mid)
    {

        $in = array(4, 6, 7, 8);

        $results = DB::table('parcels')->whereIn('status', $in)->where('merchantId', '=', $mid)->whereNull('merchantpayStatus')->get();
        $marchant = $mid;

        $minfo = Merchant::find($mid);

        return view('backEnd.superadmin.marchant_due_parcel', compact('results', 'marchant', 'minfo'));
    }

    public function submit_due_payment(Request $request)
    {
        $mid = $request->merchantId;

        $totalparcel = ($request->parcel_id) ? count($request->parcel_id) : 0;
        if ($totalparcel > 0) {

            $payment = new Merchantpayment();
            $payment->merchantId = $request->merchantId;
            $payment->parcelId   = $request->parcelId;
            $payment->save();

            $parcels_id = $request->parcel_id;
            $total = 0;
            $finaltotal = 0;
            $totaldelcharge = 0;

            foreach ($parcels_id as $parcel_id) {
                $parcel = Parcel::find($parcel_id);
                $parcel->paymentInvoice = $payment->id;
                $parcel->merchantPaid = $parcel->merchantAmount;
                $parcel->merchantDue = 0;
                $parcel->merchantpayDate = date("Y-m-d");
                $parcel->merchantpayStatus = 1;
                $parcel->save();

                $total += $parcel->merchantPaid;
            }

            $finaltotal = $total;

            $totalparcel = count(collect($request)->get('parcel_id'));
            $validMerchant = Merchant::find($request->merchantId);
            $number = "0" . $validMerchant->phoneNumber;
            $msg =  "A Payment (Invoice No. SC-" . $payment->id . ") has been issued of " . $finaltotal . " Tk where " . $totalparcel . " Parcels were paid. Check Invoice on your dashboard. \r\n Regards,\r\n Sensor Courier ";

            $send_sms = $this->sendSMS($number, $msg);

            Toastr::success('message', 'Invoice paid successfully!');
            return redirect()->back();
            // return redirect('superadmin/payment_due_marchant/'.$mid);


        } else {
            Toastr::error('message', 'Please select atleast 1 parcel then try again!');
            // return redirect('superadmin/payment_due_marchant/'.$mid);

            return redirect()->back();
        }
    }


    /*.............marchant payment.............*/
}
