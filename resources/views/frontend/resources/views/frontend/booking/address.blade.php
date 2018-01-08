@extends('layouts.frontend.single')

@section('title', 'Contact Us')

@section('css')

{!! Html::style('https://code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css') !!}

<style>
   label{
	   display: block !important;
    position: relative;
    -webkit-transform: translateY(0);
    transform: translateY(0);
    left: 0;
    color: #333;
    -webkit-transition: all 0.25s ease;
    transition: all 0.25s ease;
    -webkit-backface-visibility: hidden;
    pointer-events: none;
    font-size: 14px;
   }
   label.active {
		-webkit-transform: translateY(0px);
		transform: translateY(0px);
		left: 0px;
   }
   label.active .req{
	   opacity: 1;
   }
   .error{
	   color: red;
	   font-size: 15px;
	   font-weight: 600;
   }
  </style>

@endsection

@section('content')

@include('frontend.booking.step')
<form action="{{ url('/booking/3') }}" method="post" id="submit-form">
  {!! csrf_field() !!}
  <input class="priceDisplay" type="hidden" id="shipping" name="shipping" value="{{ $request->get('shipping') }}">
  <input type="hidden" id="shipping_fee" name="shipping_fee" value="{{ $request->get('shipping_fee') }}">
  <input class="priceDisplay" type="hidden" id="package_id" name="package_id" value="{{ $current_package->id }}">
  <input class="priceDisplay" type="hidden" id="camera" name="camera" value="{{ $request->get('camera') }}">
  <input type="hidden" id="monthly_cost" name="monthly_cost" value="{{ $request->get('monthly_cost') }}">
  <input type="hidden" id="budget_pricing" name="pricing_id" value="{{ $request->get('pricing_id') }}">
  
  <input type="hidden" name="address">
  <input type="hidden" name="county">
  <input type="hidden" name="district">
  <input type="hidden" name="zipcode">
  <input type="hidden" name="phone">
  <input type="hidden" name="special_instruction">
  <input type="hidden" name="dropOffDate">
  <input type="hidden" name="dropOffTime">
  <input type="hidden" name="scheduleOption" value="1">
</form>
<section id="address">
  <div class="container">
    <div class="row pricebox2">
      <div class="div-table morebox-drop">
        <div class="div-tr">
          <div class="div-td morebox-drop-left"> <img src="/assets/dist/img/address-icon.png">
            <div class="morebox-title morebox-questions"> 收貨地址*
              <div class="morebox-questions-description"></div>
              <div class="addressNote"></div>
            </div>
          </div>
          <div class="div-td morebox-drop-right">
            <div class="input-fields-row">
              <div class="input-fields left mobileHide">縣市</div>
                <div class="input-fields right">
                  <div class="div-table">
                    <div id="twzipcode" class="div-tr">
					<div class="input-group">
                      <div data-role="county"
					 data-name="county"
					 id = "county"
					 data-value="{{ Auth::user()->county }}"
					 data-style="county form-control" class="div-td"> </div>
                      <div data-role="district"
					 id = "district"
					 data-name="district"
					 data-value="{{ Auth::user()->district }}"
					 data-style="district form-control" class="div-td"> </div>
                      <div data-role="zipcode"
					 data-name="zipcode"
					 id = "zipcode"
					 data-value="{{ Auth::user()->zipcode }}"
					 data-style="zipcode form-control" class="div-td"> </div>
					 </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="input-fields-row">
                <div class="input-fields left mobileHide">地址</div>
                <div class="input-fields right dAddress">
                  <input type="text" value="{{ !Auth::guest() ? Auth::user()->address : '' }}"  id="address" placeholder="地址">
                </div>
              </div>
              <div class="input-fields-row">
                <div class="input-fields left mobileHide">電話</div>
                <div class="input-fields right dPhone">
                  <input type="tel" value="{{ !Auth::guest() ? Auth::user()->mobile : '' }}"  id="phone" placeholder="Phone">
                </div>
              </div>
              <div class="input-fields-row">
                <div class="input-fields left mobileHide">備註:</div>
                <div class="input-fields right last speacialInstructions">
                  <textarea class="speacial_textarea" rows="4" id="special_instruction" placeholder="e.g.: “例如：請司機到門口先撥打手機.”"></textarea>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div id="step-1" class="div-table morebox-drop">
          <div class="div-tr border-bottom">
            <div class="div-td morebox-drop-left"> <img id="dropoff-icon" src="/assets/dist/img/dropoff-icon.png">
              <div id="dropoff" class="morebox-title morebox-questions"> 派送空箱
                <div class="morebox-questions-description"></div>
              </div>
            </div>
            <div class="div-td morebox-drop-right">
              <div class="input-fields-row">
                <div class="input-fields left mobileHide"> 日期? </div>
                <div class="input-fields right">
                  <input type="text" value="" id="dropOffDate" placeholder="選擇日期" readonly style="cursor: pointer;" class="">
                </div>
              </div>
              <div class="input-fields-row">
                <div class="input-fields left mobileHide"> 時間? </div>
                <div class="input-fields right last">
                  <select id="dropOffTime">
                    <option disabled checked>取貨時段</option>
					<option value="上午">上午</option>
					<option value="下午">下午</option>
					<option value="晚上">晚上</option>
                  </select>
                </div>
              </div>
            </div>
          </div>
          <div id="pickup" class="div-tr">
            <div class="div-td morebox-drop-left"> <img src="/assets/dist/img/pickup-icon.png">
              <div class="morebox-title morebox-questions"> 預約取件
                <div class="morebox-questions-description"></div>
              </div>
            </div>
            <div class="div-td morebox-drop-right option">
              <div class="input-fields-row">
                <div class="input-fields left option">
                  <input type="radio" value="1" checked  name="scheduleOpt" class="scheduleOption">
                </div>
                <div class="input-fields right top option">
                  <div class="input-option">馬上取走</div>
                  <div class="input-option-description">貨運公司會在外頭等您將箱子裝滿，當天取走.</div>
                </div>
              </div>
              <div class="input-fields-row">
                <div class="input-fields left option">
                  <input type="radio" value="0"  name="scheduleOpt" class="scheduleOption">
                </div>
                <div class="input-fields right top option last">
                  <div class="input-option">晚點再預約</div>
                  <div class="input-option-description">請於一週內預約取件，起租日由本公司收回收納箱隔日或派送空箱後第8天起算，以較早日期計算。</div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <input id="btn-step-2" type="button" value="下一頁" onclick="addBoxes()" class="btn btn-primary morebox-continue">
      </div>
    </div>
    <div id="bf_error_dialog" title=""></div>
</section>

<!-- end pricing --> 
@endsection

@section('js') 
<script type="text/javascript">
var csrf_token = '{{ csrf_token() }}';
var current_packages = '<?php echo json_encode($current_package); ?>';
var current_package_features = '<?php echo json_encode($current_package_features) ?>';

current_packages = jQuery.parseJSON(current_packages);
current_package_features = jQuery.parseJSON(current_package_features);

var ajax_url = '{{ url("/booking/ajax-request") }}';
</script> 
<script src="{{ url('/assets/dist/js/jquery.twzipcode.min.js') }}" type="text/javascript"></script> 
<script src="{{ url('/assets/dist/js/address.js') }}" type="text/javascript"></script> 
<script type="text/javascript">

var addMinDate = 1;
var addMinDateXL = 2;
jdpDateFormat = "yy-mm-d"; 
qtyAmtFormat = "${amt}{unit} x {tqty}"; 

var dayoffs = []; 
var tsFullDates =[];


var today = new Date();
var tomorrow = new Date();
tomorrow.setDate(today.getDate() + addMinDate);




jQuery(document).ready( function($) {
	var postdata = [];
	$('.div-table input, .div-table select, .div-table textarea').each(function(){
		postdata[$(this).attr('id')] = $(this).val();
	});
	
	
	/* Javascript */
	$('#twzipcode').twzipcode();
	
	$('.scheduleOption').click(function(){
		$('input[name="scheduleOption"]').val($(this).val())
	})
	
	
	console.log(postdata);


	
	function getMySqlTime(dStr) { 
		//console.log("getMySqlTime: "+jQuery.datepicker.parseDate(jdpDateFormat, dStr).getTime()/1000+" new Date(unixtimestamp*1000): "+new Date(jQuery.datepicker.parseDate(jdpDateFormat, dStr).getTime())); 
		return jQuery.datepicker.formatDate('yy-mm-dd', new Date(jQuery.datepicker.parseDate(jdpDateFormat, dStr).getTime())); 
		//return jQuery.datepicker.formatDate('yy-mm-dd', new Date(dStr)); 
	} 


	jQuery( "input#dropOffDate" ).datepicker({ minDate: tomorrow, dateFormat: jdpDateFormat,  beforeShowDay: function(date){ return checkAvailableDate(date, 0, 'normal'); }
	}); 
	
	});
	
	
	function addBoxes() {  

		jQuery( ".errorinput" ).removeClass("errorinput"); 
		jQuery( ".errorinputRadio" ).removeClass("errorinputRadio"); 
		
		var msg = "請填寫必填項目"; 
 
		
		var isOk = true;
		
		
		
		$('.div-table input, .div-table select, .div-table textarea').each(function(){
			
			if(!$(this).hasClass('scheduleOption')){
				if( typeof $(this).attr('id') !== 'undefined')
				$('#submit-form *[name="'+$(this).attr('id')+'"]').val($(this).val());
				else $('#submit-form *[name="'+$(this).attr('class')+'"]').val($(this).val());
			}
		});

		$('#submit-form input, #submit-form select').each(function(){
			if($(this).val().length == 0 && $(this).attr('name') !== 'special_instruction') {
				
				isOk = false;
				return;
			}
			
		});
		
			

		if(isOk) { 
			
			
		
			jQuery('#submit-form').submit();
			
		} else { 
		
			bfAlert(msg); 
		} 
	} 

</script> 
@endsection 