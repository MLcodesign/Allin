@extends('layouts.frontend.app')

@section('title', 'Register')

@section('css')

@endsection

@section('content')
<!-- Google Code for &#36865;&#20986;&#34920;&#21934; Conversion Page -->
<script type="text/javascript">
/* <![CDATA[ */
var google_conversion_id = 865301674;
var google_conversion_language = "en";
var google_conversion_format = "3";
var google_conversion_color = "ffffff";
var google_conversion_label = "DYDjCP3V-WwQqunNnAM";
var google_remarketing_only = false;
/* ]]> */
</script>
<script type="text/javascript" src="//www.googleadservices.com/pagead/conversion.js">
</script>
<noscript>
<div style="display:inline;">
<img height="1" width="1" style="border-style:none;" alt="" src="//www.googleadservices.com/pagead/conversion/865301674/?label=DYDjCP3V-WwQqunNnAM&amp;guid=ON&amp;script=0"/>
</div>
</noscript>
    <!-- slider section starts here-->
	<h1 style="text-align:center;"><b>免費註冊</b></h1>
	<h4 class="subtitle">Sign Up Free</h4>
	<p class="y_line"></p>
	<img src="assets/dist/img/price1.png" class="img-responsive center-block">
<div class="row">
	<div class="col-md-12">
		<div class="form">
			<div id="signup">
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
  </style>
			@if (session('status'))
				<div class="alert alert-success">
					{{ session('status') }}
				</div>
			@endif
				@if(session('provider'))
				<form class="form-horizontal" role="form" method="POST" action="{{ url('password/create') }}">
				@else
				<form class="form-horizontal" role="form" method="POST" action="{{ url('/register') }}">
				@endif
					{!! csrf_field() !!}
					<div class="field-wrap{{ $errors->has('email') ? ' has-error' : '' }}">
						<label><span class="req">Email</span></label>
						@if(session('provider'))
							<input type="hidden" name="userid" value="{{ session('userid') }}" />
							<input name="email" placeholder="Email *" value="{{ session('email') }}" type="email" readonly required autocomplete="off"/>
						@else
							<input name="email" placeholder="Email *" value="{{ old('email') }}" type="email" required autocomplete="off"/>
						@endif
						@if ($errors->has('email'))
							<span class="help-block">
								<strong>{{ $errors->first('email') }}</strong>
							</span>
						@endif
					</div>
					<div class="field-wrap{{ $errors->has('password') ? ' has-error' : '' }}">
						<label><span class="req">密碼</span></label>
						<input name="password" placeholder="(僅可輸入6~12位英數字組合，大小寫有區別，不含特殊符號) *" type="password"required autocomplete="off"/>
						@if ($errors->has('password'))
							<span class="help-block">
								<strong>{{ $errors->first('password') }}</strong>
							</span>
						@endif
					</div>
                    <div class="g-recaptcha" data-sitekey="{{ env("GOOGLE_CAPTCHA_SITE_KEY") }}"></div>
					<button type="submit" class="button button-block"/>註冊</button>
				</form>
				<div style="margin-top: 10px; margin-bottom: 10px;">
					{!! Form::open(['url' => 'auth/login/facebook', 'method' => 'get']) !!}
					   <button class="btn btn-info btn-block" type="submit"> 使用Facebook登入註冊 </button>
					{!! Form::close() !!}
				</div> 
			</div>
			<ul class="formbox">
				<li>已經是會員了嗎? <a href="{{ url('/login') }}">會員登入</a></li>
                <li>沒有收到驗證信? <a href="{{url('/resendVerify')}}">重新發送驗證信</a></li>
			</ul>
		</div> <!-- /form -->
	</div>
</div>
@endsection

@section('js')
    <script type="text/javascript">

    </script>
@endsection
