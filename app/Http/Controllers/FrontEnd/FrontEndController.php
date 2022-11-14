<?php

namespace App\Http\Controllers\FrontEnd;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Banner;
use App\Price;
use App\Parcel;
use App\Merchant;
use App\Service;
use App\District;
use App\Feature;
use App\Deliverycharge;
use App\Codcharge;
use App\Partner;
use App\Parcelnote;
use App\About;
use App\Counter;
use App\Clientfeedback;
use App\Career;
use App\Cart;
use App\CartItem;
use App\Faq;
use App\Gallery;
use App\Notice;
use App\Hub;
use App\Logo;
use App\Pricetype;
use App\Createpage;
use App\Customer;
use App\CustomerAddress;
use App\LaundryDiscount;
use App\LaundryPackage;
use App\LaundryPackageItem;
use App\LaundryPkgOrderItem;
use App\LaundryProduct;
use App\LaundryProductBranch;
use App\PromotionalDiscount;
use App\Slider;
use App\Slogan;
use App\Thana;
use App\Topbanner;
use App\Weight;
use App\LaundryProductCategory;
use App\LaundryProductService;
use App\Order;
use App\OrderBilling;
use App\OrderItem;
use App\OrderShipping;
use App\ProductService;
use Brian2694\Toastr\Facades\Toastr;
use DB;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class FrontEndController extends Controller
{
    public function index(Request $request) {

        $defaultBranch = Hub::where('status', 1)->where('is_default', 1)->first();
        if($defaultBranch && $defaultBranch->id) {
            Session::put('default_branch', $defaultBranch->id);
        }else {
            $alterDefault = Hub::where('status', 1)->first();
            if($alterDefault && $alterDefault->id) {
                Session::put('default_branch', $alterDefault->id);
            }
        }

        if($request->branch) {
            Session::put('default_branch', $request->branch);
        }

        $selectedBranch = Session::get('default_branch');

        $topbanner = Topbanner::where(['status' => 1])->orderBy('id', 'DESC')->get();
        $banner = Banner::where(['status' => 1, 'type' => 1])->limit(1)->orderBy('id', 'DESC')->get();
        $slogan = Slogan::where(['status' => 1])->first();
        $sliders = Slider::where(['status' => 1])->orderBy('sort')->get();
        $ads = Banner::where(['status' => 1, 'type' => 2])->orderBy('id', 'DESC')->get();
        $about = About::where('status', 1)->limit(1)->orderBy('id', 'DESC')->get();
        $services = Service::where('status', 1)->orderBy('id', 'ASC')->get();
        $counter = Counter::where('status', 1)->limit(4)->orderBy('id', 'ASC')->get();
        $delivery_charges = Deliverycharge::where('status', 1)->distinct('delivery_charge_head_id')->orderBy('id', 'ASC')->get();
        $prices = Price::where('status', 1)->limit(4)->orderBy('id', 'ASC')->get();
        // $features = Feature::where('status', 1)->limit(3)->orderBy('id', 'ASC')->get();
        $features = Feature::where('status', 1)->orderBy('id', 'ASC')->get();
        $hubarea = Hub::where('status', 1)->orderBy('id', 'ASC')->get();
        $clientsfeedback = Clientfeedback::where('status', 1)->orderBy('id', 'DESC')->get();
        $marchant_logo =  Merchant::where('status', 1)->select('logo')->get();
        $sponsor_logo =  Logo::where('status', 1)->where('type', 4)->get();
        $packages = LaundryPackage::where('branch_id', $selectedBranch)->where('status', 1)->orderBy('id', 'DESC')->get();
        $products =  LaundryProduct::where('status', 'Active')
                    ->whereHas('branch', function($q) use ($selectedBranch) {
                        $q->where('laundry_branch_id', $selectedBranch);
                    });
                    if($request->search_value) {
                        $products = $products->where('product_name', 'like', '%'.$request->search_value.'%');
                    }
                    $products = $products->with('service')->with('category')->with('branch')->paginate(24);
        
        return view('frontEnd.index', compact(
            'banner',
            'ads',
            'about',
            'counter',
            'services',
            'prices',
            'features',
            'clientsfeedback',
            'hubarea',
            'delivery_charges',
            'topbanner',
            'marchant_logo',
            'sponsor_logo',
            'sliders',
            'slogan',
            'products',
            'packages'
        ));
    }

    public function login()
    {
        return view('backEnd.setting.login');
    }

    public function costCalculate(Request $request)
    {
        if ($request->merchantId) {
            $mercharntInfo = Merchant::where('id', $request->merchantId)->first();
        } else {
            $mercharntInfo = Merchant::where('id', Session::get('merchantId'))->first();
        }

        $weight = Weight::find($request->weight_id);
        $thana = Thana::find($request->thana_id);
        if (empty($thana->deliverycharge_id)) {
            return response()->json([
                'success' => false,
                'message' => 'Your selected thana is disabled.',
            ]);
        }

        // get deliverycharge
        $deliveryChargeInfo = Deliverycharge::where(['id' => $thana->deliverycharge_id])->first();
        $delivery_charge = $deliveryChargeInfo->deliverycharge - (($deliveryChargeInfo->deliverycharge * $mercharntInfo->del_commission) / 100);

        // cod charge
        // $codChargeInfo = Codcharge::where(['status' => 1])->first();
        $codcharge = (floatval($deliveryChargeInfo->cod_charge) * $request->productPrice) / 100;
        $codcharge = $codcharge - (($codcharge * $mercharntInfo->cod_commission) / 100);

        // Extra charge
        $extra_weight = $weight->value - 1;
        $delivery_charge = $delivery_charge + ($extra_weight * $deliveryChargeInfo->extradeliverycharge);

        // Promotional discount
        $promotiuonal_discount_exist = PromotionalDiscount::whereDate('start_date', '<=', date('Y-m-d'))
            ->whereDate('end_date', '>=', date('Y-m-d'))
            ->where('status', 1)->first();
        if ($promotiuonal_discount_exist) {
            $promotiuonal_discount = ($delivery_charge * $promotiuonal_discount_exist->discount) / 100;
        } else {
            $promotiuonal_discount = 0;
        }
        $delivery_charge = $delivery_charge - $promotiuonal_discount;

        Session::put('codpay', $request->productPrice);
        Session::put('pdeliverycharge', round($delivery_charge, 2));
        Session::put('pcodecharge', round($codcharge, 2));
        Session::put('promotiuonal_discount', round($promotiuonal_discount, 2));
        return response()->json([
            'success' => true,
            'codpay' => $request->productPrice,
            'pdeliverycharge' => number_format($delivery_charge, 2),
            'pcodecharge' => number_format($codcharge, 2),
            'total_charge' => number_format(($delivery_charge + $codcharge), 2),
            'promotiuonal_discount' => number_format(($promotiuonal_discount), 2)
        ]);
    }


    public function costCalculateResult()
    {
        return view('frontEnd.layouts.pages.costcalculate');
    }
    public function register()
    {
        return view('frontEnd.layouts.pages.register');
    }
    public function marchentlogin()
    {
        if (Session::get('merchantId')) {
            return redirect('merchant/dashboard');
        } else {
            return view('frontEnd.layouts.pages.marchentlogin');
        }
    }
    public function parceltrack(Request $request)
    {

        $trackparcel = DB::table('parcels')
            ->leftJoin('merchants', 'merchants.id', '=', 'parcels.merchantId')
            ->leftJoin('divisions', 'parcels.division_id', '=', 'divisions.id')
            ->leftJoin('districts', 'parcels.district_id', '=', 'districts.id')
            ->leftJoin('thanas', 'parcels.thana_id', '=', 'thanas.id')
            ->leftJoin('areas', 'parcels.area_id', '=', 'areas.id')
            ->where('parcels.trackingCode', $request->trackparcel)
            ->select('parcels.*', 'divisions.name as division', 'districts.name as district', 'thanas.name as thana', 'areas.name as area', 'merchants.companyName', 'merchants.phoneNumber', 'merchants.emailAddress')
            ->first();
        if ($trackparcel) {
            $trackInfos = Parcelnote::where('parcelId', $trackparcel->id)->orderBy('id', 'ASC')->get();

            return view('frontEnd.layouts.pages.trackparcel', compact('trackparcel', 'trackInfos'));
        } else {
            return redirect()->back();
        }
    }
    public function parceltrackget($id)
    {
        $trackparcel = DB::table('parcels')
            ->join('nearestzones', 'parcels.reciveZone', '=', 'nearestzones.id')
            ->where('parcels.trackingCode', $id)
            ->select('parcels.*', 'nearestzones.zonename')
            ->orderBy('id', 'DESC')
            ->first();


        if ($trackparcel) {
            $trackInfos = Parcelnote::where('parcelId', $trackparcel->id)->orderBy('id', 'ASC')->get();
            // return $trackInfos;
            return view('frontEnd.layouts.pages.trackparcel', compact('trackparcel', 'trackInfos'));
        } else {
            return redirect()->back();
        }
    }

    public function aboutus()
    {
        $aboutus = About::where('status', 1)->limit(1)->orderBy('id', 'DESC')->get();
        return view('frontEnd.layouts.pages.aboutus', compact('aboutus'));
    }
    public function ourservice($id)
    {
        $servicedetails = Service::where(['id' => $id, 'status' => 1])->first();
        if ($servicedetails) {
            return view('frontEnd.layouts.pages.service', compact('servicedetails'));
        } else {
            return redirect('404');
        }
    }

    public function onetimeservice()
    {
        return view('frontEnd.layouts.pages.onetimeservice');
    }
    public function career()
    {
        $careers = Career::where('status', 1)->get();
        return view('frontEnd.layouts.pages.careers', compact('careers'));
    }
    public function careerdetails($id, $slug)
    {
        $careerdetails = Career::where(['id' => $id, 'status' => 1])->first();
        if ($careerdetails) {
            return view('frontEnd.layouts.pages.careerdetails', compact('careerdetails'));
        } else {
            return redirect('404');
        }
    }
    public function notice()
    {
        $notices = Notice::where('status', 1)->get();
        return view('frontEnd.layouts.pages.notices', compact('notices'));
    }
    public function noticedetails($id, $slug)
    {
        $noticedetails = Notice::where(['id' => $id, 'status' => 1])->first();
        if ($noticedetails) {
            return view('frontEnd.layouts.pages.noticedetails', compact('noticedetails'));
        } else {
            return redirect('404');
        }
    }
    public function gallery()
    {
        $gallery = Gallery::where('status', 1)->get();
        return view('frontEnd.layouts.pages.gallery', compact('gallery'));
    }
    public function contact()
    {
        return view('frontEnd.layouts.pages.contact');
    }
    public function termscondition()
    {
        return view('frontEnd.layouts.pages.termscondition');
    }

    public function marchentdashboard()
    {
        return view('frontEnd.layouts.pages.marchentdashboard');
    }

    public function createpage($slug, $id)
    {
        $pagedetails = Createpage::where(['status' => 1, 'id' => $id])->first();
        return view('frontEnd.layouts.pages.createpage', compact('pagedetails'));
    }


    //product section
    public function productDetails($id, $slug) {
        $details =  LaundryProduct::where('id', $id)->with('category')->first();
        $branches = LaundryProductBranch::where('laundry_product_id', $id)->with('hub')->get();
        $services = ProductService::where('laundry_product_id', $id)->with('serviceName')->get();
        $relatedProducts = LaundryProduct::where([['category_id','=',$details->category_id],['id','!=',$id]])->with('category')->inRandomOrder()->limit(24)->get();
        
        return view('frontEnd.layouts.pages.product_details', compact('details','services','branches','relatedProducts'));

    }

    public function packageDetails($id) {
        $package = LaundryPackage::where('id', $id)->where('status', 1)->first();
        //$package_item = LaundryPackageItem::where('package_id', $package->id)->get();
        return view('frontEnd.package.details', compact('package'));
    }

    //add to cart
    public function addToCart(Request $request) {
        $response = array();
        if(!Session::get('merchantId')) {
            $response['status'] = false;
            $response['message'] = 'Please login and try again';
            return $response;
        }

        $cartExist = Cart::where('customer_id', Session::get('merchantId'))->first();

        if($cartExist) {
            //check product already added or not
            $exist = CartItem::where([['customer_id','=',Session::get('merchantId')],['product_id','=',$request->productID],['status','=','Active'],['service_id','=',$request->serviceId],['cart_id','=',$cartExist->id]])->first();
            
            if($exist) {
                //update quantity
                $exist->quantity = $exist->quantity + $request->quantity;
                $exist->save();

                //get total product quantity
                $response['total'] = CartItem::where('customer_id', Session::get('merchantId'))->sum('quantity');
                $response['status'] = true;
                $response['message'] = 'Product added to cart successfully';
            }else {
            
                $store_data = new CartItem();

                $store_data->cart_id = $cartExist->id;
                $store_data->customer_id = Session::get('merchantId');
                $store_data->product_id = $request->productID;
                $store_data->service_id = $request->serviceId;
                $store_data->quantity = $request->quantity;
                $store_data->status = 'Active';
                $store_data->save();
                $insId = $store_data->id;
                if($insId) {
                    $response['total'] = CartItem::where('customer_id', Session::get('merchantId'))->sum('quantity');
                    $response['status'] = true;
                    $response['message'] = 'Product added to cart successfully';
                }else {
                    $response['status'] = false;
                    $response['message'] = 'Something was wrong';
                }
            }
        }else {
            //create cart
            $customerAddress = CustomerAddress::where('customer_id', Session::get('merchantId'))->where('is_default', 'yes')->first();

            $createCart = new Cart();
            $createCart->customer_id = Session::get('merchantId');
            $createCart->billing_id = $customerAddress? $customerAddress->id:0;
            $createCart->shipping_id = $customerAddress? $customerAddress->id:0;
            $createCart->status = 'Active';
            $createCart->save();
            $cartId = $createCart->id;
            if($cartId) {
                $store_data = new CartItem();

                $store_data->cart_id = $cartId;
                $store_data->customer_id = Session::get('merchantId');
                $store_data->product_id = $request->productID;
                $store_data->service_id = $request->serviceId;
                $store_data->quantity = $request->quantity;
                $store_data->status = 'Active';
                $store_data->save();
                $insId = $store_data->id;
                if($insId) {
                    $response['total'] = CartItem::where('customer_id', Session::get('merchantId'))->sum('quantity');
                    $response['status'] = true;
                    $response['message'] = 'Product added to cart successfully';
                }else {
                    $response['status'] = false;
                    $response['message'] = 'Something was wrong';
                }
            }
            
        }

        return $response;
    }

     //add to cart package
     public function addToCartPackage(Request $request) {

        //return response()->json($request->all());
        $response = array();
        if(!Session::get('merchantId')) {
            $response['status'] = false;
            $response['message'] = 'Please login and try again';
            return $response;
        }

        $cartExist = Cart::where('customer_id', Session::get('merchantId'))->first();

        if($cartExist) {
            //check product already added or not
            $exist = CartItem::where([['customer_id','=',Session::get('merchantId')],['package_id','=',$request->package_id],['status','=','Active'],['cart_id','=',$cartExist->id]])->first();
            
            if($exist) {
                //update quantity
                $exist->quantity = $exist->quantity + $request->quantity;
                $exist->save();

                //get total product quantity
                $response['total'] = CartItem::where('customer_id', Session::get('merchantId'))->sum('quantity');
                $response['status'] = true;
                $response['message'] = 'Product added to cart successfully';
            }else {
            
                $store_data = new CartItem();

                $store_data->cart_id = $cartExist->id;
                $store_data->customer_id = Session::get('merchantId');
                $store_data->package_id = $request->package_id;
                //$store_data->service_id = $request->serviceId;
                $store_data->quantity = $request->quantity;
                $store_data->status = 'Active';
                $store_data->save();
                $insId = $store_data->id;
                if($insId) {
                    $response['total'] = CartItem::where('customer_id', Session::get('merchantId'))->sum('quantity');
                    $response['status'] = true;
                    $response['message'] = 'Product added to cart successfully';
                }else {
                    $response['status'] = false;
                    $response['message'] = 'Something was wrong';
                }
            }
        }else {
            //create cart
            $customerAddress = CustomerAddress::where('customer_id', Session::get('merchantId'))->where('is_default', 'yes')->first();

            $createCart = new Cart();
            $createCart->customer_id = Session::get('merchantId');
            $createCart->billing_id = $customerAddress? $customerAddress->id:0;
            $createCart->shipping_id = $customerAddress? $customerAddress->id:0;
            $createCart->status = 'Active';
            $createCart->save();
            $cartId = $createCart->id;
            if($cartId) {
                $store_data = new CartItem();

                $store_data->cart_id = $cartId;
                $store_data->customer_id = Session::get('merchantId');
                $store_data->package_id = $request->package_id;
                //$store_data->service_id = $request->serviceId;
                $store_data->quantity = $request->quantity;
                $store_data->status = 'Active';
                $store_data->save();
                $insId = $store_data->id;
                if($insId) {
                    $response['total'] = CartItem::where('customer_id', Session::get('merchantId'))->sum('quantity');
                    $response['status'] = true;
                    $response['message'] = 'Product added to cart successfully';
                }else {
                    $response['status'] = false;
                    $response['message'] = 'Something was wrong';
                }
            }
            
        }

        return $response;
    }

    public function cartPage() {
        $items = CartItem::where('customer_id', Session::get('merchantId'))->with(['product','service', 'package'])->get();
        //return $items;
        return view('frontEnd.layouts.pages.cartpage',compact('items'));
    }


    public function updateCartQuantity(Request $request) {
        $response = array();
        $item = CartItem::where('id', $request->cartId)->first();

        if($request->operation == 'inc') {
            //increament cart quantity
            $item->quantity = $item->quantity + 1;
            $item->save();

            $response['status'] = true;
            $response['message'] = 'Quantity increamented';

        }elseif($request->operation == 'dec') {
            if($item->quantity >1) {
                $item->quantity = $item->quantity - 1;
                $item->save();

                $response['status'] = true;
                $response['message'] = 'Quantity decreamented';
            }
            
        }elseif($request->operation == 'rem') {
            $item->delete();
            $response['status'] = true;
            $response['message'] = 'Item removed';
        }

        return $response;

    }


    public function checkout() {
        $items = CartItem::where('customer_id', Session::get('merchantId'))->with('product')->with('service')->with('package')->get();
        $shippingAndBilling = Cart::where('customer_id', Session::get('merchantId'))->with('shipping')->with('billing')->first();
        $customerAddresses = CustomerAddress::where('customer_id', Session::get('merchantId'))->with('division')->with('district')->with('thana')->get();

        //return $shippingAndBilling;
        
        return view('frontEnd.layouts.pages.checkout',compact('items','shippingAndBilling'));
    }


    public function addShippingAddress(Request $request) {
   
        $validate = $request->validate([
            'address_id' => 'required',
        ]);

        $data = array();
        if($request->address_type == 'billing') {
            $data = ['billing_id'=> $request->address_id];
        }elseif($request->address_type == 'shipping') {
            $data = ['shipping_id'=> $request->address_id];
        }

        $cart = Cart::where('customer_id', Session::get('merchantId'))->update($data);
        if($cart) {
            return redirect()->route('product.checkout')->with('success','Address added successfully');
        }else {
            return redirect()->route('product.checkout')->with('error','Failed to add address');
        }
    }

    public function placeOrder(Request $request) {
        // product and package place order
        
        $cart = Cart::where('customer_id', Session::get('merchantId'))->first();
        $cartItems = CartItem::where('customer_id', $cart->customer_id)->where('cart_id', $cart->id)->with('product')->with('service')->with('package')->get();
        //return $cartItems;
        
        if(sizeof($cartItems) < 1) {
            return redirect()->back()->with('error', 'Your cart is now empty.');
        }
        
        //check shipping address exist or not
        if(!$cart->shipping_id) {
            return redirect()->route('product.checkout')->with('error', 'Shipping address required');
        }

        $order = new Order();
        $order->order_datetime = date('Y-m-d H:i:s');
        $order->customer_id = $cart->customer_id;
        $order->branch_id = Session::get('default_branch');
        $order->payment_method_id = 1;
        $order->picked_time = date('Y-m-d H:i:s', strtotime($request->picked_time));
        $order->save();
        $orderId = $order->id;
        //$orderId = 1;
        $is_package_order = 0;
        if($orderId) {
            //insert order items
            foreach($cartItems as $item) {

                //get discount
                //dd($item);
                if($item->product_id != NULL) {
                    $discount = 0;
                    $discountInfo = LaundryDiscount::where('product_id', $item->product_id)
                                                        ->where('customer_id', $item->customer_id)
                                                        ->where('status', 1)
                                                        ->where('product_service_id', $item->service_id)
                                                        ->first();
                    if($discountInfo) {
                        $discount = (($item->service->amount * $item->quantity) * $discountInfo->discount) / 100;
                    }
                } else if($item->package_id != NULL) {
                    //$pkg = LaundryPackage::where('id', $item->package_id)->first();
                    $pkg_items = LaundryPackageItem::where('package_id', $item->package_id)->get();
                    foreach($pkg_items as $pkg_item) {
                        $laundry_pkg_order_item = new LaundryPkgOrderItem();
                        $laundry_pkg_order_item->order_id = $orderId;
                        $laundry_pkg_order_item->customer_id = $item->customer_id;//Session::get('merchantId'))
                        $laundry_pkg_order_item->product_id = $pkg_item->product_id;
                        $laundry_pkg_order_item->service_id = $pkg_item->service_id;
                        $laundry_pkg_order_item->package_id = $pkg_item->package_id;
                        $laundry_pkg_order_item->amount = $pkg_item->amount;
                        $laundry_pkg_order_item->max_qty = $pkg_item->max_qty;
                        $laundry_pkg_order_item->save();
                    }
                }

                $orderItem = new OrderItem();
                $orderItem->order_id = $orderId;
                $orderItem->customer_id = $item->customer_id;
                $orderItem->product_id = $item->product_id;
                $orderItem->package_id = $item->package_id;
                $orderItem->qty = $item->quantity;
                // product_id null na hole below insert, na hole zero or null insert
                if($item->product_id != NULL) {
                    $orderItem->shipping_charge = $item->product->shipping_charge;
                    $orderItem->service_id = $item->service_id;
                    $orderItem->service_amount = $item->service->amount;
                    $orderItem->service_discount = $discount;
                    $orderItem->total = ($item->service->amount * $item->quantity) + $item->product->shipping_charge - $discount;
                } else {
                    //$orderItem->shipping_charge = 0;
                    $orderItem->total = ($item->package->package_amount * $item->quantity);
                    $is_package_order = 1;
                }

                $orderItem->save();
            }

            //package order hole
            if($is_package_order == 1) {
                $update_order = Order::find($orderId);
                $update_order->is_package_order = 1;
                $update_order->save();
            }

            //delete cart items
            CartItem::where('customer_id', $cart->customer_id)->delete();

            //order shipping
            $orderShipping = CustomerAddress::where('id', $cart->shipping_id)->first();
            

            $storeShipping = new OrderShipping();
            $storeShipping->order_id = $orderId;
            $storeShipping->type = $orderShipping->type;
            $storeShipping->fullname = $orderShipping->fullname;
            $storeShipping->mobile_no = $orderShipping->mobile_no;
            $storeShipping->region_id = $orderShipping->region_id;
            $storeShipping->city_id = $orderShipping->city_id;
            $storeShipping->area_id = $orderShipping->area_id;
            $storeShipping->address = $orderShipping->address;
            $storeShipping->save();

            if($cart->billing_id) {
                $orderBilling = CustomerAddress::where('id', $cart->billing_id)->first();

                $storeBilling = new OrderBilling();
                $storeBilling->order_id = $orderId;
                $storeBilling->type = $orderBilling->type;
                $storeBilling->fullname = $orderBilling->fullname;
                $storeBilling->mobile_no = $orderBilling->mobile_no;
                $storeBilling->region_id = $orderBilling->region_id;
                $storeBilling->city_id = $orderBilling->city_id;
                $storeBilling->area_id = $orderBilling->area_id;
                $storeBilling->address = $orderBilling->address;
                $storeBilling->save();
            }

            return redirect()->route('product.cartpage')->with('success','Order successfully placed');
        } else {
            return redirect()->route('product.cartpage')->with('error','Order failed');
        }
        
    }


    //create address
    public function createAddress(Request $request) {

        $validate = $request->validate([
            'fullname' => 'required',
            'shipping_mobile_no' => 'required|numeric',
            'region_id' => 'required',
            'city_id' => 'required',
            'area_id' => 'required',
            'address' => 'required',
            'type' => 'required',
        ]);

        //check address exist or not
        $exist = CustomerAddress::where([
            ['customer_id' ,'=', Session::get('merchantId')],
            ['region_id','=', $request->region_id],
            ['city_id' ,'=', $request->city_id],
            ['area_id' ,'=', $request->area_id],
            ['address' ,'=', $request->address],
            ])->first();
        if($exist) {
            return redirect()->back()->with('error', 'Address already added');
        }

        $customerAddress = new CustomerAddress();
        $customerAddress->customer_id = Session::get('merchantId');
        $customerAddress->is_default = 'no';
        $customerAddress->type = $request->type;
        $customerAddress->fullname = $request->fullname;
        $customerAddress->mobile_no = $request->shipping_mobile_no;
        $customerAddress->region_id = $request->region_id;
        $customerAddress->city_id = $request->city_id;
        $customerAddress->area_id = $request->area_id;
        $customerAddress->address = $request->address;
        $customerAddress->save();
        $insId = $customerAddress->id;
        if($insId) {
            return redirect()->back()->with('success', 'Address addedd successfully');
        }else {
            return redirect()->back()->with('error', 'Something was wrong');
        }

    }

    //product by category
    public function productsByCategory(Request $request,$slug) {
        $categoryInfo = LaundryProductCategory::where('slug', $slug)->first();
        $categories = LaundryProductCategory::where('status', 'Active')->orderBy('id', 'desc')->get();

        $products = LaundryProduct::where('status', 'Active')->where('category_id', $categoryInfo->id);
                    if($request->price_range) {
                        $prices = explode('-', $request->price_range);
                        $min = $prices[0];
                        $max = $prices[1];

                        $products = $products->where('min_price','>=',$min)->where('max_price', '<=', $max);
                    }
                    if($request->order) {
                        if($request->order=='min_price') {
                            $short = 'asc';
                        }else {
                            $short = 'desc';
                        }
                        $products = $products->orderBy($request->order, $short);
                    }
                    if($request->branch) {
                        Session::put('default_branch', $request->branch);
                        $selectedBranch = Session::get('default_branch');
                        $products = $products->whereHas('branch', function($q) use ($selectedBranch) {
                            $q->where('laundry_branch_id', $selectedBranch);
                        });
                    }else {
                        $selectedBranch = Session::get('default_branch');
                        $products = $products->whereHas('branch', function($q) use ($selectedBranch) {
                            $q->where('laundry_branch_id', $selectedBranch);
                        });
                    }

                    $products = $products->with('service')->with('category')->with('branch')->paginate(24);
                    
                    
        return view('frontEnd.layouts.pages.product_list', compact('categoryInfo','categories','products'));
    }

}
