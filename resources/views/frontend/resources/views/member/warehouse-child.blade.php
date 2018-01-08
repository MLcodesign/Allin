@extends('layouts.frontend.member.app')

@section('title', '我的懶人倉  My Account')

@section('css')
{!! Html::style('/assets/plugins/lightbox/css/lightbox.css') !!}
<style>
ul>li{line-height:30px}
</style>
@endsection

@section('content')
<div class="row boxfulForm" style="padding-top:0px !important">
 @if (session('status'))
<div class="alert alert-success"> {{ session('status') }} </div>
@endif
@if (session('warning'))
<div class="alert alert-warning"> {{ session('warning') }} </div>
@endif
<div class="col-md-12 text-center" style="padding-bottom:12px;">
        <h1><b>會員中心</b></h1>
        <h4 class="subtitle">My Account - 我的懶人倉</h4>
        <p class="y_line"></p>
     <h3 class="text-center">您還有 {{ round($credit) }} 剩餘點數</h3>
 </div>

  <div id="tabs">
    <div id="schedule">
      <div class="div-table" style="width: 100%; padding-top: 0px;">
        <div class="div-tr">
          <div id="cardInfoForm" class="div-td schedule">
            <div class="morebox-questions"><span class="morebox-yellowBottom">懶人倉</span>租用中</div>
            <div class="table-responsive">
              <table class="table table-striped table-bordered table-hover" style="margin:20px auto">
                <thead>
                  <tr>
                    <th>訂單編號</th>
                    <th>狀態</th>
                    <th>空箱日期</th>
					<th>起租日期</th>

                    <th>箱子名稱</th>
                    <th>照片預覽</th>
					<th>月租費</th>
                    <th>倉庫清點</th>
                    <th>即時影像</th>
                  </tr>
                </thead>
                <tbody>

                @foreach($orders as $i => $order)
                <?php if($order->status == 3) continue; ?>
                <tr>
                  <td># {{$order->id}}</td>
                  <td><label class="label label-{{$order_status_color[$order_status[$order->status]]}}">{{ $order_status[$order->status] }}</label></td>
                  <td style="">{{$order->pickup_date}}</td>
          <td style="">{{$order->shipping_date}}</td>

                  <td><ul style="margin:0; list-style:none; padding:0">
                      @foreach($boxes[$order->id] as $box)
                      <li style="line-height:30px">{{ $box->name }}</li>
                      @endforeach
                    </ul></td>
                  <td><ul style="margin:0; list-style:none; padding:0">
                      @foreach($boxes[$order->id] as $box)
                     <li><a href="@if('' !== $box->image)/uploads/boxes/{{ $box->image }} @else {{ url('/assets/dist/img/box5_s.png')}} @endif" data-lightbox="example-1"><img src="@if('' !== $box->image)/uploads/boxes/{{ $box->image }} @else {{ url('/assets/dist/img/box5_s.png') }} @endif" style="height:24px; margin:3px" width="auto" height="20"/></a></li>
                      @endforeach
                    </ul></td>
					<td>{{ $order->monthly_cost }}</td>
                  <td><ul style="margin:0; list-style:none; padding:0">
                      @foreach($boxes[$order->id] as $box)
                      <li style="line-height:30px">
                        <input type="checkbox" @if($box->
                        arrived) {{ 'checked' }} @endif disabled /></li>
                      @endforeach
                    </ul></td>
                  <td><label class="label label-info">{{ $order->amt_service }}</label></td>
                </tr>
                @endforeach
                  </tbody>

              </table>
            </div>
            <div class="morebox-questions"><span class="morebox-yellowBottom">懶人倉</span>使用狀態</div>
            <div class="div-table" style="width:100%">
              <div class="div-tr">
			  
                <div class="div-td"> <span id="boxAmt"> 您有 <span id="boxAmts" style="color: #00c5b4">{{ count($all_boxes) }}</span> 箱正在懶人倉 </span> </div>
              </div>
            </div>
            <br>
            <br>
            <div class="clear"></div>
            <div class="morebox-questions"><span class="morebox-yellowBottom">歷史</span>紀錄</div>
            <div class="table-responsive">
              <table class="table table-striped table-bordered table-hover" style="margin:20px auto">
                <thead>
                  <tr>
                    <th>訂單編號</th>
                    <th>狀態</th>
                    <th>空箱日期</th>
					<th>起租日期</th>

                    <th>箱子名稱</th>
                    <th>照片預覽</th>
					<th>月租費</th>
                    <th>倉庫清點</th>
                    <th>即時影像</th>
                  </tr>
                </thead>
                <tbody>

                @foreach($orders as $i => $order)
                <?php if($order->status != 3) continue; ?>
                <tr>
                  <td># {{$order->id}}</td>
                  <td><label class="label label-{{$order_status_color[$order_status[$order->status]]}}">{{ $order_status[$order->status] }}</label></td>
                  <td style="">@if($order->pickup_date !== ''){{$order->pickup_date}} @else - @endif</td>
					<td style="">@if($order->shipping_date !== '') {{$order->shipping_date}} @else - @endif</td>

                  <td><ul style="margin:0; list-style:none; padding:0">
                      @foreach($boxes[$order->id] as $box)
                      <li style="line-height:30px">{{ $box->name }}</li>
                      @endforeach
                    </ul></td>
                  <td><ul style="margin:0; list-style:none; padding:0">
                      @foreach($boxes[$order->id] as $box)
                      <li><a href="@if('' !== $box->image)/uploads/boxes/{{ $box->image }}@endif" data-lightbox="example-1"><img src="@if('' !== $box->image)/uploads/boxes/{{ $box->image }}@endif" style="height:24px; margin:3px" width="auto" height="20"/></a></li>
                      @endforeach
                    </ul></td>
					<td>{{ $order->monthly_cost }}</td>
                  <td><ul style="margin:0; list-style:none; padding:0">
                      @foreach($boxes[$order->id] as $box)
                      <li style="line-height:30px">
                        <input type="checkbox" @if($box->
                        arrived) {{ 'checked' }} @endif disabled /></li>
                      @endforeach
                    </ul></td>
                  <td><label class="label label-info">{{ $order->amt_service }}</label></td>
                </tr>
                @endforeach
                  </tbody>

              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
@section('js')
{!! Html::script('/assets/plugins/lightbox/js/lightbox.js') !!}
<script src="{{ url('/assets/dist/js/jquery.twzipcode.min.js') }}" type="text/javascript"></script>
<?php /*<script src="https://cdn.jsdelivr.net/jquery.validation/1.15.0/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.15.0/additional-methods.min.js"></script>
<script>
$( document ).ready(function() {
    $( ".referral-show" ).click(function() {
      $('.referral_box').show('fast');
      return false;
    });
});

/* Javascript 
  $('#twzipcode').twzipcode();

 /* jQuery(document).ready(function($){

    $('input[name="password_confirm"]').change(function(e) {

            if($(this).val() !== $('input[name="password"]').val()) alert('Password missmatch!!!')
        });
  }) 
  console.log("{!! URL::to('/logout') !!}");
	jQuery.validator.setDefaults({
	  debug: true,
	  success: "valid"
	});
	$( "#member-profile" ).validate({
	  rules: {
		current_password: "required",
		password: "required",
		password_confirm: {
		  required: true,
		  equalTo: "#password"
		}
	  },
	  submitHandler: function(form) {
		  var old = $("input[name=current_password]").val();
		  var newpass = $("input[name=password]").val();
		  $.ajax({
			  'url' : "{!! URL::to('member/profile/changepassword') !!}",
			  'method' : 'get',
			  'data' : { 'current_password' : old, 'password' : newpass },
			  'success' : function(response){
				  if(response.status == "true"){
					  $('#alert-success').removeClass('alert-danger');
					  $('#alert-success').addClass('alert-success');
					  setTimeout(function() {						  
					  $('#alert-success').html('');
					  $('#alert-success').html(response.message);
					  $('#alert-success').show();
					  var url = "{!! URL::to('/logout') !!}";
						//location.herf = url;
					   $('#alert-success').slideUp('slow', window.location.replace(url));
					}, 5000);						
				  } else{
					  $('#alert-success').removeClass('alert-success');
					  $('#alert-success').addClass('alert-danger');
					  $('#alert-success').html(response.message);
					  $('#alert-success').show();
				  }
			  }
		  });
	  }
	});
</script> */ ?>
@endsection
