@extends('frontEnd.layouts.pages.merchant.merchantmaster')
@section('title','Parcel Details')
@section('content')
<section class="section-padding">
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-12">
				<div class="row addpercel-inner">
					<div class="col-sm-6">
						<div class="track-left">
							<div class="track-title">
								<h4>@lang('common.trackparcel')</h4>
							</div>
							@foreach($trackInfos as $trackInfo)
							<div class="tracking-step">
								<div class="tracking-step-left">
									<strong>{{date('h:i A', strtotime($trackInfo->created_at))}}</strong>
									<p>{{date('M d, Y', strtotime($trackInfo->created_at))}}</p>
								</div>
								<div class="tracking-step-right">
								    @if(!$trackInfo->description)         
                                          <p>{{$trackInfo->note}}</p>         
                                          <p>{{$trackInfo->remark}}</p>         
                                    @else
                                          <p class="track_de">{{$trackInfo->description}}</p>        
                                    @endif
									
								</div>
							</div>
							@endforeach
						</div>
					</div>
					<div class="col-sm-6">
						<div class="track-right">
							<h4>@lang('common.customer_and_parcel_details')</h4>
							<div class="item row">
								<div class="col-6">
									<p>@lang('common.parcel_id')</p>
								</div>
								<div class="col-6">
									<h6>{{$parceldetails->trackingCode}}</h6>
								</div>
								
							</div>
							<div class="item row">
								<div class="col-6">
									<p>@lang('common.status')</p>
								</div>
								<div class="col-6">
									@php
				                      $parcelstatus = App\Parceltype::find($parceldetails->status);
				                   @endphp
				                    
									<h6>{{$parcelstatus->title}}</h6>
								</div>
								
							</div>
							<div class="item row">
								<div class="col-6">
									<p>@lang('common.assign_rider') :</p>
								</div>
								@php
			                      $riderInfo = App\Deliveryman::find($parceldetails->deliverymanId);
			                   @endphp
								<div class="col-6">
									<h6>
										@if($riderInfo)
										{{$riderInfo->name}} @endif</h6>
								</div>
							</div>
							<div class="item row">
								<div class="col-6">
									<p>@lang('common.customer_name') :</p>
								</div>
								<div class="col-6">
									<h6>{{$parceldetails->recipientName}}</h6>
								</div>
							</div>
							<div class="item row">
								<div class="col-6">
									<p>@lang('common.payment_status') :</p>
								</div>
								<div class="col-6">
									<h6>
									    @if( ($parceldetails->merchantpayStatus == 1) && (($parceldetails->percelType == 2) && ($parceldetails->status == 4)) ) @lang('common.paid') 
									    @elseif( ($parceldetails->merchantpayStatus == 1) && ( ($parceldetails->status > 5 && $parceldetails->status < 9) || ($parceldetails->percelType == 1) ) ) @lang('common.service_charge_adjustment') 
									    @else @lang('common.unknown_process') 
									    @endif
									</h6>
								</div>
							</div>
							<div class="item row">
								<div class="col-6">
									<p>@lang('common.mobile_no') :</p>
								</div>
								<div class="col-6"><h6>{{$parceldetails->recipientPhone}}</h6></div>
								
							</div>
							<div class="item row">
								<div class="col-6"><p>@lang('common.address') :</p></div>
								<div class="col-6"><h6>{{$parceldetails->recipientAddress}}</h6></div>
								
							</div>
							<div class="item row">
								<div class="col-6"><p> @lang('common.pickup_address')  :</p></div>
								<div class="col-6"><h6>{{$parceldetails->pickLocation}}</h6></div>
								
							</div>
							<div class="item row">
								<div class="col-6">
									<p> @lang('common.division') :</p>
								</div>
								<div class="col-6">
									<h6>{{$parceldetails->division}}</h6>
								</div>
							</div>
							<div class="item row">
								<div class="col-6">
									<p> @lang('common.district') :</p>
								</div>
								<div class="col-6">
									<h6>{{$parceldetails->district}}</h6>
								</div>
							</div>
							<div class="item row">
								<div class="col-6">
									<p> @lang('common.thana') :</p>
								</div>
								<div class="col-6">
									<h6>{{$parceldetails->thana}}</h6>
								</div>
							</div>
							<div class="item row">
								<div class="col-6">
									<p> @lang('common.area') :</p>
								</div>
								<div class="col-6">
									<h6>{{$parceldetails->area}}</h6>
								</div>
							</div>
							<div class="item row">
								<div class="col-6">
									<p> @lang('common.delivery_address') :</p>
								</div>
								<div class="col-6">
									<h6>{{$parceldetails->delivery_address}}</h6>
								</div>
							</div>
							<div class="item row">
								<div class="col-6">
									<p>@lang('common.weight') :</p>
								</div>
								<div class="col-6">
									<h6> Upto {{$parceldetails->productWeight}} kg</h6>
								</div>
							</div>
							<div class="item row">
								<div class="col-6">
									<p>@lang('common.created_date') :</p>
								</div>
								<div class="col-6">
									<h6>{{$parceldetails->created_at}}</h6>
								</div>
							</div>
							<div class="item row">
								<div class="col-6">
									<p>@lang('common.cod') :</p>
								</div>
								<div class="col-6"><h6>{{$parceldetails->cod}}</h6></div>
							</div>
							<div class="item row">
								<div class="col-6">
									<p>@lang('common.delivery_charge') :</p>
								</div>
								<div class="col-6"><h6>{{$parceldetails->deliveryCharge}}</h6></div>
							</div>
							<div class="item row">
								<div class="col-6">
									<p>@lang('common.cod_charge') :</p>
								</div>
								<div class="col-6">
									<h6>{{$parceldetails->codCharge}}</h6>
								</div>
							</div>
							<div class="item row">
								<div class="col-6">
									<p>@lang('common.last_update') :</p>
								</div>
								<div class="col-6">
									<h6>{{$parceldetails->updated_at}}</h6>
								</div>
							</div>
						</div>
					</div>
					
				</div>
			</div>
		</div>
	</div>
</section>

@endsection