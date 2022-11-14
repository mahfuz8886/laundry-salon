@extends('backEnd.layouts.master')
@section('hr', 'active menu-open')
@section('deliveryman', 'active menu-open')
@section('deliveryman_manage', 'active')
@section('title', 'Deliveryman Detail')
@section('extracss')
    <style>
        .table th {
            padding: 5px 10px !important;
        }

        .table td {
            padding: 5px 10px !important;
        }

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
                                        <h5>@lang('common.deliveryman') @lang('common.details')</h5>
                                    </div>
                                    <div class="quick-button">
                                        <a href="{{ url('admin/deliveryman/manage') }}"
                                            class="btn btn-primary btn-actions btn-create">
                                            @lang('common.manage')
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
                                                    <label for="image"> @lang('common.deliveryman') @lang('common.photo') </label>
                                                    <div>
                                                        <img src="{{ url($deliveryman->image) }}" alt="Photo" width="100"
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
                                                        <td>{{ $deliveryman->name }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th> @lang('common.email_address') </th>
                                                        <td>{{ $deliveryman->email }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th> @lang('common.mobile_no') </th>
                                                        <td>{{ $deliveryman->phone }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th> @lang('common.alternative') @lang('common.mobile_no') </th>
                                                        <td>{{ $deliveryman->alternative_phone }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th> @lang('common.nid_number') </th>
                                                        <td>{{ $deliveryman->nid_no }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th> @lang('common.father_name') </th>
                                                        <td>{{ $deliveryman->fathers_name }}</td>
                                                    </tr>
                                                    
                                                    <tr>
                                                        <th> @lang('common.mother_name') </th>
                                                        <td>{{ $deliveryman->mothers_name }}</td>
                                                    </tr>
                                                    
                                                    <tr>
                                                        <th> @lang('common.dob') </th>
                                                        <td>{{ $deliveryman->birth_date ? date('d-F-Y', strtotime($deliveryman->birth_date)) : '' }}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th> @lang('common.religion') </th>
                                                        <td>
                                                            {{ $deliveryman->religion }}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th> @lang('common.marital_status') </th>
                                                        <td>{{ $deliveryman->marital_status }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th> @lang('common.designation') </th>
                                                        <td>{{ $deliveryman->designation }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th> @lang('common.per_parcel_amount') </th>
                                                        <td>{{ $deliveryman->per_parcel_amount }}</td>
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
                                        <h3 class="card-title"> @lang('common.educational_information')  </h3>
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
                                                        @foreach ($deliveryman->educations ?? [] as $education)
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
                                                            <th class="text-left"> @lang('common.company_name')  </th>
                                                            <th class="text-left"> @lang('common.designation') </th>
                                                            <th class="text-left"> @lang('common.date_from')  </th>
                                                            <th class="text-left"> @lang('common.date_to') </th>
                                                            
                                                        </tr>
                                                    </thead>
                                                    <tbody id="experience_container">
                                                        @foreach ($deliveryman->experiences ?? [] as $experience)
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
                                                    
                                                    <tr>
                                                        <th width="200"> @lang('common.name') </th>
                                                        <td> {{ $deliveryman->guaranteer_name }} </td>
                                                    </tr>
                                                    <tr>
                                                        <th width="200"> @lang('common.relation')  </th>
                                                        <td> {{ $deliveryman->guaranteer_relation }} </td>
                                                    </tr>
                                                    <tr>
                                                        <th width="200"> @lang('common.nid_number') </th>
                                                        <td> {{ $deliveryman->guaranteer_nid_no }} </td>
                                                    </tr>
                                                    <tr>
                                                        <th width="200"> @lang('common.mobile_no') </th>
                                                        <td> {{ $deliveryman->guaranteer_mobile_no }} </td>
                                                    </tr>
                                                    <tr>
                                                        <th width="200"> @lang('common.present_address') </th>
                                                        <td> {{ $deliveryman->guaranteer_present_address }} </td>
                                                    </tr>
                                                    <tr>
                                                        <th width="200">  @lang('common.permanent_address')</th>
                                                        <td> {{ $deliveryman->guaranteer_permanent_address }} </td>
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
                                        <h3 class="card-title">@lang('common.others_information') </h3>
                                    </div>
                                    <div class="main-body">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <table class="table table-bordered">
                                                    <tr>
                                                        <th width="200">@lang('common.division')</th>
                                                        <td>{{ $deliveryman->division->name ?? '' }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th width="200">@lang('common.district')</th>
                                                        <td>{{ $deliveryman->district->name ?? '' }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th width="200">@lang('common.thana')</th>
                                                        <td>{{ $deliveryman->thana->name ?? '' }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th> @lang('common.present_address')</th>
                                                        <td>{{ $deliveryman->present_address }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th> @lang('common.permanent_address')s </th>
                                                        <td>{{ $deliveryman->permanent_address }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th width="200"> @lang('common.status') </th>
                                                        <td>
                                                            @if ($deliveryman->status == 1)
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
                var selected = '{{ old('district_id', $deliveryman->district_id) }}';
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
