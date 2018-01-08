@extends('layouts.frontend.app')

@section('title', 'Register')

@section('css')

@endsection

@section('content')
    <!-- slider section starts here-->
	<h1 style="text-align:center;"><b>重發驗證信</b></h1>
	<h4 class="subtitle">Resend Verify Email</h4>
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
				<form class="form-horizontal" role="form" method="POST" action="{{ url('/resendVerify') }}">
					{!! csrf_field() !!}
					<div class="field-wrap{{ $errors->has('email') ? ' has-error' : '' }}">
						<label><span class="req">Email</span></label>
							<input name="email" placeholder="Email *" value="{{ old('email') }}" type="email" required autocomplete="off"/>
						@if ($errors->has('email'))
							<span class="help-block">
								<strong>{{ $errors->first('email') }}</strong>
							</span>
						@endif
					</div>
					<button type="submit" class="button button-block"/>重送</button>
				</form>
			</div>
			<ul class="formbox">
				<li>已經是會員了嗎? <a href="{{ url('/login') }}">會員登入</a></li>
			</ul>
		</div> <!-- /form -->
	</div>
</div>
@endsection

@section('js')
    <script type="text/javascript">

    </script>
@endsection
