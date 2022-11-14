<?php

namespace App\Http\Controllers;

use App\Agent;
use App\AgentThana;
use App\Area;
use App\Customer;
use App\Deliveryman;
use App\District;
use App\Employee;
use App\Merchant;
use App\Parcel;
use App\Pickupman;
use App\ProductService;
use App\SalonDiscount;
use App\SalonService;
use App\Thana;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CommonController extends Controller
{
    public function getAreaAddress(Request $request){
        $address = [];
        if($request->area_id){
            $address = Parcel::where('area_id', $request->area_id)->distinct('delivery_address')->select('delivery_address')->take(200)->get();
        }
        return response()->json($address);
    }

    public function getDivisionDistricts(Request $request){
        $districts = District::orderBy('name')->where('division_id', $request->division_id)->where('status',1)->get();
        return response()->json($districts);
    }
    
    public function getDistrictThanas(Request $request){
        $thanas = Thana::orderBy('name')->where('district_id', $request->district_id)->where('status',1)->get();
        return response()->json($thanas);
    }
    
    public function getDistrictAgents(Request $request){
        $agent_ids = AgentThana::where('district_id', $request->district_id)->distinct('agent_id')->pluck('agent_id');
        $agents = Agent::orderBy('name')->whereIn('id', $agent_ids)->where('status',1)->get();
        return response()->json($agents);
    }
    
    public function getThanaAreas(Request $request){
        $areas = Area::where('thana_id', $request->thana_id)->where('status',1)->get();
        return response()->json($areas);
    }
    
    public function getAgentAreas(Request $request){
        $thana_ids = AgentThana::whereIn('agent_id', $request->agent_id)->distinct('thana_id')->pluck('thana_id');
        $areas = Area::with('thana')->orderBy('name')->whereIn('thana_id', $thana_ids)->where('status',1)->get();
        return response()->json($areas);
    }
    
    public function getThanaDeliverymenPickupman(Request $request){
        $deliverymens = Deliveryman::where('thana_id', $request->thana_id)->where('status',1)->get();
        $pickupmans = Pickupman::where('thana_id', $request->thana_id)->where('status',1)->get();
        $data = [
            'deliverymens' => $deliverymens,
            'pickupmans' => $pickupmans,
        ];
        return response()->json($data);
    }
    
    public function getMerchantDetails(Request $request){
        $data = Merchant::find($request->merchantId);
        return response()->json($data);
    }

    public function getCustomers(Request $request) {
       
        $customers = Customer::where([
            ['status', 1],
            ['customer_type', $request->type],
            ['origin', Session::get('section')]
        ])->get();

        return response()->json($customers);
    }

    public function getServices(Request $request) {

        $services = ProductService::where('laundry_product_id', $request->product_id)->with('serviceName')->get();
        return $services;
    }

    public function getServicesAmount(Request $request) {
        $services = ProductService::where('laundry_product_id', $request->product_id)->where('laundry_service_id', $request->service_id)->first();
        //$services = ProductService::where('id', $request->id)->first();
        return $services;
    }

    // mahfuz change
    public function getProducts(Request $request)
    {  
        //$output = '<div class="row ml-4">';
        //return $request->search_data;
        $output = '';
        $last_id = '';
        //$count = 0;
        if ($request->id > 0) {
            if ($request->search_data != '') {
                $salon_services = SalonService::where(function ($q) use ($request) {
                    $q->where('service_name', 'like', '%' . $request->search_data . '%')
                        ->orWhere('category_id', 'like', '%' . $request->search_data . '%')
                        //->orWhere('category_id', $request->search_data)
                        ->orWhereHas('salonCategory', function ($sq) use ($request) {
                            $sq->where('cat_name', 'like', '%' . $request->search_data . '%');
                        });
                })->where('id', '>', $request->id)->with('salonParentService')->take(10)->get();
            } else {
                $salon_services = SalonService::where('id', '<', $request->id)->with('salonParentService')->take(10)->get();
            }
        } else {
            if ($request->search_data != '') {
                $salon_services = SalonService::where(function ($q) use ($request) {
                    $q->where('service_name', 'like', '%' . $request->search_data . '%')
                        ->orWhere('category_id', 'like', '%' . $request->search_data . '%')
                        //->orWhere('category_id', $request->search_data)
                        ->orWhereHas('salonCategory', function ($sq) use ($request) {
                            $sq->where('cat_name', 'like', '%' . $request->search_data . '%');
                        });
                })->with('salonParentService')->take(10)->get();
            } else {
                $salon_services = SalonService::orderBy('id', 'desc')->with('salonParentService')->take(10)->get();
            }
        }
        //$salon_services = SalonService::orderBy('id', 'desc')->with('salonParentService')->take(1)->get();
        //return $salon_services;
        foreach ($salon_services as $salon_service) {
            //$category = $product->category->cat_name ?? null;
            //$color = $product->productColor->name ?? null;
            //$size = $product->productSize->name ?? null;
            //$product_img = 'https://laundryexp.com/'.$salon_service->salonParentService->image ?? 'public/no_image.jpg';
            //$product_img = 'https://localhost/londry/'.$salon_service->image ?? 'https://localhost/londry/'.$salon_service->salonParentService->image;
            $product_img = $salon_service->image ?? 'public/no_image.jpg';

            /*$output .= '<div class="col-md-4" title="' . $product->name . '">
                            <div class="box box-success box-solid">
                                <div class="box-body text-center">
                                    <b>' . substr($product->name, 0, 15) . '</b> <br>
                                    <img class="rounded" src="' . url($product_img) . '" alt="" height="50" width="50">
                                    <div class="text-center" style="margin-top: 5px;">
                                        <button type="button" class="btn btn-xs btn-success add_to_sale" data-id="' . $product->code . '" id="add-to-cart">
                                            <i class="fa fa-plus" aria-hidden="true"></i>
                                            Add to Cart
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>';*/
            $output .= '<div class="col-md-5 m-2">
                                <div class="border border-success rounded">
                                    <div class="shadow bg-body rounded p-1">
                                        <div class="text-center">
                                            <b>' . substr($salon_service->service_name, 0, 15) . '</b> <br>
                                            <img class="rounded" src="'. URL($product_img) .'"
                                                alt="" height="50" width="50">
                                            <div class="text-center" style="margin-top: 5px;">
                                                <button type="button"
                                                    class="btn btn-sm btn-success add_to_sale" data-id="'. $salon_service->id .'"
                                                    id="add-to-cart">
                                                    <i class="fa fa-plus" aria-hidden="true"></i>
                                                    Add to Cart
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        </div>';
            $last_id = $salon_service->id;
            //$count++;
        }
        //$output .= '</div>';
        if (count($salon_services) >= 9) {
            $output .= '<div class="col-md-12 load-more text-center">
                            <div class="">
                                <button type="button" name="load_more_btn" class="btn btn-success" data-lid="' . $last_id . '" id="load_more_btn">Load More</button>
                            </div>
                        </div>';
        }
        return $output;
    }

    public function getProductDetails(Request $request) {
        $product = SalonService::where('id', $request->id)->first();
        // if ($product) {
        //     return response()->json(['success' => true, 'data' => $product]);
        // } else {
        //     return response()->json(['success' => false, 'data' => null]);
        // }

        $discount = SalonDiscount::where('customer_id', $request->customer_id)->where('service_id', $request->id)->first();
        if(!$discount) {
            $discount = 0;
        }
        if ($product) {
            return response()->json(['success' => true, 'data' => $product, 'discount' => $discount]);
        } else {
            return response()->json(['success' => false, 'data' => null]);
        }

    }

    public function get_employee() {
        $employees = Employee::where('origin', $this->findOrigin())->get();
        return response()->json($employees);
    }

    // for laundry quick sale, set customer_id in session
    public function setCustomerIdInSession(Request $request) {
        Session::put('customer_id', $request->customer_id);
        return response()->json(['success' => true]);
        //return response()->json($request->customer_id);
    }


}
