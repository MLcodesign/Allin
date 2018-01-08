@extends('layouts.frontend.app')

@section('title', 'Reset Password')

@section('css')

@endsection

@section('content')




       <h1 class="text-center" ><b>忘記密碼</b></h1>
	   <h4 class="subtitle">Reset Password</h4>
	   <p class="y_line"></p>
	   <h3 class="text-center">新密碼將會email到您的電子信箱</h3>
      <div class="row">
	    <div class="col-md-12">

    <div class="form2">

        <div id="reset">
          <form class="form-horizontal" role="form" method="POST" action="{{ url('/password/emailreset') }}">
		  {!! csrf_field() !!}
		  @if (count($errors) > 0)
				<ul>
					@foreach ($errors->all() as $error)
						<li>{{ $error }}</li>
					@endforeach
				</ul>
			@endif

          <div class="field-wrap form_reset1{{ $errors->has('email') ? ' has-error' : '' }}">
              <label>
               Email電子郵件信箱<span class="req">*</span>
              </label>
              <input type="email" name="email" value="{{ $email or old('email') }}" required autocomplete="off" />
			  @if ($errors->has('email'))
					<span class="help-block">
								<strong>{{ $errors->first('email') }}</strong>
							</span>
				@endif
          </div>


          <button type="submit" onclick="alert('新密碼已經email到您的電子信箱')"  class="button2 button-block2 "/>送出</button>

          </form>

        </div>


</div> <!-- /form -->


		</div>
	  </div>



@endsection
