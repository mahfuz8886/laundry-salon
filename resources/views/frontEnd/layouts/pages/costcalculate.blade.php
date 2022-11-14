<div class="row">
    <div class="col-sm-8">
        <p>Delivery Charge</p>
    </div>
    <div class="col-sm-4">
        <p>{{ Session::get('pdeliverycharge') }} Tk</p>
    </div>
</div>
<!-- row end -->
<div class="row">
    <div class="col-sm-8">
        <p>Cod Charge</p>
    </div>
    <div class="col-sm-4">
        <p>{{ Session::get('pcodecharge') }} Tk</p>
    </div>
</div>
<!-- row end -->
<div class="row">
    <div class="col-sm-8">
        <p>Total Charge</p>
    </div>
    <div class="col-sm-4">
        <p>{{ Session::get('pdeliverycharge') + Session::get('pcodecharge') }} Tk</p>
    </div>
</div>
<!-- row end -->
</hr>
<div class="row total-bar">
    <div class="col-sm-12 total-bar">
        <p class="text-center">Note : <span class="">If you regular order before 4 pm it will be
                collected. Otherwise it will be collected next day.</span></p>
    </div>
</div>
<!-- row end -->
