@extends('layouts.frontend.app')

@section('title', 'Contact Us')

@section('css')

@endsection

@section('content')


<section id="inner_content">
   <div class="container">

       <h1 style="text-align:center;"><b>聯絡我們</b></h1>
	   <h4 class="subtitle">Contact Us</h4>
	   <p class="y_line"></p>
	   <img src="assets/dist/img/box5.png" class="img-responsive center-block">
      <div class="row">
	    <div class="col-md-12">

    <div class="form">

	<p style="color:green">{{Session::get('success')}}</p>
		<style>
			label{
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
			.error {
				color: red;
				font-weight: bold;
			}
		</style>
        <div id="signup">
         {!! Form::open(['url' =>  '/contact-us', 'id' => 'contact-form', 'method' => 'post', 'class' => 'form-horizontal']) !!}
          <div class="field-wrap">
              <label>
               姓名<span class="req">*</span>
              </label>
              {!! Form::text('name', old('name'), ['class' => ' validate[required]']) !!}
          </div>
          <div class="field-wrap">
            <label>
              Email<span class="req">*</span>
            </label>
             {!! Form::email('email', old('email'), ['class' => ' validate[required,custom[email]]']) !!}
          </div>

			{!! Form::hidden('subject', 'Allin web Submission') !!}

          <div class="field-wrap">
            <label>
              聯絡電話<span class="req">*</span>
            </label>
             {!! Form::text('phone', old('phone'), ['class' => '  validate[required,custom[phone]]']) !!}
          </div>
          <div class="field-wrap">
            <label>
              留言內容<span class="req">*</span>
            </label>
            {!! Form::textarea('message', old('message'), ['class' => ' validate[required]', 'rows'=> 5]) !!}
          </div>
          <button type="submit" class="button button-block"/>送出</button>

        </form>

        </div>
        <ul class="formbox">
        <li><a href="/register">免費註冊</a></li>
        <li>已經是會員了嗎? <a href="/login">會員登入</a></li>
        </ul>


</div> <!-- /form -->

<style>
.field-wrap label{
   display: block !important;
}</style>

		</div>
	  </div>
   </div>
</section>
@endsection
@section('js')
<script>
        jQuery(document).ready(function($){
            $('#contact-form').validate({
                rules: {
                    name: {
                        minlength: 2,
                        required: true
                    },
                    email: {
                        required: true,
                        email: true
                    },
                    phone: {
                        minlength: 2,
                        required: true
                    },
                    message: {
                        minlength: 2,
                        required: true
                    }
                },
                messages: {
                    name:{
                        minlength: '字數不足',
                        required: '必填'
                    },
                    email:{
                        required: '必填',
                        email: '電子郵件格式錯誤'
                    },
                    phone:{
                        minlength: '字數不足',
                        required: '必填'
                    },
                    message:{
                        minlength: '字數不足',
                        required: '必填'
                    }
                },
                highlight: function (element) {
                    $(element).closest('.control-group').removeClass('success').addClass('error');
                },
                success: function (element) {
                    element.text('格式正確!').addClass('valid')
                        .closest('.control-group').removeClass('error').addClass('success');
                }
            });
        });
</script>
@endsection

