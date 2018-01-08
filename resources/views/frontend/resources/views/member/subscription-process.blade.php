@extends('layouts.frontend.app')

@section('title', 'Redirecting to subscription page....')

@section('css')
<style>
    .radio
    {
        overflow: hidden;
    }

    .relative
    {
        position: relative;
    }

    #hide, .pay
    {
        display: none;
    }
	#sideMenu{display:none !important}
</style>
@endsection

@section('content')
<h3>選擇付款方式</h3>
<!--<button type="button" id="payment_type_credit" class="btn btn-primary pay">Credit Card</button>
<button type="button" id="payment_type_web_atm" class="btn btn-primary pay">Web ATM</button>
<button type="button" id="payment_type_atm_transfer" class="btn btn-primary pay">ATM Transfer</button>
<button type="button" id="payment_type_payment_code" class="btn btn-primary pay">Payment Code</button>
<button type="button" id="payment_type_barcode_code" class="btn btn-primary pay">Barcode</button>-->
<form method="post" action="{{ $actionUrl }}">
    <span id="hide">正在導向智付通付款介面</span>
    @foreach($postData as $key => $val)
    <input type="hidden" name="{{$key}}" value="{{$val}}"/>
    @endforeach
    <button type="submit" id="submit" style="display:none">付款</button>
</form>
<?php
    //die();
?>
<section id="order">
<ul>
<li>日期：{{ date('d-m-Y') }}</li>
<li>總計： NT${{ $package->gift_amount }}</li>
<li>方案： {{ $package->name }}</li>
<li>付款方式：智付通加密安全金流</li>
</ul>
<p>3秒後會自動跳轉到智付通支付頁面…（請勿點選上一頁或重新整理頁面．）</p>
</section>
@endsection
@section('js')
    <script>
        jQuery(document).ready(function () {
            /*$.blockUI({ css: { 
                border: 'none', 
                padding: '15px', 
                backgroundColor: '#000', 
                '-webkit-border-radius': '10px', 
                '-moz-border-radius': '10px', 
                opacity: .5, 
                color: '#fff' 
            } }); 
            */
            var data = jQuery("#order").html();
            //alert(data);
            $.blockUI({ message: data });
     
            setTimeout($.unblockUI, 3000);  
            jQuery(document).on('click', '.pay', function () {
                var id = jQuery(this).attr('id');
                if (id != 'payment_type_credit')
                {
//                    jQuery('#notifyURL').val('');
//                    jQuery('#returnURL').val('');
                }
                jQuery('#submit').trigger('click');
            });
			setTimeout(function(){jQuery('#submit').trigger('click');}, 3000);
        });
    </script>
@endsection
