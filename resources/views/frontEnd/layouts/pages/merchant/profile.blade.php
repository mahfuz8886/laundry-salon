@extends('frontEnd.layouts.pages.merchant.merchantmaster')
@section('profile','active')
@section('title','Dashboard')
@section('style')
	<style>
		.photo{
			border-radius: 100%;
			padding: 2px;
		}
		.table th{
			padding: 5px 10px;
		}
		.table td{
			padding: 5px 10px;
		}
	</style>
@endsection
@section('content')
	<section class="section-padding">
		<div class="container">
			<div class="row">
				<div class="col-md-3">
					<div class="card">
						<div class="card-body text-center">
							<img class="photo" src="{{asset('public/frontEnd')}}/images/avator.png" alt="Photo" width="100" height="100"> <br>
							<span class="badge badge-pill badge-primary">{{ $merchantInfo->id }}</span> <br>
							{{ $merchantInfo->firstName }} <br>
							{{ $merchantInfo->phoneNumber }} <br>
						</div>
					</div>
				</div>
				<div class="col-md-9">
					<div class="card">
						<div class="card-body">
							<table class="table table-bordered">
								<tr>
									<th width="200"> @lang('common.company_name')</th>
									<td> {{ $merchantInfo->companyName }} </td>
								</tr>
								<tr>
									<th> @lang('common.trade_licence_no') </th>
									<td> {{ $merchantInfo->trade_licence_no }} </td>
								</tr>
								<tr>
									<th> @lang('common.father_name') </th>
									<td> {{ $merchantInfo->fathers_name }} </td>
								</tr>
								<tr>
									<th> @lang('common.mother_name') </th>
									<td> {{ $merchantInfo->mothers_name }} </td>
								</tr>
								<tr>
									<th> @lang('common.nid_number') </th>
									<td> {{ $merchantInfo->nidnumber }} </td>
								</tr>
								<tr>
									<th> @lang('common.driving_licence_no') </th>
									<td> {{ $merchantInfo->driving_licence_no }} </td>
								</tr>
								<tr>
									<th> @lang('common.birth_certificate_no') </th>
									<td> {{ $merchantInfo->birth_certificate_no }} </td>
								</tr>
								<tr>
									<th> @lang('common.dob') </th>
									<td> 
										@if ($merchantInfo->date_of_birth)
											{{ date('d M Y', strtotime($merchantInfo->date_of_birth)) }} 
										@endif
										
									</td>
								</tr>
								<tr>
									<th> @lang('common.facebook_page') </th>
									<td> {{ $merchantInfo->facebook_page }} </td>
								</tr>
								<tr>
									<th> @lang('common.website') </th>
									<td> {{ $merchantInfo->website }} </td>
								</tr>
								<tr>
									<th> @lang('common.division') </th>
									<td> {{ $merchantInfo->division->name??'' }} </td>
								</tr>
								<tr>
									<th> @lang('common.district') </th>
									<td> {{ $merchantInfo->district->name??'' }} </td>
								</tr>
								<tr>
									<th> @lang('common.thana') </th>
									<td> {{ $merchantInfo->thana->name??'' }} </td>
								</tr>
								<tr>
									<th> @lang('common.area') </th>
									<td> {{ $merchantInfo->area->name??'' }} </td>
								</tr>
								<tr>
									<th> @lang('common.present_address') </th>
									<td> {{ $merchantInfo->present_address }} </td>
								</tr>
								<tr>
									<th> @lang('common.permanent_address') </th>
									<td> {{ $merchantInfo->permanent_address }} </td>
								</tr>
							</table>
						</div>
					</div>
				</div>
			</div>
		
		</div>
	</section>
@endsection