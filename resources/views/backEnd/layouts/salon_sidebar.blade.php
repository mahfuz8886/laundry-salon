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
                <a href="{{ url('superadmin/salondashboard') }}" class="nav-link @yield('dashboard')">
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

                    {{-- @can('slider')
                        <li class="nav-item">
                            <a href="{{ url('/editor/slider/manage') }}" class="nav-link @yield('slider')">
                                <i class="fas fa-cicle-o"></i>
                                <p> @lang('common.slider')</p>
                            </a>
                        </li>
                    @endcan --}}

                    @can('hub_area')
                        <li class="nav-item">
                            <a href="{{ url('/editor/hub/manage') }}" class="nav-link @yield('hub')">
                                <i class="fas fa-cicle-o"></i>
                                <p>@lang('common.branch')</p>
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

        {{-- supplier --}}

        @can('deliveryman')
            <li class="nav-item has-treeview @yield('supplier')">
                <a href="#" class="nav-link">
                    <i class="fas fa-child"></i>
                    <p>
                        @lang('common.supplier')
                        <i class="right fa fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    @can('deliveryman_add')
                        <li class="nav-item">
                            <a href="{{ route('superadmin.addSupplier') }}" class="nav-link @yield('supplier_add')">
                                <p>@lang('common.add_supplier')</p>
                            </a>
                        </li>
                    @endcan
                    @can('deliveryman')
                        <li class="nav-item">
                            <a href="{{ route('superadmin.manageSupplier') }}" class="nav-link @yield('supplier_manage')">
                                <p>@lang('common.supplier_list') </p>
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan

        {{-- supplier --}}

        {{-- purchase section --}}
        @can('panel_user')
            <li class="nav-item has-treeview @yield('purchase_section')">
                <a href="#" class="nav-link">
                    <i class="fas fa-cash-register"></i>
                    <p>
                        @lang('common.purchase_and_item')
                        <i class="right fa fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">

                    @can('user_add')
                        <li class="nav-item has-treeview @yield('items')">
                            <a href="#" class="nav-link">
                                <p>
                                    @lang('common.items')
                                    <i class="right fa fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview nav-subtreeview">
                                @can('user_add')
                                    <li class="nav-item">
                                        <a href="{{ route('superadmin.salon.addItem') }}" class="nav-link @yield('add_item')">
                                            <p>
                                                @lang('common.add')
                                            </p>
                                        </a>
                                    </li>
                                @endcan
                                @can('user_add')
                                    <li class="nav-item">
                                        <a href="{{ route('superadmin.salon.manageItem') }}" class="nav-link @yield('manage_item')">
                                            <p>
                                                @lang('common.manage')
                                            </p>
                                        </a>
                                    </li>
                                @endcan
                            </ul>
                        </li>
                    @endcan

                    @can('user_add')
                        <li class="nav-item has-treeview @yield('purchase')">
                            <a href="#" class="nav-link">
                                <p>
                                    @lang('common.purchase')
                                    <i class="right fa fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview nav-subtreeview">
                                @can('user_add')
                                    <li class="nav-item">
                                        <a href="{{ route('superadmin.salon.addPurchase') }}" class="nav-link @yield('add_purchase')">
                                            <p>
                                                @lang('common.add')
                                            </p>
                                        </a>
                                    </li>
                                @endcan
                                @can('user_add')
                                    <li class="nav-item">
                                        <a href="{{ route('superadmin.salon.managePurchase') }}"
                                            class="nav-link @yield('manage_purchase')">
                                            <p>
                                                @lang('common.manage')
                                            </p>
                                        </a>
                                    </li>
                                @endcan
                            </ul>
                            @can('user_add')
                            <li class="nav-item">
                                <a href="{{ route('superadmin.salon.purchaseReport') }}" class="nav-link @yield('purchase_report')">
                                    <p>
                                        @lang('common.report')
                                    </p>
                                </a>
                            </li>
                        @endcan
                </li>
            @endcan

        </ul>
        </li>
    @endcan
    {{-- purchase section --}}

    <!-- package section -->
    @can('user_add')
        {{-- <li class="nav-item has-treeview @yield('package')">
            <a href="#" class="nav-link">
                <i class="fas fa-layer-group"></i>
                <p>
                    @lang('common.package')
                    <i class="right fa fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview nav-subtreeview">
                @can('user_add')
                <li class="nav-item">
                    <a href="{{ route('superadmin.salon.addPackage') }}" class="nav-link @yield('add_package')">
                        <p>
                            @lang('common.add')
                        </p>
                    </a>
                </li>
                @endcan
                @can('user_add')
                <li class="nav-item">
                    <a href="{{ route('superadmin.salon.managePackage') }}" class="nav-link @yield('manage_package')">
                        <p>
                            @lang('common.manage')
                        </p>
                    </a>
                </li>
                @endcan
            </ul>
        </li> --}}
    @endcan
    <!-- package section -->

    {{-- hr --}}
    @can('hr')
        <li
            class="nav-item has-treeview @yield('hr') @isset($menu) {{ $menu }} @endisset ">
            <a href="#" class="nav-link">
                <i class="fas fa-users"></i>
                <p>
                    @lang('common.hr')
                    <i class="right fa fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                @can('department')
                    <li class="nav-item">
                        <a href="{{ url('/admin/department/manage') }}" class="nav-link @yield('department_manage')">
                            <p>@lang('common.department')</p>
                        </a>
                    </li>
                @endcan

                @can('employee')
                    <li class="nav-item has-treeview @yield('employee')">
                        <a href="#" class="nav-link">
                            <p>
                                @lang('common.employee')
                                <i class="right fa fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview nav-subtreeview">
                            @can('employee_add')
                                <li class="nav-item">
                                    <a href="{{ url('/admin/employee/add') }}" class="nav-link @yield('employee_add')">
                                        <p>@lang('common.add_employee')</p>
                                    </a>
                                </li>
                            @endcan
                            @can('employee')
                                <li class="nav-item">
                                    <a href="{{ url('/admin/employee/manage') }}" class="nav-link @yield('employee_manage')">
                                        <p>@lang('common.employee_list') </p>
                                    </a>
                                </li>
                            @endcan
                            @can('employee')
                                <li class="nav-item">
                                    <a href="{{ url('/admin/employee/ledger') }}" class="nav-link @yield('employee_ledger')">
                                        <p>@lang('common.employee_ledger') </p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan

                @can('employee')
                    <li class="nav-item has-treeview @yield('employee_attendance')">
                        <a href="#" class="nav-link">
                            <p>
                                @lang('common.employee_attendance')
                                <i class="right fa fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview nav-subtreeview">
                            @can('employee_add')
                                <li class="nav-item">
                                    <a href="{{ url('/admin/employee/attendance/add') }}" class="nav-link @yield('employee_attendance_add')">
                                        <p>@lang('common.add')</p>
                                    </a>
                                </li>
                            @endcan
                            @can('employee')
                                <li class="nav-item">
                                    <a href="{{ url('/admin/employee/attendance/manage') }}" class="nav-link @yield('employee_attendance_manage')">
                                        <p>@lang('common.manage') </p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan

                @can('pickupman')
                    <li class="nav-item has-treeview @yield('pickupman')">
                        <a href="#" class="nav-link">
                            <p>
                                @lang('common.pickupman')
                                <i class="right fa fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview nav-subtreeview">
                            @can('pickupman_add')
                                <li class="nav-item">
                                    <a href="{{ url('/admin/pickupman/add') }}" class="nav-link @yield('pickupman_add')">
                                        <p>@lang('common.add_pickupman')</p>
                                    </a>
                                </li>
                            @endcan

                            @can('pickupman')
                                <li class="nav-item">
                                    <a href="{{ url('/admin/pickupman/manage') }}" class="nav-link @yield('pickupman_manage')">
                                        <p>@lang('common.pickupman_list') </p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan

                @can('deliveryman')
                    <li class="nav-item has-treeview @yield('deliveryman')">
                        <a href="#" class="nav-link">
                            <p>
                                @lang('common.deliveryman')
                                <i class="right fa fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview nav-subtreeview">
                            @can('deliveryman_add')
                                <li class="nav-item">
                                    <a href="{{ url('/admin/deliveryman/add') }}" class="nav-link @yield('deliveryman_add')">
                                        <p>@lang('common.add_deliveryman')</p>
                                    </a>
                                </li>
                            @endcan
                            @can('deliveryman')
                                <li class="nav-item">
                                    <a href="{{ url('/admin/deliveryman/manage') }}" class="nav-link @yield('deliveryman_manage')">
                                        <p>@lang('common.deliveryman_list') </p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan

            </ul>
        </li>
    @endcan
    {{-- hr --}}

    {{-- pay roll --}}
    @can('hr')
        <li class="nav-item has-treeview @yield('pay_roll')">
            <a href="#" class="nav-link">
                <i class="fas fa-user-tie"></i>
                <p>
                    @lang('common.pay_roll')
                    <i class="right fa fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                @can('user_add')
                    <li class="nav-item">
                        <a href="{{ url('/superadmin/salarysheet/create') }}" class="nav-link @yield('salarysheet_create')">
                            <i class="fas fa-cicle-o"></i>
                            <p>@lang('common.salarysheet_create')</p>
                        </a>
                    </li>
                @endcan
                @can('panel_user')
                    <li class="nav-item">
                        <a href="{{ url('/superadmin/salarysheet/manage') }}" class="nav-link @yield('salarysheet_manage')">
                            <i class="fas fa-cicle-o"></i>
                            <p>@lang('common.salarysheet_manage')</p>
                        </a>
                    </li>
                @endcan
                @can('panel_user')
                    <li class="nav-item">
                        <a href="{{ url('/superadmin/advance/add') }}" class="nav-link @yield('advance_add')">
                            <i class="fas fa-cicle-o"></i>
                            <p>@lang('common.advance')</p>
                        </a>
                    </li>
                @endcan
                @can('panel_user')
                    <li class="nav-item">
                        <a href="{{ url('/superadmin/advance/manage') }}" class="nav-link @yield('advance_manage')">
                            <i class="fas fa-cicle-o"></i>
                            <p>@lang('common.advance')&nbsp;@lang('common.manage')</p>
                        </a>
                    </li>
                @endcan
                @can('panel_user')
                    <li class="nav-item">
                        <a href="{{ url('/superadmin/commission/pay') }}" class="nav-link @yield('commission_pay')">
                            <i class="fas fa-cicle-o"></i>
                            <p>@lang('common.commission_pay')</p>
                        </a>
                    </li>
                @endcan
            </ul>
        </li>
    @endcan
    {{-- pay roll --}}

    {{-- laundry discount section --}}
    @can('panel_user')
        <li class="nav-item has-treeview @yield('discount_section')">
            <a href="#" class="nav-link">
                <i class="fas fa-tags"></i>
                <p>
                    @lang('common.discount')
                    <i class="right fa fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">

                @can('user_add')
                    <li class="nav-item has-treeview @yield('laundry_discount')">
                        <a href="#" class="nav-link">
                            <p>
                                @lang('common.salon_discount')
                                <i class="right fa fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview nav-subtreeview">
                            @can('user_add')
                                <li class="nav-item">
                                    <a href="{{ route('superadmin.salon.addDiscount') }}" class="nav-link @yield('add_ldiscount')">
                                        <p>
                                            @lang('common.add')
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('user_add')
                                <li class="nav-item">
                                    <a href="{{ route('superadmin.salon.manageDiscount') }}" class="nav-link @yield('manage_ldiscount')">
                                        <p>
                                            @lang('common.manage')
                                        </p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan

            </ul>
        </li>
    @endcan
    {{-- laundry discount section --}}

    {{-- customer section --}}
    @can('panel_user')
        <li class="nav-item has-treeview @yield('customer')">
            <a href="#" class="nav-link">
                <i class="fas fa-users"></i>
                <p>
                    @lang('common.customer')
                    <i class="right fa fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                @can('user_add')
                    <li class="nav-item">
                        <a href="{{ route('superadmin.addCustomer') }}" class="nav-link @yield('customer_add')">
                            <p>
                                @lang('common.add')
                            </p>
                        </a>
                    </li>
                @endcan

                @can('user_add')
                    <li class="nav-item">
                        <a href="{{ route('superadmin.manageCustomer') }}" class="nav-link @yield('customer_manage')">
                            <p>
                                @lang('common.manage')
                            </p>
                        </a>
                    </li>
                @endcan

            </ul>
        </li>
    @endcan
    {{-- customer section --}}

    {{-- category and service and sub service section --}}
    @can('panel_user')
        <li class="nav-item has-treeview @yield('product_section')">
            <a href="#" class="nav-link">
                <i class="fas fa-cubes"></i>
                <p>
                    @lang('common.category_and_service')
                    <i class="right fa fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                @can('user_add')
                    <li class="nav-item">
                        <a href="{{ route('superadmin.salon.addCategory') }}" class="nav-link @yield('category')">
                            <p>
                                @lang('common.category')
                            </p>
                        </a>
                    </li>
                @endcan

                @can('user_add')
                    <li class="nav-item">
                        <a href="{{ route('superadmin.salon.addParentService') }}" class="nav-link @yield('parent_service_add')">
                            <p>
                                @lang('common.parent_service')
                            </p>
                        </a>
                    </li>
                @endcan

                @can('user_add')
                    <li class="nav-item has-treeview @yield('service')">
                        <a href="#" class="nav-link">
                            <p>
                                @lang('common.service')
                                <i class="right fa fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview nav-subtreeview">
                            @can('user_add')
                                <li class="nav-item">
                                    <a href="{{ route('superadmin.salon.addService') }}" class="nav-link @yield('add_service')">
                                        <p>
                                            @lang('common.add')
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('user_add')
                                <li class="nav-item">
                                    <a href="{{ route('superadmin.salon.manageService') }}" class="nav-link @yield('manage_service')">
                                        <p>
                                            @lang('common.manage')
                                        </p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan

            </ul>
        </li>
    @endcan
    {{-- category and service section --}}

    {{-- salon order section --}}
    @can('panel_user')
        <li class="nav-item has-treeview @yield('salon_order_section')">
            <a href="#" class="nav-link">
                <i class="fas fa-shopping-cart"></i>
                <p>
                    @lang('common.salon_booking')
                    <i class="right fa fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                @can('user_add')
                    <li class="nav-item">
                        <a href="{{ route('superadmin.salon.orders') }}" class="nav-link @yield('online_order')">
                            <p>
                                @lang('common.online_bookings')
                            </p>
                        </a>
                    </li>
                @endcan

                @can('user_add')
                    <li class="nav-item has-treeview @yield('offline_order')">
                        <a href="#" class="nav-link">
                            <p>
                                @lang('common.offline_booking')
                                <i class="right fa fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview nav-subtreeview">
                            @can('user_add')
                                <li class="nav-item">
                                    <a href="{{ route('superadmin.salon.addOrders') }}" class="nav-link @yield('add_offline_order')">
                                        <p>
                                            @lang('common.add')
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('user_add')
                                <li class="nav-item">
                                    <a href="{{ route('superadmin.salon.manageOfflineOrder') }}"
                                        class="nav-link @yield('manage_offline_order')">
                                        <p>
                                            @lang('common.manage')
                                        </p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan

                @can('user_add')
                    <li class="nav-item has-treeview @yield('quick_sale')">
                        <a href="#" class="nav-link">
                            <p>
                                @lang('common.quick_sale')
                                <i class="right fa fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview nav-subtreeview">
                            @can('user_add')
                                <li class="nav-item">
                                    <a href="{{ route('add_to_cart') }}" class="nav-link @yield('add_quick_sale')">
                                        <p>
                                            @lang('common.add')
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('user_add')
                                <li class="nav-item">
                                    <a href="{{ route('manageQuickSale') }}" class="nav-link @yield('manage_quick_sale')">
                                        <p>
                                            @lang('common.manage')
                                        </p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan

            </ul>
        </li>
    @endcan
    {{-- salon order section --}}

    {{-- account section --}}
    @can('panel_user')
        <li class="nav-item has-treeview @yield('account_section')">
            <a href="#" class="nav-link">
                <i class="fas fa-bank"></i>
                <p>
                    @lang('common.accounts')
                    <i class="right fa fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">

                @can('user_add')
                    <li class="nav-item has-treeview @yield('account_head')">
                        <a href="#" class="nav-link">
                            <p>
                                @lang('common.account_head')
                                <i class="right fa fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview nav-subtreeview">
                            @can('user_add')
                                <li class="nav-item">
                                    <a href="{{ route('superadmin.account.addHead') }}" class="nav-link @yield('add_head')">
                                        <p>
                                            @lang('common.add')
                                        </p>
                                    </a>
                                </li>
                            @endcan

                            @can('user_add')
                                <li class="nav-item">
                                    <a href="{{ route('superadmin.account.headList') }}" class="nav-link @yield('head_list')">
                                        <p>
                                            @lang('common.manage')
                                        </p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan

                @can('user_add')
                    <li class="nav-item has-treeview @yield('income')">
                        <a href="#" class="nav-link">
                            <p>
                                @lang('common.income')
                                <i class="right fa fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview nav-subtreeview">
                            @can('user_add')
                                <li class="nav-item">
                                    <a href="{{ route('superadmin.account.addSalonIncome') }}"
                                        class="nav-link @yield('add_income')">
                                        <p>
                                            @lang('common.add')
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('user_add')
                                <li class="nav-item">
                                    <a href="{{ route('superadmin.account.incomeSalonList') }}"
                                        class="nav-link @yield('income_list')">
                                        <p>
                                            @lang('common.manage')
                                        </p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan

                @can('user_add')
                    <li class="nav-item has-treeview @yield('expanse')">
                        <a href="#" class="nav-link">
                            <p>
                                @lang('common.expanse')
                                <i class="right fa fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview nav-subtreeview">
                            @can('user_add')
                                <li class="nav-item">
                                    <a href="{{ route('superadmin.account.addSalonExpanse') }}"
                                        class="nav-link @yield('add_expanse')">
                                        <p>
                                            @lang('common.add')
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('user_add')
                                <li class="nav-item">
                                    <a href="{{ route('superadmin.account.expanseSalonList') }}"
                                        class="nav-link @yield('expanse_list')">
                                        <p>
                                            @lang('common.manage')
                                        </p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan

            </ul>
        </li>
    @endcan
    {{-- account section --}}

    {{-- report section --}}
    @can('panel_user')
        <li class="nav-item has-treeview @yield('report_section')">
            <a href="#" class="nav-link">
                <i class="far fa-calendar-alt"></i>
                <p>
                    @lang('common.salon_report')
                    <i class="right fa fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                @can('user_add')
                    <li class="nav-item">
                        <a href="{{ route('superadmin.salon.summaryReport') }}" class="nav-link @yield('salon_summary')">
                            <p>
                                @lang('common.summary')
                            </p>
                        </a>
                    </li>
                @endcan

            </ul>
        </li>
    @endcan
    {{-- report section --}}


    {{-- @can('bulk_sms')
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
        @endcan --}}

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
    </ul>
</nav>
