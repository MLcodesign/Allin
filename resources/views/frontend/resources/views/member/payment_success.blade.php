@extends('layouts.frontend.app')

@section('title', 'Payment successfully')

@section('css')
<style>
    #hide, .pay
    {
        display: none;
    }
	/*#sideMenu{display:none !important}*/
</style>
@endsection

@section('content')

@if(isset($data_arr))
<section id="order">
謝謝您的儲值！智付寶金流會將相關付款資訊Email至您的信箱．

<ul>
<li>交易日期：{{ $data_arr['create_t'] }}</li>
<li>總計： NT${{ $data_arr['amount'] }}</li>
<li>方案： {{ $data_arr['package_name'] }}</li>
<li>付款方式：智付寶加密安全金流: {{$data_arr['payment_type']}}</li>
</ul>
</section>


@if($data_arr['nocoupon'] === true)
<hr>
<div class="formholder" >
<form class="form-horizontal AjaxForm" action="/normal-user-coupon" method="post">
            {!! csrf_field() !!}
  <div class="form-group">
    <label class="control-label col-sm-2" for="email">優惠碼：</label>
    <div class="col-sm-10">
      <input style="max-width: 300px;" type="text" class="form-control" required name="reqcouponcode" placeholder="請在此輸入優惠碼">
    </div>
  </div>
  
  <div class="form-group"> 
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" class="btn btn-default">立即兌換</button>
    </div>
  </div>
</form>
</div>
@endif



@endif
@endsection
@section('js')
<script>

$(document).on('submit', 'form.AjaxForm', function() {            
        $.ajax({
            url     : $(this).attr('action'),
            type    : $(this).attr('method'),
            dataType: 'json',
            data    : $(this).serialize(),
            success : function( data ) {
				
				  //alert(data['msg']);
				
				
				   if (data['msg'] == 'fail') {
					   
					   alert('優惠碼不存在，請重新輸入');
					   
				   } else {
					   
					   $('.formholder').html('<h3>優惠碼已加值成功！</h3>');
				   }
				
				
                         
            },
            error   : function( xhr, err ) {
                         alert('Error');     
            }
        });    
        return false;
    });

</script>
@endsection
