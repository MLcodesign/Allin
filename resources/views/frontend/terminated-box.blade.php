@extends('layouts.frontend.single')

@section('title', '退租申請')

@section('css')

{!! Html::style('https://code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css') !!}


@endsection

@section('content')
<section id="inner_content" style="padding-top:150px;">
  <div class="container" style="max-width:900px">
    <div class="row">
      <div class="col-md-12 text-center" style="padding-bottom:12px;">
        <h1><b>退租申請</b></h1>
        <h4 class="subtitle">TERMINATE</h4>
        <p class="y_line"></p>
      </div>
      <div class="col-xs-12"> @if (session('status'))
        <div class="alert alert-success"> {{ session('status') }} </div>
        @endif
        @if (session('warning'))
        <div class="alert alert-warning"> {{ session('warning') }} </div>
        @endif
        @if(count($boxes) > 0)
      <form method="post" action="" enctype="multipart/form-data">
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
              <div class="div-td morebox-drop-left"> <img id="dropoff-icon" src="/assets/dist/img/dropoff-icon.png">
                <div id="dropoff" class="morebox-title morebox-questions"> 派送空箱
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
                    <select name="ship_time">
                      <option disabled checked>取貨時段</option>
                      <option value="上午">上午</option>
                      <option value="下午">下午</option>
                      <option value="晚上">晚上</option>
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
              
            
              
            <div id="pickup" class="div-tr">
              <div class="div-td morebox-drop-left"> <img src="/assets/dist/img/pickup-icon.png">
                <div class="morebox-title morebox-questions"> 預約取件
                  <div class="morebox-questions-description"></div>
                </div>
              </div>
              <div class="div-td morebox-drop-right option">
              @if(NULL === $request->get('schedule_option'))
                <div class="input-fields-row">
                  <div class="input-fields left option">
                    <input type="radio" value="晚點再預約" checked id="scheduleOption" name="schedule_option" class="scheduleOption">
                  </div>
                  <div class="input-fields right top option">
                    <div class="input-option">馬上取走</div>
                    <div class="input-option-description">貨運公司會在外頭等您將箱子裝滿，當天取走.</div>
                  </div>
                </div>
                <div class="input-fields-row">
                  <div class="input-fields left option">
                    <input type="radio" value="馬上取走" id="scheduleOption" name="schedule_option" class="scheduleOption">
                  </div>
                  <div class="input-fields right top option last">
                    <div class="input-option">晚點再預約</div>
                    <div class="input-option-description">請於一週內預約取件，起租日由本公司收回收納箱隔日或派送空箱後第8天起算，以較早日期計算。</div>
                  </div>
                </div>
                @else
                <span>{{ $request->get('schedule_option') }}</span>
                <input type="hidden" value="{{ $request->get('schedule_option') }}" name="schedule_option"/>
                @endif
              </div>
            </div>
            
            <div class="div-tr border-bottom">
            <div class="div-td morebox-drop-left">
              <div id="dropoff" class="morebox-title morebox-questions"> 我的箱子
                <div class="morebox-questions-description"></div>
              </div>
            </div>
            <div class="div-td">
            <div class="col-sm-offset-2">
            @foreach($boxes as $i => $box)
              <div class="col-xs-12 col-sm-4">
                <p>#{{ $i+1 }}</p>
                @if(NULL !== $request->get('box_pickup')[$i+1])
                <input type="hidden" name="box_pickup[{{ $i+1 }}][name]" value="{{ $request->get('box_pickup')[$i+1]['name'] }}"/>
                <input type="hidden" name="box_pickup[{{ $i+1 }}][img]" value="@if(isset($pictures[$i])){{$pictures[$i]}}@endif" />
                <input type="hidden" name="box_pickup[{{ $i+1 }}][id]" value="{{$box->id}}" />
                <p><span>{{ $request->get('box_pickup')[$i+1]['name'] }}</span> <br/>
                  @if(isset($pictures[$i])) <img style="height:80px; width:auto" src="/uploads/boxes/{{$pictures[$i]}}"/> @else
                <div class="img-none"></div>
                @endif
                </p>
                @else
                <input type="text" name="box_pickup[{{ $i+1 }}][name]" placeholder="請幫您的寶貝箱取名" value="{{ $box->name }}"/>
                <div class="img-placeholder" data-id="pick-img-{{$i+1}}"> <img class="imageCanvas"/> </div>
                <input type="file" id="pick-img-{{$i+1}}" name="box_pickup_image[]" value="" class="hide input-image" />
                @endif </div>
              @endforeach
              </div></div>
          </div>
          <div class="div-tr border-bottom text-center">
            <div class="div-td">
              <p></p>
            </div>
            <div class="div-td"> @if($request->get('action') === '預覽')
              <input type="submit" class="btn-primary morebox-continue" name="action" value="送出" style="width:100px"/>
              @else
              <input type="submit" class="btn-primary morebox-continue" name="action" value="預覽" style="width:100px"/>
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
	
	
	
})
</script> 
@endsection