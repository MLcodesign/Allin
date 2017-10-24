@extends('layouts.frontend.single')

@section('title', 'Deposite')

@section('css')

{!! Html::style('https://code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css') !!}
{!! Html::style('assets/plugins/pricingTable/pricingTable.min.css') !!}


@endsection

@section('content')

<section id="inner_content" style="padding-top:150px;">
<div class="container" style="/*max-width:900px*/">
<div class="row">
@if (session('status'))
        <div class="alert alert-success"> {{ session('status') }} </div>
        @endif
        @if (session('warning'))
        <div class="alert alert-warning"> {{ session('warning') }} </div>
        @endif
<div class="col-md-12 text-center" style="padding-bottom:12px;">
	   <h1><b>會員儲值</b></h1>
	   <h4 class="subtitle">DEPOSIT</h4>
	   <p class="y_line"></p>
	</div>

<div class="col-xs-12">
@if (session('status'))
	<div class="alert alert-success">
		{{ session('status') }}
	</div>
@endif
@if (session('warning'))
	<div class="alert alert-warning">
		{{ session('warning') }}
	</div>
@endif

</div>
</div>
	<div class="row">
	    <div class="col-md-12">
	        @foreach($pricings as $i => $pricing)
	            <div class="vpt_plan-container col-md-3 {{ $pricing->featured }} {{ $i==0 ? 'col-md-offset-2' : '' }} no-margin">
	                <ul class="vpt_plan drop-shadow {{ $pricing->featured=='featured'?'bootstrap-vtp-orange':'bootstrap-vpt-green' }} hover-animate-position {{ $pricing->featured }}">
	                    <li class="vpt_plan-name"><strong>{{ $pricing->name }}</strong></li>
	                    <li class="vpt_plan-price"><span class="vpt_year"><i
	                                    class="fa fa-dollar"></i></span>{{ $pricing->giftAmount }}
	                        </li>
	                    <li class="vpt_plan-footer"><a href="{{ url('/register') }}" data-id="{{ $pricing->id }}" class="pricing-select">立即儲值</a></li>
									<li><p></p></li>
									<li  class="vptbg">儲值金額: {{ $pricing->giftAmount }}{{ getSetting('DEFAULT_CURRENCY') }}</li>
	                                <li>兌換點數: {{ $pricing->redeemPoints }}</li>
									<li  class="vptbg">贈送點數: {{ $pricing->getPoints }}</li>
									<li><p></p></li>

	                </ul>
	            </div>
	        @endforeach
	    </div>
        <div class="col-xs-12" style="text-align:center">
<img src="{{url('/assets/dist/img/paay2go.png')}}"/> <br/>
本站使用智付寶加密安全金流，進入後可選擇 信用卡、WEB ATM、ATM 轉帳、條碼繳費、超商代碼繳費。

        </div>
	</div>
</div>
</section>

@endsection

@section('js')
<script src="{{ url('/assets/dist/js/address.js') }}" type="text/javascript"></script>
<script>

var dayoffs = ["2016-09-16","2016-10-01","2016-10-09","2016-12-25"];
var tsFullDates = ["2016-08-30","2016-08-31","2016-09-01","2016-09-02","2016-09-03"];

var addMinDate = 1;
var addMinDateXL = 2;
jdpDateFormat = "yy-mm-d";
qtyAmtFormat = "${amt}{unit} x {tqty}";

var today = new Date();
var tomorrow = new Date();
tomorrow.setDate(today.getDate() + addMinDate);

jQuery( "#datePicker" ).datepicker({ minDate: tomorrow, dateFormat: jdpDateFormat,  beforeShowDay: function(date){ return checkAvailableDate(date, 0, 'normal'); }});


jQuery(document).ready(function($){
	$('#change_address').change(function(){
		if($(this)[0].checked)  $('#new_address').show();
		else $('#new_address').hide();
	})
})

	$('.pricing-select').click(function(event){
		event.preventDefault();
		$('#submit-form input#budget_pricing').val($(this).attr('data-id'));
		$('#submit-form input#monthly_cost').val(parseInt($('#estimatePrice span').text()))

		$('#submit-form').submit();
	})
</script>
@endsection
