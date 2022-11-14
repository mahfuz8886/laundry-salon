@extends('backEnd.layouts.master')
@section('hr', 'active menu-open')
@section('pickupman', 'active menu-open')
@section('pickupman_manage', 'active')
@section('title', 'Pickupman details')
@section('extracss')
    <style>
        .profile_table th, .profile_table td{
            padding: 3px 10px 1px 10px !important;
            border: 0px solid #dddddd !important;
        }
        .profile_table td{
            border-bottom: 1px dashed #000000 !important;
        }
        .profile_table th{
            font-weight: normal;
        }

        .table_education thead th, .table_education tbody td{
            border: 1px solid #cccccc !important;
        }
        .profile_image{
            position: absolute;
            top: -10px;
            right: 3%;
            width: 120px;
            height: 120px;
            padding: 10px;
            border: 1px solid #dddddd;
            border-radius: 3px;
        }
        .header_logo{
            padding: 5px;
            margin-left: 25px
        }
        @media print {
            .col-sm-1, .col-sm-2, .col-sm-3, .col-sm-4, .col-sm-5, .col-sm-6, .col-sm-7, .col-sm-8, .col-sm-9, .col-sm-10, .col-sm-11, .col-sm-12 {
                    float: left;
            }
            .col-sm-12 {
                    width: 100%;
            }
            .col-sm-11 {
                    width: 91.66666667%;
            }
            .col-sm-10 {
                    width: 83.33333333%;
            }
            .col-sm-9 {
                    width: 75%;
            }
            .col-sm-8 {
                    width: 66.66666667%;
            }
            .col-sm-7 {
                    width: 58.33333333%;
            }
            .col-sm-6 {
                    width: 50%;
            }
            .col-sm-5 {
                    width: 41.66666667%;
            }
            .col-sm-4 {
                    width: 33.33333333%;
            }
            .col-sm-3 {
                    width: 25%;
            }
            .col-sm-2 {
                    width: 16.66666667%;
            }
            .col-sm-1 {
                    width: 8.33333333%;
            }
        }
    </style>
@endsection
@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="box-content">
                <button type="button" class="btn btn-sm btn-primary pull-right" onclick="printNow()"> Print </button>
                <br>
                <div class="row print_area">
                    <div class="row profile_header">
                        <div class="col-md-8 col-sm-8">
                            <img class="header_logo" src="{{ url($setting->logo) }}" width="120" height="120" alt="Logo">
                        </div>
                        <div class="col-md-4 col-sm-4">
                            <p>
                                {{ $setting->address }}
                            </p>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-12 col-lg-12">
                        <div class="card custom-card">
                            <div class="col-sm-12">
                                <img class="profile_image" src="{{ url($pickupman->image) }}" alt="Photo">
                                <br>
                                <h3 class="text-center"> Pickupman Form </h3>
                            </div>
                            <div class="card-body">
                                <table class="table profile_table">
                                    <tr>
                                        <th width="25%" colspan="1"> Pickupman name <span style="float: right"><b>:</b></span> </th>
                                        <td width="75%" colspan="3"> {{ $pickupman->name }} </td>
                                    </tr>
                                    <tr>
                                        <th width="25%" colspan="1"> Father's name <span style="float: right"><b>:</b></span> </th>
                                        <td  colspan="3"> {{ $pickupman->fathers_name }} </td>
                                    </tr>
                                    <tr>
                                        <th width="25%" colspan="1"> Father's profession <span style="float: right"><b>:</b></span> </th>
                                        <td  colspan="3"> {{ $pickupman->fathers_profession }} </td>
                                    </tr>
                                    <tr>
                                        <th width="25%" colspan="1"> Father's NID no. <span style="float: right"><b>:</b></span> </th>
                                        <td  colspan="1" width="25%"> {{ $pickupman->fathers_nid_no }} </td>
                                        <th width="20%" colspan="1" class="text-right"> Father's mobile no. <span style="float: right"><b>:</b></span> </th>
                                        <td  colspan="1" width="30%"> {{ $pickupman->fathers_mobile_no }} </td>
                                    </tr>
                                    <tr>
                                        <th width="25%" colspan="1"> Mother's name <span style="float: right"><b>:</b></span> </th>
                                        <td  colspan="3"> {{ $pickupman->mothers_name }} </td>
                                    </tr>
                                    <tr>
                                        <th width="25%" colspan="1"> Mother's profession <span style="float: right"><b>:</b></span> </th>
                                        <td  colspan="3"> {{ $pickupman->mothers_profession }} </td>
                                    </tr>
                                    <tr>
                                        <th width="25%" colspan="1"> Mother's NID no. <span style="float: right"><b>:</b></span> </th>
                                        <td  colspan="1" width="25%"> {{ $pickupman->mothers_nid_no }} </td>
                                        <th width="20%" colspan="1" class="text-right"> Mother's mobile no. <span style="float: right"><b>:</b></span> </th>
                                        <td  colspan="1"> {{ $pickupman->mothers_mobile_no }} </td>
                                    </tr>
                                    <tr>
                                        <th width="25%" colspan="1"> Present Address <span style="float: right"><b>:</b></span> </th>
                                        <td  colspan="3"> {{ $pickupman->present_address }} </td>
                                    </tr>
                                    <tr>
                                        <th width="25%" colspan="1"> Permanent Address <span style="float: right"><b>:</b></span> </th>
                                        <td  colspan="3"> {{ $pickupman->permanent_address }} </td>
                                    </tr>
                                    <tr>
                                        <th width="25%" colspan="1"> Date of birth <span style="float: right"><b>:</b></span> </th>
                                        <td  colspan="1" width="30%"> {{ $pickupman->birth_date?date('d-m-Y', strtotime($pickupman->birth_date)):'' }} </td>
                                        <th width="20%" colspan="1" class="text-right"> Religion <span style="float: right"><b>:</b></span> </th>
                                        <td  colspan="1"> {{ $pickupman->religion }} </td>
                                    </tr>
                                    <tr>
                                        <th width="25%" colspan="1"> Maritial Status <span style="float: right"><b>:</b></span> </th>
                                        <td  colspan="1" width="30%"> {{ $pickupman->marital_status }} </td>
                                        <th width="20%" colspan="1" class="text-right"> Mobile no. <span style="float: right"><b>:</b></span> </th>
                                        <td  colspan="1"> {{ $pickupman->phone }} </td>
                                    </tr>
                                    <tr>
                                        <th colspan="2"> <b>Educational Qualification</b> </th>
                                    </tr>
                                    <tr>
                                        <th colspan="4">
                                            <table class="table table_education table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th> Serial </th>
                                                        <th> Exam name </th>
                                                        <th> Group </th>
                                                        <th> GPA/CGPA </th>
                                                        <th> Year </th>
                                                        <th> Board </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($pickupman->educations??[] as $education)
                                                        <tr>
                                                            <td> {{ $loop->iteration }} </td>
                                                            <td> {{ $education->exam_name }} </td>
                                                            <td> {{ $education->group }} </td>
                                                            <td> {{ $education->gpa }} </td>
                                                            <td> {{ $education->year }} </td>
                                                            <td> {{ $education->board }} </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </th>
                                    </tr>
                                    @foreach ($pickupman->experiences??[] as $experience)
                                        <tr>
                                            <th colspan="2"> <b> {{ $loop->iteration }}. Experience </b> </th>
                                        </tr>
                                        <tr>
                                            <th width="25%" colspan="1"> Company name <span style="float: right"><b>:</b></span> </th>
                                            <td  colspan="1"> {{ $experience->company_name }} </td>
                                            <th width="25%" colspan="1" class="text-right"> Designation <span style="float: right"><b>:</b></span> </th>
                                            <td  colspan="1"> {{ $experience->designation }} </td>
                                        </tr>
                                        <tr>
                                            <th width="25%" colspan="1"> Job Duration <span style="float: right"><b>:</b></span> </th>
                                            <td  colspan="1"> {{ date('d F-Y', strtotime($experience->start_date)) }} to Continuing... </td>
                                            <th width="25%" colspan="1" class="text-right">  </th>
                                            <td  colspan="1">  </td>
                                        </tr>
                                    @endforeach
                                    
                                    <tr>
                                        <th width="25%" colspan="1"> <br> </th>
                                    </tr>
                                    <tr>
                                        <th width="25%" colspan="1"> Guaranteer information <span style="float: right"><b>:</b></span> </th>
                                        <td  colspan="3"> {{ $pickupman->guaranteer_information }} </td>
                                    </tr>
                                    <tr>
                                        <th width="25%" colspan="1"> Guaranteer name <span style="float: right"><b>:</b></span> </th>
                                        <td  colspan="3"> {{ $pickupman->guaranteer_name }} </td>
                                    </tr>
                                    <tr>
                                        <th width="25%" colspan="1"> Guaranteer relation <span style="float: right"><b>:</b></span> </th>
                                        <td  colspan="3"> {{ $pickupman->guaranteer_relation }} </td>
                                    </tr>
                                    <tr>
                                        <th width="25%" colspan="1"> Guaranteer NID no. <span style="float: right"><b>:</b></span> </th>
                                        <td  colspan="3"> {{ $pickupman->guaranteer_nid_no }} </td>
                                    </tr>
                                    <tr>
                                        <th width="25%" colspan="1"> Guaranteer mobile no. <span style="float: right"><b>:</b></span> </th>
                                        <td  colspan="3"> {{ $pickupman->guaranteer_mobile_no }} </td>
                                    </tr>
                                    <tr>
                                        <th width="25%" colspan="1"> Guaranteer present address <span style="float: right"><b>:</b></span> </th>
                                        <td  colspan="3"> {{ $pickupman->guaranteer_present_address }} </td>
                                    </tr>
                                    <tr>
                                        <th width="25%" colspan="1"> Guaranteer permanent address <span style="float: right"><b>:</b></span> </th>
                                        <td  colspan="3"> {{ $pickupman->guaranteer_permanent_address }} </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-12 col-lg-12">
                        <p class="text-right" style="padding-right: 50px"> 
                            <br>
                            Signature of applicant  <br>
                            Mobile: {{ $pickupman->phone }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

@section('script')
    <script>
        var APP_URL = '{!! url()->full()  !!}';
        function printNow() {
            $('body').html($('.print_area').html());
            window.print();
            window.location.replace(APP_URL)
        }
    </script>
@endsection