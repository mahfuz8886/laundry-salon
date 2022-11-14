@extends('backEnd.layouts.master')
@section('package_section', 'active menu-open')
@section('package', 'active menu-open')
@section('manage_package', 'active')
@section('title', 'Items')

@section('content')

    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <div class="alert alert-warning alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                {{ $error }}
            </div>
        @endforeach
    @endif

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <form method="GET" action="">
                        <div class="row">
                            <div class="col-md-3 col-sm-6">
                                <div class="form-group">
                                    <label>Package Name</label>
                                    <input type="text" name="name" value="{{ $_GET['name']??'' }}" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6">
                                <div class="form-group">
                                    <label>Date From</label>
                                    <input type="date" name="date_from" value="{{ $_GET['date_from']??'' }}" class="flatDate form-control flatpickr-input" value="">
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6">
                                <div class="form-group">
                                    <label>Date To</label>
                                    <input type="date" name="date_to" value="{{ $_GET['date_to']??'' }}" class="flatDate form-control flatpickr-input" value="">
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6">
                                <div class="form-group">
                                    <label>&nbsp;</label><br>
                                    <input type="submit" class="btn btn-primary" value="Search" name="submit">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>@lang('common.action')</th>
                                    <th>Status</th>
                                    <th>Package Name</th>
                                    <th>Package Amount</th>
                                    <th>Package Duration</th>
                                    <th>Package Maximum Quantity</th>
                                    <th>Branch</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($packages as $item)
                                    <tr>
                                        <td>
                                            <a href="{{ route('superadmin.laundry.getPackage', $item->id) }}" class="mr-2"><i class="fa fa-edit"></i></a>
                                            <a href="{{ route('superadmin.laundry.detailsPackage', $item->id) }}" class="mr-2"><i class="fa fa-desktop"></i></a>
                                        </td>
                                        <td>
                                            @if($item->status==1)
                                            Active
                                            @else
                                            Inactive
                                            @endif
                                        </td>
                                        <td>
                                            {{$item->package_name}}
                                        </td>
                                        <td>{{ $item->package_amount??0 }}</td>
                                        <td>{{ $item->duration }} days</td>
                                        <td>{{ $item->package_quantity }}</td>
                                        <td>
                                            @php
                                            $branchInfo = App\Hub::where('id', $item->branch_id)->first();
                                            if($branchInfo) {
                                                echo $branchInfo->title;
                                            }
                                            @endphp
                                        </td>
                                    </tr>
                                @empty
                                    
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            {{ $packages->appends($_GET)->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('script')
    <script>
        $(function () {
            $('[data-toggle="tooltip"]').tooltip()
        })
    </script>
@endsection