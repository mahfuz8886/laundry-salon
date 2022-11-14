@extends('backEnd.layouts.master')
@section('hr', 'active menu-open')
@section('employee', 'menu-open')
@section('employee_add', 'active')
@section('title', 'Employee Detail')
@section('extracss')
    <style>
        .table th {
            padding: 5px 10px !important;
        }

        .table td {
            padding: 5px 10px !important;
        }

        .tt {
            margin-bottom: 15px;
        }

        /* ul {
            list-style-type: circle!important;
        } */
    </style>
@endsection
@section('content')
    <!-- Main content -->
    <section class="content">
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                <div class="alert alert-danger alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    {{ $error }}
                </div>
            @endforeach
        @endif
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="box-content">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="manage-button">
                                    <div class="body-title">
                                        <h5>@lang('common.employee') @lang('common.details')</h5>
                                    </div>
                                    <div class="quick-button">
                                        <a href="{{ url('admin/employee/manage') }}"
                                            class="btn btn-primary btn-actions btn-create">
                                            @lang('common.employee') @lang('common.manage')
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12 col-sm-12">
                                <div class="card card-primary">
                                    <div class="card-header">
                                        <h3 class="card-title">@lang('common.personal_information') </h3>
                                    </div>
                                    <div class="main-body">
                                        <div class="row">
                                            <div class="col-md-12 text-center">
                                                <div class="form-group">
                                                    <label for="image"> @lang('common.employee') @lang('common.photo') </label>
                                                    <div>
                                                        <img src="{{ url($employee->image) }}" alt="Photo" width="100"
                                                            height="100">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <table class="table table-bordered">
                                                    <tr>
                                                        <th width="200"> @lang('common.name') </th>
                                                        <td>{{ $employee->name }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th> @lang('common.email_address') </th>
                                                        <td>{{ $employee->email }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th> @lang('common.mobile_no') </th>
                                                        <td>{{ $employee->phone }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th> @lang('common.alternative') @lang('common.mobile_no') </th>
                                                        <td>{{ $employee->alternative_phone }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th> @lang('common.nid_number') </th>
                                                        <td>{{ $employee->nid_no }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th> @lang('common.father_name') </th>
                                                        <td>{{ $employee->fathers_name }}</td>
                                                    </tr>

                                                    <tr>
                                                        <th> @lang('common.mother_name') </th>
                                                        <td>{{ $employee->mothers_name }}</td>
                                                    </tr>

                                                    <tr>
                                                        <th> @lang('common.dob') </th>
                                                        <td>{{ $employee->birth_date ? date('d-F-Y', strtotime($employee->birth_date)) : '' }}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th> @lang('common.religion') </th>
                                                        <td>
                                                            {{ $employee->religion }}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th> @lang('common.marital_status') </th>
                                                        <td>{{ $employee->marital_status }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th> @lang('common.designation') </th>
                                                        <td>{{ $employee->designation }}</td>
                                                    </tr>
                                                    @if ($employee->identification_type == 1)
                                                        <tr>
                                                            <th> @lang('common.nid_front_photo') </th>
                                                            <td><a href="{{ asset($employee->nid_front) }}"
                                                                    download=""><img style="width: 60px"
                                                                        src="{{ asset($employee->nid_front) }}"
                                                                        alt=""></a></td>
                                                        </tr>
                                                        <tr>
                                                            <th> @lang('common.nid_back_photo') </th>
                                                            <td><a href="{{ asset($employee->nid_back) }}"
                                                                    download=""><img style="width: 60px"
                                                                        src="{{ asset($employee->nid_back) }}"
                                                                        alt=""></a></td>
                                                        </tr>
                                                    @else
                                                        <tr>
                                                            <th> @lang('common.birth_certificate') </th>
                                                            <td><a href="{{ asset($employee->birth_certificate) }}"
                                                                    download=""><img style="width: 60px"
                                                                        src="{{ asset($employee->birth_certificate) }}"
                                                                        alt=""></a></td>
                                                        </tr>
                                                    @endif
                                                    <!-- <tr>
                                                            <th> Per parcel amount </th>
                                                            <td>{{ $employee->per_parcel_amount }}</td>
                                                        </tr> -->

                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            @if (Session::get('section') == 'salon')
                                <div class="col-md-12 col-sm-12">
                                    <div class="card card-primary">
                                        <div class="card-header">
                                            <h3 class="card-title">@lang('common.service_information') </h3>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                @forelse ($service as $item)
                                                <div class="col-md-4">
                                                    
                                                    <ul>
                                                        <li class="p-2 bg-info m-1 rounded">
                                                            {{ $item->service->service_name }}
                                                        </li>
                                                        
                                                    </ul>
                                
                                                </div>
                                                @empty
                                                <span>No service assign</span>
                                                @endforelse
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            <div class="col-md-12 col-sm-12">
                                <div class="card card-primary">
                                    <div class="card-header">
                                        <h3 class="card-title">@lang('common.salary_information') </h3>
                                    </div>
                                    <div class="main-body">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <table class="table table-bordered">
                                                    <tr>
                                                        <th width="200"> @lang('common.gross_salary') </th>
                                                        <td>{{ $employee->gross_salary }}</td>
                                                    </tr>
                                                    @if (Session::get('section') == 'salon')
                                                        <tr>
                                                            <th> @lang('common.commission') </th>
                                                            <td>{{ $employee->commission }}%</td>
                                                        </tr>
                                                    @endif
                                                    <tr>
                                                        <th> @lang('common.others_allowance') </th>
                                                        <td>{{ $employee->others_allowance }}</td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12 col-sm-12">
                                <div class="card card-primary">
                                    <div class="card-header">
                                        <h3 class="card-title">@lang('common.educational_information') </h3>
                                    </div>
                                    <div class="main-body">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <table class="table table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th class="text-left"> @lang('common.exam_name') </th>
                                                            <th class="text-left"> @lang('common.group') </th>
                                                            <th class="text-left"> @lang('common.gpa') </th>
                                                            <th class="text-left"> @lang('common.pass_year') </th>
                                                            <th class="text-left"> @lang('common.board') </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="education_container">
                                                        @foreach ($employee->educations ?? [] as $education)
                                                            <tr class="education_item">
                                                                <td class="text-left">
                                                                    {{ $education->exam_name }}
                                                                </td>
                                                                <td class="text-left">
                                                                    {{ $education->group }}
                                                                </td>
                                                                <td class="text-left">
                                                                    {{ $education->gpa }}
                                                                </td>
                                                                <td class="text-left">
                                                                    {{ $education->year }}
                                                                </td>
                                                                <td class="text-left">
                                                                    {{ $education->board }}
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12 col-sm-12">
                                <div class="card card-primary">
                                    <div class="card-header">
                                        <h3 class="card-title">@lang('common.experience_information') </h3>
                                    </div>
                                    <div class="main-body">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <table class="table table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th class="text-left"> @lang('common.company_name') </th>
                                                            <th class="text-left"> @lang('common.designation') </th>
                                                            <th class="text-left"> @lang('common.date_from') </th>
                                                            <th class="text-left"> @lang('common.date_to') </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="experience_container">
                                                        @foreach ($employee->experiences ?? [] as $experience)
                                                            <tr class="experience_item">
                                                                <td class="text-left">
                                                                    {{ $experience->company_name }}
                                                                </td>
                                                                <td class="text-left">
                                                                    {{ $experience->designation }}
                                                                </td>
                                                                <td class="text-left">
                                                                    {{ $experience->start_date }}
                                                                </td>
                                                                <td class="text-left">
                                                                    {{ $experience->end_date }}
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12 col-sm-12">
                                <div class="card card-primary">
                                    <div class="card-header">
                                        <h3 class="card-title">@lang('common.guarantor_information') </h3>
                                    </div>
                                    <div class="main-body">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <table class="table table-bordered">
                                                    {{-- <tr>
                                                        <th width="200"> @lang('common.guarantor_information') </th>
                                                        <td> {{ $employee->guaranteer_information }} </td>
                                                    </tr> --}}
                                                    <tr>
                                                        <th width="200"> @lang('common.name') </th>
                                                        <td> {{ $employee->guaranteer_name }} </td>
                                                    </tr>
                                                    <tr>
                                                        <th width="200"> @lang('common.relation') </th>
                                                        <td> {{ $employee->guaranteer_relation }} </td>
                                                    </tr>
                                                    <tr>
                                                        <th width="200"> @lang('common.nid_number') </th>
                                                        <td> {{ $employee->guaranteer_nid_no }} </td>
                                                    </tr>
                                                    <tr>
                                                        <th width="200"> @lang('common.mobile_no') </th>
                                                        <td> {{ $employee->guaranteer_mobile_no }} </td>
                                                    </tr>
                                                    <tr>
                                                        <th width="200"> @lang('common.present_address') </th>
                                                        <td> {{ $employee->guaranteer_present_address }} </td>
                                                    </tr>
                                                    <tr>
                                                        <th width="200"> @lang('common.permanent_address') </th>
                                                        <td> {{ $employee->guaranteer_permanent_address }} </td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12 col-sm-12">
                                <div class="card card-primary">
                                    <div class="card-header">
                                        <h3 class="card-title">@lang('common.additional_information') </h3>
                                    </div>
                                    <div class="main-body">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <table class="table table-bordered">
                                                    <tr>
                                                        <th width="200">@lang('common.division')</th>
                                                        <td>{{ $employee->division->name ?? '' }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th width="200">@lang('common.district')</th>
                                                        <td>{{ $employee->district->name ?? '' }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th width="200">@lang('common.thana')</th>
                                                        <td>{{ $employee->thana->name ?? '' }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th> @lang('common.present_address') </th>
                                                        <td>{{ $employee->present_address }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th> @lang('common.permanent_address') </th>
                                                        <td>{{ $employee->permanent_address }}</td>
                                                    </tr>
                                                    {{-- <tr>
                                                        <th width="200">@lang('common.agent')</th>
                                                        <td>
                                                            @foreach ($employee->agentDetails() ?? [] as $agent)
                                                                <span class="badge badge-info">{{ $agent->name }}</span>
                                                                <button
                                                                    class="btn btn-sm btn-info">{{ $agent->name }}</button>
                                                            @endforeach
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th width="200"> @lang('common.area') </th>
                                                        <td>
                                                            @foreach ($employee->areaDetails() as $area)
                                                                <span class="badge badge-info">{{ $area->name }}</span>
                                                            @endforeach
                                                        </td>
                                                    </tr> --}}
                                                    <tr>
                                                        <th width="200"> @lang('common.status') </th>
                                                        <td>
                                                            @if ($employee->status == 1)
                                                                @lang('common.active')
                                                            @else
                                                                @lang('common.inactive')
                                                            @endif
                                                        </td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <template id="template_education">
        <tr class="education_item">
            <td class="text-left">
                <input type="text" name="exam_name[]" class="form-control" required>
            </td>
            <td class="text-left">
                <input type="text" name="group[]" class="form-control" required>
            </td>
            <td class="text-left">
                <input type="text" name="gpa[]" class="form-control" required>
            </td>
            <td class="text-left">
                <input type="text" name="year[]" class="form-control" required>
            </td>
            <td class="text-left">
                <input type="text" name="board[]" class="form-control" required>
            </td>
            <td class="text-left">
                <button type="button" class="btn btn-sm btn-danger remove_education">x</button>
            </td>
        </tr>
    </template>
    <template id="template_experience">
        <tr class="experience_item">
            <td class="text-left">
                <input type="text" name="company_name[]" class="form-control" required>
            </td>
            <td class="text-left">
                <input type="text" name="designations[]" class="form-control" required>
            </td>
            <td class="text-left">
                <input type="date" name="start_date[]" class="form-control" required>
            </td>
            <td class="text-left">
                <input type="date" name="end_date[]" class="form-control">
            </td>
            <td class="text-left">
                <button type="button" class="btn btn-sm btn-danger remove_experience">x</button>
            </td>
        </tr>
    </template>
@endsection

@section('script')
    <script>
        $(function() {
            // Education part
            $('body').on('click', '.add_education', function() {
                var html = $('#template_education').html();
                $('#education_container').append(html);
            });

            $('body').on('click', '.remove_education', function() {
                $(this).closest('.education_item').remove();
                // if ($('.education_item').length <= 1 ) {
                //     $('.remove_education').hide();
                // }
            });

            // Experience Part
            $('body').on('click', '.add_experience', function() {
                var html = $('#template_experience').html();
                $('#experience_container').append(html);
            });

            $('body').on('click', '.remove_experience', function() {
                $(this).closest('.experience_item').remove();
                // if ($('.experience_item').length <= 1 ) {
                //     $('.remove_experience').hide();
                // }
            });

            $('#area_id').on("select2:select", function(e) {
                var data = e.params.data.text;
                if (data == '') {
                    $("#area_id > option").prop("selected", "selected");
                    $("#area_id").trigger("change");
                }
            });

            $('#agent_id').on("select2:select", function(e) {
                var data = e.params.data.text;
                if (data == '') {
                    $("#agent_id > option").prop("selected", "selected");
                    $("#agent_id").trigger("change");
                }
            });

            // Get District
            $('body').on('change', '#division_id', function() {
                var division_id = $('#division_id').val();
                var options = '<option value=""> Select district </option>';
                var selected = '{{ old('district_id', $employee->district_id) }}';
                $.ajax({
                    method: "GET",
                    url: "{{ route('get_division_districts') }}",
                    data: {
                        'division_id': division_id
                    },
                }).done(function(response) {
                    // console.log(response);
                    response.forEach(function(item, i) {
                        if (item.id == selected) {
                            options += '<option selected value="' + item.id + '"> ' + item
                                .name + ' </option>';
                        } else {
                            options += '<option value="' + item.id + '"> ' + item.name +
                                ' </option>';
                        }
                    });
                    $('#district_id').html(options);
                    $('#district_id').trigger('change');
                });
            })
            $('#division_id').trigger('change');

            // Get Thana
            $('body').on('change', '#district_id', function() {
                var district_id = $('#district_id').val();
                var options = '<option value="" class="agent_list">All</option>';
                var selected = <?php echo old('agent_id', json_encode($agent_id)); ?>;
                $.ajax({
                    method: "GET",
                    url: "{{ route('get_district_agents') }}",
                    data: {
                        'district_id': district_id
                    },
                }).done(function(response) {
                    // console.log(response);
                    response.forEach(function(item, i) {
                        if (jQuery.inArray(item.id, selected) != '-1') {
                            options += '<option selected value="' + item.id + '"> ' + item
                                .name + ' - ' + item.phone + ' </option>';
                        } else {
                            options += '<option value="' + item.id + '"> ' + item.name +
                                ' - ' + item.phone + ' </option>';
                        }
                    });
                    $('#agent_id').html(options);
                    $('#agent_id').trigger('change');
                });
            })
            // Get Area
            $('body').on('change', '#agent_id', function() {
                var agent_id = $('#agent_id').val();
                var options = '<option value="" class="area_list">All</option>';
                var selected = <?php echo old('area_id', json_encode($area_id)); ?>;
                // console.log(agent_id);
                $.ajax({
                    method: "GET",
                    url: "{{ route('get_agent_areas') }}",
                    data: {
                        'agent_id': agent_id
                    },
                }).done(function(response) {
                    // console.log(response);
                    response.forEach(function(item, i) {
                        if (jQuery.inArray(item.id, selected) != '-1') {
                            options += '<option selected value="' + item.id + '"> ' + item
                                .name + ' (' + item.thana.name + ') </option>';
                        } else {
                            options += '<option value="' + item.id + '"> ' + item.name +
                                ' (' + item.thana.name + ') </option>';
                        }
                    });
                    $('#area_id').html(options);
                });

            })
        })

        $(document).ready(function() {
            function readURL(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $('#image_show').attr('src', e.target.result);
                    }
                    reader.readAsDataURL(input.files[0]);
                }
            }
            $("#image").change(function() {
                readURL(this);
            });
        });
    </script>
@endsection
