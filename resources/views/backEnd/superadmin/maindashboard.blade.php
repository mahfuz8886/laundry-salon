@extends('backEnd.layouts.main_dashboard_master')
@section('title','Super Admin Dashboard')
@section('content')

<!-- Main content -->
  <section class="content">
    <div class="container">
      <div class="outer-section" style="display: flex;flex-direction: row;justify-content: center;align-items: center;padding-top: 50px;">
        <div class="row">
          <div class="col-md-4">
            <div class="card dash-card" style="max-width: 18rem;margin:auto">
              <img src="{{ asset('public/pos.jpg') }}" class="" style="width: 100%;height:200px" alt="...">
              <div class="card-body">
                <h5 class="card-title text-primary"><b>POS</b></h5>
                <p class="card-text">All feature about pos are given in this section. Mange everything of pos from here...</p>
                <a href="" class="btn btn-primary btn-sm">Go pos section</a>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="card dash-card" style="max-width: 18rem;margin:auto">
              <img src="{{ asset('public/laundryimg.jpg') }}" class="" style="width: 100%;height:200px" alt="...">
              <div class="card-body">
                <h5 class="card-title text-primary"><b>Laundry</b></h5>
                <p class="card-text">All feature about Laundry are given in this section. Mange everything of Laundry from here...</p>
                <a href="{{ url('superadmin/laundrydashboard') }}" class="btn btn-primary btn-sm">Go laundry section</a>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="card dash-card" style="max-width: 18rem;margin:auto">
              <img src="{{ asset('public/salon.jpg') }}" class="" style="width: 100%;height:200px" alt="...">
              <div class="card-body">
                <h5 class="card-title text-primary"><b>Salon</b></h5>
                <p class="card-text">All feature about Salon are given in this section. Mange everything of Salon from here...</p>
                <a href="{{ url('superadmin/salondashboard') }}" class="btn btn-primary btn-sm">Go salon section</a>
              </div>
            </div>
          </div>
        </div>
      </div>
  </div>
</section>

@endsection