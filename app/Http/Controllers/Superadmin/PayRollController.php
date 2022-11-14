<?php

namespace App\Http\Controllers\Superadmin;

use App\Employee;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\LaundryTransaction;
use App\Salary;
use App\SalonTransaction;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use DateTime;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class PayRollController extends Controller
{
    public function salary_sheet_create() {
        $employee_det = [];
        return view('backEnd.pay_roll.salarysheet_create', compact('employee_det'));
    }

    public function salary_sheet_show(Request $request) {
        //return $request->all();
        $validate = $request->validate([
            'year' => 'required',
            'month' => 'required',
            'employee_id.*' => 'required',
        ]);
        $query = "SELECT COUNT(DISTINCT `year`) FROM `salaries` GROUP BY `month`";
        $count = DB::select($query);
        $count = count($count);
        $invoice_no = str_pad($count + 1, 5, 0, STR_PAD_LEFT);
        //return $invoice_no;
        $month = $request->month;
        $year = $request->year;
        $date = $month . "-" . $year;
        $date_ = DateTime::createFromFormat('d-M-Y', "1-".$date);
        $date_from = $date_->format('Y-m-d');
        $date_to = date("Y-m-t", strtotime($date_from));
        //return  $date_from . " to " . $date_to;

        //return $this->findOrigin();
    
        $length = sizeof($request->employee_id);
        $employee_det = [];

        for($i = 0; $i<$length; $i++) {
            $temp = [];
            $this_month_commission = 0;
            $this_month_paid_commission = 0;
            $this_month_advance = 0;
            $salary = Salary::where('employee_id', $request->employee_id[$i])->where('year', $request->year)
                             ->where('month', $request->month)
                             ->first();
            if(!empty($salary)) {
                //salary already created
                $temp['salarysheet'] = true;
                $employee = Employee ::where('id', $request->employee_id[$i])->where('origin', $this->findOrigin())->first();

                /* commission and advance */
                // $this_month_commission = $employee->account_head->tot_commission;
                // $this_month_commission = $this_month_commission
                //                     ->where('created_at','>=', date('Y-m-d', strtotime($date_from)).' 00:00:00')
                //                     ->where('created_at','<=', date('Y-m-d', strtotime($date_to)).' 23:59:59');

                // $this_month_paid_commission = $employee->account_head->tot_paid_commission;
                // $this_month_paid_commission = $this_month_paid_commission
                //                           ->where('created_at','>=', date('Y-m-d', strtotime($date_from)).' 00:00:00')
                //                           ->where('created_at','<=', date('Y-m-d', strtotime($date_to)).' 23:59:59');

                // $this_month_advance = $employee->account_head->advance;
                // $this_month_advance = $this_month_advance
                //                   ->where('created_at','>=', date('Y-m-d', strtotime($date_from)).' 00:00:00')
                //                   ->where('created_at','<=', date('Y-m-d', strtotime($date_to)).' 23:59:59');
                /* commission and advance */

                $temp['employee_id'] = $employee->id;
                $temp['name'] = $employee->name;
                // $temp['gross_salary'] = $employee->gross_salary;
                // $temp['month_commission'] = $this_month_commission;
                // $temp['month_withdraw_commission'] = $this_month_paid_commission;
                // $temp['advance'] = $this_month_advance;
                //array_push($employee_det,$temp);
            } else {
                //newly salary created
                $temp['salarysheet'] = false;
                $employee = Employee ::where('id', $request->employee_id[$i])->where('origin', $this->findOrigin())->first();
                /* commission and advance */
                $this_month_commission = $employee->account_head->tot_commission;
                $this_month_commission = $this_month_commission
                                    ->where('created_at','>=', date('Y-m-d', strtotime($date_from)).' 00:00:00')
                                    ->where('created_at','<=', date('Y-m-d', strtotime($date_to)).' 23:59:59');

                $this_month_paid_commission = $employee->account_head->tot_paid_commission;
                $this_month_paid_commission = $this_month_paid_commission
                                          ->where('created_at','>=', date('Y-m-d', strtotime($date_from)).' 00:00:00')
                                          ->where('created_at','<=', date('Y-m-d', strtotime($date_to)).' 23:59:59');

                $this_month_advance = $employee->account_head->advance;
                $this_month_advance = $this_month_advance
                                  ->where('created_at','>=', date('Y-m-d', strtotime($date_from)).' 00:00:00')
                                  ->where('created_at','<=', date('Y-m-d', strtotime($date_to)).' 23:59:59');
                /* commission and advance */

                $temp['employee_id'] = $employee->id;
                $temp['name'] = $employee->name;
                $temp['gross_salary'] = $employee->gross_salary;
                $temp['month_commission'] = $this_month_commission->sum('amount');
                $temp['month_withdraw_commission'] = $this_month_paid_commission->sum('amount');
                $temp['advance'] = $this_month_advance->sum('amount');
                $temp['invoice_no'] = $invoice_no;
            }
            array_push($employee_det, $temp);
        }
        // echo "<pre>";
        // print_r($employee_det);
        // echo "</pre>";
        return view('backEnd.pay_roll.salarysheet_create', compact('employee_det', 'month', 'year'));
    }

    public function salary_sheet_store(Request $request) {
        //return $request->all();
        $validate = $request->validate([
            'employee_id.*' => 'required',
            'month' => 'required',
            'year' => 'required',
            'gross_salary.*' => 'nullable',
            'amount.*' => 'required',
        ]);
        $length = sizeof($request->employee_id);

        for($i = 0; $i<$length; $i++) {
            $invoice_no = 0;
            $check_same_month_salary_created = Salary::where('year', $request->year)->where('month', $request->month)->first();
            if($check_same_month_salary_created) {
                $invoice_no = $check_same_month_salary_created->invoice_no;
            } else {
                $invoice_no = $request->invoice_no;
            }
            $salary = new Salary();
            $salary->employee_id = $request->employee_id[$i];
            $salary->year = $request->year;
            $salary->month = $request->month;
            $salary->amount = $request->amount[$i];
            $salary->bonus = $request->bonus[$i];
            $salary->fine = $request->fine[$i];
            $salary->remain_commission = ($request->month_commission[$i] - $request->month_withdraw_commission[$i]);
            $salary->origin = $this->findOrigin();
            $salary->status = 0;
            $salary->invoice_no = $request->invoice_no;
            $salary->save();
        }

        Toastr::success('Salary Created');
        return redirect('superadmin/salarysheet/manage');
    }

    public function salary_sheet_manage(Request $request) {
        $salaries = Salary::where('origin', $this->findOrigin());
        // if($request->has()) {
        //     $salaries = Salary::where('origin', $this->findOrigin());
        // }
        //$salaries = Salary::where('origin', 1);
        if($request->year != NULL) {
            $salaries = $salaries->where('year', $request->year);
        }
        if($request->month != NULL) {
            $salaries = $salaries->where('month', $request->month);
        }
        /*if($request->year != NULL && $request->month != NULL) {
            $salaries = $salaries->where('year', $request->year);
            $salaries = $salaries->where('month', $request->month);
            $salaries = $salaries->with('employee')->groupBy('invoice_no')->orderBy('id', 'DESC')->get();
        }*/
        //$salaries = $salaries->with('employee')->get();
        $salaries = $salaries->with('employee')->groupBy('invoice_no')->orderBy('id', 'DESC')->paginate(10);
        //return $salaries;
        return view('backEnd.pay_roll.manage', compact('salaries'));
    }

    public function salary_paid(Request $request) {
        //return $request->all();
        $validate = $request->validate([
            'invoice_no' => 'required',
            'pay_date' => 'required',
            'payment_method' => 'required',
        ]);
        $salaries = Salary::where('invoice_no', $request->invoice_no)->where('status', 0)->with('employee')->get();
        //return $salaries;
        foreach($salaries as $salary) {
            echo $salary->employee->account_head->id . "<br>";
        }

        foreach($salaries as $salary) {
            $salary->pay_date = date('Y-m-d', strtotime($request->pay_date));
            $salary->payment_via = $request->payment_method;
            $salary->status = 1;
            $salary->save();

            // transection add kora lagbe
            if(Session::get('section') == 'laundry') {
                // laundry transection
                $laundry_transection = new LaundryTransaction();
                $laundry_transection->transaction_type = 4;
                $laundry_transection->account_head_id = $salary->employee->account_head->id;
                $laundry_transection->amount = $salary->amount;
                $laundry_transection->in_out = 2;
                $laundry_transection->status = 1;
                $laundry_transection->ref_table_id = $salary->id;
                $laundry_transection->comment = 'Laundry Salary Withdraw With Advance Adjustment';
                $laundry_transection->save();
            } else if(Session::get('section') == 'salon') {
                // salon transection
                $salon_transection = new SalonTransaction();
                $salon_transection->transaction_type = 3;
                $salon_transection->account_head_id = $salary->employee->account_head->id;
                $salon_transection->amount = $salary->remain_commission;
                $salon_transection->in_out = 2;
                $salon_transection->status = 1;
                $salon_transection->ref_table_id = $salary->id;
                $salon_transection->comment = 'Salon Commission Withdraw With Advance Adjustment';
                $salon_transection->save();

                $salon_transection = new SalonTransaction();
                $salon_transection->transaction_type = 4;
                $salon_transection->account_head_id = $salary->employee->account_head->id;
                $salon_transection->amount = $salary->amount - $salary->remain_commission;
                $salon_transection->in_out = 2;
                $salon_transection->status = 1;
                $salon_transection->ref_table_id = $salary->id;
                $salon_transection->comment = 'Salon Salary Withdraw With Advance Adjustment';
                $salon_transection->save();
            }
        }
        Toastr::success('Salary Paid');
        return redirect('superadmin/salarysheet/manage');
    }

    public function salary_sheet_view($invoice_no) {

        $salaries = Salary::where('invoice_no', $invoice_no)->with('employee')->get();
        $salary_det = [];
        foreach($salaries as $salary) {
            $temp = [];
            $this_month_commission = 0;
            $this_month_paid_commission = 0;
            $this_month_advance = 0;
            $pay_amount = 0;
            $date = $salary->month . "-" . $salary->year;
            $date_ = DateTime::createFromFormat('d-M-Y', "1-".$date);
            $date_from = $date_->format('Y-m-d');
            $date_to = date("Y-m-t", strtotime($date_from));
            $employee = Employee ::where('id', $salary->employee_id)->where('origin', $this->findOrigin())->first();
            /* commission and advance */
            $this_month_commission = $employee->account_head->tot_commission;
            $this_month_commission = $this_month_commission
                                    ->where('created_at','>=', date('Y-m-d', strtotime($date_from)).' 00:00:00')
                                    ->where('created_at','<=', date('Y-m-d', strtotime($date_to)).' 23:59:59');

            $this_month_paid_commission = $employee->account_head->tot_paid_commission;
            $this_month_paid_commission = $this_month_paid_commission
                                          ->where('created_at','>=', date('Y-m-d', strtotime($date_from)).' 00:00:00')
                                          ->where('created_at','<=', date('Y-m-d', strtotime($date_to)).' 23:59:59');

            $this_month_advance = $employee->account_head->advance;
            $this_month_advance = $this_month_advance
                                  ->where('created_at','>=', date('Y-m-d', strtotime($date_from)).' 00:00:00')
                                  ->where('created_at','<=', date('Y-m-d', strtotime($date_to)).' 23:59:59');
            /* commission and advance */

            $temp['employee_id'] = $employee->id;
            $temp['name'] = $employee->name;
            $temp['gross_salary'] = $employee->gross_salary;
            $temp['month_commission'] = $this_month_commission->sum('amount');
            $temp['month_withdraw_commission'] = $this_month_paid_commission->sum('amount');
            $temp['advance'] = $this_month_advance->sum('amount');

            $pay_amount = ($this_month_commission->sum('amount') + $employee->gross_salary);
            $pay_amount = $pay_amount - ($this_month_paid_commission->sum('amount') + $this_month_advance->sum('amount'));

            $temp['payable_amount'] = $pay_amount;
            $temp['month'] = $salary->month;
            $temp['year'] = $salary->year;
            array_push($salary_det, $temp);
        }
        return view('backEnd.pay_roll.salary_sheet_view', compact('salary_det'));
    }

    public function advance_add() {
        $advance_det = [];
        return view('backEnd.pay_roll.advance_add', compact('advance_det'));
    }

    public function advance_create(Request $request) {
        //return $request->all();
        $validate = $request->validate([
            'pay_date' => 'required',
            'employee_id.*' => 'required'
        ]);
        $first_day = date('Y-m-01', strtotime($request->pay_date));
        $last_day = date('Y-m-t', strtotime($request->pay_date));
        //return $first_day . " === " . $last_day;
        $advance_det = [];
        $length = sizeof($request->employee_id);
        for($i = 0; $i<$length; $i++) {
            $temp = [];
            $this_month_advance = 0;
            $employee = Employee::where('id', $request->employee_id[$i])->where('origin', $this->findOrigin())->first();
            $this_month_advance = $employee->account_head->advance;
            $this_month_advance = $this_month_advance
                                  ->where('created_at','>=', date('Y-m-d', strtotime($first_day)).' 00:00:00')
                                  ->where('created_at','<=', date('Y-m-d', strtotime($request->pay_date)).' 23:59:59');
            $temp['employee_id'] = $employee->id;
            $temp['name'] = $employee->name;
            $temp['account_head_id'] = $employee->account_head->id;
            $temp['advance_amount'] = $this_month_advance->sum('amount');
            $temp['date'] = $request->pay_date;
            array_push($advance_det, $temp);
        }
        return view('backEnd.pay_roll.advance_add', compact('advance_det'));
    }

    public function advance_store(Request $request) {
        //return $request->all();
        $validate = $request->validate([
            'date' => 'required',
            'account_head_id.*' => 'required',
            'amount.*' => 'required',
        ]);
        //return date('Y-m-d h:i:s', strtotime($request->date));
        $length = sizeof($request->account_head_id);
        for($i = 0; $i<$length; $i++) {
            if(Session::get('section') == 'laundry') {
                // laundry transection
                $laundry_transection = new LaundryTransaction();
                $laundry_transection->transaction_type = 5;
                $laundry_transection->account_head_id = $request->account_head_id[$i];
                $laundry_transection->amount = $request->amount[$i];
                $laundry_transection->in_out = 2;
                $laundry_transection->status = 1;
                $laundry_transection->created_at = date('Y-m-d h:i:s', strtotime($request->date));
                $laundry_transection->comment = 'Laundry Advance';
                $laundry_transection->save();
            } else if(Session::get('section') == 'salon') {
                // salon transection
                $salon_transection = new SalonTransaction();
                $salon_transection->transaction_type = 5;
                $salon_transection->account_head_id = $request->account_head_id[$i];
                $salon_transection->amount = $request->amount[$i];
                $salon_transection->in_out = 2;
                $salon_transection->status = 1;
                $salon_transection->created_at = date('Y-m-d h:i:s', strtotime($request->date));
                $salon_transection->comment = 'Salon Advance';
                $salon_transection->save();
            }
        }
        Toastr::success('Advance Paid');
        return redirect('superadmin/advance/manage');
    }

    public function advance_manage(Request $request) {
        $employees = Employee::where('origin', $this->findOrigin())->with('account_head');
        $employees = $employees->orderBy('id', 'desc')->get();

        $employees_datas = [];
        $first_day = date('Y-m-01');
        $today = date('Y-m-d');

        foreach($employees as $employee) {
            $temp = [];
            $temp['name'] = $employee->name ?? '';

            $employee = $employee->account_head->advance;
            $employee_amt = $employee->whereBetween('created_at', [$first_day . ' 00:00:00', $today . ' 23:59:59']);

            if($request->date_from != null) {
                $employee_amt = $employee->where('created_at','>=', date('Y-m-d', strtotime($request->date_from)).' 00:00:00');
            }
            if($request->date_to != null) {
                $employee_amt = $employee->where('created_at','<=', date('Y-m-d', strtotime($request->date_to)).' 23:59:59');
            }

            $temp['amount'] = $employee_amt->sum('amount');
            
            array_push($employees_datas, $temp);
        }

        return view('backEnd.pay_roll.advance_manage', compact('employees_datas'));
    }

    public function commission_show() {
        $employee_det = [];
        return view('backEnd.pay_roll.commission_pay', compact('employee_det'));
    }

    public function commission_create(Request $request) {
        //return $request->all();
        $validate = $request->validate([
            'employee_id.*' => 'required'
        ]);
        $length = sizeof($request->employee_id);
        $employee_det = [];
        for($i = 0; $i<$length; $i++) {
            $temp = [];
            $employee = Employee::where('id', $request->employee_id[$i])->first();
            $total_commission = $employee->account_head->tot_commission->sum('amount');
            $total_paid_commission = $employee->account_head->tot_paid_commission->sum('amount');
            $due_commission = $total_commission - $total_paid_commission;
            $today_commission = $employee->account_head->today_commission->sum('amount');

            $temp['employee_id'] = $employee->id;
            $temp['name'] = $employee->name;
            $temp['account_head_id'] = $employee->account_head->id;
            $temp['today_commission'] = $today_commission;
            $temp['due_commission'] = $due_commission;
            array_push($employee_det, $temp);
        }
        return view('backEnd.pay_roll.commission_pay', compact('employee_det'));
    }

    public function commission_store(Request $request) {
        //return $request->all();
        $validate = $request->validate([
            'employee_id.*' => 'required',
            'account_head_id.*' => 'required',
            'tody_commission.*' => 'required',
            'due_commission.*' => 'required',
            'amount.*' => 'lte:due_commission.*',
        ]);
        $length = sizeof($request->employee_id);
        for($i = 0; $i<$length; $i++) {
            //
            // check due_commission cannot exceed amount
            if($request->amount[$i] <= $request->due_commission[$i]) {
                //insert otherwise not
                $store_transection = new SalonTransaction();
                $store_transection->transaction_type = 3;
                $store_transection->account_head_id = $request->account_head_id[$i];
                $store_transection->amount = $request->amount[$i];
                $store_transection->in_out = 2;//out
                $store_transection->status = 1;
                $store_transection->save();
            }
            // $store_transection = new SalonTransaction();
            // $store_transection->transaction_type = 3;
            // $store_transection->account_head_id = $request->account_head_id[$i];
            // $store_transection->amount = $request->amount[$i];
            // $store_transection->in_out = 2;//out
            // $store_transection->status = 1;
            // $store_transection->save();
        }
        Toastr::success('Employee commission paid successfully!');
		return redirect()->back();
    }
}
