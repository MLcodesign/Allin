@extends('layouts.frontend.single')

@section('title', '會員儲值 Deposit')

@section('css')
    {!! Html::style('assets/plugins/pricingTable/pricingTable.min.css') !!}
<style>
@media all and (min-width:991px){
.vpt_plan-container.col-md-3.col-md-offset-2{margin-left:11%}
}
</style>
@endsection

@section('content')


<!-- start pricing -->
    <section id="inner_content">
        <div class="container">
            <div class="row">
				<div class="col-md-12 text-center" style="padding-bottom:12px;">
				   <h1><b>會員儲值</b></h1>
				   <h4 class="subtitle">DEPOSIT</h4>
				   <p class="y_line"></p>
				</div>
                <div class="col-md-12 wow bounceIn">

                </div>
                <div class="row">
                    <div class="col-md-12">
                        @if (session('payment') == 'failed')
                            <div class="alert alert-danger">
                                Transaction failed! Please try again
                            </div>
                        @elseif (session('payment') != '')
                        <div class="alert alert-success">
                            {{ Session::get('payment') }}
                        </div>
                        @endif
                        @foreach($pricings as $i => $pricing)
                            <div class="vpt_plan-container col-md-3 {{ $pricing->featured == 1 ? 'featured' : '' }} {{ $i==0 ? 'col-md-offset-2' : 'no-margin' }} " {{ $i==0 ? 'style=padding-right:0' : '' }}>
                                <ul class="vpt_plan drop-shadow {{ $pricing->featured == 1 ?'bootstrap-vtp-orange':'bootstrap-vpt-green' }} hover-animate-position {{ $pricing->featured == 1 ? 'featured' : '' }}">
                                    <li class="vpt_plan-name"><strong>{{ $pricing->name }}</strong></li>
                                    <li class="vpt_plan-price"><span class="vpt_year"><i
                                                    class="fa fa-dollar"></i></span>{{ $pricing->gift_amount }}
                                       </li>
                                    <li class="vpt_plan-footer"><a target="_blank" href="{{ url('/package/subscribe/'.$pricing->id) }}" data-id="{{ $pricing->id }}" class="pricing-select">立即儲值</a></li>
												<li><p></p></li>
												<li  class="vptbg">儲值金額: {{ $pricing->gift_amount }}{{ getSetting('DEFAULT_CURRENCY') }}</li>
                                                <li>兌換點數: {{ $pricing->redeem_points }}</li>
												<li  class="vptbg">贈送點數: {{ $pricing->get_points }}</li>
												<li><p></p></li>

                                </ul>
                            </div>
                        @endforeach
                    </div>
<div class="col-xs-12" style="text-align:center">
                    <div class="col-xs-12" style="text-align:center">
<img src="{{url('/assets/dist/img/paay2go.png')}}"/> <br/>
本站使用智付寶加密安全金流，進入後可選擇 信用卡、WEB ATM、ATM 轉帳、條碼繳費、超商代碼繳費。

        </div>
                </div>
            </div>
        </div>
    </section>
    <!-- end pricing -->


@endsection

@section('js')


@endsection
