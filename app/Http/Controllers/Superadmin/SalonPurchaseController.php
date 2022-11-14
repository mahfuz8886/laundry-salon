<?php

namespace App\Http\Controllers\Superadmin;

use App\helper\CustomHelper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Hub;
use App\InventoryLog;
use App\LaundryDiscount;
use App\SalonItem;
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
use App\Purchase;
use App\PurchaseItem;
use App\SalonInventoryLog;
use App\SalonPurchase;
use App\SalonPurchaseItem;
use App\Unit;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class SalonPurchaseController extends Controller
{
    public function addSalonItem()
    {
        $units = Unit::where('status', 1)->get();
        return view('backEnd.salon.item.add', compact('units'));
    }

    public function storeSalonItem(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'item_name' => 'required|unique:salon_items,name',
            'unit' => 'required',
            'image' => 'required | mimes:jpeg,jpg,png | max:1000',
            'status' => 'required',
        ]);

        $storeData = new SalonItem();

        if ($request->file('image')) {
            $storeData->image = $this->fileUpload($request->file('image'), 'public/uploads/others/', 324, 204);
        }

        $storeData->name = $request->item_name;
        $storeData->unit_id = $request->unit;
        $storeData->sku = $request->sku;
        $storeData->description = $request->description;
        $storeData->status = $request->status;
        $storeData->save();
        $insId = $storeData->id;
        if ($insId) {
            Toastr::success('Item added successfully');
        } else {
            Toastr::error('Something was wrong');
        }

        return redirect()->back();
    }

    public function manageSalonItem(Request $request)
    {
        $items = SalonItem::orderBy('id', 'desc')->with('unit');
        if ($request->status != null) {
            $items = $items->where('status', $request->status);
        }
        if ($request->name != null) {
            $items = $items->where('name', 'like', '%' . $request->name . '%');
        }

        $items = $items->paginate(15);
        return view('backEnd.salon.item.manage', compact('items'));
    }

    public function getSalonItem($id)
    {
        $item = SalonItem::where('id', $id)->first();
        $units = Unit::where('status', 1)->get();
        return view('backEnd.salon.item.edit', compact('item', 'units'));;
    }

    public function updateSalonItem(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'item_name' => 'required|unique:laundry_items,name,' . $request->rowId,
            'unit' => 'required',
            'status' => 'required'
        ]);

        $storeData = SalonItem::where('id', $request->rowId)->first();

        if ($request->file('image')) {
            $storeData->image = $this->fileUpload($request->file('image'), 'public/uploads/others/', 324, 204);
        }

        $storeData->name = $request->item_name;
        $storeData->unit_id = $request->unit;
        $storeData->sku = $request->sku;
        $storeData->description = $request->description;
        $storeData->status = $request->status;
        $storeData->save();
        $updId = $storeData->id;
        if ($updId) {
            Toastr::success('Item updated successfully');
            return redirect()->route('superadmin.salon.manageItem');
        } else {
            Toastr::error('Something was wrong');
            return redirect()->back();
        }
    }

    /*.................purchase section.................*/

    public function addSalonPurchase()
    {

        $items = SalonItem::where('status', 1)->get();
        $units = Unit::where('status', 1)->get();

        $branches = CustomHelper::getUserBranch();
        if ($branches) {
            $allBranch = Hub::where('status', 1)->whereIn('id', $branches)->get();
        } else {
            $allBranch = Hub::where('status', 1)->get();
        }


        return view('backEnd.salon.purchase.add', compact('items', 'units', 'allBranch'));
    }

    public function storeSalonPurchase(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'purchase_date' => 'required',
            'supplier' => 'required',
            'branch_id' => 'required',
            'item' => 'required',
            // 'unit' => 'required', 
            'buy_price' => 'required',
            'sale_price' => 'required',
            'quantity' => 'required',
            'paid' => 'required'
        ]);

        $allSubtotal = 0;
        $payable = 0;
        $discount = 0;
        $paid = 0;
        $due = 0;

        //calculate all subtotal
        $items = $request->item;
        $itemLength = sizeof($items);

        $buyPrices = $request->buy_price;
        $salePrices = $request->sale_price;
        // $units = $request->unit;

        $quantities = $request->quantity;
        $quantityLength = sizeof($quantities);

        for ($i = 0; $i < $itemLength; $i++) {
            $allSubtotal += $buyPrices[$i] * $quantities[$i];
        }

        $payable = $allSubtotal;

        //check discount
        if ($request->discount) {
            if (strpos($request->discount, '%')) {
                $temp = explode('%', $request->discount);
                $discount = ($payable * $temp[0]) / 100;
            } else {
                $discount = $request->discount;
            }
        }

        $payable = $payable - $discount;

        if ($request->paid) {
            $paid = $request->paid;
        }
        $due = $payable - $paid;

        $invNo = mt_rand(1000000, 9999999);
        //insert purchase 
        $store_purchase = new SalonPurchase();
        $store_purchase->invoice_no = $invNo;
        $store_purchase->supplier_id = $request->supplier;
        $store_purchase->branch_id = $request->branch_id;
        $store_purchase->purchase_date = $request->purchase_date;
        $store_purchase->invoice_total = $allSubtotal;
        $store_purchase->discount = $request->discount;
        $store_purchase->payable = $payable;
        $store_purchase->paid = $paid;
        $store_purchase->due = $due;
        $store_purchase->status = 1;
        $store_purchase->save();
        $pinsId = $store_purchase->id;
        if ($pinsId) {
            //insert purchase item

            for ($i = 0; $i < $itemLength; $i++) {

                $itemInfo = SalonItem::where('id', $items[$i])->first();

                $store_items = new SalonPurchaseItem();
                $store_items->invoice_no = $invNo;
                $store_items->purchase_id = $pinsId;
                $store_items->item_id = $items[$i];
                $store_items->unit_id = $itemInfo->unit_id;
                $store_items->buy_price = $buyPrices[$i];
                $store_items->sale_price = $salePrices[$i];
                $store_items->quantity = $quantities[$i];
                $store_items->subtotal = $buyPrices[$i] * $quantities[$i];
                $store_items->status = 1;
                $store_items->save();
            }

            for ($i = 0; $i < $itemLength; $i++) {

                $itemInfo = SalonItem::where('id', $items[$i])->first();

                // $exist = InventoryLog::where([
                //     ['item_id', $items[$i]],
                //     ['unit_id', $units[$i]],
                //     ['buy_price', $buyPrices[$i]],
                //     ['sale_price', $salePrices[$i]]
                // ])->first();
                // if($exist && $exist->id) {
                //     //update quantity
                //     $exist->quantity = $exist->quantity + $quantities[$i];
                //     $exist->save();
                // }else {
                //     //insert or update inventory logs
                //     $store_inventory = new InventoryLog();
                //     $store_inventory->invoice_no = $invNo;
                //     $store_inventory->item_id = $items[$i];
                //     $store_inventory->unit_id = $units[$i];
                //     $store_inventory->buy_price = $buyPrices[$i];
                //     $store_inventory->sale_price = $salePrices[$i];
                //     $store_inventory->quantity = $quantities[$i];
                //     $store_inventory->subtotal = $buyPrices[$i] * $quantities[$i];
                //     $store_inventory->origin = 'Laundry';
                //     $store_inventory->save();
                // }
                //insert or update inventory logs
                $store_inventory = new SalonInventoryLog();
                $store_inventory->invoice_no = $invNo;
                $store_inventory->item_id = $items[$i];
                $store_inventory->branch_id = $request->branch_id;
                $store_inventory->unit_id = $itemInfo->unit_id;
                $store_inventory->buy_price = $buyPrices[$i];
                $store_inventory->sale_price = $salePrices[$i];
                $store_inventory->quantity = $quantities[$i];
                $store_inventory->subtotal = $buyPrices[$i] * $quantities[$i];
                $store_inventory->origin = 'Salon';
                $store_inventory->save();
            }

            Toastr::success('Purchased successfully');
        } else {
            Toastr::error('Something was wrong');
        }

        return redirect()->back();
    }

    public function manageSalonPurchase(Request $request)
    {
        $branches = CustomHelper::getUserBranch();
        $purchases = SalonPurchase::where('status', 1);
        if ($branches) {
            $purchases = $purchases->whereIn('branch_id', $branches);
        }
        if ($request->date_from != null) {
            $purchases = $purchases->where('purchase_date', '>=', $request->date_from);
        }
        if ($request->date_to != null) {
            $purchases = $purchases->where('purchase_date', '<=', $request->date_to . '%');
        }

        $purchases = $purchases->with('branch')->paginate(15);
        return view('backEnd.salon.purchase.manage', compact('purchases'));
    }

    public function getSalonPurchase($id)
    {
        $purchase = SalonPurchase::where('id', $id)->first();
        $pitems = SalonPurchaseItem::where('purchase_id', $id)->get();
        $items = SalonItem::where('status', 1)->get();
        $units = Unit::where('status', 1)->get();

        $branches = CustomHelper::getUserBranch();
        if ($branches) {
            $allBranch = Hub::where('status', 1)->whereIn('id', $branches)->get();
        } else {
            $allBranch = Hub::where('status', 1)->get();
        }

        return view('backEnd.salon.purchase.edit', compact('purchase', 'pitems', 'items', 'units', 'allBranch'));
    }

    public function updateSalonPurchase(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'purchase_date' => 'required',
            'supplier' => 'required',
            'branch_id' => 'required',
            'item' => 'required',
            // 'unit' => 'required', 
            'buy_price' => 'required',
            'sale_price' => 'required',
            'quantity' => 'required',
            'paid' => 'required'
        ]);

        $pid = $request->pid;
        $allSubtotal = 0;
        $payable = 0;
        $discount = 0;
        $paid = 0;
        $due = 0;

        //calculate all subtotal
        $items = $request->item;
        $itemLength = sizeof($items);

        $buyPrices = $request->buy_price;
        $salePrices = $request->sale_price;
        // $units = $request->unit;

        $quantities = $request->quantity;
        $quantityLength = sizeof($quantities);

        for ($i = 0; $i < $itemLength; $i++) {
            $allSubtotal += $buyPrices[$i] * $quantities[$i];
        }

        $payable = $allSubtotal;

        //check discount
        if ($request->discount) {
            if (strpos($request->discount, '%')) {
                $temp = explode('%', $request->discount);
                $discount = ($payable * $temp[0]) / 100;
            } else {
                $discount = $request->discount;
            }
        }

        $payable = $payable - $discount;

        if ($request->paid) {
            $paid = $request->paid;
        }
        $due = $payable - $paid;

        //update purchase 
        $store_purchase = SalonPurchase::where('id', $pid)->first();
        $store_purchase->supplier_id = $request->supplier;
        $store_purchase->branch_id = $request->branch_id;
        $store_purchase->purchase_date = $request->purchase_date;
        $store_purchase->invoice_total = $allSubtotal;
        $store_purchase->discount = $request->discount;
        $store_purchase->payable = $payable;
        $store_purchase->paid = $paid;
        $store_purchase->due = $due;
        $store_purchase->save();
        $pinsId = $store_purchase->id;
        if ($pinsId) {
            //update purchase item

            for ($i = 0; $i < $itemLength; $i++) {

                $itemInfo = SalonItem::where('id', $items[$i])->first();

                $store_items = SalonPurchaseItem::where('purchase_id', $pid)->first();
                if ($store_items && $store_items->id) {
                    $store_items->item_id = $items[$i];
                    $store_items->unit_id = $itemInfo->unit_id;
                    $store_items->buy_price = $buyPrices[$i];
                    $store_items->sale_price = $salePrices[$i];
                    $store_items->quantity = $quantities[$i];
                    $store_items->subtotal = $buyPrices[$i] * $quantities[$i];
                    $store_items->status = 1;
                    $store_items->save();
                } else {
                    $store_items = new SalonPurchaseItem();
                    $store_items->invoice_no = $store_purchase->invoice_no;
                    $store_items->item_id = $items[$i];
                    $store_items->unit_id = $itemInfo->unit_id;
                    $store_items->buy_price = $buyPrices[$i];
                    $store_items->sale_price = $salePrices[$i];
                    $store_items->quantity = $quantities[$i];
                    $store_items->subtotal = $buyPrices[$i] * $quantities[$i];
                    $store_items->status = 1;
                    $store_items->save();
                }
            }

            for ($i = 0; $i < $itemLength; $i++) {

                $itemInfo = SalonItem::where('id', $items[$i])->first();

                //update inventory logs
                $update_inventory = SalonInventoryLog::where('invoice_no', $store_purchase->invoice_no)->first();
                if ($update_inventory && $update_inventory->id) {
                    $update_inventory->item_id = $items[$i];
                    $update_inventory->branch_id = $request->branch_id;
                    $update_inventory->unit_id = $itemInfo->unit_id;
                    $update_inventory->buy_price = $buyPrices[$i];
                    $update_inventory->sale_price = $salePrices[$i];
                    $update_inventory->quantity = $quantities[$i];
                    $update_inventory->subtotal = $buyPrices[$i] * $quantities[$i];
                    $update_inventory->save();
                } else {
                    $store_inventory = new SalonInventoryLog();
                    $store_inventory->invoice_no = $store_purchase->invoice_no;
                    $store_inventory->branch_id = $request->branch_id;
                    $store_inventory->item_id = $items[$i];
                    $store_inventory->unit_id = $itemInfo->unit_id;
                    $store_inventory->buy_price = $buyPrices[$i];
                    $store_inventory->sale_price = $salePrices[$i];
                    $store_inventory->quantity = $quantities[$i];
                    $store_inventory->subtotal = $buyPrices[$i] * $quantities[$i];
                    $store_inventory->save();
                }
            }

            Toastr::success('Purchase updated successfully');
            return redirect()->route('superadmin.salon.managePurchase');
        } else {
            Toastr::error('Something was wrong');
            return redirect()->back();
        }
    }


    public function salonPurchaseDetails($id)
    {
        $purchase = SalonPurchase::where('id', $id)->first();
        $pitems = SalonPurchaseItem::where('purchase_id', $id)->get();
        $items = SalonItem::where('status', 1)->get();
        $units = Unit::where('status', 1)->get();
        return view('backEnd.salon.purchase.details', compact('purchase', 'pitems', 'items', 'units'));
    }

    // report
    public function salonPurchaseReport()
    {
        //$salon_purchase_items = SalonPurchaseItem::groupBy('item_id')->selectRaw('sum(quantity) as sum, item_id')->pluck('sum','item_id');
        //$salon_purchase_items = SalonPurchaseItem::groupBy('item_id')->selectRaw('sum(quantity) as sum, item_id')->pluck('sum','item_id');
        $salon_purchase_items = SalonPurchaseItem::where('status', 1)->with('salon_item')->groupBy('item_id', 'unit_id')->get();
        //return $salon_purchase_items;

        $purchase_datas = [];
        foreach($salon_purchase_items as $item) {
            $temp = [];
            $total = 0;
            $items_purchase = SalonPurchaseItem::where('item_id', $item->item_id)->where('unit_id', $item->unit_id)->get();
            foreach($items_purchase as $items) {
                $temp['code'] = $items->salon_item->id ?? '';
                $temp['item_name'] = $items->salon_item->name ?? '';
                $temp['unit'] = $items->salon_item->unit->unit_type ?? '';
                $total = $total + $items->quantity ?? 0;
                $temp['buy_quantity'] = $total;

                $salon_inventory = SalonInventoryLog::where('item_id', $items->item_id)->where('unit_id', $items->unit_id)->where('origin', 'Salon')->where('in_out', 'Out')->get();
                $temp['sale_quantity'] = $salon_inventory->sum('quantity');
                $temp['stock_quantity'] = $total - $salon_inventory->sum('quantity');
            }
            array_push($purchase_datas, $temp);
        }
        // echo "<pre>";
        // print_r($purchase_datas);
        // echo "</pre>";
        return view('backEnd.salon.purchase.report', compact('purchase_datas'));
    }

    /*.................purchase section.................*/
}
