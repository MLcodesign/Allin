@extends('layouts.frontend.single')

@section('title', 'Schedule New Box')

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
<section id="inner_content" style="padding-top:150px;">
  <div class="container" style="">
    <div class="row">

	
      <div class="col-xs-12"> @if (session('status'))
        <div class="alert alert-success"> {{ session('status') }} </div>
        @endif
        @if (session('warning'))
        <div class="alert alert-warning"> {{ session('warning') }} </div>
        @endif
        <form action="{!! URL::to('checkout') !!}" method="get" id="submitform">
		  {!! csrf_field() !!}
		  
		 <input type="hidden" name="monthly_cost"  value="{{ $request->get('monthly_cost') }}"/>
		<input type="hidden" name="shipping_fee"  value="{{ $request->get('shipping_fee') }}"/>
        <input type="hidden" name="floor_fee"  value="100"/>
		 
		  @foreach($request->get('packages') as $id => $package)
		  
		  
		  <input type="hidden" name="packages[{{ $id }}][box_quantity]" value="{{ $package['box_quantity'] }}" data-id="{{ $id }}" data-type="box_quantity" />
		  <input type="hidden" name="packages[{{ $id }}][amt_service]"  value="{{ $package['amt_service'] }}" data-id="{{ $id }}" data-type="amt_service" />
		 <input type="hidden" name="ppvheck" value="{{$lcheck}}" />		
		 
		  @endforeach		
        <div class="row pricebox3">
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
                    <input type="text" name="address" value="{{ !Auth::guest() ? Auth::user()->address : '' }}"  id="address" placeholder="地址">
                  </div>
                </div>
                <div class="input-fields-row">
                  <div class="input-fields left mobileHide">電話</div>
                  <div class="input-fields right dPhone">
                    <input type="tel" value="{{ !Auth::guest() ? Auth::user()->mobile : '' }}" name="phone" id="phone" placeholder="Phone">
                  </div>
                </div>
				<div class="input-fields-row">
                  <div class="input-fields left mobileHide"></div>
                  <div class="input-fields right">
                  <div class="checkbox" id="checkp">
				 <input name="moving_floor" id="moving_floor" type="checkbox"  value="100">是否搬運上下樓？(僅限有電梯大樓)   上樓搬運費 100點
				</div>
				  
                  </div>
                </div>
				
                <div class="input-fields-row">
                  <div class="input-fields left mobileHide">備註:</div>
                  <div class="input-fields right last speacialInstructions">
                    <textarea class="speacial_textarea" rows="4" name="special_instruction" id="special_instruction" placeholder="e.g.: “例如：請司機到門口先撥打手機.”"></textarea>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div id="step-1" class="div-table morebox-drop">
		  
		  <?php  if ($lcheck == 0) { } else { ?>
		  
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
                    <input type="text" value="" id="dropOffDate" placeholder="選擇日期" name="newbox_date" style="cursor: pointer;" required class="">
                  </div>
                </div>
                <div class="input-fields-row">
                  <div class="input-fields left mobileHide"> 時間? </div>
                  <div class="input-fields right last">
                    <select id="dropOffTime" name="newbox_time" required></select>
                  </div>
                </div>
              </div>
            </div>
			
		  <?php } ?>
            <!--<div id="pickup" class="div-tr">
              <div class="div-td morebox-drop-left"> <img src="/assets/dist/img/pickup-icon.png">
                <div class="morebox-title morebox-questions"> 預約取件
                  <div class="morebox-questions-description"></div>
                </div>
              </div>
			   <div class="div-td morebox-drop-right">
                <div class="input-fields-row">
                  <div class="input-fields left mobileHide"> 日期? </div>
                  <div class="input-fields right">
                    <input type="text" value="" id="pickupDate" name="pickup_date" placeholder="選擇日期" style="cursor: pointer;" @if($largeFlag == true) required
                    @endif class="">
                  </div>
                </div>
                <div class="input-fields-row">
                  <div class="input-fields left mobileHide"> 時間? </div>
                  <div class="input-fields right last">
                    <select id="pickupOffTime" name="pickup_time"></select>
                  </div>
                </div>
              </div>
            </div>-->
			 
          </div>
		  <div class="text-center">
		
          <input id="btn-step-2" type="submit" value="送出" class="btn btn-primary morebox-continue">
		  </div>
        </div>
		</form>
      </div>
    </div>
  </div>
</section>


<div id="bf_error_dialog" title=""></div>
@endsection
@section('js') 
<script src="{{ url('/assets/dist/js/jquery.twzipcode.min.js') }}" type="text/javascript"></script> 
<script src="{{ url('/assets/dist/js/address.js') }}" type="text/javascript"></script> 
<!--<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.15.0/jquery.validate.min.js"></script>
<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.15.0/additional-methods.min.js"></script>-->
<script>




var packages = '<?php echo json_encode($packages); ?>';
var features = '<?php echo json_encode($features) ?>';
var packages_arr = '<?php echo json_encode($packages_arr) ?>';


packages = jQuery.parseJSON(packages);
features = jQuery.parseJSON(features);
packages_arr = jQuery.parseJSON(packages_arr);

var current_packages;
var current_package_features;


/* Javascript */
	$('#twzipcode').twzipcode();

jQuery(document).ready(function($){ 

    var dayoffs = []; 
    var tsFullDates = ["2016-08-30","2016-08-31","2016-09-01","2016-09-02","2016-09-03"]; 

    var addMinDate = 1;
    var addMinDateXL = 2;
    jdpDateFormat = "yy-mm-d"; 
    qtyAmtFormat = "${amt}{unit} x {tqty}"; 

    var today = new Date();
    var tomorrow = new Date();
    tomorrow.setDate(today.getDate() + addMinDate);

	
	function noSunday(date){ 
         return [date.getDay() != 0, ''];
    }; 

<?php  if ($lcheck == 0) { ?>
    /*jQuery( "#pickupDate" ).datepicker({ 
        minDate: tomorrow,
        dateFormat: jdpDateFormat,
        beforeShowDay: noSunday,
    });*/
<?php } else { ?>
    jQuery( "#dropOffDate" ).datepicker({ 
        minDate: tomorrow,
        dateFormat: jdpDateFormat,
        beforeShowDay: noSunday,
    });
	jQuery("#dropOffDate").change(function(){
		
		var days = ['Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday'];
		var d = new Date($(this).val());
		var daysName = days[d.getDay()];
		
		var dxc =  $('#dropOffDate').datepicker('getDate');
	    var tomorrowxx = new Date();
		tomorrowxx.setDate(dxc.getDate() + addMinDate);
        
        /*var pxc =  $('#pickupDate');
        if(pxc.val() == ""){    
            pxc.datepicker({ 
                minDate: tomorrowxx,
                dateFormat: jdpDateFormat,
                beforeShowDay: noSunday,
            });             
        }else{       
            var minimumDate = new Date();
            minimumDate.setDate(d.getDate()+1);
            pxc.datepicker( "option", "minDate", minimumDate);            
        }*/

		
		if(daysName == "Saturday"){
			$("#dropOffTime").html('');
			$("#dropOffTime").append('<option disabled checked>取貨時段</option>');
			$("#dropOffTime").append('<option value="上午（9:00~12:00）">上午（9:00~12:00）</option>');
		} else {
			$("#dropOffTime").html('');
			$("#dropOffTime").append('<option disabled checked>取貨時段</option>');
			$("#dropOffTime").append('<option value="上午（9:00~12:00）">上午（9:00~12:00）</option>');
			$("#dropOffTime").append('<option value="下午1（12:00~15:00）">下午1（12:00~15:00）</option>');
			$("#dropOffTime").append('<option value="下午2（15:00~18:00）">下午2（15:00~18:00）</option>');
		}
		return false;
		
	});
<?php } ?>
        	
	/*jQuery("#pickupDate").change(function(){
		var days = ['Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday'];
		var d = new Date($(this).val());
		var daysName = days[d.getDay()];
        
        //var dxc =  $('#dropOffDate');
        //var maximumDate = new Date();
        //maximumDate.setDate(d.getDate()-1);
        //dxc.datepicker( "option", "maxDate", maximumDate);

		if(daysName == "Saturday"){
			$("#pickupOffTime").html('');
			$("#pickupOffTime").append('<option disabled checked>取貨時段</option>');
			$("#pickupOffTime").append('<option value="上午（9:00~12:00）">上午（9:00~12:00）</option>');
		} else {
			$("#pickupOffTime").html('');
			$("#pickupOffTime").append('<option disabled checked>取貨時段</option>');
			$("#pickupOffTime").append('<option value="上午（9:00~12:00）">上午（9:00~12:00）</option>');
			$("#pickupOffTime").append('<option value="下午1（12:00~15:00）">下午1（12:00~15:00）</option>');
			$("#pickupOffTime").append('<option value="下午2（15:00~18:00）">下午2（15:00~18:00）</option>');
		}
		return false;
	});*/
});
	// jQuery( "#pickupDate" ).datepicker({ 
		// minDate: tomorrow,
		// dateFormat: jdpDateFormat,
		// beforeShowDay: noSunday,
	// });

	jQuery(document).ready(function($){
		$('#change_address').change(function(){
			if($(this)[0].checked)  $('#new_address').show();
			else $('#new_address').hide();
		});	
		$('.scheduleOption').click(function(){
			$('input[name="scheduleOption"]').val($(this).val())
		});
	});


/* function addBoxes() {  

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
	} */
	/*
	$("#submitform").validate({
		rules : {
			box_quantity : 'required',
			amt_service : 'required',
			package_id : 'required',
			scheduleOption : 'required',
			address : 'required',
			phone : 'required',			
			dropOffDate : 'required',
			dropOffTime : 'required',
		}, 
		messages : {
			box_quantity : {
				required : '欄位必填'
			},
			amt_service : {
				required : '欄位必填'
			},
			package_id : {
				required : '欄位必填'
			},
			scheduleOption : {
				required : '欄位必填'
			},
			address : {
				required : '欄位必填'
			},
			phone : {
				required : '欄位必填'
			},
			dropOffDate : {
				required : '欄位必填'
			},
			dropOffTime : {
				required : '欄位必填'
			},
		},
		submitHandler: function(form) {
			$(form).submit();
		}
	});
	*/
	
</script> 
@endsection