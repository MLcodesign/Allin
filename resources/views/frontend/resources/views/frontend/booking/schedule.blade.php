@extends('layouts.frontend.single')

@section('title', 'Contact Us')

@section('css')
{!! Html::style('https://code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css') !!}
{!! Html::style('assets/plugins/pricingTable/pricingTable.min.css') !!}

@endsection

@section('content')

@include('frontend.booking.step')
<form action="{{ url('/booking/2') }}" method="post" id="submit-form">
{!! csrf_field() !!}
<input type="hidden" id="shipping" name="shipping">
<input type="hidden" id="shipping_fee" name="shipping_fee" value="0">
<input type="hidden" id="package_id" name="package_id" value="{{ $current_package->id }}">
<input type="hidden" id="camera" name="camera" value="0">
<input type="hidden" id="monthly_cost" name="monthly_cost" value="0">
<input type="hidden" id="budget_pricing" name="pricing_id" value="0">
</form>
<section id="pricing">
   <div class="container">

		<div class="row pricebox2">
            <div class="col-md-6 ">
               <div class="col-sm-3">
		       <img src="/assets/dist/img/box5_s.png" class="img-responsive center-block">
               </div>
               <div class="col-sm-9">
               <h3>運費</h3>
				 <small>
				 <p>假設總共有n箱需運送，則運費=(130 + 69*n)。<br>即1箱運費199點，2箱運費268點，3箱運費337點…以此類推。</p></small>

               </div>
               <div class="col-sm-12 pbox">
                 <h3><b>{{ $current_package_features[7]->spec }}</b></h3>

                 <div class="morebox-priceButtonContainer">
				  <div class="morebox-priceButtonLeft">
					<div class="morebox-priceButtonDivLeft">

					  <div id="shipping-number" class="number-display">0</div>
					</div>
				  </div>
				  <div class="morebox-priceButtonRight" data-type="shipping">
					<div class="morebox-priceButtonDiv"><a class="add morebox-priceButton" href="#">
					  <div>+</div>
					  </a></div>
					<div class="morebox-priceButtonDiv last"><a class="sub morebox-priceButton" href="#" >
					  <div>－</div>
					  </a></div>
				  </div>
				</div>

               </div>
            </div>
            <div class="col-md-6">
               <div class="col-sm-3">
		       <img src="/assets/dist/img/icon_p02.png" class="img-responsive center-block">
               </div>
               <div class="col-sm-9">
               <h3>即時影像加值服務</h3>
				 <small>
				 <p>大型物品每件只要加100點/月，即享有即時影像觀看權限，<br>讓您隨時隨地都可透過手機關心寶貝物品即時狀態。</p>
				 </small>
               </div>
               <div class="col-sm-12 pbox">
			     <h3><b>{{ $current_package_features[6]->spec }}點</b> <span class="small">/月/件</span></h3>
				 <div class="morebox-priceButtonContainer">
				  <div class="morebox-priceButtonLeft">
					<div class="morebox-priceButtonDivLeft">

					  <div id="camera-number" class="number-display">0</div>
					</div>
				  </div>
				  <div class="morebox-priceButtonRight" data-type="camera">
					<div class="morebox-priceButtonDiv"><a class="add morebox-priceButton" href="#">
					  <div>+</div>
					  </a></div>
					<div class="morebox-priceButtonDiv last"><a class="sub morebox-priceButton" href="#">
					  <div>－</div>
					  </a></div>
				  </div>
				</div>


				</div>
			</div>

		<div class="col-xs-12">
		 <div class="orderNote">不確定租用一共需要多少點數嗎？別擔心！以下我們先幫您試算！</div>

		 <div class="morebox-remark">
		  <div class="calculator-container">
			<div class="calculator-row title"><img class="cal mobileHide" src="/assets/dist/img/cal.png"><img class="cal mobileShow" src="/assets/dist/img/cal-m.png">
			  <div class="calculator-header">點數扣除試算<sup class="colorGreen">*</sup></div>
			</div>
			<div class="calculator-row" id="estimatePrice">$<span>0</span></div>
			<div class="estimateNote"> <sup class="colorGreen"></sup></div>
		  </div>
		</div>

		</div>
     </div>


   </div>
</section>
<!-- start pricing -->
    <section id="pricing-table">
        <div class="container">
            <div class="row">
                <div class="col-md-12 wow bounceIn">

                </div>
                <div class="row">
                    <div class="col-md-12">
                        @foreach($pricings as $i => $pricing)
                            <div class="vpt_plan-container col-md-3 {{ $pricing->featured == 1 ? 'featured' : '' }} {{ $i==0 ? 'col-md-offset-2' : '' }} no-margin col-xs-offset-0">
                                <ul class="vpt_plan drop-shadow {{ $pricing->featured == 1 ?'bootstrap-vtp-orange':'bootstrap-vpt-green' }} hover-animate-position {{ $pricing->featured == 1 ? 'featured' : '' }}">
                                    <li class="vpt_plan-name"><strong>{{ $pricing->name }}</strong></li>
                                    <li class="vpt_plan-price"><span class="vpt_year"><i
                                                    class="fa fa-dollar"></i></span>{{ $pricing->gift_amount }}
                                       </li>
                                    <li class="vpt_plan-footer"><a href="{{ url('/register') }}" data-id="{{ $pricing->id }}" class="pricing-select">立即儲值</a></li>
												<li><p></p></li>
												<li  class="vptbg">儲值金額: {{ $pricing->gift_amount }}{{ getSetting('DEFAULT_CURRENCY') }}</li>
                                                <li>兌換點數: {{ $pricing->redeem_points }}</li>
												<li  class="vptbg">贈送點數: {{ $pricing->get_points }}</li>
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
        </div>
    </section>
	<div id="bf_error_dialog" title=""></div>
    <!-- end pricing -->
@endsection

@section('js')

<script src="{{ url('/assets/dist/js/address.js') }}" type="text/javascript"></script>

<script type="text/javascript">

var current_packages = '<?php echo json_encode($current_package); ?>';
var current_package_features = '<?php echo json_encode($current_package_features) ?>';

current_packages = jQuery.parseJSON(current_packages);
current_package_features = jQuery.parseJSON(current_package_features);

jQuery(document).ready(function($){
	$('.morebox-priceButton').click(function(event){

		event.preventDefault();

		var type = $(this).parent().parent().attr('data-type');


		Numboxamt = parseInt($('#'+type+'-number').text());

		Numboxamt_shipping = parseInt($('#shipping-number').text());

		Numboxamt_camera = parseInt($('#camera-number').text());

		var addition_service = parseFloat(current_package_features[6].spec);

		var estimatePrice = parseInt($('#estimatePrice span').text());

		var shipping_price = current_package_features[5].spec;
        var origNumboxamt = Numboxamt;

        if($(this).hasClass('add')) {
            Numboxamt ++;

            if(type == "camera"){
                if(Numboxamt > Numboxamt_shipping){
                    Numboxamt = origNumboxamt;
                }
            }
        }
        else if(Numboxamt > 0){
            Numboxamt --
            
            if(type === "shipping"){
                
                //alert(Numboxamt_camera);
                if(Numboxamt < Numboxamt_camera){
                    Numboxamt_camera = Numboxamt;

                    $('#camera-number').text(Numboxamt_camera);
                    $('input#camera').val(Numboxamt_camera);
                    if(Numboxamt_camera > 0) $('#camera-number').addClass('yellow');
                    else $('#camera-number').removeClass('yellow');
                }
            }
        }

		var shipping_fee = 0;

		if(Numboxamt > 0) $('#'+type+'-number').addClass('yellow');
		else $('#'+type+'-number').removeClass('yellow');


		$('#'+type+'-number').text(Numboxamt);
		$('input#'+type).val(Numboxamt);


		if(type === 'shipping'){

			var n = Numboxamt;

			var is_empty = Numboxamt > 0 ? 1 : 0;

			var formular = '(addition_service*Numboxamt_camera) + '
						 + '((parseFloat(current_packages.cost) * n) + '
						 + shipping_price
						 + ') * is_empty';

			shipping_fee = eval(shipping_price);
			$('#shipping_fee').val(shipping_fee)
		}
		else{


			var n = Numboxamt_shipping;

			var is_empty = Numboxamt_shipping > 0 ? 1 : 0;

			var formular = '(addition_service*Numboxamt) + '
						 + '((parseFloat(current_packages.cost) * n) + '
						 + shipping_price
						 + ') * is_empty';


		}
		console.log(formular)
		estimatePrice = eval(formular);
		$('#estimatePrice span').text(estimatePrice);
		;

	});

	$('.pricing-select').click(function(event){
		event.preventDefault();
		$('#submit-form input#budget_pricing').val($(this).attr('data-id'));
		$('#submit-form input#monthly_cost').val(parseInt($('#estimatePrice span').text()))


		jQuery( ".errorinput" ).removeClass("errorinput");
		jQuery( ".errorinputRadio" ).removeClass("errorinputRadio");

		var msg = "請選擇箱數";


		var isOk = true;

		$('#submit-form input, #submit-form select').each(function(){
			if($(this).val().length == 0 && $(this).attr('name') !== 'camera') {

				isOk = false;
				return;
			}

		});

		if(isOk) {

			jQuery('#submit-form').submit();

		} else {

			bfAlert(msg);
		}
	})

});

</script>


@endsection
