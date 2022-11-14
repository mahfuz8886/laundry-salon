<?php

namespace App\Http\Controllers\Superadmin;

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
use App\Order;
use App\OrderBilling;
use App\OrderItem;
use App\OrderShipping;
use App\ProductService;
use App\Purchase;
use App\PurchaseItem;
use App\Unit;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class PurchaseController extends Controller
{
    public function addLaundryItem() {
        $units = Unit::where('status', 1)->get();
        return view('backEnd.laundry.purchase.item.add', compact('units'));
    }

    public function storeLaundryItem(Request $request) {
        // dd($request->all());
        $request->validate([
            'item_name' => 'required|unique:laundry_items,name',
            'unit' => 'required',
            'image' => 'required | mimes:jpeg,jpg,png | max:1000',
            'status' => 'required', 
        ]);

        $storeData = new LaundryItem();

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
        if($insId) {
            Toastr::success('Item added successfully');
        }else {
            Toastr::error('Something was wrong');
        }

        return redirect()->back();

    }

    public function manageLaundryItem(Request $request) {
        $items = LaundryItem::orderBy('id', 'desc')->with('unit');
                if($request->status != null) {
                    $items = $items->where('status', $request->status);
                }
                if($request->name != null) {
                    $items = $items->where('name', 'like', '%'.$request->name.'%');
                }
        
        $items = $items->paginate(15);
        return view('backEnd.laundry.purchase.item.manage', compact('items'));
    }

    public function getLaundryItem($id) {
        $item = LaundryItem::where('id', $id)->first();
        $units = Unit::where('status', 1)->get();
        return view('backEnd.laundry.purchase.item.edit', compact('item','units'));;
    }

    public function updateLaundryItem(Request $request) {
        // dd($request->all());
        $request->validate([
            'item_name' => 'required|unique:laundry_items,name,'.$request->rowId,
            'unit' => 'required', 
            'status' => 'required'
        ]);

        $storeData = LaundryItem::where('id', $request->rowId)->first();

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
        if($updId) {
            Toastr::success('Item updated successfully');
            return redirect()->route('superadmin.laundry.manageItem');
        }else {
            Toastr::error('Something was wrong');
            return redirect()->back();
        }
    }

    /*.................purchase section.................*/

    public function addLaundryPurchase() {

        $items = LaundryItem::where('status', 1)->get();
        $units = Unit::where('status', 1)->get();

        $branches = $this->getUserBranch();
        if($branches) {
            $allBranch = Hub::where('status', 1)->whereIn('id', $branches)->get();
        }else {
            $allBranch = Hub::where('status', 1)->get();
        }


        return view('backEnd.laundry.purchase.purchase.add', compact('items','units','allBranch'));
    }

    public function storeLaundryPurchase(Request $request) {
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

        for($i = 0; $i < $itemLength; $i++) {
            $allSubtotal += $buyPrices[$i] * $quantities[$i];
        }

        $payable = $allSubtotal;
        
        //check discount
        if($request->discount) {
            if(strpos($request->discount, '%')) {
                $temp = explode('%', $request->discount);
                $discount = ($payable * $temp[0]) / 100;
            }else {
                $discount = $request->discount;
            }
        }

        $payable = $payable - $discount;

        if($request->paid) {
            $paid = $request->paid;
        }
        $due = $payable - $paid;
        
        $invNo = mt_rand(1000000, 9999999);
        //insert purchase 
        $store_purchase = new Purchase();
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
        if($pinsId) {
            //insert purchase item

            for($i = 0; $i < $itemLength; $i++) {

                $itemInfo = LaundryItem::where('id', $items[$i])->first();

                $store_items = new PurchaseItem();
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

            for($i = 0; $i < $itemLength; $i++) {

                $itemInfo = LaundryItem::where('id', $items[$i])->first();

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
                $store_inventory = new InventoryLog();
                $store_inventory->invoice_no = $invNo;
                $store_inventory->branch_id = $request->branch_id;
                $store_inventory->item_id = $items[$i];
                $store_inventory->unit_id = $itemInfo->unit_id;
                $store_inventory->buy_price = $buyPrices[$i];
                $store_inventory->sale_price = $salePrices[$i];
                $store_inventory->quantity = $quantities[$i];
                $store_inventory->subtotal = $buyPrices[$i] * $quantities[$i];
                $store_inventory->origin = 'Laundry';
                $store_inventory->save();
            }

            Toastr::success('Purchased successfully');
        }else {
            Toastr::error('Something was wrong');
        }
        
        return redirect()->back();
    }

    public function manageLaundryPurchase(Request $request) {
        $branches = $this->getUserBranch();
        $purchases = Purchase::where('status', 1);
                if($branches) {
                    $purchases = $purchases->whereIn('branch_id', $branches);
                }
                if($request->date_from != null) {
                    $purchases = $purchases->where('purchase_date','>=', $request->date_from);
                }
                if($request->date_to != null) {
                    $purchases = $purchases->where('purchase_date','<=', $request->date_to.'%');
                }
        
        $purchases = $purchases->with('branch')->paginate(15);
        return view('backEnd.laundry.purchase.purchase.manage', compact('purchases'));
    }

    public function getLaundryPurchase($id) {
        $purchase = Purchase::where('id', $id)->first();
        $pitems = PurchaseItem::where('purchase_id', $id)->get();
        $items = LaundryItem::where('status', 1)->get();
        $units = Unit::where('status', 1)->get();

        $branches = $this->getUserBranch();
        if($branches) {
            $allBranch = Hub::where('status', 1)->whereIn('id', $branches)->get();
        }else {
            $allBranch = Hub::where('status', 1)->get();
        }

        return view('backEnd.laundry.purchase.purchase.edit', compact('purchase','pitems','items','units','allBranch'));
    }

    public function updateLaundryPurchase(Request $request) {
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

        for($i = 0; $i < $itemLength; $i++) {
            $allSubtotal += $buyPrices[$i] * $quantities[$i];
        }

        $payable = $allSubtotal;
        
        //check discount
        if($request->discount) {
            if(strpos($request->discount, '%')) {
                $temp = explode('%', $request->discount);
                $discount = ($payable * $temp[0]) / 100;
            }else {
                $discount = $request->discount;
            }
        }

        $payable = $payable - $discount;

        if($request->paid) {
            $paid = $request->paid;
        }
        $due = $payable - $paid;
        
        //update purchase 
        $store_purchase = Purchase::where('id', $pid)->first();
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
        if($pinsId) {
            //update purchase item

            for($i = 0; $i < $itemLength; $i++) {
                
                $itemInfo = LaundryItem::where('id', $items[$i])->first();

                $store_items = PurchaseItem::where('purchase_id', $pid)->first();
                if($store_items && $store_items->id) {
                    $store_items->item_id = $items[$i];
                    $store_items->unit_id = $itemInfo->unit_id;
                    $store_items->buy_price = $buyPrices[$i];
                    $store_items->sale_price = $salePrices[$i];
                    $store_items->quantity = $quantities[$i];
                    $store_items->subtotal = $buyPrices[$i] * $quantities[$i];
                    $store_items->status = 1;
                    $store_items->save();
                }else {
                    $store_items = new PurchaseItem();
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

            for($i = 0; $i < $itemLength; $i++) {

                $itemInfo = LaundryItem::where('id', $items[$i])->first();

                //update inventory logs
                $update_inventory = InventoryLog::where('invoice_no', $store_purchase->invoice_no)->first();
                if($update_inventory && $update_inventory->id) {
                    $update_inventory->item_id = $items[$i];
                    $update_inventory->branch_id = $request->branch_id;
                    $update_inventory->unit_id = $itemInfo->unit_id;
                    $update_inventory->buy_price = $buyPrices[$i];
                    $update_inventory->sale_price = $salePrices[$i];
                    $update_inventory->quantity = $quantities[$i];
                    $update_inventory->subtotal = $buyPrices[$i] * $quantities[$i];
                    $update_inventory->save();
                }else {
                    $store_inventory = new InventoryLog();
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
            return redirect()->route('superadmin.laundry.managePurchase');
        }else {
            Toastr::error('Something was wrong');
            return redirect()->back();
        }
    }


    public function laundryPurchaseDetails($id) {
        $purchase = Purchase::where('id', $id)->first();
        $pitems = PurchaseItem::where('purchase_id', $id)->get();
        $items = LaundryItem::where('status', 1)->get();
        $units = Unit::where('status', 1)->get();
        return view('backEnd.laundry.purchase.purchase.details', compact('purchase','pitems','items','units'));
    }

    /*.................purchase section.................*/

    // get branches
    public function getUserBranch() {
        $userInfo = User::where('id', Auth::id())->first();
        if($userInfo->branches) {
            $branches = str_split($userInfo->branches);
            return $branches;
        }else {
            return null;
        }
    }

}
