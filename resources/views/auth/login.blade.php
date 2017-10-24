@extends('layouts.frontend.app')

@section('title', 'Login')

@section('css')
@endsection

@section('content')
    <!-- slider section starts here-->



   <h1 style="text-align:center;"><b>會員登入</b></h1>
	   <h4 class="subtitle">Log In</h4>
	   <p class="y_line"></p>
	   <img src="assets/dist/img/price1.png" class="img-responsive center-block">
      <div class="row">
	    <div class="col-md-12">
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
    <div class="form">
        <div id="login">
			@if (session('status'))
				<div class="alert alert-success">
					{{ session('status') }}
				</div>
			@endif
			@if(isset($message))
				<div class="alert alert-warning">
					{{ $message }}
				</div>
			@endif
			@if (session('warning'))
				<div class="alert alert-warning">
					{{ session('warning') }}
				</div>
			@endif
          <form class="form-horizontal" id="frmlogin" role="form" method="POST" action="{{ url('/login') }}">
		  {!! csrf_field() !!}
          <div class="field-wrap{{ $errors->has('email') ? ' has-error' : '' }}">
              <label>
                <span class="req">Email</span>
              </label>
              <input type="text" name="email" id="formEmail" placeholder="Email *" value="{{ old('email') }}" required autocomplete="off" />
			  @if ($errors->has('email'))
					<span class="help-block">
								<strong>{{ $errors->first('email') }}</strong>
							</span>
				@endif
          </div>

          <div class="field-wrap{{ $errors->has('password') ? ' has-error' : '' }}">
            <label>
              <span class="req">密碼</span>
            </label>
            <input name="password" placeholder="密碼 *" type="password" required autocomplete="off"/>
			@if ($errors->has('password'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                        @endif
          </div>
          <div class="g-recaptcha" data-sitekey="{{ env("GOOGLE_CAPTCHA_SITE_KEY") }}"></div>

          <button type="submit" class="button button-block"/>登入</button>

          </form>
			<div style="margin-top: 10px; margin-bottom: 10px;">
					{!! Form::open(['url' => 'auth/login/facebook', 'method' => 'get']) !!}
					   <button class="btn btn-info btn-block" type="submit"> facebook快速登入 </button>
					{!! Form::close() !!}
				</div>
        </div>
        <ul class="formbox">
        <li><a href="{{url('/password/reset')}}">忘記密碼？</a></li>
        <li>還不是會員嗎? <a href="{{url('/register')}}">點此免費註冊</a></li>
        <li>沒有收到驗證信? <a href="{{url('/resendVerify')}}">重新發送驗證信</a></li>
        </ul>


</div> <!-- /form -->


		</div>
	  </div>


@endsection

@section('js')
<script>
        jQuery(document).ready(function($){
            $("#formEmail").focus();
        });
</script>
@endsection
