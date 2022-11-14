@extends('frontEnd.layouts.pages.merchant.merchantmaster')
@section('title','Track Order')
@section('content')
<section class="section-padding">
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-12">
				<div class="row addpercel-inner">
					<div class="col-sm-5">
						<div class="track-left">
							<h4>@lang('common.trackparcel')</h4>
							@foreach($trackInfos as $trackInfo)
							<div class="tracking-step">
								<div class="tracking-step-left">
									<strong>{{date('h:i A', strtotime($trackInfo->created_at))}}</strong>
									<p>{{date('M d, Y', strtotime($trackInfo->created_at))}}</p>
								</div>
								<div class="tracking-step-right">
									@if(!$trackInfo->description)         
                                          <p>{{$trackInfo->note}}</p>         
                                    @else
                                          <p class="track_de">{{$trackInfo->description}}</p>        
                                    @endif
								</div>
							</div>
							@endforeach
						</div>
					</div>
					<div class="col-sm-7">
						<div class="track-right">
							<h4>@lang('common.customer_and_parcel_details')</h4>
							<div class="item">
								<p>@lang('common.parcel_id')</p>
								<h6><strong>{{$trackparcel->trackingCode}}</strong></h6>
							</div>
							<div class="item">
								<p>@lang('common.customer_name') :</p>
								<h6><strong>{{$trackparcel->recipientName}}</strong></h6>
							</div>
							<div class="item">
								<p>@lang('common.address') :</p>
								<h6><strong>{{$trackparcel->recipientAddress}}</strong></h6>
							</div>
							<div class="item">
								<p>@lang('common.mobile_no') :</p>
								<h6><strong>{{$trackparcel->recipientPhone}}</strong></h6>
							</div>
							<div class="item">
								<p>@lang('common.area') :</p>
								<h6><strong>{{$trackparcel->area->name??''}}</strong></h6>
							</div>
							<div class="item">
								<p>@lang('common.weight') :</p>
								<h6><strong>{{$trackparcel->productWeight}}</strong></h6>
							</div>
							<div class="item">
								<p>@lang('common.cod') :</p>
								<h6><strong>{{$trackparcel->cod}}<strong></h6>
							</div>
							<div class="item">
								<p>@lang('common.delivery_charge') :</p>
								<h6><strong>{{$trackparcel->deliveryCharge}}<strong></h6>
							</div>
							<div class="item">
								<p>@lang('common.cod_charge') :</p>
								<h6><strong>{{$trackparcel->codCharge}}<strong></h6>
							</div>
						</div>
					</div>
					
				</div>
			</div>
		</div>
	</div>
</section>

@endsection