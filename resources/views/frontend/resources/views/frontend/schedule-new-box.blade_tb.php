@extends('layouts.frontend.single')

@section('title', 'Schedule New Box')

@section('css')

    {!! Html::style('https://code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css') !!}


@endsection

@section('content')
<div style="font-size: 18px;
    box-shadow: rgb(0, 0, 0) 2px 2px 5px;
    color: rgb(255, 255, 255);
    background: #4e4744;
    position: fixed;
    bottom: 50px;
    z-index: 999999;
    padding: 10px;
    left: 50px;
    display: none;" id="nomoneymsg">您的餘額不足，請前往儲值，謝謝!</div>
    <section id="inner_content" style="padding-top:150px;">
        <div class="container" style="">
            <div class="row">
              
                <div class="col-xs-12"> @if (session('status'))
                        <div class="alert alert-success"> {{ session('status') }} </div>
                    @endif
                    @if (session('warning'))
                        <div class="alert alert-warning"> {{ session('warning') }} </div>
                    @endif
                    <form method="post" id="pformchxcv" action="{{url('/schedule-new-box/confirm')}}">
                        {!! csrf_field() !!}
                        
						<input type="hidden" name="monthly_cost"  value="0"/>
						<input type="hidden" name="shipping_fee"  value="0"/>
						
                        <div class="row">
                            <?php $j = 0; ?>
                            @foreach($packages as $i => $package)
                                <div id="cfr{{ $package->id }}" data-id="{{ $package->id }}"
                                     class="choose-package col-md-4 col-md-offset-{{
		  ($i == 0) ? 4-count($packages) : 0}}">
		  
									<input id="fxsixthzer" type="hidden" name="packages[{{ $package->id }}][box_quantity]" value="0" data-id="{{ $package->id }}" data-type="box_quantity" />
									<input type="hidden" name="packages[{{ $package->id }}][amt_service]"  value="0" data-id="{{ $package->id }}" data-type="amt_service" />
									<input type="hidden" name="checktopleft" id="rezthxisxf" value="0" />
                                    <input type="hidden" name="checktobleft" id="largeleft" value="0" />
                                    <div class="inner">
                                        <div class="row">
                                            <div class="col-md-12"><img src="{{ $package->features[3]->pivot->spec }}"
                                                                        class="img-responsive center-block"
                                                                        @if(isset($package->features[4]) && $package->features[4]->isActive()) width="{{ $package->features[4]->pivot->spec }}" @endif >
                                            </div>
                                            <div class="col-md-12">
                                                <h1 class="text-center" id="inner-head">{{ $package->name }}</h1>
                                            </div>
                                            
                                            <div class="col-md-12 text-center">
                                                @if(empty($package->features[9]->pivot->spec))
                                                    <h2> 月租 <b>{{ round($package->cost) }}{{ getSetting('DEFAULT_CURRENCY') }}</b> <span
                                                                class="small">/{{ $package->cost_per }}</span></h2>
                                                @else
                                                    <h2>{!! $package->features[9]->pivot->spec !!}</h2>
                                                @endif
                                                <small>{{ $package->features[0]->pivot->spec }}</small>
                                                <hr>
                                            </div>
                                            <div class="col-md-12 text-center">
                                                <h3 id="shipping-info{{$j}}">
                                                    <b>{{ $package->features[7]->pivot->spec }}</b></h3>
                                                <div class="inner-icon"><i class="fa fa-cog" aria-hidden="true"></i>&nbsp;&nbsp;
                                                    <span>{{ $package->features[1]->pivot->spec }}</span><br>
                                                    <i class="fa fa-star" aria-hidden="true"></i>&nbsp;&nbsp;
                                                    <span>{{ $package->features[2]->pivot->spec }}</span></div>
                                            </div>
                                            <div class="col-sm-12 text-center">
                                                <div class="morebox-priceButtonContainer" style="display:block">
												
                                                    <div class="morebox-priceButtonLeft">
                                                        <div class="morebox-priceButtonDivLeft">
                                                            <div id="amt-number-{{$j}}" class="number-display scinxahax" data-id="{{ $package->id }}">0</div>
                                                        </div>
                                                    </div>
                                                    <div class="morebox-priceButtonRight" data-type="box_quantity">
                                                        <div class="morebox-priceButtonDiv"><a
                                                                    class="add morebox-priceButton tyhbjusc" href="#">
                                                                <div>+</div>
                                                            </a></div>
                                                        <div class="morebox-priceButtonDiv last"><a
                                                                    class="sub morebox-priceButton tyhbjusc" href="#">
                                                                <div>－</div>
                                                            </a></div>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>

                                @if($i==1)
                                    <div class="col-xs-12 col-md-4 col-sm-offset-6 text-center" class="" id="addition_service"
                                         style="display:block;">
                                        <h3 id="addition-info"><b>即時影像加值服務</b></h3>
                                        <div class="morebox-priceButtonContainer">
										 
                                            <div class="morebox-priceButtonLeft">
                                                <div class="morebox-priceButtonDivLeft">
                                                    <div id="camera-number" data-id="{{ $package->id }}" class="number-display inixzex">0</div>
                                                </div>
                                            </div>
                                            <div class="morebox-priceButtonRight" data-type="amt_service">
                                                <div class="morebox-priceButtonDiv"><a id="topriintrg" class="add morebox-priceButton"
                                                                                       href="#">
                                                        <div>+</div>
                                                    </a></div>
                                                <div class="morebox-priceButtonDiv last"><a
                                                            class="sub morebox-priceButton" id="topriintrg" href="#">
                                                        <div>－</div>
                                                    </a></div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                <?php $j++; ?>
                            @endforeach </div>


                        <div class="row pricebox2" style="display:block">

                            <div class="col-xs-12">
                                <div class="orderNote">不確定租用一共需要多少點數嗎？別擔心！以下我們先幫您試算！</div>
                                <div class="morebox-remark">
                                    <div class="calculator-container">
                                        <div class="calculator-row title"><img class="cal mobileHide"
                                                                               src="/assets/dist/img/cal.png"><img
                                                    class="cal mobileShow" src="/assets/dist/img/cal-m.png">
                                            <div class="calculator-header">點數扣除試算<sup class="colorGreen">*</sup></div>
                                        </div>
                                        <div class="table"
                                             style="width:350px; margin:0 auto; border-spacing:5px 10px; border-collapse:seperate">
                                            <div class="table-row">
                                                <div class="table-cell" style="width:200px">月租費</div>
                                                <div class="calculator-row" style="display:table-cell"
                                                     id="estimatePrice"><span id="addcheckfi">0</span>點
                                                </div>
                                            </div>
                                            <div class="table-row">
                                                <div class="table-cell" style="width:200px">運費</div>
                                                <div class="calculator-row" style="display:table-cell"
                                                     id="shipping_fee"><span id="addchecksec">0</span>點
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <input type="hidden" name="slug" value="/confirm"/>
                        <div class="row">
                            <div class="form-group col-xs-12 col-md-12 text-center">
                                <input id="btn-step-2" type="submit" name="action" value="下一頁"
                                       class="btn btn-primary morebox-continue"/>
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
    <script>
	
	$( ".hasDatepicker" ).change(function() {
	  alert( "Handler for .change() called." );
	});

$(".hasDatepicker").datepicker({
  onSelect: function(dateText) {
    display("Selected date: " + dateText + "; input's current value: " + this.value);
  }
});

	$( "#cfr2 .tyhbjusc" ).click(function() {
	 
     setTimeout(function(){ 
              
			 r =  $('#camera-number').text();
			 e =  $('#amt-number-1').text();

	        if (e == 0) {
				//$('#addcheckfi').text('0');
				$('#camera-number').text(e);
			}
			if (r > e) {
				$('#camera-number').text(e);
			}
			}, 100);

	
	 
	 
	 
	});
	
	
	$('#pformchxcv').submit(function() {
    
	    credits = '{{ round($credit) }}';
		a = parseInt($('#addcheckfi').text());
		b = parseInt($('#addchecksec').text());
		c = a+b;
		
		
		x =  parseInt($('#amt-number-0').text());
		y =  parseInt($('#amt-number-1').text());
		
		
		if (x == 0 && y == 0) {
			
			
			$('#nomoneymsg').html('請先選擇數量');
			$('#nomoneymsg').fadeIn();
			return false; 
			
		} else {
			
			
			  if (c > credits) {
		   
				   $('#nomoneymsg').fadeIn();
					redirctdepost();
					return false; 
				 
			   } else {
				   
				   
				   return true;
				   
			   }
			
			
		}
		
		
		
		
		
		
		

	    
	 
	
	   
	
	
});



function redirctdepost() {
	
	
	   setTimeout(function(){ 
              
			 
             window.location.href = "{{url('/member/home#desposit')}}";

			}, 4000);
		   
	
}
	

	function checktopinput(v) {
			
			
			//alert(v);
			
			if (v == '00') {
				
				$('#addition_service').hide();
				
			} else if (v >= 1) {
				
				$('#addition_service').show();
			}
			
		}
	
	
        var packages = '<?php echo json_encode($packages); ?>';
        var features = '<?php echo json_encode($features) ?>';
        var packages_arr = '<?php echo json_encode($packages_arr) ?>';


        packages = jQuery.parseJSON(packages);
        features = jQuery.parseJSON(features);
        packages_arr = jQuery.parseJSON(packages_arr);
		
	
		
        var current_packages;
        var current_package_features;
		
		

        jQuery(document).ready(function ($) {
            $('#change_address').change(function () {
                if ($(this)[0].checked)  $('#new_address').show();
                else $('#new_address').hide();
            });
			
			
			function calc_price(type, fxv) {
				var estimatePrice = shipping_fee = 0;
                var sumBaseFeeFlag = false;
				for(var i=0; i< packages.length; i++){
					package_id = packages[i].id;
					addition_service = parseFloat(packages_arr[package_id].feature['add-on service']);
					package_cost = parseFloat(packages_arr[package_id].package['cost']);
                    base_fee = parseInt(packages_arr[package_id].feature['base fee']);
					box_quantity = n = parseInt(packages_arr[package_id].box_quantity);
					amt_service =  parseInt(packages_arr[package_id].amt_service);
                    if(addition_service >= 0){
                        if(amt_service >= fxv){
                            amt_service = fxv;
                            $('input[data-id="'+package_id+'"][data-type="amt_service"]').val(amt_service);
                            packages_arr[package_id].amt_service = fxv ;
                        }
                    }
					$('#input_packages').val(packages_arr);
					is_empty = box_quantity == 0 ? 0 : 1;
					formular = '((addition_service*amt_service) + ' + '(package_cost * box_quantity) ) * is_empty';
					shipping_fee += eval(packages_arr[package_id].feature['shipping fee']) * is_empty;
                    
                    if(sumBaseFeeFlag == false && shipping_fee > 0){
                        sumBaseFeeFlag = true;
                        shipping_fee += base_fee;
                    }
                    
					estimatePrice += eval(formular);
				}
				$('#shipping_fee span').text(shipping_fee);
				$('#estimatePrice span').text(estimatePrice);
				$('input[name="monthly_cost"]').val(estimatePrice);
				$('input[name="shipping_fee"]').val(shipping_fee);
			}
            $('.morebox-priceButton').click(function (event) {
				event.preventDefault();
				var type = $(this).parent().parent().attr('data-type');
				var quantity = $(this).parent().parent().parent().find('.number-display');
				package_id = quantity.attr('data-id');
				Numboxamt = parseInt(quantity.text());
                if ($(this).hasClass('add')) {
                    Numboxamt++;
                } else if (Numboxamt > 0) {
                    Numboxamt--;
                }
                if (Numboxamt > 0) quantity.addClass('yellow');
                else quantity.removeClass('yellow');
				$('input[data-id="'+package_id+'"][data-type="'+type+'"]').val(Numboxamt);
                quantity.text(Numboxamt);
				packages_arr[package_id][type] = Numboxamt;
				fxv = parseInt($('#amt-number-1').text());
				checktopinput(fxv);
                calc_price(type, fxv);
				zx = $('#fxsixthzer').val();
				$('body #rezthxisxf').val(zx);
            });
        });
    </script>
	<script>
		jQuery(document).ready(function(){
		$("body #topriintrg").click(function(){
			f = parseInt($('.inixzex').text());
			m = parseInt($('#amt-number-1').text());
			
			if (f > m) {
				
				$('.inixzex').text(m);
			
			} else if (f == m) {
				
				//alert('equal');
				
			} else if (f < m) {
				
				//alert('small');
			}
			
			
			
		});
		
		
		topvalue = $('.scinxahax').text();
		
		checktopinput(topvalue);
		
		 
		 
		 
		});
		</script>
	
@endsection