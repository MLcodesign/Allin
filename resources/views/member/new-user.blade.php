@extends('layouts.frontend.single')

@section('title', '帳單確認 Overview')

@section('css')
{!! Html::style('https://code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css') !!}
{!! Html::style('/assets/plugins/lightbox/css/lightbox.css') !!}
<style>
ul>li{line-height:30px}
div#cardInfoForm div.div-td.boxful-payment-title{
	vertical-align: middle;
}
.error{
	color: red;
	font-weight: 800;
	font-size: 15px;
}
</style>
@endsection

@section('content')
<section id="inner_content">
	<div class="container">
		<h1 style="text-align:center;"><b>歡迎您的加入</b></h1>
		<h4 class="subtitle">Welcome</h4>
		<p class="y_line"></p>
		<h3 class="text-center">Hi , 歡迎您加入ALL IN 精品倉儲，請輸入您的基本資料</h3>
		<h5 class="text-center" style="color:#dd0922;">請將「請輸入真實收件者姓名、電話及地址資訊，以利宅配作業」等文字備註於「Hi 歡迎您加入....基本資料」下方</h5>
		<div style="margin-top: 10px; margin-bottom: 10px;">&nbsp;</div>
		<div class="row">
			<div class="col-md-6 col-md-offset-3">		
				<div class="div-table" style="width: 100%; padding-top: 0px;">
					<div class="div-tr">
						<div id="cardInfoForm" class="div-td"> <span class="profile-edit">
							<form id="member-profile-update" action="{!! URL::to('post_user') !!}" method="post" class="form-validate form-horizontal " enctype="multipart/form-data">
							{!! csrf_field() !!}
								<div class="boxful-card-payment">個人資訊</div>
									<input type="hidden" value="{{ Auth::user()->id }}" name="id">
									<div class="div-table billing" style="width: 80%">
										<div class="div-tr">
											<div class="div-td"></div>
											<div class="div-td">
												<div id="alert-success-profile-update" class="alert" style="display: none;"></div>
											</div>
										</div>
										<div class="div-tr">
											<div class="div-td boxful-payment-title">姓名</div>
											<div class="div-td">
												<input placeholder="請輸入您的正確姓名，以供物流收送貨。" type="text" aria-required="true" required="required" class="form-control required" value="{{ !empty(Auth::user()->name) ?  Auth::user()->name : old('name') }}" name="name" aria-invalid="false" required />
												<div class="error">{{ $errors->first('name') }}</div>
											</div>
										</div>
										<div class="div-tr">
											<div class="div-td boxful-payment-title">聯絡電話</div>
											<div class="div-td">
												<input type="tel" class="form-control" value="{{ !empty(Auth::user()->mobile) ? Auth::user()->mobile : old('mobile') }}" name="mobile">
												<div class="error">{{ $errors->first('mobile') }}</div>
											</div>
										</div>
										<div class="div-tr">
											<div class="div-td boxful-payment-title"></div>
											<div class="div-td" style="text-align: right;">
											<?php /*<button type="submit" class="btn btn-primary validate"><span>更新</span></button> */?>
										</div>
									</div>
								</div>			  
								<div class="boxful-card-payment">地址資訊</div>
									<div class="div-table billing" style="width: 80%">
										<div class="div-tr">
											<div class="div-td"></div>
											<div class="div-td">
												<div id="alert-success-address" class="alert" style="display: none;"></div>
											</div>
										</div>
									<div class="div-tr">
										<div class="div-td boxful-payment-title">縣市</div>
										<div class="div-td">
											<div id="twzipcode" class="div-tr">
												<div class="input-group">
													<div data-role="county"
															data-name="county"
															id = "county"
															data-value="{{ !empty(Auth::user()->county) ? Auth::user()->county : old('country') }}"
															data-style="county form-control" class="div-td"> </div>
															<?php /*<div class="error">{{ $errors->first('country') }}</div> */ ?>
													<div data-role="district"
															id = "district"
															data-name="district"
															data-value="{{ !empty(Auth::user()->district) ? Auth::user()->district : old('district') }}"
															data-style="district form-control" class="div-td"> </div>
															<?php /*<div class="error">{{ $errors->first('district') }}</div> */ ?>
													<div data-role="zipcode"
															data-name="zipcode"
															id = "zipcode"
															data-value="{{ !empty(Auth::user()->zipcode) ? Auth::user()->zipcode : old('zipcode') }}"
															data-style="zipcode form-control" class="div-td"> </div>
															<?php /*<div class="error">{{ $errors->first('zipcode') }}</div> */ ?>
												</div>
											</div>
										</div>
									</div>
									<div class="div-tr">
										<div class="div-td boxful-payment-title">地址 </div>
										<div class="div-td">
											<input name="address" type="text" class="form-control" value="{{ !empty(Auth::user()->address) ? Auth::user()->address : old('address') }}" />
											<div class="error">{{ $errors->first('address') }}</div>
										</div>
									</div>
									<div class="div-tr">
										<div class="div-td boxful-payment-title"></div>
										<div class="div-td" style="text-align: center;">
											<?php /*<button type="submit" class="btn btn-primary validate"><span>更新</span></button> */ ?>
										</div>
									</div>
								</div>	
								<div class="form-group col-md-12 text-center">
									<button type="submit" class="btn btn-primary"><span>儲存</span></button>
								</div>
							</form>			  
						</div>
					</div>
				</div>
				<div id="bf_error_dialog" title=""></div>
			</div>
		</div>
	</div>
</section>
    <!-- end pricing -->
@endsection

@section('js')
{!! Html::script('/assets/plugins/lightbox/js/lightbox.js') !!}
<script src="{{ url('/assets/dist/js/jquery.twzipcode.min.js') }}" type="text/javascript"></script>

<script>
$(function(){
	$('body,html').animate({
		scrollTop: 0
	}, 800);
	return false;
});
$( document ).ready(function() {
    $( ".referral-show" ).click(function() {
      $('.referral_box').show('fast');
      return false;
    });	
});

/* Javascript */
  $('#twzipcode').twzipcode();
</script>
@endsection