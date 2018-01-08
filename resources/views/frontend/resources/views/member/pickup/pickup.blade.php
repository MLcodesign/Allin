@extends('layouts.frontend.single')

@section('title', '預約取件')

@section('css')

{!! Html::style('https://code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css') !!}

<style>

.dodbob  input{
        border: none !important;
        background: transparent!important;
        color: #000!important;
        box-shadow: inset 0 1px 1px rgba(0,0,0,.0)!important;
    }
    
    
    .dodbob  textarea{
        border: none !important;
        background: transparent!important;
        color: #000!important;
        box-shadow: inset 0 1px 1px rgba(0,0,0,.0)!important;
    }
    
    
    .dodbob  select{
        border: none !important;
        background: transparent!important;
        color: #000!important;
        box-shadow: inset 0 1px 1px rgba(0,0,0,.0)!important;
    }

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
   
   
   .input-group {
       
        box-shadow: inset 0 0px 0px rgba(0,0,0,.075);
        background: #fafafa;
        border: 0px !important;
   }
  </style>
@endsection

@section('content')
<section id="inner_content" style="padding-top:150px;">
  <div class="container" style="max-width:900px">
    <div class="row">
      <div class="col-md-12 text-center" style="padding-bottom:12px;">
        <h1><b>來收箱子</b></h1>
        <h4 class="subtitle">SCHEDULE PICK UP</h4>
        <p class="y_line"></p>
      </div>
      <div class="col-xs-12"> @if (session('status'))
        <div class="alert alert-success"> {{ session('status') }} </div>
        @endif
        @if (session('warning'))
        <div class="alert alert-warning"> {{ session('warning') }} </div>
        @endif
        @if(count($boxes) > 0)
      <form method="post" action="{!! URL::to('schedule-pickup/confirm') !!}" id="submitform" enctype="multipart/form-data">
          {!! csrf_field() !!}
        <div class="row pricebox3">
          <div class="div-table morebox-drop">
            <div class="dodbob div-tr" style="pointer-events: nonee;">
              <div class="div-td morebox-drop-left"> <img src="/assets/dist/img/address-icon.png">
                <div class="morebox-title morebox-questions"> 收貨地址*
                  <div class="morebox-questions-description"></div>
                  <div class="addressNote"></div>
                </div>
              </div>
              
              <div class="div-td morebox-drop-right diffincss">
                <div class="input-fields-row">
                  <div class="input-fields left mobileHide">縣市</div>
                  <div class="input-fields right">
                    <div class="div-table">
                    @if(NULL === $request->get('county'))
                      <!--    
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
                         -->
                        
                      <div class="div-tr">
                      <span>{{ Auth::user()->county }}</span><span>{{ Auth::user()->district }}</span><span>{{ Auth::user()->zipcode }}</span>
                          <input type="hidden" value="{{ Auth::user()->county }}"  name="county"/>
                          <input type="hidden" value="{{ Auth::user()->district }}"  name="district"/>
                          <input type="hidden" value="{{ Auth::user()->zipcode }}"  name="zipcode"/>
                      </div>
                      @else
                        
                      <span>{{$request->get('county')}}</span> <span>{{$request->get('district')}}</span><span>{{$request->get('zipcode')}}</span>
                      <input type="hidden" disabled value="{{ $request->get('county') }}"  name="county"/>
                      <input type="hidden" disabled value="{{ $request->get('district') }}"  name="district"/>
                      <input type="hidden" disabled value="{{ $request->get('zipcode') }}"  name="zipcode"/>
                      @endif
                    </div>
                  </div>
                </div>
                <div class="input-fields-row">
                  <div class="input-fields left mobileHide">地址</div>
                  <div class="input-fields right dAddress">
                  @if(NULL === $request->get('address'))
                    <input readonly type="text" name="address" class="form-control" value="{{ !Auth::guest() ? Auth::user()->address : '' }}"  id="address" placeholder="地址">
                    @else
                    <span>{{$request->get('address')}}</span>
                    <input readonly type="hidden" value="{{ $request->get('address') }}" name="address"/>
                    @endif
                  </div>
                </div>
                <div class="input-fields-row">
                  <div class="input-fields left mobileHide">電話</div>
                  <div class="input-fields right dPhone">
                   @if(NULL === $request->get('phone'))
                    <input readonly type="tel" value="{{ !Auth::guest() ? Auth::user()->mobile : '' }}" name="phone"  id="phone" placeholder="Phone">
                    @else
                    <span>{{$request->get('phone')}}</span>
                    <input readonly type="hidden" value="{{ $request->get('phone') }}" name="phone"/>
                    @endif
                  </div>
                </div>
                @if(0 !== $lastorder->moving_floor)
                   <div class="input-fields-row">
                  <div class="input-fields left mobileHide">上樓搬運費</div>
                  <div class="input-fields right dPhone">
                    
                    {{$lastorder->moving_floor}} 點
                    
                  </div>
                </div>
                @endif
                
                <!--
                <div class="input-fields-row">
                  <div class="input-fields left mobileHide">備註:</div>
                  <div class="input-fields right last speacialInstructions">
                  
                {{$lastorder->note}}
                   
                  </div>
                </div>
                -->
                <div class="input-fields-row">
                  <div class="input-fields left mobileHide">備註:</div>
                  <div class="input-fields right last speacialInstructions">
                    <textarea class="speacial_textarea" rows="4" name="special_instruction" id="special_instruction" placeholder="e.g.: “例如：請司機到門口先撥打手機.”">{{$lastorder->note}}</textarea>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div id="step-1" class="div-table morebox-drop">
            <div class="div-tr border-bottom">
              <div class="div-td morebox-drop-left"> <img id="dropoff-icon" src="/assets/dist/img/pickup-icon.png">
                <div id="dropoff" class="morebox-title morebox-questions">  預約取件
                  <div class="morebox-questions-description"></div>
                </div>
              </div>
              <div class="div-td morebox-drop-right">
                <div class="input-fields-row">
                  <div class="input-fields left mobileHide"> 日期? </div>
                  <div class="input-fields right">
                  @if(NULL === $request->get('ship_date'))
                     <input type="text" value="" id="datePicker" name="ship_date" required  style="cursor: pointer;" placeholder="選擇日期"/>
                     @else
                     <span>{{$request->get('ship_date')}}</span>
                     <input type="hidden" value="{{ $request->get('ship_date') }}" required name="ship_date"/>
                     @endif
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
            <div class="div-tr border-bottom">
                <div class="div-td morebox-drop-left">
                  <div id="dropoff" class="morebox-title morebox-questions">預訂數量
                    <div class="morebox-questions-description"></div>
                  </div>
                </div>
                <div class="div-td morebox-drop-right">
                  <div class="input-fields-row">
                    <div class="input-fields left"> 數量 </div>
                    <div class="input-fields right last"> <span class="display-value">{{ count($boxes) }}</span>
                      <input type="hidden" value="{{ count($boxes) }}" name="quantity"/>
                    </div>
                  </div>
                </div>
              </div>
              
            
            <br><br>
          <div class="div-tr border-bottom text-center">
            <div class="div-td">
              <p></p>
            </div>
            <div class="div-td">
                <button id="btnSubmit" class="btn-primary morebox-continue" name="action" value="送出" style="width:100px"/>送出</button>
          </div>
          </div>
        </div>
        </form>
        @endif
      </div>
    </div>
    
    <div id="opreview" class="row" style="max-width: 600px;margin: 0 auto;display:none">

        <h3>Order Preview</h3>
   
    
            <ul class="list-group">
          <li class="list-group-item">縣市 <span class="pull-right">{{ Auth::user()->county }} , {{ Auth::user()->district }} , {{ Auth::user()->zipcode }} </span></li>
          <li class="list-group-item">地址 <span class="pull-right">

                    {{ !Auth::guest() ? Auth::user()->address : '' }}

           
          </span></li> 
          <li class="list-group-item">電話 <span class="pull-right">{{ !Auth::guest() ? Auth::user()->mobile : '' }}</span></li>
          <li class="list-group-item">備註 <span class="pull-right"><?php echo $lastorder->note;?></span></li>
          
          <li class="list-group-item">日期 <span class="pull-right"><?php echo $lastorder->created_at->format('d-m-y');?></span></li>
          <li class="list-group-item">時間<span class="pull-right"><?php echo $lastorder->created_at->format(' H:m:s');?></span></li> 
          
          
         
          
              @if(0 !== $lastorder->moving_floor)
                <li class="list-group-item">上樓搬運費<span class="pull-right"> {{$lastorder->moving_floor}} 點</span></li> 
                @endif
          
          
          <li class="list-group-item">數量<span class="pull-right">{{ count($boxes) }}</span></li> 

          
        </ul>
            </div>
    

  </div>
  </div>
</section>
@endsection

@section('js') 
<script src="{{ url('/assets/dist/js/jquery.twzipcode.min.js') }}" type="text/javascript"></script> 
<script src="{{ url('/assets/dist/js/address.js') }}" type="text/javascript"></script> 
<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.15.0/jquery.validate.min.js"></script>
<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.15.0/additional-methods.min.js"></script>
<script>

      
    function showpreview() {
        
        //$('.pricebox3').hide();
        //$('#opreview').show();
    }



var dayoffs = []; 
var tsFullDates = ["2016-08-30","2016-08-31","2016-09-01","2016-09-02","2016-09-03"]; 

var addMinDate = 1;
var addMinDateXL = 2;
jdpDateFormat = "yy-mm-d"; 
qtyAmtFormat = "${amt}{unit} x {tqty}"; 

var today = new Date('<?php echo $lastorder->created_at->format('y');?>', '<?php echo $lastorder->created_at->format('m');?>', '<?php echo $lastorder->created_at->format('d');?>'); 



var tomorrow = new Date();
tomorrow.setDate(today.getDate() + addMinDate);





    jQuery( "#datePicker" ).datepicker({ 
        minDate: tomorrow,
        dateFormat: jdpDateFormat,
        beforeShowDay: noSunday,
        
    });
    
    function noSunday(date){ 
         return [date.getDay() != 0, ''];
    }

    jQuery(document).ready(function($){
        $('.img-placeholder').click(function(){
            $('#'+$(this).attr('data-id')).click();
        });
        
        $('.btnSubmit').click(function(){
            $("#submitform").submit();
        })
    });
    /* Javascript */
    $('#twzipcode').twzipcode();
    
    $('input[type="file"]').change(function(){
        var preview  = $('div[data-id="'+$(this).attr('id')+'"] .imageCanvas');
        preview = preview[0];
        handleImage($(this)[0].files[0], preview );
    });
    
    
    function handleImage(file, preview){
        var reader  = new FileReader();

          reader.addEventListener("load", function () {
            preview.src = reader.result;
          }, false);

          if (file) {
            reader.readAsDataURL(file);
          } 
    }

    $('#change_address').change(function(){
        if($(this)[0].checked)  $('#new_address').show();
        else $('#new_address').hide();
    });
    
</script> 
<script>



jQuery("#datePicker").change(function(){
        var days = ['Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday'];
        var d = new Date($(this).val());
        var daysName = days[d.getDay()];
        
        if(daysName == "Saturday"){
            $("#dropOffTime").html('');
            $("#dropOffTime").append('<option disabled checked>取貨時段</option>');
            $("#dropOffTime").append('<option value="上午">上午（9:00~12:00）</option>');
        } else {
            $("#dropOffTime").html('');
            $("#dropOffTime").append('<option disabled checked>取貨時段</option>');
            $("#dropOffTime").append('<option value="上午（9:00~12:00）">上午（9:00~12:00）</option>');
            $("#dropOffTime").append('<option value="下午1（12:00~15:00）">下午1（12:00~15:00）</option>');
            $("#dropOffTime").append('<option value="下午2（15:00~18:00）">下午2（15:00~18:00）</option>');
        }
        return false;
        
    });


    
    
     $("#submitform").submit(function(e) {
        d = $('#datePicker').value();
        
        alert(d);
        //prevent Default functionality
        e.preventDefault();

        
    });



    $("#submitforms").validate({
        rules : {
            address : 'required',
            phone : 'required',            
            dropOffDate : 'required',
            dropOffTime : 'required',
            pickupDate : 'required',
        }, 
        messages : {
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
            pickupDate : {
                required : '欄位必填'
            },
        },
        submitHandler: function(form) {
            $(form).submit();
        }
    });
</script>
@endsection