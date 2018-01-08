@extends('layouts.frontend.app')

@section('title', 'Reset Password')

@section('css')

@endsection

@section('content')

<!-- slider section starts here-->

<section id="inner_content">
   <div class="container text-center">

       <h1  ><b>忘記密碼</b></h1>
	   <h4 class="subtitle">Reset Password</h4>
	   <p class="y_line"></p>
	   <h3>新密碼將會email到您的電子信箱</h3>
      <div class="row">
	    <div class="col-md-12">

    <div class="form2">

        <div id="reset">
          <form class="form-horizontal" role="form" method="POST" action="{{ url('/password/emailreset') }}">
		  {!! csrf_field() !!}
		   <input type="hidden" name="token" value="{{ $token }}">
          <div class="field-wrap form_reset1{{ $errors->has('email') ? ' has-error' : '' }}">

              <input type="email" placeholder="Email電子郵件信箱" name="email" value="{{ $email or old('email') }}" required autocomplete="off" />
			  @if ($errors->has('email'))
					<span class="help-block">
								<strong>{{ $errors->first('email') }}</strong>
							</span>
				@endif
          </div>


          <button type="submit" class="button2 button-block2 "/>送出</button>

          </form>

        </div>


</div> <!-- /form -->


		</div>
	  </div>
   </div>
</section>


@endsection
