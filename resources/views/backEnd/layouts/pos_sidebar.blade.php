<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        @can('dashboard')
            <li class="nav-item">
                <a href="{{ url('superadmin/main_dashboard') }}" class="nav-link @yield('dashboard')">
                    <i class="fas fa-arrow-alt-circle-left"></i>
                    <p>
                        @lang('common.main_dashboard')
                    </p>
                </a>
            </li>
        @endcan
        @can('dashboard')
            <li class="nav-item">
                <a href="{{ url('/login') }}" class="nav-link @yield('dashboard')">
                    <i class="fas fa-home"></i>
                    <p>
                        @lang('common.dashboard')
                    </p>
                </a>
            </li>
        @endcan
        @can('website')
            <li class="nav-item has-treeview @yield('website')">
                <a href="#" class="nav-link">
                    <i class="fas fa-bookmark"></i>
                    <p>
                        @lang('common.website')
                        <i class="right fa fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    @can('setting')
                        <li class="nav-item">
                            <a href="{{ url('/editor/setting/create') }}" class="nav-link @yield('setting')">
                                <i class="fas fa-cicle-o"></i>
                                <p>@lang('common.settings')</p>
                            </a>
                        </li>
                    @endcan
                    @can('logo')
                        <li class="nav-item">
                            <a href="{{ url('/editor/logo/manage') }}" class="nav-link @yield('logo')">
                                <i class="fas fa-cicle-o"></i>
                                <p>@lang('common.logo')</p>
                            </a>
                        </li>
                    @endcan
                    @can('banner')
                        <li class="nav-item">
                            <a href="{{ url('/editor/banner/manage') }}" class="nav-link @yield('banner')">
                                <i class="fas fa-cicle-o"></i>
                                <p>@lang('common.banner')</p>
                            </a>
                        </li>
                    @endcan
                    @can('slider')
                        <li class="nav-item">
                            <a href="{{ url('/editor/slider/manage') }}" class="nav-link @yield('slider')">
                                <i class="fas fa-cicle-o"></i>
                                <p> @lang('common.slider')</p>
                            </a>
                        </li>
                    @endcan
                    @can('slogan')
                        <li class="nav-item">
                            <a href="{{ url('/editor/slogan/create') }}" class="nav-link @yield('slogan')">
                                <i class="fas fa-cicle-o"></i>
                                <p> @lang('common.slogan') </p>
                            </a>
                        </li>
                    @endcan
                    @can('price')
                        <li class="nav-item">
                            <a href="{{ url('/editor/price/manage') }}" class="nav-link @yield('price')">
                                <i class="fas fa-cicle-o"></i>
                                <p>Pricing</p>
                            </a>
                        </li>
                    @endcan
                    @can('feature')
                        <li class="nav-item">
                            <a href="{{ url('/editor/feature/manage') }}" class="nav-link @yield('feature')">
                                <i class="fas fa-cicle-o"></i>
                                <p>@lang('common.feature')</p>
                            </a>
                        </li>
                    @endcan
                    @can('hub_area')
                        <li class="nav-item">
                            <a href="{{ url('/editor/hub/manage') }}" class="nav-link @yield('hub')">
                                <i class="fas fa-cicle-o"></i>
                                <p>@lang('common.hub_area')</p>
                            </a>
                        </li>
                    @endcan
                    @can('service')
                        <li class="nav-item">
                            <a href="{{ url('/editor/service/manage') }}" class="nav-link @yield('service')">
                                <i class="fas fa-cicle-o"></i>
                                <p>@lang('common.service')</p>
                            </a>
                        </li>
                    @endcan
                    @can('create_page')
                        <li class="nav-item">
                            <a href="{{ url('/editor/createpage/manage') }}" class="nav-link @yield('create_page')">
                                <i class="fas fa-cicle-o"></i>
                                <p>@lang('common.create_page')</p>
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan

        @can('panel_user')
            <li class="nav-item has-treeview @yield('user')">
                <a href="#" class="nav-link">
                    <i class="fas fa-user-tie"></i>
                    <p>
                        @lang('common.panel_user')
                        <i class="right fa fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    @can('user_add')
                        <li class="nav-item">
                            <a href="{{ url('/superadmin/user/add') }}" class="nav-link @yield('user_add')">
                                <i class="fas fa-cicle-o"></i>
                                <p>@lang('common.add')</p>
                            </a>
                        </li>
                    @endcan
                    @can('panel_user')
                        <li class="nav-item">
                            <a href="{{ url('/superadmin/user/manage') }}" class="nav-link @yield('user_manage')">
                                <i class="fas fa-cicle-o"></i>
                                <p>@lang('common.manage')</p>
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan


        @can('bulk_sms')
            <li class="nav-item has-treeview @yield('bulk_sms')">
                <a href="#" class="nav-link">
                    <i class="fab fa-angellist"></i>
                    <p>
                        @lang('common.bulk_sms')
                        <i class="right fa fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    @can('send_sms')
                        <li class="nav-item">
                            <a href="{{ url('/editor/sms/create') }}" class="nav-link @yield('bulk_sms_manage')">
                                <i class="fas fa-cicle-o"></i>
                                <p> @lang('common.sms_send') </p>
                            </a>
                        </li>
                    @endcan
                    @can('sms_balance')
                        <li class="nav-item">
                            <a href="{{ url('/editor/sms/balance') }}" class="nav-link @yield('bulk_sms_balance')">
                                <i class="fas fa-cicle-o"></i>
                                <p> @lang('common.sms_balance') </p>
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan

        @can('merchant')
            <li class="nav-item has-treeview @yield('merchant')">
                <a href="#" class="nav-link">
                    <i class="fas fa-briefcase"></i>
                    <p>
                        @lang('common.merchant')
                        <i class="right fa fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    @can('merchant_requiest')
                        <li class="nav-item">
                            <a href="{{ url('/editor/merchant-request/manage') }}" class="nav-link @yield('merchant_request')">
                                <i class="fas fa-cicle-o"></i>
                                <p>Merchant Request</p>
                            </a>
                        </li>
                    @endcan
                    @can('merchant_add')
                        <li class="nav-item">
                            <a href="{{ url('/editor/merchant/add') }}" class="nav-link @yield('merchant_add')">
                                <i class="fas fa-cicle-o"></i>
                                <p>@lang('common.add_merchant')</p>
                            </a>
                        </li>
                    @endcan
                    @can('merchant')
                        <li class="nav-item">
                            <a href="{{ url('/editor/merchant/manage') }}" class="nav-link @yield('merchant_manage')">
                                <i class="fas fa-cicle-o"></i>
                                <p>@lang('common.manage')</p>
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan

        @can('delivery_charge')
            <li class="nav-item has-treeview @yield('delivery_charge')">
                <a href="#" class="nav-link">
                    <i class="fab fa-angellist"></i>
                    <p>
                        @lang('common.delivery_charge')
                        <i class="right fa fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    @can('delivery_charge_add')
                        <li class="nav-item">
                            <a href="{{ url('/admin/deliverycharge/add') }}" class="nav-link @yield('delivery_charge_add')">
                                <i class="fas fa-cicle-o"></i>
                                <p>Add</p>
                            </a>
                        </li>
                    @endcan
                    @can('delivery_charge')
                        <li class="nav-item">
                            <a href="{{ url('/admin/deliverycharge/manage') }}" class="nav-link @yield('delivery_charge_manage')">
                                <i class="fas fa-cicle-o"></i>
                                <p>@lang('common.manage')</p>
                            </a>
                        </li>
                    @endcan

                </ul>
            </li>
        @endcan

        @can('discount')
            <li class="nav-item has-treeview @yield('discount')">
                <a href="#" class="nav-link">
                    <i class="fas fa-award"></i>
                    <p>
                        @lang('common.discount')
                        <i class="right fa fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    @can('promotional_discount_add')
                        <li class="nav-item">
                            <a href="{{ url('/admin/promotional-discount/add') }}" class="nav-link @yield('promotional_discount')">
                                <i class="fas fa-cicle-o"></i>
                                <p> @lang('common.promotional_discount') </p>
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan

        @can('area_panel')
            <li class="nav-item has-treeview @yield('area')">
                <a href="#" class="nav-link">
                    <i class="fas fa-map-marker"></i>
                    <p>
                        @lang('common.area')
                        <i class="right fa fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    @can('division')
                        <li class="nav-item">
                            <a href="{{ url('/admin/division/manage') }}" class="nav-link @yield('division_manage')">
                                <i class="fas fa-cicle-o"></i>
                                <p>@lang('common.division')</p>
                            </a>
                        </li>
                    @endcan
                    @can('district')
                        <li class="nav-item">
                            <a href="{{ url('/admin/district/manage') }}" class="nav-link @yield('district_manage')">
                                <i class="fas fa-cicle-o"></i>
                                <p>@lang('common.district')</p>
                            </a>
                        </li>
                    @endcan
                    @can('thana')
                        <li class="nav-item">
                            <a href="{{ url('/admin/thana/manage') }}" class="nav-link @yield('thana_manage')">
                                <i class="fas fa-cicle-o"></i>
                                <p>@lang('common.thana')</p>
                            </a>
                        </li>
                    @endcan
                    @can('area')
                        <li class="nav-item">
                            <a href="{{ url('/admin/area/manage') }}" class="nav-link @yield('area_manage')">
                                <i class="fas fa-cicle-o"></i>
                                <p>@lang('common.area')</p>
                            </a>
                        </li>
                    @endcan

                </ul>
            </li>
        @endcan

        @can('hr')
            <li
                class="nav-item has-treeview @yield('hr') @isset($menu) {{ $menu }} @endisset ">
                <a href="#" class="nav-link">
                    <i class="fas fa-chart-pie"></i>
                    <p>
                        @lang('common.hr')
                        <i class="right fa fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    @can('department')
                        <li class="nav-item">
                            <a href="{{ url('/admin/department/manage') }}" class="nav-link @yield('department_manage')">
                                <i class="fas fa-cicle-o"></i>
                                <p>@lang('common.department')</p>
                            </a>
                        </li>
                    @endcan
                    @can('employee_add')
                        <li class="nav-item">
                            <a href="{{ url('/admin/employee/add') }}" class="nav-link @yield('employee_add')">
                                <i class="fas fa-cicle-o"></i>
                                <p>@lang('common.add_employee')</p>
                            </a>
                        </li>
                    @endcan
                    @can('employee')
                        <li class="nav-item">
                            <a href="{{ url('/admin/employee/manage') }}" class="nav-link @yield('employee_manage')">
                                <i class="fas fa-cicle-o"></i>
                                <p>@lang('common.employee_list') </p>
                            </a>
                        </li>
                    @endcan
                    @can('agent_add')
                        <li class="nav-item">
                            <a href="{{ url('/admin/agent/add') }}" class="nav-link @yield('agent_add')">
                                <i class="fas fa-cicle-o"></i>
                                <p> @lang('common.add_agent')</p>
                            </a>
                        </li>
                    @endcan
                    @can('agent')
                        <li class="nav-item">
                            <a href="{{ url('/admin/agent/manage') }}" class="nav-link @yield('agent_manage')">
                                <i class="fas fa-cicle-o"></i>
                                <p> @lang('common.agent_list') </p>
                            </a>
                        </li>
                    @endcan
                    @can('pickupman_add')
                        <li class="nav-item">
                            <a href="{{ url('/admin/pickupman/add') }}" class="nav-link @yield('pickupman_add')">
                                <i class="fas fa-cicle-o"></i>
                                <p>@lang('common.add_pickupman')</p>
                            </a>
                        </li>
                    @endcan

                    @can('pickupman')
                        <li class="nav-item">
                            <a href="{{ url('/admin/pickupman/manage') }}" class="nav-link @yield('pickupman_manage')">
                                <i class="fas fa-cicle-o"></i>
                                <p>@lang('common.pickupman_list') </p>
                            </a>
                        </li>
                    @endcan
                    @can('pickupman_location')
                        <li class="nav-item">
                            <a href="{{ url('/admin/pickupman/location-track') }}"
                                class="nav-link @isset($pick_sub_menu) {{ $pick_sub_menu }} @endisset">
                                <i class="fas fa-cicle-o"></i>
                                <p>@lang('common.pickupman_location') </p>
                            </a>
                        </li>
                    @endcan
                    @can('deliveryman_add')
                        <li class="nav-item">
                            <a href="{{ url('/admin/deliveryman/add') }}" class="nav-link @yield('deliveryman_add')">
                                <i class="fas fa-cicle-o"></i>
                                <p>@lang('common.add_deliveryman')</p>
                            </a>
                        </li>
                    @endcan
                    @can('deliveryman')
                        <li class="nav-item">
                            <a href="{{ url('/admin/deliveryman/manage') }}" class="nav-link @yield('deliveryman_manage')">
                                <i class="fas fa-cicle-o"></i>
                                <p>@lang('common.deliveryman_list') </p>
                            </a>
                        </li>
                    @endcan
                    @can('deliveryman_location')
                        <li class="nav-item">
                            <a href="{{ url('/admin/deliveryman/location-track') }}"
                                class="nav-link @isset($sub_menu) {{ $sub_menu }} @endisset">
                                <i class="fas fa-cicle-o"></i>
                                <p>@lang('common.deliveryman_location') </p>
                            </a>
                        </li>
                    @endcan

                </ul>
            </li>
        @endcan

        @can('parcel_manage')
            <li class="nav-item has-treeview @yield('parcel')">
                <a href="#" class="nav-link">
                    <i class="fas fa-gift"></i>
                    <p>
                        @lang('common.parcel_manage')
                        <i class="right fa fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    @can('parcel_create')
                        <li class="nav-item">
                            <a href="{{ url('/editor/parcel/create') }}" class="nav-link @yield('parcel_add')">
                                <i class="fas fa-cicle-o"></i>
                                <p>Parcel Create</p>
                            </a>
                        </li>
                    @endcan
                    @can('multiple_parcel_pick')
                        <li class="nav-item">
                            <a href="{{ url('/editor/multiple-parcel-pick') }}" class="nav-link @yield('multiple_parcel_pick')">
                                <i class="fas fa-cicle-o"></i>
                                <p> @lang('common.multiple_parcel_pick') </p>
                            </a>
                        </li>
                    @endcan


                    @foreach ($parceltypes as $parceltype)
                        @php
                            $parcelcount = App\Parcel::where('status', $parceltype->id)->count();
                        @endphp
                        <li class="nav-item">
                            <a href="{{ url('editor/parcel', $parceltype->slug) }}"
                                class="nav-link @yield($parceltype->title)">
                                <i class="fas fa-cicle-o"></i>
                                <p>{{ $parceltype->title }} ({{ $parcelcount }})</p>
                            </a>
                        </li>
                    @endforeach
                    <li class="nav-item">
                        <a href="{{ url('/editor/merchants') }}" class="nav-link @yield('merchants')">
                            <i class="fas fa-cicle-o"></i>
                            <p>@lang('common.merchant_based_parcels')</p>
                        </a>
                    </li>
                </ul>
            </li>
        @endcan


        @can('payment')
            <li class="nav-item has-treeview @yield('payment') ">
                <a href="#" class="nav-link">
                    <i class="fas fa-credit-card"></i>
                    <p>
                        @lang('common.payments')
                        <i class="right fa fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    @can('payment_to_merchant')
                        <li class="nav-item active">
                            <a href="{{ url('superadmin/show_due_marchant') }}"
                                class="nav-link   @if (Request::segment(2) == 'show_due_marchant') active @endif ">
                                <p>@lang('common.payment_to_marchant')</p>
                            </a>
                        </li>
                    @endcan
                    @can('payment_to_pickupman')
                        <li class="nav-item active">
                            <a href="{{ url('superadmin/pickupman-payment-summary') }}"
                                class="nav-link @yield('pickupman_payment_summary')">
                                <p>@lang('common.payment_to_pickupman')</p>
                            </a>
                        </li>
                    @endcan
                    @can('payment_to_deliveryman')
                        <li class="nav-item active">
                            <a href="{{ url('superadmin/deliveryman-payment-summary') }}"
                                class="nav-link @yield('deliveryman_payment_summary')">
                                <p>@lang('common.payment_to_deliveryman')</p>
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        @can('report')
            <li class="nav-item has-treeview  @yield('report') ">
                <a href="#" class="nav-link">
                    <i class="fas fa-poll-h"></i>
                    <p>
                        @lang('common.report')
                        <i class="right fa fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    @can('summary_report')
                        <li class="nav-item active">
                            <a href="{{ url('superadmin/summary') }}" class="nav-link @yield('summary_report')  ">
                                <i class="fas fa-cicle-o"></i>
                                <p> @lang('common.summary_report') </p>
                            </a>
                        </li>
                    @endcan
                    @can('merchant_based_report')
                        <li class="nav-item  @yield('merchant_based_parcels')">
                            <a href="{{ url('report/merchant-based-parcels') }}" class="nav-link @yield('merchant_based_parcels')">
                                <i class="fas fa-cicle-o"></i>
                                <p> @lang('common.merchant_based_report') </p>
                            </a>
                        </li>
                    @endcan
                    @can('pickupman_based_report')
                        <li class="nav-item  @yield('pickupman_based_parcels')">
                            <a href="{{ url('report/pickupman-based-parcels') }}" class="nav-link @yield('pickupman_based_parcels')">
                                <i class="fas fa-cicle-o"></i>
                                <p> @lang('common.pickupman_based_report') </p>
                            </a>
                        </li>
                    @endcan
                    @can('deliveryman_based_report')
                        <li class="nav-item  @yield('deliveryman_based_parcels')">
                            <a href="{{ url('report/deliveryman-based-parcels') }}" class="nav-link @yield('deliveryman_based_parcels')">
                                <i class="fas fa-cicle-o"></i>
                                <p> @lang('common.deliveryman_based_report') </p>
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
    </ul>
</nav>
