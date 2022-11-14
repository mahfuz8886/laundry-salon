<?php

use App\Merchant;
use App\Parcel;
use App\Parcelnote;
use Illuminate\Support\Facades\Route;

Auth::routes();
//Clear Config cache:
Route::get('/config-cache', function () {
    $exitCode = Artisan::call('config:cache');
    return '<h1>Clear Config cleared</h1>';
});

//Clear View cache:
Route::get('/view-clear', function () {
    $exitCode = Artisan::call('view:clear');
    return '<h1>View cache cleared</h1>';
});

//Migrate create
Route::get('/migrate', function () {
    $exitCode = Artisan::call('migrate');
    return '<h1>Migrate Create</h1>';
});
Route::get('locale/{locale}', function ($locale) {
    Session::put('locale', $locale);
    return back();
});

Route::post('visitor/contact', 'VisitorController@visitorcontact');
Route::post('merchant/support', 'VisitorController@merchantsupport');
Route::post('career/apply', 'VisitorController@careerapply');

Route::group(['namespace' => 'FrontEnd'], function () {
    Route::get('/', 'FrontEndController@index');
    Route::get('/pages/{slug}/{id}', 'FrontEndController@createpage');
    Route::get('/about-us', 'FrontEndController@aboutus');
    Route::get('/our-service/{id}', 'FrontEndController@ourservice');
    Route::get('/one-time-service', 'FrontEndController@onetimeservice');
    Route::get('/career', 'FrontEndController@career');
    Route::get('/career/{id}/{slug}', 'FrontEndController@careerdetails');
    Route::get('/gallery', 'FrontEndController@gallery');
    Route::get('/notice', 'FrontEndController@notice');
    Route::get('/notice/{id}/{slug}', 'FrontEndController@noticedetails');
    Route::get('/contact-us', 'FrontEndController@contact');
    Route::get('/terms-condition', 'FrontEndController@termscondition');
    Route::post('/track/parcel/', 'FrontEndController@parceltrack');
    Route::get('/track/parcel/{id}', 'FrontEndController@parceltrackget');
    Route::get('/cost/calculate', 'FrontEndController@costCalculate');
    Route::get('cost/calculate/result', 'FrontEndController@costCalculateResult');

    /*.......product page..........*/

    Route::get('product/details/{id}/{slug}','FrontEndController@productDetails');
    Route::get('package/details/{id}','FrontEndController@packageDetails');
    Route::post('product/addtocart','FrontEndController@addToCart')->name('product.addtocart');
    Route::post('product/addtocart/package','FrontEndController@addToCartPackage')->name('package.addtocart_package');
    Route::get('product/cartpage','FrontEndController@cartPage')->name('product.cartpage');
    Route::post('product/update_cart_quantity','FrontEndController@updateCartQuantity')->name('product.updateCart');
    Route::get('product/checkout','FrontEndController@checkout')->name('product.checkout');
    Route::post('product/add_shipping_address','FrontEndController@addShippingAddress')->name('product.addShipping');
    Route::post('product/create_address','FrontEndController@createAddress')->name('product.createAddress');
    Route::post('product/place_order','FrontEndController@placeOrder')->name('product.placeOrder');
    Route::get('category/{slug}', 'FrontEndController@productsByCategory')->name('product.categoryProduct');


    Route::get('package/details', 'FrontEndController@packageDetails')->name('package.details');

    /*.......product page..........*/

    Route::get('user/login', 'MerchantController@loginpage');
    // Merchant Operation 
    Route::get('merchant/register', 'MerchantController@registerpage');
    Route::post('auth/merchant/register', 'MerchantController@register');
    Route::post('free/merchant/register', 'MerchantController@freeregister');
    Route::get('merchant/login', 'MerchantController@loginpage');
    Route::post('merchant/login', 'MerchantController@login');
    Route::get('merchant/logout', 'MerchantController@logout');
    Route::get('merchant/verify', 'MerchantController@merchantverify');
    Route::post('merchant/verify/save', 'MerchantController@merchantverifysave');

    Route::get('merchant/forget/password', 'MerchantController@passreset');
    Route::post('auth/merchant/password/reset', 'MerchantController@passfromreset');
    Route::get('/merchant/resetpassword/verify', 'MerchantController@resetpasswordverify');
    Route::get('resend/password-reset/code/{id}', 'MerchantController@resendPasswordcode');
    Route::post('auth/merchant/reset/password', 'MerchantController@saveResetPassword');
    Route::post('auth/merchant/single-servicer', 'MerchantController@singleservice');


    // Agent Operation
    Route::get('agent/login', 'AgentController@loginform');
    Route::post('auth/agent/login', 'AgentController@login');
    Route::get('agent/forget/password', 'AgentController@passreset');
    Route::post('auth/agent/password/reset', 'AgentController@passfromreset');
    Route::get('/agent/resetpassword/verify', 'AgentController@resetpasswordverify');
    Route::post('auth/agent/reset/password', 'AgentController@saveResetPassword');

    // Deliveryman Operation
    Route::get('deliveryman/login', 'DeliverymanController@loginform');
    Route::post('auth/deliveryman/login', 'DeliverymanController@login');
    Route::get('deliveryman/forget/password', 'DeliverymanController@passreset');
    Route::post('auth/deliveryman/password/reset', 'DeliverymanController@passfromreset');
    Route::get('/deliveryman/resetpassword/verify', 'DeliverymanController@resetpasswordverify');
    Route::post('auth/deliveryman/reset/password', 'DeliverymanController@saveResetPassword');

    // Pickupman Operation
    Route::get('pickupman/login', 'PickupmanController@loginform');
    Route::post('auth/pickupman/login', 'PickupmanController@login');
    Route::get('pickupman/forget/password', 'PickupmanController@passreset');
    Route::post('auth/pickupman/password/reset', 'PickupmanController@passfromreset');
    Route::get('/pickupman/resetpassword/verify', 'PickupmanController@resetpasswordverify');
    Route::post('auth/pickupman/reset/password', 'PickupmanController@saveResetPassword');
});

Route::group(['namespace' => 'FrontEnd', 'middleware' => ['agentauth']], function () {
    Route::get('/agent/dashboard', 'AgentController@dashboard');
    Route::get('agent/logout', 'AgentController@logout');
    Route::get('agent/parcels', 'AgentController@parcels');
    Route::get('agent/assignable-parcels', 'AgentController@assignableParcels');
    Route::post('agent-parcel-assign-parcel', 'AgentController@assignParcel');
    Route::get('agent/parcel/invoice/{id}', 'AgentController@invoice');
    Route::get('agent/pickup', 'AgentController@pickup');
    Route::post('agent/deliveryman/asign', 'AgentController@delivermanasiagn');
    Route::post('agent/pickupman/asign', 'AgentController@pickmanasiagn');
    Route::post('agent/parcel/status-update', 'AgentController@statusupdate');
    Route::post('agent/pickup/deliveryman/asign', 'AgentController@pickupdeliverman');
    Route::post('agent/pickup/status-update', 'AgentController@pickupstatus');
    Route::post('agent/parcel/export', 'AgentController@export');
});

Route::group(['as'=>'deliveryman.','namespace' => 'FrontEnd', 'middleware' => ['deliverymanauth']], function () {
    Route::get('deliveryman/dashboard', 'DeliverymanController@dashboard');
    Route::get('deliveryman/logout', 'DeliverymanController@logout');

    Route::get('deliveryman/parcels', 'DeliverymanController@parcels');
    Route::get('deliveryman/order-details/{id}', 'DeliverymanController@orderDetails')->name('orderdetails');
    Route::post('deliveryman/order-delivery', 'DeliverymanController@deliveredOrder')->name('orderdelivered');

    Route::get('deliveryman/pending-parcels', 'DeliverymanController@pendingParcels');
    Route::post('deliveryman/asign', 'DeliverymanController@deliverymanAsign');
    Route::get('deliveryman/parcel/invoice/{id}', 'DeliverymanController@invoice');
    Route::post('deliveryman/parcel/status-update', 'DeliverymanController@statusupdate');
    Route::get('deliveryman/pickup', 'DeliverymanController@pickup');
    Route::post('deliveryman/pickup/status-update', 'AgentController@pickupstatus');
    Route::post('deliveryman/parcel/export', 'DeliverymanController@export');
    Route::get('deliveryman/payments/{type}', 'DeliverymanController@payments');

    //ajax section
    Route::get('deliveryman/get-new-assign-orders', 'DeliverymanController@getTotalNewOrder')->name('laundry.getNewAssignOrders');
});

Route::group(['as'=>'pickupman.','namespace' => 'FrontEnd', 'middleware' => ['pickupmanauth']], function () {
    Route::get('pickupman/dashboard', 'PickupmanController@dashboard');
    Route::get('pickupman/logout', 'PickupmanController@logout');

    Route::get('pickupman/parcels', 'PickupmanController@parcels');
    Route::get('pickupman/order-details/{id}', 'PickupmanController@orderDetails')->name('orderdetails');
    Route::post('pickupman/order-update', 'PickupmanController@orderUpdate')->name('laundry.orderUpdate');

    Route::get('pickupman/get-order-items/{id}', 'PickupmanController@getOrderItems')->name('getorderitems');
    Route::get('pickupman/update-qty', 'PickupmanController@updateQty')->name('updateqty');

    Route::get('pickupman/order-pick/{id}', 'PickupmanController@pickedOrder')->name('orderpicked');

    Route::get('pickupman/multipickup-parcels', 'PickupmanController@multipickupParcels');
    Route::post('pickupman/multipickup-parcels', 'PickupmanController@multipleParcelPicked');
    Route::get('pickupman/pending-parcels', 'PickupmanController@pendingParcels');
    Route::post('pickupman/asign', 'PickupmanController@pickupmanAsign');
    Route::get('pickupman/parcel/invoice/{id}', 'PickupmanController@invoice');
    Route::post('pickupman/parcel/status-update', 'PickupmanController@statusupdate');
    Route::get('pickupman/pickup', 'PickupmanController@pickup');
    Route::post('pickupman/pickup/status-update', 'AgentController@pickupstatus');
    Route::post('pickupman/parcel/export', 'PickupmanController@export');
    Route::get('pickupman/payments/{type}', 'PickupmanController@payments');


    // ajax
    Route::get('/laundry/getproduct','PickupmanController@getProducts')->name('laundry.getproduct');
    Route::get('/laundry/getproduct-services','PickupmanController@getProductServices')->name('laundry.getproductservice');
    Route::get('/pickupman/get-new-assign-orders', 'PickupmanController@getTotalNewOrder')->name('laundry.getNewAssignOrders');
    
});


// merchant route
Route::group(['namespace' => 'FrontEnd', 'middleware' => ['merchantauth']], function () {
    // Merchant operation
    Route::get('merchant/dashboard', 'MerchantController@dashboard');
    Route::get('merchant/orders', 'MerchantController@orders')->name('merchant.orders');
    Route::get('merchant/order-details/{id}', 'MerchantController@orderDetails')->name('merchant.orderdetails');


    Route::post('merchant/parcel/import', 'MerchantController@import');
    Route::post('merchant/parcel/export', 'MerchantController@export');
    Route::get('merchant/new-order', 'MerchantController@parcelcreate');
    Route::get('merchant/pricing/{slug}', 'MerchantController@pricing');
    Route::get('merchant/payment/invoice-details/{id}', 'MerchantController@inovicedetails');
    Route::get('merchant/profile', 'MerchantController@profile');
    Route::get('merchant/profile/edit', 'MerchantController@profileEdit');
    Route::post('merchant/profile/edit', 'MerchantController@profileUpdate');
    Route::get('merchant/profile/settings', 'MerchantController@profileEdit');
    Route::get('merchant/stats', 'MerchantController@stats');
    Route::get('merchant/fraud-check', 'MerchantController@fraudcheck');
    Route::get('merchant/choose-service', 'MerchantController@chooseservice');
    Route::get('merchant/pickup', 'MerchantController@pickup');
    Route::get('merchant/support', 'MerchantController@support');
    Route::get('merchant/parcel/invoice/{id}', 'MerchantController@invoice');
    // pickup request
    Route::post('merchant/pickup/request', 'MerchantController@pickuprequest');
    // parcel oparation
    Route::post('merchant/add/parcel', 'MerchantController@parcelstore');
    Route::get('merchant/parcels', 'MerchantController@parcels');
    Route::get('merchant/parcel-cancel/{parcel_id}', 'MerchantController@parcelCancel');
    Route::get('merchant/parcel/in-details/{id}', 'MerchantController@parceldetails');
    Route::get('merchant/parcel/edit/{id}', 'MerchantController@parceledit');
    Route::post('merchant/update/parcel', 'MerchantController@parcelupdate');
    Route::post('/merchant/parcel/track/', 'MerchantController@parceltrack');
    Route::get('merchant/get/payments', 'MerchantController@payments');
});


Route::group(['as' => 'superadmin.', 'prefix' => 'superadmin', 'namespace' => 'Superadmin', 'middleware' => ['auth']], function () {

    // Superadmin dashboard
    Route::get('/main_dashboard', 'DashboardController@mainDashboard')->name('main_dashboard');
    Route::get('/dashboard', 'DashboardController@index')->name('dashboard')->middleware('permission:dashboard');
    Route::get('/user/add', 'UserController@add')->middleware('permission:user_add');
    Route::post('/user/save', 'UserController@save')->middleware('permission:user_add');
    Route::get('/user/edit/{id}', 'UserController@edit')->middleware('permission:user_edit');
    Route::post('/user/update', 'UserController@update')->middleware('permission:user_edit');
    Route::get('/user/manage', 'UserController@manage')->middleware('permission:panel_user');
    Route::post('/user/inactive', 'UserController@inactive')->middleware('permission:user_edit');
    Route::post('/user/active', 'UserController@active')->middleware('permission:user_edit');
    Route::post('/user/delete', 'UserController@destroy')->middleware('permission:user_delete');

    /*...........customer section............*/
    Route::get('/add-customer', 'CustomerController@add')->name('addCustomer');
    Route::post('/store-customer', 'CustomerController@store')->name('storeCustomer');
    Route::get('/manage-customer', 'CustomerController@manage')->name('manageCustomer');
    Route::get('/get-customer/{id}', 'CustomerController@getCustomer')->name('getCustomer');
    Route::get('/details-customer/{id}', 'CustomerController@details')->name('detailsCustomer');
    Route::post('/update-customer', 'CustomerController@update')->name('updateCustomer');

    Route::get('/corporate-customer-product-add/{id}', 'CustomerController@add_corporate_customer_product')->name('add_or_edit_corporate_customer_product');
    Route::post('/corporate-customer-product-store/{customer_id}', 'CustomerController@store_corporate_customer_product')->name('store_corporate_customer_product');
    /*...........customer section............*/

    /*...........supplier section............*/
    Route::get('/add-supplier', 'SupplierController@add')->name('addSupplier');
    Route::post('/store-supplier', 'SupplierController@store')->name('storeSupplier');
    Route::get('/manage-supplier', 'SupplierController@manage')->name('manageSupplier');
    Route::get('/get-supplier/{id}', 'SupplierController@getsupplier')->name('getSupplier');
    Route::get('/details-supplier/{id}', 'SupplierController@details')->name('detailsSupplier');
    Route::post('/update-supplier', 'SupplierController@update')->name('updateSupplier');

    // supplier ledger
    Route::get('/supplier-ledger', 'SupplierController@supplierLedger')->name('supplierLedger');
    /*...........supplier section............*/

    /*...........discount section.............*/
    Route::get('/add-laundry-discount', 'DiscountController@addLaundryDiscount')->name('laundry.addDiscount');
    Route::post('/store-laundry-discount', 'DiscountController@storeLaundryDiscount')->name('laundry.storeDiscount');
    Route::get('/manage-laundry-discount', 'DiscountController@manageLaundryDiscount')->name('laundry.manageDiscount');
    Route::get('/get-laundry-discount/{id}', 'DiscountController@getLaundryDiscount')->name('laundry.getDiscount');
    Route::post('/update-laundry-discount', 'DiscountController@updateLaundryDiscount')->name('laundry.updateDiscount');

    /*...........discount section.............*/


    Route::get('/summary', 'DashboardController@summary')->middleware('permission:summary_report');
    Route::get('/date_to_date_reports', 'DashboardController@date_to_date_reports')->middleware('permission:summary_report');

    /*.............pos.............*/
    Route::get('/posdashboard', 'DashboardController@posDashboard')->name('posdashboard')->middleware('permission:dashboard');
    /*.............pos.............*/

    /*.............laundry.............*/
    Route::get('/laundrydashboard', 'DashboardController@laundryDashboard')->name('laundrydashboard')->middleware('permission:dashboard');

    //product section
    Route::get('/laundry/add_category','LaundryProductController@addCategory')->name('laundry.addCategory');
    Route::post('/laundry/store_category','LaundryProductController@storeCategory')->name('laundry.storeCategory');
    Route::get('/laundry/get_category/{id}','LaundryProductController@getCategory')->name('laundry.getCategory');
    Route::post('/laundry/category_update','LaundryProductController@updateCategory')->name('laundry.updateCategory');

    Route::get('/laundry/add_service','LaundryProductController@addService')->name('laundry.addService');
    Route::post('/laundry/store_service','LaundryProductController@storeService')->name('laundry.storeService');
    Route::get('/laundry/get_service/{id}','LaundryProductController@getService')->name('laundry.getService');
    Route::post('/laundry/service_update','LaundryProductController@updateService')->name('laundry.updateService');

    Route::get('/laundry/add_product','LaundryProductController@addProduct')->name('laundry.addProduct');
    Route::post('/laundry/store_product','LaundryProductController@storeProduct')->name('laundry.storeProduct');
    Route::get('/laundry/list_product','LaundryProductController@listProduct')->name('laundry.listProduct');
    Route::get('/laundry/get_product/{id}','LaundryProductController@getProduct')->name('laundry.getProduct');
    Route::get('/laundry/details_product/{id}','LaundryProductController@detailsProduct')->name('laundry.detailsProduct');
    Route::post('/laundry/product_update','LaundryProductController@updateProduct')->name('laundry.updateProduct');

    // order section
    Route::get('/laundry/orders','LaundryProductController@orders')->name('laundry.orders');
    Route::get('/laundry/add-orders','LaundryProductController@addOrders')->name('laundry.addOrders');
    Route::post('/laundry/store-order','LaundryProductController@storeOrders')->name('laundry.storeOrders');

    Route::post('/laundry/getaddress','LaundryProductController@getCustomerAddress')->name('laundry.customerAddress');
    Route::post('/laundry/getproduct','LaundryProductController@getProducts')->name('laundry.getproduct');
    Route::post('/laundry/getproduct-services','LaundryProductController@getProductServices')->name('laundry.getproductservice');
    Route::post('/laundry/getprices','LaundryProductController@getItemPrices')->name('laundry.getItemPrices');

    Route::get('/laundry/manage-offline-orders','LaundryProductController@manageOfflineOrders')->name('laundry.manageOfflineOrder');

    Route::get('/laundry/order_details/{id}','LaundryProductController@orderDetails')->name('laundry.orderdetails');
    Route::post('/laundry/order_update/{id}','LaundryProductController@orderUpdate')->name('laundry.orderUpdate');

    Route::post('/laundry/order-edit', 'LaundryProductController@orderEdit')->name('laundry.orderEdit');
    Route::get('/laundry/get-order-items/{id}', 'LaundryProductController@getOrderItems')->name('laundry.getorderitems');
    Route::get('laundry/update-qty', 'LaundryProductController@updateQty')->name('laundry.updateqty');
    //for ajax in order update
    Route::get('/laundry/getproduct','LaundryProductController@getProducts_for_edit')->name('laundry.getproduct_for_edit');
    Route::get('/laundry/getproduct','LaundryProductController@getProductServices_for_edit')->name('laundry.getProductServices_for_edit');


    Route::get('/laundry/order_cancel/{id}','LaundryProductController@orderCancel')->name('laundry.ordercancel');
    Route::get('/laundry/order_hold/{id}','LaundryProductController@orderHold')->name('laundry.orderhold');

    // quick sale
    Route::get('/laundry/quick-sale','LaundryProductController@quickSaleLaundry')->name('laundry.quickSaleLaundry');
    Route::get('/laundry/quick-sale/product','LaundryProductController@getLaundryProduct')->name('laundry.getLaundryProduct');
    Route::get('/laundry/quick-sale/product/details','LaundryProductController@product_details')->name('get_londry_products_det');
    Route::post('/laundry/quick-sale/','LaundryProductController@quickSaleLaundryStore')->name('quick_laundry_sale');

    /*...........purchase and item section.............*/
    Route::get('/add-laundry-item', 'PurchaseController@addLaundryItem')->name('laundry.addItem');
    Route::post('/store-laundry-item', 'PurchaseController@storeLaundryItem')->name('laundry.storeItem');
    Route::get('/manage-laundry-item', 'PurchaseController@manageLaundryItem')->name('laundry.manageItem');
    Route::get('/get-laundry-item/{id}', 'PurchaseController@getLaundryItem')->name('laundry.getItem');
    Route::post('/update-laundry-item', 'PurchaseController@updateLaundryItem')->name('laundry.updateItem');

    //purchase
    Route::get('/add-laundry-purchase', 'PurchaseController@addLaundryPurchase')->name('laundry.addPurchase');
    Route::post('/store-laundry-purchase', 'PurchaseController@storeLaundryPurchase')->name('laundry.storePurchase');
    Route::get('/manage-laundry-purchase', 'PurchaseController@manageLaundryPurchase')->name('laundry.managePurchase');
    Route::get('/get-laundry-purchase/{id}', 'PurchaseController@getLaundryPurchase')->name('laundry.getPurchase');
    Route::get('/get-laundry-purchase-details/{id}', 'PurchaseController@laundryPurchaseDetails')->name('laundry.detailsPurchase');
    Route::post('/update-laundry-purchase', 'PurchaseController@updateLaundryPurchase')->name('laundry.updatePurchase');

    /*...........purchase and item section.............*/
    
    /*package*/
    Route::get('/laundry/add-package', 'LaundryProductController@createPackage')->name('laundry.addPackage');
    Route::post('/laundry/store-package', 'LaundryProductController@storePackage')->name('laundry.storePackage');
    Route::get('/laundry/manage-package', 'LaundryProductController@managePackage')->name('laundry.managePackage');
    Route::get('/laundry/get-package/{id}', 'LaundryProductController@getPackage')->name('laundry.getPackage');
    Route::post('/laundry/update-package', 'LaundryProductController@updatePackage')->name('laundry.updatePackage');
    Route::get('/laundry/details-package/{id}', 'LaundryProductController@detailsPackage')->name('laundry.detailsPackage');

    Route::post('/laundry/order/edit-package', 'LaundryProductController@updateOrderPackage')->name('laundry.update-order-package');
    /*package*/

    // ajax section
    Route::get('/laundry/get-new-orders', 'LaundryProductController@getTotalNewOrder')->name('laundry.getNewOrders');

    /*.............laundry.............*/



    /*.............salon.............*/
    Route::get('/salondashboard', 'DashboardController@salonDashboard')->name('salondashboard')->middleware('permission:dashboard');

    /*...........purchase and item section.............*/
    Route::get('/add-salon-item', 'SalonPurchaseController@addSalonItem')->name('salon.addItem');
    Route::post('/store-salon-item', 'SalonPurchaseController@storeSalonItem')->name('salon.storeItem');
    Route::get('/manage-salon-item', 'SalonPurchaseController@manageSalonItem')->name('salon.manageItem');
    Route::get('/get-salon-item/{id}', 'SalonPurchaseController@getSalonItem')->name('salon.getItem');
    Route::post('/update-salon-item', 'SalonPurchaseController@updateSalonItem')->name('salon.updateItem');

    //purchase
    Route::get('/add-salon-purchase', 'SalonPurchaseController@addSalonPurchase')->name('salon.addPurchase');
    Route::post('/store-salon-purchase', 'SalonPurchaseController@storeSalonPurchase')->name('salon.storePurchase');
    Route::get('/manage-salon-purchase', 'SalonPurchaseController@manageSalonPurchase')->name('salon.managePurchase');
    Route::get('/get-salon-purchase/{id}', 'SalonPurchaseController@getSalonPurchase')->name('salon.getPurchase');
    Route::get('/get-salon-purchase-details/{id}', 'SalonPurchaseController@salonPurchaseDetails')->name('salon.detailsPurchase');
    Route::post('/update-salon-purchase', 'SalonPurchaseController@updateSalonPurchase')->name('salon.purchaseReport');

    // report purchase
    Route::get('/report-salon-purchase', 'SalonPurchaseController@salonPurchaseReport')->name('salon.purchaseReport');
    /*...........purchase and item section.............*/

    /*...........discount section.............*/
    Route::get('/add-salon-discount', 'DiscountController@addSalonDiscount')->name('salon.addDiscount');
    Route::post('/store-salon-discount', 'DiscountController@storeSalonDiscount')->name('salon.storeDiscount');
    Route::get('/manage-salon-discount', 'DiscountController@manageSalonDiscount')->name('salon.manageDiscount');
    Route::get('/get-salon-discount/{id}', 'DiscountController@getSalonDiscount')->name('salon.getDiscount');
    Route::post('/update-salon-discount', 'DiscountController@updateSalonDiscount')->name('salon.updateDiscount');
    /*...........discount section.............*/

    /*..............category and service section................*/
    Route::get('/salon/add_category','SalonController@addCategory')->name('salon.addCategory');
    Route::post('/salon/store_category','SalonController@storeCategory')->name('salon.storeCategory');
    Route::get('/salon/get_category/{id}','SalonController@getCategory')->name('salon.getCategory');
    Route::post('/salon/category_update','SalonController@updateCategory')->name('salon.updateCategory');

    Route::get('/salon/add_parent_service','SalonController@addParentService')->name('salon.addParentService');
    Route::post('/salon/store_parent_service','SalonController@storeParentService')->name('salon.storeParentService');
    Route::get('/salon/get_parent_service/{id}','SalonController@getParentService')->name('salon.getParentService');
    Route::post('/salon/parent_service_update','SalonController@updateParentService')->name('salon.updateParentService');
    Route::post('/salon/parent_service_update','SalonController@updateParentService')->name('salon.updateParentService');

    Route::get('/salon/get-parent_services','SalonController@getParentServices')->name('salon.getParentService');

    Route::get('/salon/add_service','SalonController@addService')->name('salon.addService');
    Route::post('/salon/store_service','SalonController@storeService')->name('salon.storeService');
    Route::get('/salon/manage_service','SalonController@manageService')->name('salon.manageService');
    Route::get('/salon/get_service/{id}','SalonController@getService')->name('salon.getService');
    Route::post('/salon/service_update','SalonController@updateService')->name('salon.updateService');

    /*..............category and service section................*/

    /*..............order section................*/
    Route::get('/salon/orders','SalonController@orders')->name('salon.orders');
    Route::get('/salon/add-orders','SalonController@addOrders')->name('salon.addOrders');
    Route::post('/salon/store-order','SalonController@storeOrders')->name('salon.storeOrders');

    Route::post('/salon/getaddress','SalonController@getCustomerAddress')->name('salon.customerAddress');
    Route::post('/salon/getsche','SalonController@getProducts')->name('salon.getproduct');
    Route::post('/salon/get-salonservices','SalonController@getSalonServices')->name('salon.getSalonService');
    Route::post('/salon/get-salon-service-schedule','SalonController@getServicesSchedule')->name('salon.getServiceSchedule');

    Route::post('/salon/get-salon-service-employee','SalonController@getServiceEmployee')->name('salon.getServiceEmployee');
    
    Route::post('/salon/getprices','SalonController@getItemPrices')->name('salon.getItemPrices');

    Route::get('/salon/manage-offline-orders','SalonController@manageOfflineOrders')->name('salon.manageOfflineOrder');

    Route::get('/salon/order_details/{id}','SalonController@orderDetails')->name('salon.orderdetails');
    Route::post('/salon/order_update/{id}','SalonController@orderUpdate')->name('salon.orderUpdate');
    Route::get('/salon/order_cancel/{id}','SalonController@orderCancel')->name('salon.ordercancel');
    Route::get('/salon/order_hold/{id}','SalonController@orderHold')->name('salon.orderhold');

    /*..............order section................*/

    /*package*/
    Route::get('/salon/add-package', 'SalonController@createPackage')->name('salon.addPackage');
    Route::post('/salon/store-package', 'SalonController@storePackage')->name('salon.storePackage');
    Route::post('/salon/manage-package', 'SalonController@managePackage')->name('salon.managePackage');
    Route::get('/salon/get-package/{id}', 'SalonController@getPackage')->name('salon.getPackage');
    Route::post('/salon/update-package', 'SalonController@updatePackage')->name('salon.updatePackage');
    /*package*/

    /*.............salon.............*/

    /*.............account section................*/
    Route::get('/account/add-head','AccountController@addHead')->name('account.addHead');
    Route::post('/account/store-head','AccountController@storeHead')->name('account.storeHead');
    Route::get('/account/head-list','AccountController@headList')->name('account.headList');
    Route::get('/account/get-item/{id}','AccountController@getItem')->name('account.getItem');
    Route::post('/account/update-head','AccountController@updateHead')->name('account.updateHead');

    // income
    Route::get('/account/add-income','AccountController@addIncome')->name('account.addIncome');
    Route::post('/account/store-income','AccountController@storeIncome')->name('account.storeIncome');
    Route::get('/account/income-list','AccountController@incomeList')->name('account.incomeList');
    Route::get('/account/income-edit/{id}','AccountController@incomeEdit')->name('account.incomeEdit');
    Route::post('/account/update-income','AccountController@updateIncome')->name('account.updateIncome');
    Route::get('/account/income-delete/{id}','AccountController@incomeDelete')->name('account.incomeDelete');

    // expanse
    Route::get('/account/add-expanse','AccountController@addExpanse')->name('account.addExpanse');
    Route::post('/account/store-expanse','AccountController@storeExpanse')->name('account.storeExpanse');
    Route::get('/account/expanse-list','AccountController@expanseList')->name('account.expanseList');
    Route::get('/account/expanse-edit/{id}','AccountController@expanseEdit')->name('account.expanseEdit');
    Route::post('/account/update-expanse','AccountController@updateExpanse')->name('account.updateExpanse');
    Route::get('/account/expanse-delete/{id}','AccountController@expanseDelete')->name('account.expanseDelete');

    // income Salon
    Route::get('/account/add-salon-income','AccountController@addSalonIncome')->name('account.addSalonIncome');
    Route::post('/account/store-salon-income','AccountController@storeSalonIncome')->name('account.storeSalonIncome');
    Route::get('/account/salon-income-list','AccountController@incomeSalonList')->name('account.incomeSalonList');
    Route::get('/account/salon-income-edit/{id}','AccountController@incomeSalonEdit')->name('account.incomeSalonEdit');
    Route::post('/account/salon-update-income','AccountController@updateSalonIncome')->name('account.updateSalonIncome');
    Route::get('/account/salon-income-delete/{id}','AccountController@incomeSalonDelete')->name('account.incomeSalonDelete');
    Route::get('/account/salon-income-pdf/{id}','AccountController@incomeSalonPDF')->name('account.incomeSalonPDF');


    // expanse Salon
    Route::get('/account/add-salon-expanse','AccountController@addSalonExpanse')->name('account.addSalonExpanse');
    Route::post('/account/store-salon-expanse','AccountController@storeSalonExpanse')->name('account.storeSalonExpanse');
    Route::get('/account/salon-expanse-list','AccountController@expanseSalonList')->name('account.expanseSalonList');
    Route::get('/account/salon-expanse-edit/{id}','AccountController@expanseSalonEdit')->name('account.expanseSalonEdit');
    Route::post('/account/salon-update-expanse','AccountController@updateSalonExpanse')->name('account.updateSalonExpanse');
    Route::get('/account/salon-expanse-delete/{id}','AccountController@expanseSalonDelete')->name('account.expanseSalonDelete');
    /*.............account section................*/

    /*............report section...............*/

    //laundry
    Route::get('/report/summary-report','ReportController@laundrySummary')->name('laundry.summaryReport');


    //salon
    Route::get('/report/salon-summary-report','ReportController@salonSummary')->name('salon.summaryReport');

    /*............report section...............*/
    

    /*..........payment to marchant..............*/

    Route::get('/show_due_marchant', 'DashboardController@show_marchant')->middleware('permission:payment_to_merchant');
    Route::get('/payment_due_marchant/{mid}', 'DashboardController@payment_marchant')->middleware('permission:payment_to_merchant');
    Route::post('/submit_due_payment', 'DashboardController@submit_due_payment')->middleware('permission:payment_to_merchant');


    /*..........payment to pickupman..............*/
    Route::get('/pickupman-payment-summary', 'PickupmanPaymentController@pickupmanPaymentSummary')->name('pickupman_payment_summary')->middleware('permission:payment_to_pickupman');
    Route::get('/pickupman-payments/{type}/{pickupmanId}', 'PickupmanPaymentController@pickupmanPayments')->name('pickupman_payments')->middleware('permission:payment_to_pickupman');
    Route::post('/pickupman-payment', 'PickupmanPaymentController@pickupmanPayment')->name('pickupman_payment')->middleware('permission:payment_to_pickupman');
    Route::get('/pickupman-payment-invoice/{parcel_id}', 'PickupmanPaymentController@pickupmanPaymentInvoice')->name('pickupman_payment_invoice')->middleware('permission:payment_to_pickupman');

    /*..........payment to deliveryman..............*/
    Route::get('/deliveryman-payment-summary', 'DeliverymanPaymentController@deliverymanPaymentSummary')->name('deliveryman_payment_summary')->middleware('permission:payment_to_deliveryman');
    Route::get('/deliveryman-payments/{type}/{deliverymanId}', 'DeliverymanPaymentController@deliverymanPayments')->name('deliveryman_payments')->middleware('permission:payment_to_deliveryman');
    Route::post('/deliveryman-payment', 'DeliverymanPaymentController@deliverymanPayment')->name('deliveryman_payment')->middleware('permission:payment_to_deliveryman');
    Route::get('/deliveryman-payment-invoice/{parcel_id}', 'DeliverymanPaymentController@deliverymanPaymentInvoice')->name('deliveryman_payment_invoice')->middleware('permission:payment_to_deliveryman');

    /*..........Salary/PayRoll..............*/
    // salary
    Route::get('/salarysheet/create', 'PayRollController@salary_sheet_create')->middleware('permission:user_add');
    Route::post('/salarysheet/create', 'PayRollController@salary_sheet_show')->middleware('permission:user_add');
    Route::post('/salarysheet/store', 'PayRollController@salary_sheet_store')->middleware('permission:user_add');
    Route::get('/salarysheet/manage', 'PayRollController@salary_sheet_manage')->middleware('permission:user_add');
    Route::post('/salarysheet/salary-paid', 'PayRollController@salary_paid')->middleware('permission:user_add');
    Route::get('/salarysheet/view/{invoice_no}', 'PayRollController@salary_sheet_view')->middleware('permission:user_add');

    // advance
    Route::get('/advance/add', 'PayRollController@advance_add')->middleware('permission:user_add');
    Route::post('/advance/add', 'PayRollController@advance_create')->middleware('permission:user_add');
    Route::post('/advance/store', 'PayRollController@advance_store')->middleware('permission:user_add');
    Route::get('/advance/manage', 'PayRollController@advance_manage')->middleware('permission:user_add');

    // commission
    Route::get('/commission/pay', 'PayRollController@commission_show')->middleware('permission:user_add');
    Route::post('/commission/pay', 'PayRollController@commission_create')->middleware('permission:user_add');
    Route::post('/commission/store', 'PayRollController@commission_store')->middleware('permission:user_add');
});

// Live Search
Route::get('search_data/{keyword}', 'search\liveSearchController@SearchData');
Route::get('search_data', 'search\liveSearchController@SearchWithoutData');



// Ajax Route
Route::get('/ajax-product-subcategory', 'editor\productController@getSubcategory');
Route::get('/server-side', 'editor\ParcelManageController@getDatatableData');

//ajax route end

Route::group(['as' => 'admin.', 'prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => ['auth']], function () {

    // admin dashboard
    Route::get('/dashboard', 'DashboardController@index')->name('dashboard')->middleware('permission:dashboard');
    Route::post('merchant-payment/bulk-option', 'DashboardController@bulkpayment')->middleware('permission:payment');
    // Nearest Zone Route 
    Route::get('/nearestzone/add', 'NearestzoneController@add');
    Route::post('/nearestzone/save', 'NearestzoneController@store');
    Route::get('/nearestzone/manage', 'NearestzoneController@manage');
    Route::get('/nearestzone/edit/{id}', 'NearestzoneController@edit');
    Route::post('/nearestzone/update', 'NearestzoneController@update');
    Route::post('/nearestzone/inactive', 'NearestzoneController@inactive');
    Route::post('/nearestzone/active', 'NearestzoneController@active');
    Route::post('/nearestzone/delete', 'NearestzoneController@destroy');

    // Delivery Charge Route 
    Route::get('/deliverycharge/add', 'DeliveryChargeController@add')->middleware('permission:delivery_charge_add');
    Route::post('/deliverycharge/save', 'DeliveryChargeController@store')->middleware('permission:delivery_charge_add');
    Route::get('/deliverycharge/manage', 'DeliveryChargeController@manage')->middleware('permission:delivery_charge');
    Route::get('/deliverycharge/edit/{id}', 'DeliveryChargeController@edit')->middleware('permission:delivery_charge_edit');
    Route::post('/deliverycharge/update', 'DeliveryChargeController@update')->middleware('permission:delivery_charge_edit');
    Route::post('/deliverycharge/inactive', 'DeliveryChargeController@inactive')->middleware('permission:delivery_charge_edit');
    Route::post('/deliverycharge/active', 'DeliveryChargeController@active')->middleware('permission:delivery_charge_edit');
    Route::post('/deliverycharge/delete', 'DeliveryChargeController@destroy')->middleware('permission:delivery_charge_delete');

    // Cod Charge Route 
    Route::get('codcharge/add', 'CodChargeController@add');
    Route::post('codcharge/save', 'CodChargeController@store');
    Route::get('codcharge/manage', 'CodChargeController@manage');
    Route::get('codcharge/edit/{id}', 'CodChargeController@edit');
    Route::post('codcharge/update', 'CodChargeController@update');
    Route::post('codcharge/inactive', 'CodChargeController@inactive');
    Route::post('codcharge/active', 'CodChargeController@active');
    Route::post('codcharge/delete', 'CodChargeController@destroy');

    // Promotional Discount 
    Route::get('promotional-discount/add', 'PromotionalDiscountController@add')->middleware('permission:promotional_discount_add');
    Route::post('promotional-discount/store', 'PromotionalDiscountController@store')->middleware('permission:promotional_discount_add');
    Route::get('promotional-discount/inactive', 'PromotionalDiscountController@inactive')->middleware('permission:promotional_discount_edit');
    Route::get('promotional-discount/active', 'PromotionalDiscountController@active')->middleware('permission:promotional_discount_edit');

    // Division Route 
    Route::get('division/add', 'DivisionController@add')->middleware('permission:division_add');
    Route::post('division/save', 'DivisionController@store')->middleware('permission:division_add');
    Route::get('division/manage', 'DivisionController@manage')->middleware('permission:division');
    Route::get('division/edit/{id}', 'DivisionController@edit')->middleware('permission:division_edit');
    Route::post('division/update', 'DivisionController@update')->middleware('permission:division_edit');
    Route::post('division/inactive', 'DivisionController@inactive')->middleware('permission:division_edit');
    Route::post('division/active', 'DivisionController@active')->middleware('permission:division_edit');
    Route::post('division/delete', 'DivisionController@destroy')->middleware('permission:division_delete');

    // District route
    Route::get('/district/add', 'DistrictController@index')->middleware('permission:district_add');
    Route::post('/district/save', 'DistrictController@store')->middleware('permission:district_add');
    Route::get('/district/manage', 'DistrictController@manage')->middleware('permission:district');
    Route::get('/district/edit/{id}', 'DistrictController@edit')->middleware('permission:district_edit');
    Route::post('/district/update', 'DistrictController@update')->middleware('permission:district_edit');
    Route::post('/district/inactive', 'DistrictController@inactive')->middleware('permission:district_edit');
    Route::post('/district/active', 'DistrictController@active')->middleware('permission:district_edit');
    Route::post('/district/delete', 'DistrictController@destroy')->middleware('permission:district_delete');

    // Thana route
    Route::get('/thana/add', 'ThanaController@index')->middleware('permission:thana_add');
    Route::post('/thana/save', 'ThanaController@store')->middleware('permission:thana_add');
    Route::get('/thana/manage', 'ThanaController@manage')->middleware('permission:thana');
    Route::get('/thana/edit/{id}', 'ThanaController@edit')->middleware('permission:thana_edit');
    Route::post('/thana/update', 'ThanaController@update')->middleware('permission:thana_edit');
    Route::post('/thana/inactive', 'ThanaController@inactive')->middleware('permission:thana_edit');
    Route::post('/thana/active', 'ThanaController@active')->middleware('permission:thana_edit');
    Route::post('/thana/delete', 'ThanaController@destroy')->middleware('permission:thana_delete');

    // Area route 
    Route::get('/area/add', 'AreaController@index')->middleware('permission:area_add');
    Route::post('/area/save', 'AreaController@store')->middleware('permission:area_add');
    Route::get('/area/manage', 'AreaController@manage')->middleware('permission:area');
    Route::get('/area-datatable', 'AreaController@areaDatatable')->middleware('permission:area');
    Route::get('/area/edit/{id}', 'AreaController@edit')->middleware('permission:area_edit');
    Route::post('/area/update', 'AreaController@update')->middleware('permission:area_edit');
    Route::post('/area/inactive', 'AreaController@inactive')->middleware('permission:area_edit');
    Route::post('/area/active', 'AreaController@active')->middleware('permission:area_edit');
    Route::post('/area/delete', 'AreaController@destroy')->middleware('permission:area_delete');

    // Department Route 
    Route::get('department/add', 'DepartmentController@add')->middleware('permission:department_add');
    Route::post('department/save', 'DepartmentController@store')->middleware('permission:department_add');
    Route::get('department/manage', 'DepartmentController@manage')->middleware('permission:department');
    Route::get('department/edit/{id}', 'DepartmentController@edit')->middleware('permission:department_edit');
    Route::post('department/update', 'DepartmentController@update')->middleware('permission:department_edit');
    Route::post('department/inactive', 'DepartmentController@inactive')->middleware('permission:department_edit');
    Route::post('department/active', 'DepartmentController@active')->middleware('permission:department_edit');
    Route::post('department/delete', 'DepartmentController@destroy')->middleware('permission:department_delete');

    // Employee Route 
    Route::get('/employee/add', 'EmployeeController@add')->middleware('permission:employee_add');
    Route::post('/employee/save', 'EmployeeController@save')->middleware('permission:employee_add');
    Route::get('/employee/commission/{id}', 'EmployeeController@commission_show')/*->middleware('permission:employee_edit')*/;
    Route::post('/employee/commission/', 'EmployeeController@commission_pay')/*->middleware('permission:employee_edit')*/;
    Route::get('/employee/edit/{id}', 'EmployeeController@edit')->middleware('permission:employee_edit');
    Route::post('/employee/update', 'EmployeeController@update')->middleware('permission:employee_edit');
    Route::get('/employee/manage', 'EmployeeController@manage')->middleware('permission:employee');
    Route::get('/employee/ledger', 'EmployeeController@ledger')->middleware('permission:employee_add');
    //Route::post('/employee/ledger', 'EmployeeController@ledger_add')->middleware('permission:employee_add');
    Route::get('employee/details/{employee_id}', 'EmployeeController@details')->middleware('permission:employee');
    Route::post('/employee/inactive', 'EmployeeController@inactive')->middleware('permission:employee_edit');
    Route::post('/employee/active', 'EmployeeController@active')->middleware('permission:employee_edit');
    Route::post('/employee/delete', 'EmployeeController@destroy')->middleware('permission:employee_delete');
    Route::post('/employee/assign-service', 'EmployeeController@assignService');
    //attendance
    Route::get('/employee/attendance/add', 'EmployeeController@add_attendance')->middleware('permission:employee_add');
    Route::post('/employee/attendance/store', 'EmployeeController@store_attendance')->middleware('permission:employee_add');
    Route::get('/employee/attendance/manage', 'EmployeeController@attendance_manage')->middleware('permission:employee_add');

    // Agent Manage Route 
    Route::get('agent/add', 'AgentManageController@add')->middleware('permission:agent_add');
    Route::post('agent/save', 'AgentManageController@save')->middleware('permission:agent_add');
    Route::get('agent/edit/{id}', 'AgentManageController@edit')->middleware('permission:agent_edit');
    Route::post('agent/update', 'AgentManageController@update')->middleware('permission:agent_edit');
    Route::get('agent/manage', 'AgentManageController@manage')->middleware('permission:agent');
    Route::get('agent/details/{agent_id}', 'AgentManageController@details')->middleware('permission:agent');
    Route::post('agent/inactive', 'AgentManageController@inactive')->middleware('permission:agent_edit');
    Route::post('agent/active', 'AgentManageController@active')->middleware('permission:agent_edit');
    Route::post('agent/delete', 'AgentManageController@destroy')->middleware('permission:agent_delete');

    // Delivery Man Route 
    Route::get('deliveryman/add', 'DeliverymanManageController@add')->middleware('permission:deliveryman_add');
    Route::post('deliveryman/save', 'DeliverymanManageController@save')->middleware('permission:deliveryman_add');
    Route::get('deliveryman/edit/{id}', 'DeliverymanManageController@edit')->middleware('permission:deliveryman_edit');
    Route::post('deliveryman/update', 'DeliverymanManageController@update')->middleware('permission:deliveryman_edit');
    Route::get('deliveryman/manage', 'DeliverymanManageController@manage')->middleware('permission:deliveryman');
    Route::get('deliveryman/details/{deliveryman_id}', 'DeliverymanManageController@details')->middleware('permission:deliveryman');
    Route::get('deliveryman/location-track', 'DeliverymanManageController@locationTrack')->middleware('permission:deliveryman');
    Route::get('deliveryman/get-deliverymans', 'DeliverymanManageController@getDeliverymans')->middleware('permission:deliveryman');
    Route::post('deliveryman/inactive', 'DeliverymanManageController@inactive')->middleware('permission:deliveryman_edit');
    Route::post('deliveryman/active', 'DeliverymanManageController@active')->middleware('permission:deliveryman_edit');
    Route::post('deliveryman/delete', 'DeliverymanManageController@destroy')->middleware('permission:deliveryman_delete');

    // Pickup Man Route 
    Route::get('pickupman/add', 'PickupmanManageController@add')->middleware('permission:pickupman_add');
    Route::post('pickupman/save', 'PickupmanManageController@save')->middleware('permission:pickupman_add');
    Route::get('pickupman/edit/{id}', 'PickupmanManageController@edit')->middleware('permission:pickupman_add');
    Route::post('pickupman/update', 'PickupmanManageController@update')->middleware('permission:pickupman_add');
    Route::get('pickupman/manage', 'PickupmanManageController@manage')->middleware('permission:pickupman_add');
    Route::get('pickupman/details/{pickupman_id}', 'PickupmanManageController@details')->middleware('permission:pickupman_add');
    Route::get('pickupman/location-track', 'PickupmanManageController@locationTrack')->middleware('permission:pickupman_add');
    Route::get('pickupman/get-pickupmans', 'PickupmanManageController@getPickupmans')->middleware('permission:pickupman_add');
    Route::post('pickupman/inactive', 'PickupmanManageController@inactive')->middleware('permission:pickupman_add');
    Route::post('pickupman/active', 'PickupmanManageController@active')->middleware('permission:pickupman_add');
    Route::post('pickupman/delete', 'PickupmanManageController@destroy')->middleware('permission:pickupman_add');
});

Route::group(['as' => 'editor.', 'prefix' => 'editor', 'namespace' => 'Editor', 'middleware' => ['auth']], function () {
    // editor dashboard 
    Route::get('/dashboard', 'DashboardController@index')->name('dashboard')->middleware('permission:dashboard');

    // Banner route here 
    Route::get('/parcel/create', 'ParcelManageController@create')->middleware('permission:parcel_create');
    Route::post('/parcel/store', 'ParcelManageController@parcelstore')->middleware('permission:parcel_create');
    Route::get('/parcel/edit/{id}', 'ParcelManageController@parceledit')->middleware('permission:parcel_edit');
    Route::post('/parcel/update', 'ParcelManageController@parcelupdate')->middleware('permission:parcel_edit');
    Route::post('/parcel/selectupdate', 'ParcelManageController@parcelupdatebyselect')->middleware('permission:parcel_edit');

    //parcel manage
    Route::get('multiple-parcel-pick', 'ParcelManageController@multipleParcelPick')->middleware('permission:multiple_parcel_pick');
    Route::post('multiple-parcel-pick', 'ParcelManageController@multipleParcelPicked')->middleware('permission:multiple_parcel_pick');
    Route::get('parcel/{slug}', 'ParcelManageController@parcel')->middleware('permission:parcel_manage');
    Route::get('/processing/parcel', 'ParcelManageController@processing')->middleware('permission:parcel_manage');
    Route::post('agent/asign', 'ParcelManageController@agentasign')->middleware('permission:parcel_edit');
    Route::post('deliveryman/asign', 'ParcelManageController@deliverymanasign')->middleware('permission:parcel_edit');
    Route::post('pickupman/asign', 'ParcelManageController@pickupmanasign')->middleware('permission:parcel_edit');
    Route::post('/parcel/status-update', 'ParcelManageController@statusupdate')->middleware('permission:parcel_edit');
    Route::get('/parcel/invoice/{id}', 'ParcelManageController@invoice')->middleware('permission:parcel_manage');

    Route::get('/merchants', 'ParcelManageController@merchants')->name('merchants')->middleware('permission:parcel_manage');
    Route::get('/merchant-parcels/{merchant_id}', 'ParcelManageController@merchantParcels')->name('merchant_parcels')->middleware('permission:parcel_manage');


    // parcel Manage
    Route::get('/new/pickup', 'PickupManageController@newpickup');
    Route::get('/pending/pickup', 'PickupManageController@pendingpickup');
    Route::get('/accepted/pickup', 'PickupManageController@acceptedpickup');
    Route::get('/cancelled/pickup', 'PickupManageController@cancelled');
    Route::post('pickup/agent/asign', 'PickupManageController@agentmanasign');
    Route::post('/pickup/status-update', 'PickupManageController@statusupdate');
    //  ================ website oparation =====================

    // Logo route here
    Route::get('/logo/create', 'LogoController@create')->middleware('permission:logo_add');
    Route::post('/logo/store', 'LogoController@store')->middleware('permission:logo_add');
    Route::get('/logo/manage', 'LogoController@manage')->middleware('permission:logo');
    Route::get('/logo/edit/{id}', 'LogoController@edit')->middleware('permission:logo_edit');
    Route::post('/logo/update', 'LogoController@update')->middleware('permission:logo_edit');
    Route::post('/logo/inactive', 'LogoController@inactive')->middleware('permission:logo_edit');
    Route::post('/logo/active', 'LogoController@active')->middleware('permission:logo_edit');
    Route::post('/logo/delete', 'LogoController@destroy')->middleware('permission:logo_delete');

    // Banner route here
    Route::get('/banner/create', 'BannerController@create');
    Route::post('/banner/store', 'BannerController@store');
    Route::get('/banner/manage', 'BannerController@manage');
    Route::get('/banner/edit/{id}', 'BannerController@edit');
    Route::post('/banner/update', 'BannerController@update');
    Route::post('/banner/inactive', 'BannerController@inactive');
    Route::post('/banner/active', 'BannerController@active');
    Route::post('/banner/delete', 'BannerController@destroy');

    // Slider 
    Route::get('/slider/create', 'SliderController@create')->middleware('permission:slider_add');
    Route::post('/slider/store', 'SliderController@store')->middleware('permission:slider_add');
    Route::get('/slider/manage', 'SliderController@manage')->middleware('permission:slider');
    Route::get('/slider/edit/{id}', 'SliderController@edit')->middleware('permission:slider_edit');
    Route::post('/slider/update', 'SliderController@update')->middleware('permission:slider_edit');
    Route::post('/slider/inactive', 'SliderController@inactive')->middleware('permission:slider_edit');
    Route::post('/slider/active', 'SliderController@active')->middleware('permission:slider_edit');
    Route::post('/slider/delete', 'SliderController@destroy')->middleware('permission:slider_delete');

    // Slogan 
    Route::get('/slogan/create', 'SloganController@create')->middleware('permission:slogan');
    Route::post('/slogan/store', 'SloganController@store')->middleware('permission:slogan');

    // Setting 
    Route::get('/setting/create', 'SettingController@create')->middleware('permission:setting');
    Route::post('/setting/store', 'SettingController@store')->middleware('permission:setting');

    // Service route here
    Route::get('/service/create', 'ServiceController@create')->middleware('permission:service_add');
    Route::post('/service/store', 'ServiceController@store')->middleware('permission:service_add');
    Route::get('/service/manage', 'ServiceController@manage')->middleware('permission:service');
    Route::get('/service/edit/{id}', 'ServiceController@edit')->middleware('permission:service_edit');
    Route::post('/service/update', 'ServiceController@update')->middleware('permission:service_edit');
    Route::post('/service/inactive', 'ServiceController@inactive')->middleware('permission:service_edit');
    Route::post('/service/active', 'ServiceController@active')->middleware('permission:service_edit');
    Route::post('/service/delete', 'ServiceController@destroy')->middleware('permission:service_delete');

    // Feature Operation
    Route::get('/feature/create', 'FeatureController@create')->middleware('permission:feature_add');
    Route::post('/feature/store', 'FeatureController@store')->middleware('permission:feature_add');
    Route::get('/feature/manage', 'FeatureController@manage')->middleware('permission:feature');
    Route::get('/feature/edit/{id}', 'FeatureController@edit')->middleware('permission:feature_edit');
    Route::post('/feature/update', 'FeatureController@update')->middleware('permission:feature_edit');
    Route::post('/feature/inactive', 'FeatureController@inactive')->middleware('permission:feature_edit');
    Route::post('/feature/active', 'FeatureController@active')->middleware('permission:feature_edit');
    Route::post('/feature/delete', 'FeatureController@destroy')->middleware('permission:feature_delete');

    // Hub Operation
    Route::get('/hub/create', 'HubController@create')->middleware('permission:hub_area_add');
    Route::post('/hub/store', 'HubController@store')->middleware('permission:hub_area_add');
    Route::get('/hub/manage', 'HubController@manage')->middleware('permission:hub_area');
    Route::get('/hub/edit/{id}', 'HubController@edit')->middleware('permission:hub_area_edit');
    Route::post('/hub/update', 'HubController@update')->middleware('permission:hub_area_edit');
    Route::post('/hub/inactive', 'HubController@inactive')->middleware('permission:hub_area_edit');
    Route::post('/hub/set-default', 'HubController@setDefault')->middleware('permission:hub_area_edit');
    Route::post('/hub/set-nondefault', 'HubController@setNonDefault')->middleware('permission:hub_area_edit');
    Route::post('/hub/active', 'HubController@active')->middleware('permission:hub_area_edit');
    Route::post('/hub/delete', 'HubController@destroy')->middleware('permission:hub_area_delete');

    // Price route here
    Route::get('price/create', 'PriceController@create');
    Route::post('price/store', 'PriceController@store');
    Route::get('price/manage', 'PriceController@manage');
    Route::get('price/edit/{id}', 'PriceController@edit');
    Route::post('price/update', 'PriceController@update');
    Route::post('price/inactive', 'PriceController@inactive');
    Route::post('price/active', 'PriceController@active');
    Route::post('price/delete', 'PriceController@destroy');

    // Page Create route here
    Route::get('createpage/create', 'CreatepageController@create')->middleware('permission:create_page_add');
    Route::post('createpage/store', 'CreatepageController@store')->middleware('permission:create_page_add');
    Route::get('createpage/manage', 'CreatepageController@manage')->middleware('permission:create_page');
    Route::get('createpage/edit/{id}', 'CreatepageController@edit')->middleware('permission:create_page_edit');
    Route::post('createpage/update', 'CreatepageController@update')->middleware('permission:create_page_edit');
    Route::post('createpage/inactive', 'CreatepageController@inactive')->middleware('permission:create_page_edit');
    Route::post('createpage/active', 'CreatepageController@active')->middleware('permission:create_page_edit');
    Route::post('createpage/delete', 'CreatepageController@destroy')->middleware('permission:create_page_delete');

    Route::get('/social-media/add', 'SocialController@index');
    Route::post('/social-media/save', 'SocialController@store');
    Route::get('/social-media/manage', 'SocialController@manage');
    Route::get('/social-media/edit/{id}', 'SocialController@edit');
    Route::post('/social-media/update', 'SocialController@update');
    Route::post('/social-media/unpublished', 'SocialController@unpublished');
    Route::post('/social-media/published', 'SocialController@published');
    Route::post('/social-media/delete', 'SocialController@destroy');

    // merchant operation
    Route::get('/merchant-request/manage', 'MerchantOperationController@merchantrequest')->middleware('permission:merchant');
    Route::get('/merchant/add', 'MerchantOperationController@add')->middleware('permission:merchant_add');
    Route::get('/merchant/manage', 'MerchantOperationController@manage')->middleware('permission:merchant');
    Route::post('/merchant/register', 'MerchantOperationController@register')->middleware('permission:merchant_add');
    Route::get('/merchant/edit/{id}', 'MerchantOperationController@profileedit')->middleware('permission:merchant_edit');
    Route::post('merchant/profile/edit', 'MerchantOperationController@profileUpdate')->middleware('permission:merchant_edit');
    Route::post('merchant/inactive', 'MerchantOperationController@inactive')->middleware('permission:merchant_edit');
    Route::post('merchant/active', 'MerchantOperationController@active')->middleware('permission:merchant_edit');
    Route::get('merchant/view/{id}', 'MerchantOperationController@view')->middleware('permission:merchant');
    Route::post('merchant/get/payment', 'MerchantOperationController@payment')->middleware('permission:payment');
    Route::get('/merchant/payment/invoice/{id}', 'MerchantOperationController@paymentinvoice')->middleware('permission:merchant');
    Route::get('/merchant/payment/invoice-details/{id}', 'MerchantOperationController@inovicedetails')->middleware('permission:merchant');

    // About route here
    Route::get('/about/create', 'AboutController@create');
    Route::post('/about/store', 'AboutController@store');
    Route::get('/about/manage', 'AboutController@manage');
    Route::get('/about/edit/{id}', 'AboutController@edit');
    Route::post('/about/update', 'AboutController@update');
    Route::post('/about/inactive', 'AboutController@inactive');
    Route::post('/about/active', 'AboutController@active');
    Route::post('/about/delete', 'AboutController@destroy');


    Route::get('/clientfeedback/create', 'ClientfeedbackController@create');
    Route::post('/clientfeedback/store', 'ClientfeedbackController@store');
    Route::get('/clientfeedback/manage', 'ClientfeedbackController@manage');
    Route::get('/clientfeedback/edit/{id}', 'ClientfeedbackController@edit');
    Route::post('/clientfeedback/update', 'ClientfeedbackController@update');
    Route::post('/clientfeedback/inactive', 'ClientfeedbackController@inactive');
    Route::post('/clientfeedback/active', 'ClientfeedbackController@active');
    Route::post('/clientfeedback/delete', 'ClientfeedbackController@destroy');

    // career
    Route::get('career/create', 'CareerController@create');
    Route::post('career/store', 'CareerController@store');
    Route::get('career/manage', 'CareerController@manage');
    Route::get('career/edit/{id}', 'CareerController@edit');
    Route::post('career/update', 'CareerController@update');
    Route::post('career/inactive', 'CareerController@inactive');
    Route::post('career/active', 'CareerController@active');
    Route::post('career/delete', 'CareerController@destroy');

    // notice
    Route::get('notice/create', 'NoticeController@create');
    Route::post('notice/store', 'NoticeController@store');
    Route::get('notice/manage', 'NoticeController@manage');
    Route::get('notice/edit/{id}', 'NoticeController@edit');
    Route::post('notice/update', 'NoticeController@update');
    Route::post('notice/inactive', 'NoticeController@inactive');
    Route::post('notice/active', 'NoticeController@active');
    Route::post('notice/delete', 'NoticeController@destroy');

    // Gallery
    Route::get('gallery/create', 'GalleryController@create');
    Route::post('gallery/store', 'GalleryController@store');
    Route::get('gallery/manage', 'GalleryController@manage');
    Route::get('gallery/edit/{id}', 'GalleryController@edit');
    Route::post('gallery/update', 'GalleryController@update');
    Route::post('gallery/inactive', 'GalleryController@inactive');
    Route::post('gallery/active', 'GalleryController@active');
    Route::post('gallery/delete', 'GalleryController@destroy');

    // Top Banner
    Route::get('topbanner/create', 'TopbannerController@create');
    Route::post('topbanner/store', 'TopbannerController@store');
    Route::get('topbanner/manage', 'TopbannerController@manage');
    Route::get('topbanner/edit/{id}', 'TopbannerController@edit');
    Route::post('topbanner/update', 'TopbannerController@update');
    Route::post('topbanner/inactive', 'TopbannerController@inactive');
    Route::post('topbanner/active', 'TopbannerController@active');
    Route::post('topbanner/delete', 'TopbannerController@destroy');

    // Gallery
    Route::get('sms/create', 'SmsController@create')->middleware('permission:send_sms');
    Route::post('sms/store', 'SmsController@store')->middleware('permission:send_sms');
    Route::get('sms/manage', 'SmsController@manage')->middleware('permission:bulk_sms');
    Route::get('sms/edit/{id}', 'SmsController@edit')->middleware('permission:send_sms');
    Route::post('sms/update', 'SmsController@update')->middleware('permission:send_sms');
    Route::post('sms/inactive', 'SmsController@inactive')->middleware('permission:send_sms');
    Route::post('sms/active', 'SmsController@active')->middleware('permission:send_sms');
    Route::post('sms/delete', 'SmsController@destroy')->middleware('permission:send_sms');
    Route::post('sms/send', 'SmsController@SMSsend')->middleware('permission:send_sms');
    Route::get('sms/resend/{id}', 'SmsController@resend')->middleware('permission:send_sms');
    Route::post('sms/deleteSMS', 'SmsController@DeleteSMS')->middleware('permission:send_sms');

    Route::get('sms/balance', 'SmsController@smsAllBalance')->middleware('permission:sms_balance');
});

Route::get('/get-division-districts', 'CommonController@getDivisionDistricts')->name('get_division_districts');
Route::get('/get-district-thanas', 'CommonController@getDistrictThanas')->name('get_district_thanas');
Route::get('/get-district-agents', 'CommonController@getDistrictAgents')->name('get_district_agents');
Route::get('/get-thana-deliverymen-pickupman', 'CommonController@getThanaDeliverymenPickupman')->name('get_thana_deliverymen_pickupman');
Route::get('/get-thana-areas', 'CommonController@getThanaAreas')->name('get_thana_areas');
Route::get('/get-agent-areas', 'CommonController@getAgentAreas')->name('get_agent_areas');
Route::get('/get-area-address', 'CommonController@getAreaAddress')->name('get_area_address');
Route::get('/get-thana-agents', 'CommonController@getThanaAgents')->name('get_thana_agents');
Route::get('/get-merchant-details', 'CommonController@getMerchantDetails')->name('get_merchant_details');
Route::post('/get-customers', 'CommonController@getCustomers')->name('getCustomers');
Route::post('/get-services', 'CommonController@getServices')->name('getServices');
Route::post('/get-services-amount', 'CommonController@getServicesAmount')->name('getServicesAmount');

Route::group(['as' => 'author.', 'prefix' => 'author', 'namespace' => 'author', 'middleware' => ['auth']], function () {
    Route::get('/dashboard', 'DashboardController@index')->name('dashboard')->middleware('permission:dashboard');
});

Route::group(['as' => 'report_', 'prefix' => 'report', 'middleware' => ['auth']], function () {
    Route::get('/merchant-based-parcels', 'ReportControlller@merchantBasedParcels')->name('merchant_based_parcels')->middleware('permission:merchant_based_report');
    Route::get('/pickupman-based-parcels', 'ReportControlller@pickupmanBasedParcels')->name('pickupman_based_parcels')->middleware('permission:merchant_based_report');
    Route::get('/deliveryman-based-parcels', 'ReportControlller@deliverymanBasedParcels')->name('deliveryman_based_parcels')->middleware('permission:merchant_based_report');
});

Route::group(['namespace' => 'Admin'], function () {
    Route::get('/send-mail', 'DashboardController@sendMail')->name('sens_mail');
});

Route::get('test', function () {
    // $merchants = Merchant::all();
    // foreach($merchants as $merchant){
    //     $merchant->api_token = Str::random(50);
    //     $merchant->save();
    // }
    // return count($merchants) .' Merchant token generate';
    // $parcels = Parcel::whereNotIn('merchantId', [1, 2, 23, 50, 51, 53])->get();
    // foreach ($parcels as $key => $parcel) {
    //     Parcelnote::where('parcelId', $parcel->id)->delete();
    //     $parcel->delete();
    // }
    // dd('Parcel Deleted');
});

Route::get('/cache-clear', function () {
    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('config:cache');
    Artisan::call('view:clear');
    return "Cleared!";
});


// mahfuz change
Route::get('/salon/add-to-cart', 'ReportControlller@saleShow')->name('add_to_cart');
Route::get('/salon/get-product', 'CommonController@getProducts')->name('get_products');
Route::get('/salon/get-product-details', 'CommonController@getProductDetails')->name('get_product_details');
Route::get('/laundry/set-customer-id-session', 'CommonController@setCustomerIdInSession')->name('setCustomerIdInSession');
Route::post('/salon/cart-store', 'ReportControlller@cartServiceStore')->name('cart_service_store');

Route::namespace('Superadmin')->group(function () { 
Route::get('/salon/manage-quick-sale', 'SalonController@manageQuickOrders')->name('manageQuickSale');
});

Route::post('/salon/customer-add-new', 'ReportControlller@customerAdd')->name('customer_add_new');

Route::get('/get-employee-details', 'CommonController@get_employee')->name('get_employee');

