@extends('backEnd.layouts.master')
@section('parcel', 'active menu-open')
@section('merchants', 'active')
@section('title', 'Merchant Parcel')
@section('extracss')
<style>
    .table-cont {
        max-width: 400px;
        max-height: 200px;
        overflow: auto;
        border: 1px red solid;
    }
    .table-cont .table {
        min-width: 600px;
    }
    .table th, .table td {
        white-space: nowrap !important; 
        /* word-wrap: break-word;   */
    }
    table {
        table-layout: fixed;
    }
    

</style>
@endsection
@section('content')
    
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="box-content">
                <div class="row">
                    <div class="col-sm-12 col-md-12 col-lg-12">
                        <div class="card custom-card">
                            <div class="col-sm-12">
                                <div class="manage-button">
                                    <div class="body-title">
                                        <h5> @lang('common.merchant') </h5>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <form action="" class="filte-form">
                                    @csrf
                                </form>
                            </div>
                            <div class="card-body">
                                <table id="example2" class="table table-bordered custom-table" style="max-height: 500px;">
                                    <thead>
                                        <tr>
                                            <th>@lang('common.id')</th>
                                            <th> @lang('common.name') </th>
                                            <th> @lang('common.mobile_no') </th>
                                            <th> @lang('common.company_name') </th>
                                            <th class="text-right"> @lang('common.total_parcel')  </th>
                                            <th> @lang('common.action') </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($merchants as $key => $merchant)
                                            @php
                                                $parcelCount = $merchant->parcelCount();
                                            @endphp
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $merchant->firstName }}</td>
                                                <td>{{ $merchant->phoneNumber }}</td>
                                                <td>{{ $merchant->companyName }}</td>
                                                <td class="text-right">{{ $parcelCount['total'] }}</td>
                                                <td>
                                                    <a href="{{ url('/editor/merchant-parcels/'.$merchant->id) }}" class="btn btn-sm btn-primary" target="_blank">
                                                    @lang('common.all_parcel') 
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                {{-- <div class="pagination-area">
                                    <div class="pagination-wrapper d-flex justify-content-center align-items-center">
                                        {{ $merchants->links() }}
                                    </div>
                                </div> --}}
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>

    </script>

    <!-- Modal Section  -->
@endsection
