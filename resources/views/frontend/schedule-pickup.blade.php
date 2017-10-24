@extends('layouts.frontend.single')

@section('title', '預約取件')

@section('css')

{!! Html::style('https://code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css') !!}


@endsection

@section('content')
<section id="inner_content">
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
      <form method="post" action="{{url('/schedule-pickup')}}" id="submitforms" enctype="multipart/form-data">
          {!! csrf_field() !!}
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
                    @if(NULL === $request->get('county'))
                      <div id="twzipcode" class="div-tr">
                        <div data-role="county"
                         data-name="county"
                         id = "county"
                         data-value="{{ Auth::user()->county }}"
                         data-style="county" class="div-td"> </div>
                        <div data-role="district"
                         id = "district"
                         data-name="district"
                         data-value="{{ Auth::user()->district }}"
                         data-style="district" class="div-td"> </div>
                        <div data-role="zipcode"
                         data-name="zipcode"
                         id = "zipcode"
                         data-value="{{ Auth::user()->zipcode }}"
                         data-style="zipcode" class="div-td"> </div>
                      </div>
                      @else
                      <span>{{$request->get('county')}}</span> <span>{{$request->get('district')}}</span><span>{{$request->get('zipcode')}}</span>
                      <input type="hidden" value="{{ $request->get('county') }}" name="county"/>
                      <input type="hidden" value="{{ $request->get('district') }}" name="district"/>
                      <input type="hidden" value="{{ $request->get('zipcode') }}" name="zipcode"/>
                      @endif
                    </div>
                  </div>
                </div>
                <div class="input-fields-row">
                  <div class="input-fields left mobileHide">地址</div>
                  <div class="input-fields right dAddress">
                  @if(NULL === $request->get('address'))
                    <input type="text" name="address" value="{{ !Auth::guest() ? Auth::user()->address : '' }}"  id="address" placeholder="地址">
                    @else
                    <span>{{$request->get('address')}}</span>
                    <input type="hidden" value="{{ $request->get('address') }}" name="address"/>
                    @endif
                  </div>
                </div>
                <div class="input-fields-row">
                  <div class="input-fields left mobileHide">電話</div>
                  <div class="input-fields right dPhone">
                   @if(NULL === $request->get('phone'))
                    <input type="tel" value="{{ !Auth::guest() ? Auth::user()->mobile : '' }}" name="phone"  id="phone" placeholder="Phone">
                    @else
                    <span>{{$request->get('phone')}}</span>
                    <input type="hidden" value="{{ $request->get('phone') }}" name="phone"/>
                    @endif
                  </div>
                </div>
                <div class="input-fields-row">
                  <div class="input-fields left mobileHide">備註:</div>
                  <div class="input-fields right last speacialInstructions">
                   @if(NULL === $request->get('special_instruction'))
                    <textarea class="speacial_textarea" rows="4" name="special_instruction" id="special_instruction" placeholder="e.g.: “例如：請司機到門口先撥打手機.”"></textarea>
                     @else
                    <p>{{$request->get('special_instruction')}}</p>
                    <input type="hidden" value="{{ $request->get('special_instruction') }}" name="special_instruction"/>
                    @endif
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div id="step-1" class="div-table morebox-drop">
            <div class="div-tr border-bottom">
              <div class="div-td morebox-drop-left"> <img id="dropoff-icon" src="/assets/dist/img/pickup-icon.png">
                <div id="dropoff" class="morebox-title morebox-questions"> 預約取件
                  <div class="morebox-questions-description"></div>
                </div>
              </div>
              <div class="div-td morebox-drop-right">
                <div class="input-fields-row">
                  <div class="input-fields left mobileHide"> 日期? </div>
                  <div class="input-fields right">
                  @if(NULL === $request->get('ship_date'))
                     <input type="text" value="" id="datePicker" name="ship_date" placeholder="選擇日期"/>
                     @else
                     <span>{{$request->get('ship_date')}}</span>
                     <input type="hidden" value="{{ $request->get('ship_date') }}" name="ship_date"/>
                     @endif
                  </div>
                </div>
                <div class="input-fields-row">
                  <div class="input-fields left mobileHide"> 時間? </div>
                  <div class="input-fields right last">
                  @if(NULL === $request->get('ship_time'))
                    <select name="ship_time" id="ship_time">
                      <option disabled checked>取貨時段</option>
                    </select>
                    @else
                    <span>{{$request->get('ship_time')}}</span>
                    <input type="hidden" value="{{ $request->get('ship_time') }}" name="ship_time"/>
                    @endif
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
              
            
            <div class="div-tr border-bottom">
            <div class="div-td morebox-drop-left">
              <div id="dropoff" class="morebox-title morebox-questions"> <!--我的箱子-->
                <div class="morebox-questions-description"></div>
              </div>
            </div>
            <div class="div-td">
            <div class="col-sm-offset-2">
            @foreach($boxes as $i => $box)
              <div class="col-xs-12 col-sm-4 cust_boxes">
                <p class="box_num">{{ $box->admin_id }}</p>
                <p class="box_name">{{ $box->name }}</p>
                @if(NULL !== $request->get('box_pickup')[$i+1])
                <input type="hidden" name="box_pickup[{{ $i+1 }}][name]" value="{{ $request->get('box_pickup')[$i+1]['name'] }}"/>
                <input type="hidden" name="box_pickup[{{ $i+1 }}][img]" value="@if(isset($pictures[$i])){{$pictures[$i]}}@endif" />
                <input type="hidden" name="box_pickup[{{ $i+1 }}][id]" value="{{$box->id}}" />
                <p>
                @if($box->image != "")
                <img width="140" height="140" src="/uploads/boxes/{{$box->image}}" />
                @else
					@if($box->package_id==1)
						<img width="140" height="140" src="/assets/dist/img/warehouse/box.png" />
					@else
						<img width="140" height="140" src="/assets/dist/img/warehouse/large_box.png" />
					@endif
		        @endif
                </p>
                @else
                <input type="hidden" name="box_pickup[{{ $i+1 }}][name]" value="{{ $box->name }}"/>
                <div class="img-placeholder" data-id="pick-img-{{$i+1}}">
                @if($box->image != "")
				
                <img width="140" height="140" src="/uploads/boxes/{{$box->image}}" />
                @else
					@if($box->package_id==1)
						<img width="140" height="140" src="/assets/dist/img/warehouse/box.png" />
					@else
						<img width="140" height="140" src="/assets/dist/img/warehouse/large_box.png" />
					@endif
                @endif
                </div>
                <!--<input type="file" id="pick-img-{{$i+1}}" name="box_pickup_image[]" value="" class="hide input-image" />-->
                @endif</div>
              @endforeach
              </div></div>
          </div>
          <div class="div-tr border-bottom text-center">
            <div class="div-td">
              <p></p>
            </div>
            <div class="div-td"> @if($request->get('action') === '預覽')
              <input type="button" id="btnSubmit" class="btn-primary morebox-continue btnSubmit" name="action" value="送出" style="width:100px;margin-left:15px;"/>
              <input type="hidden" name="action" value="送出" />
              @else
              <input type="button" id="btnPreview" class="btn-primary morebox-continue btnSubmit" name="action" value="預覽" style="width:100px;margin-left:15px;"/>
              <input type="hidden" name="action" value="預覽" />
              @endif </div>
          </div>
          </div>
        </div>
        </form>
        @endif
      </div>
    </div>

  </div>
  </div>
</section>
@endsection

@section('js') 
<script src="{{ url('/assets/dist/js/jquery.twzipcode.min.js') }}" type="text/javascript"></script> 
<script src="{{ url('/assets/dist/js/address.js') }}" type="text/javascript"></script> 
<!--<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.15.0/jquery.validate.min.js"></script>
<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.15.0/additional-methods.min.js"></script>-->
<script>
var dayoffs = []; 
var tsFullDates = ["2016-08-30","2016-08-31","2016-09-01","2016-09-02","2016-09-03"]; 

var addMinDate = 1;
var addMinDateXL = 2;
jdpDateFormat = "yy-mm-d"; 
qtyAmtFormat = "${amt}{unit} x {tqty}"; 

var today = new Date();
var tomorrow = new Date();
tomorrow.setDate(today.getDate() + addMinDate);

jQuery( "#datePicker" ).datepicker({ minDate: tomorrow, dateFormat: jdpDateFormat,  beforeShowDay: function(date){ return checkAvailableDate(date, 0, 'normal'); }});
    

jQuery("#datePicker").change(function(){
        var days = ['Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday'];
        var d = new Date($(this).val());
        var daysName = days[d.getDay()];
        
        if(daysName == "Saturday"){
            $("#ship_time").html('');
            $("#ship_time").append('<option disabled checked>取貨時段</option>');
            $("#ship_time").append('<option value="上午（9:00~12:00）">上午（9:00~12:00）</option>');
        } else {
            $("#ship_time").html('');
            $("#ship_time").append('<option disabled checked>取貨時段</option>');
            $("#ship_time").append('<option value="上午（9:00~12:00）">上午（9:00~12:00）</option>');
            $("#ship_time").append('<option value="下午1（12:00~15:00）">下午1（12:00~15:00）</option>');
            $("#ship_time").append('<option value="下午2（15:00~18:00）">下午2（15:00~18:00）</option>');
        }
        return false;
        
    });    
    
jQuery(document).ready(function($){

  
    
    $('.img-placeholder').click(function(){
        $('#'+$(this).attr('data-id')).click();
    })
    /* Javascript */
    $('#twzipcode').twzipcode();
  
    
    $('input[type="file"]').change(function(){
        var preview  = $('div[data-id="'+$(this).attr('id')+'"] .imageCanvas');
        preview = preview[0];
        handleImage($(this)[0].files[0], preview );
    })
    
    
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
    })


    $(".btnSubmit").click(function() {
        if($("#datePicker").val() != ""){
            $('#submitforms').submit();
        }else {
            $.blockUI({ css: { 
                border: 'none', 
                padding: '15px', 
                backgroundColor: '#000', 
                '-webkit-border-radius': '10px', 
                '-moz-border-radius': '10px', 
                opacity: .5, 
                color: '#fff' 
            },
            message : "預約日期未填"}); 
     
            setTimeout($.unblockUI, 2000);       
        }
        });
    
})


</script> 
@endsection