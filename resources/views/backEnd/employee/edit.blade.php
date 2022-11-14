@extends('backEnd.layouts.master')
@section('hr', 'active menu-open')
@section('employee', 'menu-open')
@section('employee_manage', 'active')
@section('title', 'Update employee')
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
                                        <h5>@lang('common.employee') @lang('common.edit')</h5>
                                    </div>
                                    <div class="quick-button">
                                        <a href="{{ url('admin/employee/manage') }}"
                                            class="btn btn-primary btn-actions btn-create">
                                            @lang('common.employee') @lang('common.manage')
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <form action="{{ url('admin/employee/update') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="hidden_id" value="{{ $edit_data->id }}">
                                <div class="col-md-12 col-sm-12">
                                    <div class="card card-primary">
                                        <div class="card-header">
                                            <h3 class="card-title">@lang('common.personal_information') </h3>
                                        </div>
                                        <div class="main-body">
                                            <div class="row">
                                                <div class="col-md-12 text-center">
                                                    <div class="form-group">
                                                        <label for="image"> @lang('common.employee') @lang('common.photo') <span
                                                                class="text-danger">*</span> </label>
                                                        <div>
                                                            <img src="{{ url($edit_data->image) }}" id="image_show"
                                                                alt="Photo" width="100" height="100">
                                                        </div>
                                                        <input type="file" name="image" id="image"
                                                            class="{{ $errors->has('image') ? ' is-invalid' : '' }}"
                                                            value="{{ old('image') }}">
                                                        @if ($errors->has('image'))
                                                            <span class="invalid-feedback">
                                                                <strong>{{ $errors->first('image') }}</strong>
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label for="name">@lang('common.name') <span class="text-danger">*</span>
                                                        </label>
                                                        <input type="text" name="name" id="name"
                                                            class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}"
                                                            value="{{ old('name', $edit_data->name) }}" required>
                                                        @if ($errors->has('name'))
                                                            <span class="invalid-feedback">
                                                                <strong>{{ $errors->first('name') }}</strong>
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <!-- column end -->
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label for="email">@lang('common.email_address') </label>
                                                        <input type="email" name="email" id="email"
                                                            class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}"
                                                            value="{{ old('email', $edit_data->email) }}">
                                                        @if ($errors->has('email'))
                                                            <span class="invalid-feedback">
                                                                <strong>{{ $errors->first('email') }}</strong>
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <!-- column end -->
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label for="phone">@lang('common.mobile_no') <span class="text-danger">*</span>
                                                        </label>
                                                        <input type="text" name="phone" id="phone"
                                                            class="form-control {{ $errors->has('phone') ? ' is-invalid' : '' }}"
                                                            value="{{ old('phone', $edit_data->phone) }}" required>
                                                        @if ($errors->has('phone'))
                                                            <span class="invalid-feedback">
                                                                <strong>{{ $errors->first('phone') }}</strong>
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label for="alternative_phone"> @lang('common.alternative') @lang('common.mobile_no') </label>
                                                        <input type="text" name="alternative_phone" id="alternative_phone"
                                                            class="form-control {{ $errors->has('alternative_phone') ? ' is-invalid' : '' }}"
                                                            value="{{ old('alternative_phone', $edit_data->alternative_phone) }}">
                                                        @if ($errors->has('alternative_phone'))
                                                            <span class="invalid-feedback">
                                                                <strong>{{ $errors->first('alternative_phone') }}</strong>
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label for="nid_no"> @lang('common.nid_number') </label>
                                                        <input type="text" name="nid_no" id="nid_no"
                                                            class="form-control {{ $errors->has('nid_no') ? ' is-invalid' : '' }}"
                                                            value="{{ old('nid_no', $edit_data->nid_no) }}">
                                                        @if ($errors->has('nid_no'))
                                                            <span class="invalid-feedback">
                                                                <strong>{{ $errors->first('nid') }}</strong>
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div>

                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label for="fathers_name"> @lang('common.father_name') </label>
                                                        <input type="text" name="fathers_name" id="fathers_name"
                                                            class="form-control {{ $errors->has('fathers_name') ? ' is-invalid' : '' }}"
                                                            value="{{ old('fathers_name', $edit_data->fathers_name) }}">
                                                        @if ($errors->has('fathers_name'))
                                                            <span class="invalid-feedback">
                                                                <strong>{{ $errors->first('fathers_name') }}</strong>
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div>

                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label for="mothers_name">@lang('common.mother_name') </label>
                                                        <input type="text" name="mothers_name" id="mothers_name"
                                                            class="form-control {{ $errors->has('mothers_name') ? ' is-invalid' : '' }}"
                                                            value="{{ old('mothers_name', $edit_data->mothers_name) }}">
                                                        @if ($errors->has('mothers_name'))
                                                            <span class="invalid-feedback">
                                                                <strong>{{ $errors->first('mothers_name') }}</strong>
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div>

                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label for="birth_date">  @lang('common.dob')  </label>
                                                        <input type="date" name="birth_date" id="birth_date"
                                                            class="flatDate form-control flatpickr-input {{ $errors->has('birth_date') ? ' is-invalid' : '' }}"
                                                            value="{{ old('birth_date', $edit_data->birth_date) }}">
                                                        @if ($errors->has('birth_date'))
                                                            <span class="invalid-feedback">
                                                                <strong>{{ $errors->first('birth_date') }}</strong>
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label for="religion"> @lang('common.religion') </label>
                                                        <select id="religion" name="religion" class="form-control select2">
                                                            <option value="Islam"
                                                                @if (old('religion', $edit_data->religion) == 'Islam') selected @endif>@lang('common.islam')
                                                            </option>
                                                            <option value="Christianity"
                                                                @if (old('religion', $edit_data->religion) == 'Islam') selected @endif>
                                                                @lang('common.christian')</option>
                                                            <option value="Hinduism"
                                                                @if (old('religion', $edit_data->religion) == 'Islam') selected @endif>@lang('common.hindu')
                                                            </option>
                                                            <option value="Buddhism"
                                                                @if (old('religion', $edit_data->religion) == 'Islam') selected @endif>@lang('common.boddho')
                                                            </option>
                                                            <option value="Godless"
                                                                @if (old('religion', $edit_data->religion) == 'Islam') selected @endif>@lang('common.godless')
                                                            </option>
                                                            <option value="Others"
                                                                @if (old('religion', $edit_data->religion) == 'Islam') selected @endif>@lang('common.others')
                                                            </option>
                                                        </select>
                                                        @if ($errors->has('religion'))
                                                            <span class="invalid-feedback">
                                                                <strong>{{ $errors->first('religion') }}</strong>
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label for="marital_status"> @lang('common.marital_status') </label>
                                                        <select id="marital_status" name="marital_status"
                                                            class="form-control select2">
                                                            <option value="Single"
                                                                @if (old('marital_status', $edit_data->marital_status) == 'Single') selected @endif>@lang('common.single')
                                                            </option>
                                                            <option value="Married"
                                                                @if (old('marital_status', $edit_data->marital_status) == 'Married') selected @endif>@lang('common.married')
                                                            </option>
                                                            <option value="Widowed"
                                                                @if (old('marital_status', $edit_data->marital_status) == 'Widowed') selected @endif>@lang('common.widowed')
                                                            </option>
                                                            <option value="Divorced"
                                                                @if (old('marital_status', $edit_data->marital_status) == 'Divorced') selected @endif>@lang('common.divorced')
                                                            </option>
                                                            <option value="Others"
                                                                @if (old('marital_status', $edit_data->marital_status) == 'Others') selected @endif>@lang('common.others')
                                                            </option>
                                                        </select>
                                                        @if ($errors->has('marital_status'))
                                                            <span class="invalid-feedback">
                                                                <strong>{{ $errors->first('marital_status') }}</strong>
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div>

                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label for="branch_id">Branch</label>
                                                        <select name="branch_id" class="form-control select2" id="branch_id" required>
                                                            <option value="">@lang('common.choose')</option>
                                                            @foreach($allBranch as $branch)
                                                            <option {{ $edit_data->branch_id==$branch->id? 'selected':'' }} value="{{ $branch->id }}">{{ $branch->title }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label for="department_id">@lang('common.department') </label>
                                                        <select id="department_id" name="department_id"
                                                            class="form-control select2">
                                                            <option value=""> @lang('common.select_department') </option>
                                                            @foreach ($departments as $department)
                                                                <option value="{{ $department->id }}"
                                                                    @if (old('department_id', $edit_data->department_id) == $department->id) selected @endif>
                                                                    {{ $department->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                        @if ($errors->has('department_id'))
                                                            <span class="invalid-feedback">
                                                                <strong>{{ $errors->first('nid') }}</strong>
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label for="designation">@lang('common.designation')</label>
                                                        <input type="text" name="designation" id="designation"
                                                            class="form-control {{ $errors->has('designation') ? ' is-invalid' : '' }}"
                                                            value="{{ old('designation', $edit_data->designation) }}">
                                                        @if ($errors->has('designation'))
                                                            <span class="invalid-feedback">
                                                                <strong>{{ $errors->first('designation') }}</strong>
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div>

                                                {{-- <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label for="per_parcel_amount"> Per parcel amount</label>
                                                        <input type="text" name="per_parcel_amount" id="per_parcel_amount"
                                                            class="form-control {{ $errors->has('per_parcel_amount') ? ' is-invalid' : '' }}"
                                                            value="{{ old('per_parcel_amount', $edit_data->per_parcel_amount) }}">
                                                        @if ($errors->has('per_parcel_amount'))
                                                            <span class="invalid-feedback">
                                                                <strong>{{ $errors->first('per_parcel_amount') }}</strong>
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div> --}}

                                                <div class="col-md-12">
                                                    <p> <b>@lang('common.nid_birth')</b> <span class="text-danger">*</span> </p>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-check-inline">
                                                                <input class="form-check-input identification_type"
                                                                    type="radio" id="nid"
                                                                    name="identification_type" value="1"
                                                                    @if (old('identification_type', $edit_data->identification_type) == 1) checked @endif>
                                                                <label class="form-check-label" for="nid">
                                                                    @lang('common.nid') </label>
                                                            </div>
                                                            <div class="form-check-inline">
                                                                <input class="form-check-input identification_type"
                                                                    type="radio" id="birth_certificate"
                                                                    name="identification_type" value="2"
                                                                    @if (old('identification_type', $edit_data->identification_type) == 2) checked @endif>
                                                                <label class="form-check-label" for="birth_certificate">
                                                                    @lang('common.birth_certificate') </label>
                                                            </div>
                                                            
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="row">
                                                                {{-- <div class="col-md-12 nid_part">
                                                                    <div
                                                                        class="form-group {{ $errors->has('nidnumber') ? ' is-invalid' : '' }}">
                                                                        <input class="form-control" type="text"
                                                                            name="nidnumber"
                                                                            value="{{ old('nidnumber', $edit_data->nidnumber) }}"
                                                                            placeholder="@lang('common.nid_number')">
                                                                        @if ($errors->has('nidnumber'))
                                                                            <span class="invalid-feedback">
                                                                                <strong>{{ $errors->first('nidnumber') }}</strong>
                                                                            </span>
                                                                        @endif
                                                                    </div>
                                                                </div> --}}
                                                                <div class="col-md-6 nid_part">
                                                                    <div
                                                                        class="form-group {{ $errors->has('nid_photo') ? ' is-invalid' : '' }}">
                                                                        <label for="nid_photo"> @lang('common.nid_front_photo') <span
                                                                                class="text-danger">*</span> <small>
                                                                                Size (324x204)</small> </label>
                                                                        <input class="form-control" type="file"
                                                                            name="nid_photo" id="nid_photo"
                                                                            accept="image/*">

                                                                        @if ($errors->has('nid_photo'))
                                                                            <span class="invalid-feedback">
                                                                                <strong>{{ $errors->first('nid_photo') }}</strong>
                                                                            </span>
                                                                        @endif
                                                                    </div>
                                                                    <div>
                                                                        <img id="nid_photo_show"
                                                                            src="{{ asset($edit_data->nid_front) }}"
                                                                            alt="NID Photo">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6 nid_part">
                                                                    <div
                                                                        class="form-group {{ $errors->has('nid_photo_back') ? ' is-invalid' : '' }}">
                                                                        <label for="nid_photo_back"> @lang('common.nid_back_photo')
                                                                            <span class="text-danger">*</span> <small>
                                                                                Size (324x204)</small> </label>
                                                                        <input class="form-control" type="file"
                                                                            name="nid_photo_back" id="nid_photo_back"
                                                                            accept="image/*">

                                                                        @if ($errors->has('nid_photo_back'))
                                                                            <span class="invalid-feedback">
                                                                                <strong>{{ $errors->first('nid_photo_back') }}</strong>
                                                                            </span>
                                                                        @endif
                                                                    </div>
                                                                    <div>
                                                                        <img id="nid_photo_back_show"
                                                                            src="{{ asset($edit_data->nid_back) }}"
                                                                            alt="NID Photo Back">
                                                                    </div>
                                                                </div>
                                                                {{-- <div class="col-md-12 birth_certificate_part"
                                                                    style="display: none;">
                                                                    <div
                                                                        class="form-group {{ $errors->has('birth_certificate_no') ? ' is-invalid' : '' }}">
                                                                        <input class="form-control" type="text"
                                                                            name="birth_certificate_no"
                                                                            value="{{ old('birth_certificate_no', $edit_data->birth_certificate_no) }}"
                                                                            placeholder="@lang('common.birth_certificate_no')">

                                                                        @if ($errors->has('birth_certificate_no'))
                                                                            <span class="invalid-feedback">
                                                                                <strong>{{ $errors->first('birth_certificate_no') }}</strong>
                                                                            </span>
                                                                        @endif
                                                                    </div>
                                                                </div> --}}
                                                                <div class="col-md-6 birth_certificate_part"
                                                                    style="display: none;">
                                                                    <div
                                                                        class="form-group {{ $errors->has('birth_certificate_photo') ? ' is-invalid' : '' }}">
                                                                        <label for=""> @lang('common.birth_certificate_photo') <span
                                                                                class="text-danger">*</span> <small>
                                                                                Size (324x204)</small> </label>
                                                                        <input class="form-control" type="file"
                                                                            name="birth_certificate_photo"
                                                                            id="birth_certificate_photo" accept="image/*">

                                                                        @if ($errors->has('birth_certificate_photo'))
                                                                            <span class="invalid-feedback">
                                                                                <strong>{{ $errors->first('birth_certificate_photo') }}</strong>
                                                                            </span>
                                                                        @endif
                                                                    </div>
                                                                    <div>
                                                                        <img id="birth_certificate_photo_show"
                                                                            src="{{ asset($edit_data->birth_certificate) }}"
                                                                            alt="Birth certificate photo">
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

                                {{-- salary inforamation --}}
                                <div class="col-md-12 col-sm-12">
                                    <div class="card card-primary">
                                        <div class="card-header">
                                            <h3 class="card-title"> @lang('common.salary_information') </h3>
                                        </div>
                                        <div class="main-body">
                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <label for="gross_salary">@lang('common.gross_salary') <span class="text-danger">*</span></label>
                                                        <input type="number" name="gross_salary" step="any" id="gross_salary"
                                                            class="form-control {{ $errors->has('gross_salary') ? ' is-invalid' : '' }}"
                                                            value="{{ old('gross_salary', $edit_data->gross_salary) }}" required>
                                                        @if ($errors->has('gross_salary'))
                                                            <span class="invalid-feedback">
                                                                <strong>{{ $errors->first('gross_salary') }}</strong>
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div>  

                                                @if(Session::get('section')=='salon')
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <label for="commission">@lang('common.commission') <span class="text-danger">*</span></label>
                                                        <input type="number" name="commission" step="any" id="commission"
                                                            class="form-control {{ $errors->has('commission') ? ' is-invalid' : '' }}"
                                                            value="{{ old('commission', $edit_data->commission) }}" required>
                                                        @if ($errors->has('commission'))
                                                            <span class="invalid-feedback">
                                                                <strong>{{ $errors->first('commission') }}</strong>
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div> 
                                                @endif 

                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <label for="others_allowance">@lang('common.others_allowance')</label>
                                                        <input type="number" name="others_allowance" step="any" id="others_allowance"
                                                            class="form-control {{ $errors->has('others_allowance') ? ' is-invalid' : '' }}"
                                                            value="{{ old('others_allowance', $edit_data->others_allowance) }}">
                                                        @if ($errors->has('others_allowance'))
                                                            <span class="invalid-feedback">
                                                                <strong>{{ $errors->first('others_allowance') }}</strong>
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div>  

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- salary inforamation --}}

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
                                                                <th class="text-left">  @lang('common.exam_name') <span
                                                                        class="text-danger">*</span></th>
                                                                <th class="text-left"> @lang('common.group') <span
                                                                        class="text-danger">*</span></th>
                                                                <th class="text-left"> @lang('common.gpa') <span
                                                                        class="text-danger">*</span></th>
                                                                <th class="text-left"> @lang('common.pass_year') <span
                                                                        class="text-danger">*</span></th>
                                                                <th class="text-left"> @lang('common.board') <span
                                                                        class="text-danger">*</span></th>
                                                                <th class="text-left"> </th>
                                                            </tr>
                                                        </thead>
                                                        <tbody id="education_container">
                                                            @foreach ($edit_data->educations ?? [] as $education)
                                                                <tr class="education_item">
                                                                    <td class="text-left">
                                                                        <input type="text" name="exam_name[]"
                                                                            value="{{ $education->exam_name }}"
                                                                            class="form-control" required>
                                                                    </td>
                                                                    <td class="text-left">
                                                                        <input type="text" name="group[]"
                                                                            value="{{ $education->group }}"
                                                                            class="form-control" required>
                                                                    </td>
                                                                    <td class="text-left">
                                                                        <input type="text" name="gpa[]"
                                                                            value="{{ $education->gpa }}"
                                                                            class="form-control" required>
                                                                    </td>
                                                                    <td class="text-left">
                                                                        <input type="text" name="year[]"
                                                                            value="{{ $education->year }}"
                                                                            class="form-control" required>
                                                                    </td>
                                                                    <td class="text-left">
                                                                        <input type="text" name="board[]"
                                                                            value="{{ $education->board }}"
                                                                            class="form-control" required>
                                                                    </td>
                                                                    <td class="text-left">
                                                                        <button type="button"
                                                                            class="btn btn-sm btn-danger remove_education">x</button>
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>

                                                        <tfoot>
                                                            <tr>
                                                                <td>
                                                                    <button type="button"
                                                                        class="btn btn-sm btn-info add_education"> @lang('common.add_more')</button>
                                                                </td>
                                                            </tr>
                                                        </tfoot>

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
                                                                <th class="text-left"> @lang('common.company_name') <span
                                                                        class="text-danger">*</span> </th>
                                                                <th class="text-left"> @lang('common.designation') <span
                                                                        class="text-danger">*</span></th>
                                                                <th class="text-left"> @lang('common.date_from') <span
                                                                        class="text-danger">*</span> </th>
                                                                <th class="text-left"> @lang('common.date_to') <small> (@lang('common.empty_for_continue')) </small> </th>
                                                                <th class="text-left"> </th>
                                                            </tr>
                                                        </thead>
                                                        <tbody id="experience_container">
                                                            @foreach ($edit_data->experiences ?? [] as $experience)
                                                                <tr class="experience_item">
                                                                    <td class="text-left">
                                                                        <input type="text" name="company_name[]"
                                                                            value="{{ $experience->company_name }}"
                                                                            class="form-control" required>
                                                                    </td>
                                                                    <td class="text-left">
                                                                        <input type="text" name="designations[]"
                                                                            value="{{ $experience->designation }}"
                                                                            class="form-control" required>
                                                                    </td>
                                                                    <td class="text-left">
                                                                        <input type="date" name="start_date[]"
                                                                            value="{{ $experience->start_date }}"
                                                                            class="form-control" required>
                                                                    </td>
                                                                    <td class="text-left">
                                                                        <input type="date" name="end_date[]"
                                                                            value="{{ $experience->end_date }}"
                                                                            class="form-control">
                                                                    </td>
                                                                    <td class="text-left">
                                                                        <button type="button"
                                                                            class="btn btn-sm btn-danger remove_experience">x</button>
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>

                                                        <tfoot>
                                                            <tr>
                                                                <td>
                                                                    <button type="button"
                                                                        class="btn btn-sm btn-info add_experience"> @lang('common.add_more')</button>
                                                                </td>
                                                            </tr>
                                                        </tfoot>

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
                                                {{-- <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label for="guaranteer_information"> @lang('common.guarantor_information') </label>
                                                        <input type="text" name="guaranteer_information"
                                                            id="guaranteer_information"
                                                            class="form-control {{ $errors->has('guaranteer_information') ? ' is-invalid' : '' }}"
                                                            value="{{ old('guaranteer_information', $edit_data->guaranteer_information) }}"
                                                            autocomplete="new-guaranteer_information">
                                                        @if ($errors->has('guaranteer_information'))
                                                            <span class="invalid-feedback">
                                                                <strong>{{ $errors->first('guaranteer_information') }}</strong>
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div> --}}

                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label for="guaranteer_name"> @lang('common.name') </label>
                                                        <input type="text" name="guaranteer_name" id="guaranteer_name"
                                                            class="form-control {{ $errors->has('guaranteer_name') ? ' is-invalid' : '' }}"
                                                            value="{{ old('guaranteer_name', $edit_data->guaranteer_name) }}"
                                                            autocomplete="new-guaranteer_name">
                                                        @if ($errors->has('guaranteer_name'))
                                                            <span class="invalid-feedback">
                                                                <strong>{{ $errors->first('guaranteer_name') }}</strong>
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div>

                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label for="guaranteer_relation"> @lang('common.relation') </label>
                                                        <input type="text" name="guaranteer_relation"
                                                            id="guaranteer_relation"
                                                            class="form-control {{ $errors->has('guaranteer_relation') ? ' is-invalid' : '' }}"
                                                            value="{{ old('guaranteer_relation', $edit_data->guaranteer_relation) }}"
                                                            autocomplete="new-guaranteer_relation">
                                                        @if ($errors->has('guaranteer_relation'))
                                                            <span class="invalid-feedback">
                                                                <strong>{{ $errors->first('guaranteer_relation') }}</strong>
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div>

                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label for="guaranteer_nid_no"> @lang('common.nid_number') </label>
                                                        <input type="text" name="guaranteer_nid_no" id="guaranteer_nid_no"
                                                            class="form-control {{ $errors->has('guaranteer_nid_no') ? ' is-invalid' : '' }}"
                                                            value="{{ old('guaranteer_nid_no', $edit_data->guaranteer_nid_no) }}"
                                                            autocomplete="new-guaranteer_nid_no">
                                                        @if ($errors->has('guaranteer_nid_no'))
                                                            <span class="invalid-feedback">
                                                                <strong>{{ $errors->first('guaranteer_nid_no') }}</strong>
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div>

                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label for="guaranteer_mobile_no">  @lang('common.mobile_no') </label>
                                                        <input type="text" name="guaranteer_mobile_no"
                                                            id="guaranteer_mobile_no"
                                                            class="form-control {{ $errors->has('guaranteer_mobile_no') ? ' is-invalid' : '' }}"
                                                            value="{{ old('guaranteer_mobile_no', $edit_data->guaranteer_mobile_no) }}"
                                                            autocomplete="new-guaranteer_mobile_no">
                                                        @if ($errors->has('guaranteer_mobile_no'))
                                                            <span class="invalid-feedback">
                                                                <strong>{{ $errors->first('guaranteer_mobile_no') }}</strong>
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div>

                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <label for="guaranteer_present_address"> @lang('common.present_address')
                                                        </label>
                                                        <input type="text" name="guaranteer_present_address"
                                                            id="guaranteer_present_address"
                                                            class="form-control {{ $errors->has('guaranteer_present_address') ? ' is-invalid' : '' }}"
                                                            value="{{ old('guaranteer_present_address', $edit_data->guaranteer_present_address) }}"
                                                            autocomplete="new-guaranteer_present_address">
                                                        @if ($errors->has('guaranteer_present_address'))
                                                            <span class="invalid-feedback">
                                                                <strong>{{ $errors->first('guaranteer_present_address') }}</strong>
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div>

                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <label for="guaranteer_permanent_address"> @lang('common.permanent_address')
                                                             </label>
                                                        <input type="text" name="guaranteer_permanent_address"
                                                            id="guaranteer_permanent_address"
                                                            class="form-control {{ $errors->has('guaranteer_permanent_address') ? ' is-invalid' : '' }}"
                                                            value="{{ old('guaranteer_permanent_address', $edit_data->guaranteer_permanent_address) }}"
                                                            autocomplete="new-guaranteer_permanent_address">
                                                        @if ($errors->has('guaranteer_permanent_address'))
                                                            <span class="invalid-feedback">
                                                                <strong>{{ $errors->first('guaranteer_permanent_address') }}</strong>
                                                            </span>
                                                        @endif
                                                    </div>
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
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <label for="division_id"> @lang('common.division') <span
                                                                class="text-danger">*</span> </label>
                                                        <select name="division_id" id="division_id"
                                                            class="form-control select2 {{ $errors->has('division_id') ? ' is-invalid' : '' }}"
                                                            required>
                                                            <option value="">@lang('common.division')</option>
                                                            @foreach ($divisions as $division)
                                                                <option value="{{ $division->id }}"
                                                                    @if (old('division_id', $edit_data->division_id) == $division->id) selected @endif>
                                                                    {{ $division->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                        @if ($errors->has('division_id'))
                                                            <span class="invalid-feedback">
                                                                <strong>{{ $errors->first('division_id') }}</strong>
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div>

                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <label for="district_id">@lang('common.district') <span
                                                                class="text-danger">*</span> </label>
                                                        <select name="district_id" id="district_id"
                                                            class="form-control select2" required>
                                                            <option value="">@lang('common.select_district') </option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <label for="thana_id">@lang('common.thana') <span class="text-danger">*</span>
                                                        </label>
                                                        <select name="thana_id" id="thana_id"
                                                            class="form-control select2" required>
                                                            <option value="">@lang('common.select_thana') </option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <label for="present_address">@lang('common.present_address') </label>
                                                        <input type="text" name="present_address" id="present_address"
                                                            class="form-control {{ $errors->has('present_address') ? ' is-invalid' : '' }} py-5"
                                                            value="{{ old('present_address', $edit_data->present_address) }}"
                                                            autocomplete="new-present_address">
                                                        @if ($errors->has('present_address'))
                                                            <span class="invalid-feedback">
                                                                <strong>{{ $errors->first('present_address') }}</strong>
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div>

                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <label for="permanent_address"> @lang('common.permanent_address') </label>
                                                        <input type="text" name="permanent_address" id="permanent_address"
                                                            class="form-control {{ $errors->has('permanent_address') ? ' is-invalid' : '' }} py-5"
                                                            value="{{ old('permanent_address', $edit_data->permanent_address) }}"
                                                            autocomplete="new-permanent_address">
                                                        @if ($errors->has('permanent_address'))
                                                            <span class="invalid-feedback">
                                                                <strong>{{ $errors->first('permanent_address') }}</strong>
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div>

                                                {{-- <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <label for="agent_id"> @lang('common.agent') <span class="text-danger">*</span>
                                                        </label>
                                                        <select name="agent_id[]" id="agent_id"
                                                            class="form-control multi_select2" multiple required>
                                                            <option value="">@lang('common.agent') @lang('common.select') </option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <label for="area_id">@lang('common.area') <span class="text-danger">*</span>
                                                        </label>
                                                        <select name="area_id[]" id="area_id"
                                                            class="form-control multi_select2" multiple required>
                                                            <option value="">@lang('common.select_area')  </option>
                                                        </select>
                                                    </div>
                                                </div> --}}

                                                {{-- <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label for="password">Password </label>
                                                        <input type="password" name="password" id="password"
                                                            class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}"
                                                            value="" autocomplete="new-password">
                                                        @if ($errors->has('password'))
                                                            <span class="invalid-feedback">
                                                                <strong>{{ $errors->first('password') }}</strong>
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label for="confirm"> Confirm password </label>
                                                        <input type="password" name="confirm" id="confirm"
                                                            class="form-control {{ $errors->has('confirm') ? ' is-invalid' : '' }}"
                                                            value="" autocomplete="new-password">
                                                        @if ($errors->has('confirm'))
                                                            <span class="invalid-feedback">
                                                                <strong>{{ $errors->first('confirm') }}</strong>
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div> --}}
                                                <div class="col-md-6">
                                                    <div class="row">
                                                        <div class="col-sm-12">
                                                            <div class="form-group">
                                                                <div class="custom-label">
                                                                    <label> @lang('common.status')  <span class="text-danger">*</span>
                                                                    </label>
                                                                </div>
                                                                <div class="box-body pub-stat display-inline">
                                                                    <input
                                                                        class="form-control{{ $errors->has('status') ? ' is-invalid' : '' }}"
                                                                        type="radio" id="active" name="status" value="1"
                                                                        @if (old('status', $edit_data->status) == 1) checked @endif>
                                                                    <label for="active">@lang('common.active') </label>
                                                                    @if ($errors->has('status'))
                                                                        <span class="invalid-feedback">
                                                                            <strong>{{ $errors->first('status') }}</strong>
                                                                        </span>
                                                                    @endif
                                                                </div>
                                                                <div class="box-body pub-stat display-inline">
                                                                    <input
                                                                        class="form-control{{ $errors->has('status') ? ' is-invalid' : '' }}"
                                                                        type="radio" name="status" value="0" id="inactive"
                                                                        @if (old('status', $edit_data->status) == 0) checked @endif>
                                                                    <label for="inactive">@lang('common.inactive') </label>
                                                                    @if ($errors->has('status'))
                                                                        <span class="invalid-feedback">
                                                                            <strong>{{ $errors->first('status') }}</strong>
                                                                        </span>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 mrt-30">
                                                    <div class="form-group">
                                                        <button type="submit" class="btn btn-primary">@lang('common.submit') </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
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

        // NID Photo Show
        $(function() {
            function readURL(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $('#nid_photo_show').attr('src', e.target.result);
                    }
                    reader.readAsDataURL(input.files[0]);
                }
            }
            $("#nid_photo").change(function() {
                readURL(this);
            });
        })
        // NID Photo Back Show
        $(function() {
            function readURL(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $('#nid_photo_back_show').attr('src', e.target.result);
                    }
                    reader.readAsDataURL(input.files[0]);
                }
            }
            $("#nid_photo_back").change(function() {
                readURL(this);
            });
        })
        // Birth certificate photo Show
        $(function() {
            function readURL(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $('#birth_certificate_photo_show').attr('src', e.target.result);
                    }
                    reader.readAsDataURL(input.files[0]);
                }
            }
            $("#birth_certificate_photo").change(function() {
                readURL(this);
            });
        })

        function startIdentification() {
            var identification_type = $('input[name="identification_type"]:checked').val();
            if (identification_type == 1) {
                $('.nid_part').show();
                $('.birth_certificate_part').hide();
                $('.driving_licence_part').hide();
            } else if (identification_type == 2) {
                $('.nid_part').hide();
                $('.birth_certificate_part').show();
                $('.driving_licence_part').hide();
            }
        }



        $(function() {

            // nid birth photo
            $('body').on('click', '.identification_type', function() {
                startIdentification();
            })
            startIdentification();



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

            $('#agent_id').on("select2:select", function(e) {
                var data = e.params.data.text;
                if (data == 'All') {
                    $("#agent_id > option").prop("selected", "selected");
                    $("#agent_id").trigger("change");
                }
            });

            $('#area_id').on("select2:select", function(e) {
                var data = e.params.data.text;
                if (data == 'All') {
                    $("#area_id > option").prop("selected", "selected");
                    $("#area_id").trigger("change");
                }
            });


            // Get District
            $('body').on('change', '#division_id', function() {
                var division_id = $('#division_id').val();
                var options = '<option value=""> Select district </option>';
                var selected = '{{ old('district_id', $edit_data->district_id) }}';
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
                var options = '<option value=""> Select thana </option>';
                var selected = '{{ old('thana_id', $edit_data->thana_id) }}';
                $.ajax({
                    method: "GET",
                    url: "{{ route('get_district_thanas') }}",
                    data: {
                        'district_id': district_id
                    },
                }).done(function(response) {
                    // console.log(response);
                    response.forEach(function(item, i) {
                        if (selected == item.id) {
                            options += '<option selected value="' + item.id + '"> ' + item
                                .name + ' </option>';
                        } else {
                            options += '<option value="' + item.id + '"> ' + item.name +
                                ' </option>';
                        }
                    });
                    $('#thana_id').html(options);
                    $('#thana_id').trigger('change');
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
