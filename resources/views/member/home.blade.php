@extends('layouts.frontend.member.app')

@section('title', '會員中心  My Account')

@section('css')
{!! Html::style('/assets/plugins/lightbox/css/lightbox.css') !!}
 {!! Html::style('/assets/plugins/pricingTable/pricingTable.min.css') !!}
<style>
ul>li{line-height:30px}
div#cardInfoForm div.div-td.boxful-payment-title{
	vertical-align: middle;
}

@media all and (min-width:991px){
.vpt_plan-container.col-md-3.col-md-offset-2{margin-left:11%}
}

</style>
@endsection
@section('content')
@if (Session::has('success'))
    
    <div class="alert alert-success" role="alert">
        {{ Session::get('success') }}
    </div>

@endif

@if (Session::has('invalidcoupon'))
    
    <div class="alert alert-success" role="alert">
        {{ Session::get('invalidcoupon') }}
    </div>

@endif
<div class="row boxfulForm" style="padding-top:0px !important">
 @if (session('status'))
<div class="alert alert-success"> {{ session('status') }} </div>
@endif
@if (session('warning'))
<div class="alert alert-warning"> {{ session('warning') }} </div>
@endif

<div class="col-md-12 text-center" style="padding-bottom:12px;">
        <h1><b>會員中心</b></h1>
        <h4 class="subtitle">MY ACCOUNT</h4>
        <p class="y_line"></p>
     <h3 class="text-center">您還有 {{ round($credit) }} 剩餘點數</h3>
 </div>

  <div id="tabs">
    <ul style="padding: 0;" class="titleOption">
      <?php /*<li class="sectiontitle "><a href="#schedule">我的懶人倉</a></li> */ ?>
      <li class="sectiontitle "><a id="triggermeformagic" href="#desposit">會員儲值</a></li> 
	  <li class="sectiontitle "><a href="#my-info">我的資料</a></li> 
      <li class="sectiontitle "><a href="#invoice">帳單紀錄</a></li>
      <li class="sectiontitle "><a href="#coupon">優惠碼</a></li>
      <li class="sectiontitle "><a href="#referal">推薦碼</a></li>
    </ul>
    <?php /*<div id="schedule">
      <div class="div-table" style="width: 100%; padding-top: 0px;">
        <div class="div-tr">
          <div id="cardInfoForm" class="div-td schedule">
            <div class="morebox-questions"><span class="morebox-yellowBottom">懶人倉</span>租用中</div>
            <div class="table-responsive">
              <table class="table table-striped table-bordered table-hover" style="margin:20px auto">
                <thead>
                  <tr>
                    <th>訂單編號</th>
                    <th>狀態</th>
                    <th>空箱日期</th>
					<th>起租日期</th>

                    <th>箱子名稱</th>
                    <th>照片預覽</th>
					<th>月租費</th>
                    <th>倉庫清點</th>
                    <th>即時影像</th>
                  </tr>
                </thead>
                <tbody>

                @foreach($orders as $i => $order)
                <?php if($order->status == 3) continue; ?>
                <tr>
                  <td># {{$order->id}}</td>
                  <td><label class="label label-{{$order_status_color[$order_status[$order->status]]}}">{{ $order_status[$order->status] }}</label></td>
                  <td style="">{{$order->pickup_date}}</td>
          <td style="">{{$order->shipping_date}}</td>

                  <td><ul style="margin:0; list-style:none; padding:0">
                      @foreach($boxes[$order->id] as $box)
                      <li style="line-height:30px">{{ $box->name }}</li>
                      @endforeach
                    </ul></td>
                  <td><ul style="margin:0; list-style:none; padding:0">
                      @foreach($boxes[$order->id] as $box)
                     <li><a href="@if('' !== $box->image)/uploads/boxes/{{ $box->image }} @else {{ url('/assets/dist/img/box5_s.png')}} @endif" data-lightbox="example-1"><img src="@if('' !== $box->image)/uploads/boxes/{{ $box->image }} @else {{ url('/assets/dist/img/box5_s.png') }} @endif" style="height:24px; margin:3px" width="auto" height="20"/></a></li>
                      @endforeach
                    </ul></td>
					<td>{{ $order->monthly_cost }}</td>
                  <td><ul style="margin:0; list-style:none; padding:0">
                      @foreach($boxes[$order->id] as $box)
                      <li style="line-height:30px">
                        <input type="checkbox" @if($box->
                        arrived) {{ 'checked' }} @endif disabled /></li>
                      @endforeach
                    </ul></td>
                  <td><label class="label label-info">{{ $order->amt_service }}</label></td>
                </tr>
                @endforeach
                  </tbody>

              </table>
            </div>
            <div class="morebox-questions"><span class="morebox-yellowBottom">懶人倉</span>使用狀態</div>
            <div class="div-table" style="width:100%">
              <div class="div-tr">
                <div class="div-td"> <span id="boxAmt"> 您有 <span id="boxAmts" style="color: #00c5b4">{{ count($all_boxes) }}</span> 箱正在懶人倉 </span> </div>
              </div>
            </div>
            <br>
            <br>
            <div class="clear"></div>
            <div class="morebox-questions"><span class="morebox-yellowBottom">歷史</span>紀錄</div>
            <div class="table-responsive">
              <table class="table table-striped table-bordered table-hover" style="margin:20px auto">
                <thead>
                  <tr>
                    <th>訂單編號</th>
                    <th>狀態</th>
                    <th>空箱日期</th>
					<th>起租日期</th>

                    <th>箱子名稱</th>
                    <th>照片預覽</th>
					<th>月租費</th>
                    <th>倉庫清點</th>
                    <th>即時影像</th>
                  </tr>
                </thead>
                <tbody>

                @foreach($orders as $i => $order)
                <?php if($order->status != 3) continue; ?>
                <tr>
                  <td># {{$order->id}}</td>
                  <td><label class="label label-{{$order_status_color[$order_status[$order->status]]}}">{{ $order_status[$order->status] }}</label></td>
                  <td style="">@if($order->pickup_date !== ''){{$order->pickup_date}} @else - @endif</td>
					<td style="">@if($order->shipping_date !== '') {{$order->shipping_date}} @else - @endif</td>

                  <td><ul style="margin:0; list-style:none; padding:0">
                      @foreach($boxes[$order->id] as $box)
                      <li style="line-height:30px">{{ $box->name }}</li>
                      @endforeach
                    </ul></td>
                  <td><ul style="margin:0; list-style:none; padding:0">
                      @foreach($boxes[$order->id] as $box)
                      <li><a href="@if('' !== $box->image)/uploads/boxes/{{ $box->image }}@endif" data-lightbox="example-1"><img src="@if('' !== $box->image)/uploads/boxes/{{ $box->image }}@endif" style="height:24px; margin:3px" width="auto" height="20"/></a></li>
                      @endforeach
                    </ul></td>
					<td>{{ $order->monthly_cost }}</td>
                  <td><ul style="margin:0; list-style:none; padding:0">
                      @foreach($boxes[$order->id] as $box)
                      <li style="line-height:30px">
                        <input type="checkbox" @if($box->
                        arrived) {{ 'checked' }} @endif disabled /></li>
                      @endforeach
                    </ul></td>
                  <td><label class="label label-info">{{ $order->amt_service }}</label></td>
                </tr>
                @endforeach
                  </tbody>

              </table>
            </div>
          </div>
        </div>
      </div>
    </div> */ ?>
    <div id="my-info">
      <div class="div-table" style="width: 100%; padding-top: 0px;">
        <div class="div-tr">
          <div id="cardInfoForm" class="div-td"> <span class="profile-edit">
            <form id="member-profile-update" action="" method="put" class="form-validate form-horizontal " enctype="multipart/form-data">

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
                  <div class="div-td boxful-payment-title" style="width: 145px;display: table-cell;">Email</div>
                  <div class="div-td">
                    <input disabled type="text" readonly class="form-control" value="{{ null !== Auth::user()->email ? Auth::user()->email : '' }}" />
                  </div>
                </div>
				
                <div class="div-tr">
                  <div class="div-td boxful-payment-title">姓名</div>
                  <div class="div-td">
                    <input type="text" placeholder="請輸入您的正確姓名，以供物流收送貨。" aria-required="true" required="required" class="form-control required" value="{{ null !== Auth::user()->name ? Auth::user()->name : '' }}" name="name" aria-invalid="false" required />
                  </div>
                </div>
                <div class="div-tr">
                  <div class="div-td boxful-payment-title">聯絡電話</div>
                  <div class="div-td">
                    <input type="tel" class="form-control" value="{{ null !== Auth::user()->mobile ? Auth::user()->mobile : '' }}" name="mobile">
                  </div>
                </div>
                <div class="div-tr">
                  <div class="div-td boxful-payment-title"></div>
                  <div class="div-td" style="text-align: right;">
                    <button type="submit" class="btn btn-primary validate"><span>更新</span></button>
                  </div>
                </div>
              </div>
			  </form>
              <div class="boxful-card-payment">地址資訊</div>
			  <form id="member-address" action="" method="put" class="form-validate form-horizontal " enctype="multipart/form-data">

            {!! csrf_field() !!}
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
           data-value="{{ null !== Auth::user()->county ? Auth::user()->county : '' }}"
           data-style="county form-control" class="div-td"> </div>
                      <div data-role="district"
           id = "district"
           data-name="district"
           data-value="{{ null !== Auth::user()->district ? Auth::user()->district : '' }}"
           data-style="district form-control" class="div-td"> </div>
		   
                      <div data-role="zipcode"
           data-name="zipcode"
           id = "zipcode"
           data-value="{{ null !== Auth::user()->zipcode ? Auth::user()->zipcode : '' }}"
           data-style="zipcode form-control" class="div-td"> </div>
		   </div>
                    </div>
                  </div>
                </div>
                <div class="div-tr">
                  <div class="div-td boxful-payment-title">地址 </div>
                  <div class="div-td">
                    <input name="address" type="text" class="form-control" value="{{ null !== Auth::user()->address ? Auth::user()->address : '' }}" />
                  </div>
                </div>
				<div class="div-tr">
                  <div class="div-td boxful-payment-title"></div>
                  <div class="div-td" style="text-align: right;">
                    <button type="submit" class="btn btn-primary validate"><span>更新</span></button>
                  </div>
                </div>
              </div>
			  </form>
			  
              <div class="div-table billing" style="width: 80%"> </div>
              <div class="boxful-card-payment">更改密碼</div>
			  <form id="member-profile" action="" method="post" class="form-validate form-horizontal " enctype="multipart/form-data">

            {!! csrf_field() !!}
              <div class="div-table billing" style="width: 80%">
			  <div class="div-tr">
					<div class="div-td"></div>
					<div class="div-td">
						<div id="alert-success-profile" class="alert" style="display: none;"></div>
					</div>
				</div>
				
                <div class="div-tr">
                  <div class="div-td boxful-payment-title" style="width: 145px;display: table-cell;">原密碼</div>
                  <div class="div-td">
                    <input type="password" maxlength="99" size="30" class="form-control validate-password" autocomplete="off" value="" name="current_password" placeholder="(僅可輸入6~12位英數字組合，大小寫有區別，不含特殊符號) *">
                  </div>
                </div>				
                <div class="div-tr">
                  <div class="div-td boxful-payment-title" style="width: 145px;display: table-cell;">新密碼</div>
                  <div class="div-td">
                    <input type="password" maxlength="99" size="30" class="form-control validate-password" autocomplete="off" value="" id="password" name="password" placeholder="(僅可輸入6~12位英數字組合，大小寫有區別，不含特殊符號) *">
                  </div>
                </div>
                <div class="div-tr">
                  <div class="div-td boxful-payment-title" style="width: 145px;display: table-cell;">再次確認</div>
                  <div class="div-td">
                    <input type="password" maxlength="99" size="30" class="form-control validate-password" autocomplete="off" value="" name="password_confirm" placeholder="(僅可輸入6~12位英數字組合，大小寫有區別，不含特殊符號) *">
                  </div>
                </div>
                <div class="div-tr">
                  <div class="div-td boxful-payment-title"></div>
                  <div class="div-td" style="text-align: right;">
                    <button type="submit" class="btn btn-primary validate"><span>更新</span></button>
                  </div>
                </div>
              </div>
            </form>
            </span> </div>
        </div>
      </div>
    </div>
    <div id="invoice">
      <div class="div-table" style="width: 100%; padding-top: 0px;">
        <div class="div-tr">
          <div id="cardInfoForm" class="div-td schedule" style="width: 80%;">
            <div class="morebox-questions">金流儲值記錄</div>
            <div class="div-table billing" style="width:100%">
              <div id="invoiceContent">
                <div class="table-responsive" id="scroll_table">
                  <table class="table table-striped table-bordered table-hover" style="margin:20px auto">
                    <thead>
                      <tr>
                        <th>交易編號</th>
                        <th>交易日期</th>
                        <th>繳款日期</th>
                        <th>儲值金額</th>
                        <th>紅利點數</th>
                        <th>付款方式</th>
                        <th>付款狀態</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php $sum = 0; ?>    
                    @foreach($payments as $i => $payment)
                    <tr>
                      <td> #{{ $payment->temp_order_number }} </td>
                      <td>{{$payment->create_t}}</td>
                      <td>{{$payment->payment_time}}</td>
                      <td> {{ $payment->amount }} </td>
                      <td> {{ $payment->total_payment - $payment->amount }} </td>
                      <td> {{ $payment->payment_type }} </td>
                      <td>@if(NULl !== $payment_status[$payment->status]) {{ $payment_status[$payment->status] }} @else {{ $payment->status }} @endif</td>
                      <?php $sum += $payment->total_payment; ?>
                    </tr>
                    @endforeach
                    <tr>
                      <td>合計</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td> {{ $sum }} </td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                    </tr>                    
                      </tbody>

                  </table>
                </div>
              </div>
            </div>
            <div class="clear"></div>
          </div>
        </div>
 

        <!-- 帳單記錄 Start -->
        <div class="div-tr">
          <div id="cardInfoForm" class="div-td schedule" style="width: 80%;">
            <div class="morebox-questions">帳單紀錄</div>
            <div class="div-table billing" style="width:100%">
              <div id="invoiceContent">
                <div class="table-responsive" id="scroll_table">
                  <table class="table table-striped table-bordered table-hover" style="margin:20px auto">
                    <thead>
                      <tr>
                        <th>訂單編號</th>
                        <th>月租費</th>
                        <th>運費</th>
                        <th>上樓搬運費</th>
                         <th>總扣點</th>
                        <th>扣點日期</th>
                        <th>剩餘點數</th>
                        <th>結存點數</th>

                      </tr>
                    </thead>
                    <tbody>

                    @foreach($subscriptions as $i => $subscription)
                    <tr>
                      <td> #{{ $subscription->order_id }} </td>
                      <td> {{$subscription->monthly_cost}}</td>
                      <td> {{ $subscription->shipping_fee }} </td>
                      <td> {{ $subscription->floor_fee }} </td>
                      <td> {{ $subscription->billing_amount}} </td>
                      <td> {{ $subscription->created_at }} </td>
                      <td>{{ $subscription->original_credit }}</td>
                      <td>{{ $subscription->original_credit - $subscription->billing_amount }}</td>
                    </tr>
                    @endforeach
                      </tbody>

                  </table>
                </div>
              </div>
            </div>
            <div class="clear"></div>
          </div>
        </div>
        <!-- 帳單記錄 End -->
      </div>
    </div>
	<div id="desposit">
     
	    <div class="row">
				<div class="col-md-12 text-center" style="padding-bottom:12px;">
				   
				 
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
                        <?php if(isset($pricings)): ?>
							@foreach($pricings as $i => $pricing)
                            <div class="vpt_plan-container col-md-3 {{ $pricing->featured == 1 ? 'featured' : '' }} {{ $i==0 ? 'col-md-offset-2' : 'no-margin' }} " {{ $i==0 ? 'style=padding-right:0' : '' }}>
                                <ul class="vpt_plan drop-shadow {{ $pricing->featured == 1 ?'bootstrap-vtp-orange':'bootstrap-vpt-green' }} hover-animate-position {{ $pricing->featured == 1 ? 'featured' : '' }}">
                                    <li class="vpt_plan-name"><strong>{{ $pricing->name }}</strong></li>
                                    <li class="vpt_plan-price"><span class="vpt_year"><i
                                                    class="fa fa-dollar"></i></span>{{ $pricing->gift_amount }}
                                       </li>
                                    <li class="vpt_plan-footer"><a target="_blank" href="{{ url('/package/subscribe/'.$pricing->id) }}" data-id="{{ $pricing->id }}" class="pricing-select">立即儲值</a></li>
												<li><p></p></li>
												<li  class="vptbg">儲值金額: {{ $pricing->gift_amount }} 元</li>
                                                <li>兌換點數: {{ $pricing->redeem_points }}</li>
												<li  class="vptbg">贈送點數: {{ $pricing->get_points }}</li>
												<li><p></p></li>

                                </ul>
                            </div>
							@endforeach
						<?php endif; ?>
                    </div>
<div class="col-xs-12" style="text-align:center">
                    <div class="col-xs-12" style="text-align:center">
<img src="{{url('/assets/dist/img/paay2go.png')}}"/> <br/>
本站使用智付寶加密安全金流，進入後可選擇 信用卡、WEB ATM、ATM 轉帳、條碼繳費、超商代碼繳費。

        </div>
                </div>
            </div>
        </div>
	 
	 
    </div>
    <div id="coupon">
      <div class="referralWallet">
      
		 
		 
		 
		  <?php if ($bhfy == 0) { ?>
		  
		   
		  
		   <div class="morebox-questions"><span class="morebox-yellowBottom">首次登入</span>優惠碼</div>
		 <div class="refFdContainer">
          <div class="refFdContainerText"> 登錄優惠碼，送您{{ $inspoint }}點! </div>
          <div class="refFdContainerButton">
            <div class="refFdButton"> <a id="refFd" href="" class="referral-show">馬上兌換</a> </div>
          </div>
        </div>		
        <div class="referral_box fngfgf" style="display: none;">
          <div class="col-md-6">
            <img src="/assets/dist/img/referral.png">
          </div>
          <div class="col-md-6">
            <div class="share-promo">
              <span>登錄優惠碼</span>
              <h4>{{ Auth::user()->coupon_code}}</h4>
            </div>
            <form action="/new-user-coupon" method="post">
            {!! csrf_field() !!}
              <input type="text" name="reqcouponcode" placeholder="輸入首次登入會員專用優惠碼" required>
              <button>兌換</button>
            </form>
          </div>
          <div style="clear: both;"></div>
        </div>    
    
		 <?php } ?>
		 
		 
		 
		 
		 
	
		
        <div class="morebox-questions"><span class="morebox-yellowBottom">點數調</span>整紀錄</div>
        <div class="summaryContainer">

            <table class="table table-striped table-bordered table-hover" style="margin:20px auto">
              <thead>
                <tr>
                 <th>使用日期</th>
				<th>調整類別</th>
				<th>內容描述</th>
				<th>點數</th>
				<th>儲值紀錄</th>
				<th>調整後點數餘額</th>
               
                </tr>
              </thead>
              <tbody>				
              @foreach($depo as $deposit)
              <tr>
                <td>{{Carbon\Carbon::parse($deposit->created_at)->format('d-m-Y')}}</td>
				<td>{{$deposit->api_memo_note}}</td>
				<td>{{$deposit->api_system_note}}</td>
                <td>{{$deposit->p_cnt}}</td>
				<td>{{$deposit->pay_amt}}</td>
				<td>{{$deposit->user_credit}}</td>
              </tr>
              @endforeach
                </tbody>

            </table>
        </div>
      </div>
  
        <!-- table1 扣點記錄 Start -->      
         <div class="">
          <div id="cardInfoForm1" class="div-td1 schedule">
            <div class="morebox-questions"><span class="morebox-yellowBottom">取消還點記錄</span></div>
            <div class="div-table billing" style="width:100%">
              <div id="invoiceContent">
                <div class="table-responsive" id="scroll_table">
                  <table class="table table-striped table-bordered table-hover" style="margin:20px auto">
                    <thead>
                      <tr>
                        <th>交易編號</th>
                        <th>交易日期</th>
                        <th>返還點數</th>
                        <th>交易類別</th>
                        <th>關連代碼</th>
                        <th>註記</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php $sum = 0; ?>    
                    @foreach($deposits as $i => $de)
                    <tr>
                      <td> #{{ $de->id }} </td>
                      <td> {{ $de->created_at}}</td>
                      <td> {{ $de->p_cnt}}</td>
                      <td> {{ $de->getCategory()->name }} </td>
                      <td> {{ $de->api_key }} </td>
                      <td> {{ $de->api_memo_note }} </td>
                      <?php $sum += $de->p_cnt; ?>
                    </tr>
                    @endforeach
                    <tr>
                      <td>合計</td>
                      <td>&nbsp;</td>
                      <td> {{ $sum }} </td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                    </tr>                    
                      </tbody>

                  </table>
                </div>
              </div>
            </div>
            <div class="clear"></div>
          </div>
        </div>
        <!-- table1 扣點記錄 End -->          
        <!-- table2 扣點記錄 Start -->
        <div class="">
          <div id="cardInfoForm1" class="schedule">
            <div class="morebox-questions"><span class="morebox-yellowBottom">扣點紀錄</span></div>
            <div class="div-table billing" style="width:100%">
              <div id="invoiceContent">
                <div class="table-responsive" id="scroll_table">
                  <table class="table table-striped table-bordered table-hover" style="margin:20px auto">
                    <thead>
                      <tr>
                        <th>扣點編號</th>
                        <th>扣點類別</th>
                        <th>扣點日期</th>
                        <th>對應訂單</th>
                        <th>點數</th>
                        <th>備註</th>

                      </tr>
                    </thead>
                    <tbody>

                    <?php $sum = 0; ?>    
                    @foreach($exchanges as $i => $ex)
                    <tr>
                      <td> {{ $ex->id }} </td>
                      <td> {{ $ex->getCategory()->name }} </td>
                      <td> {{ $ex->created_at }} </td>
                      <td> @if($ex->op_type == "system")
                      新建單
                      @else
                      退倉物流
                      @endif #{{ $ex->api_key }} </td>
                      <td> {{ $ex->p_cnt}} </td>
                      <td> {{ $ex->api_memo_note }}</td>
                      <?php $sum += $ex->p_cnt; ?>
                    </tr>
                    @endforeach
                    
                    <tr>
                      <td>合計</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td> {{ $sum }} </td>
                      <td>&nbsp;</td>
                    </tr>
                      </tbody>

                  </table>
                </div>
              </div>
            </div>
            <div class="clear"></div>
          </div>
        </div>
        <!-- table2 扣點記錄 End -->      
    </div>		
		
    <div id="referal">
      <div class="referralWallet">
        <div class="morebox-questions"><span class="morebox-yellowBottom">推薦</span>朋友</div>
        <div class="refFdContainer">
          <div class="refFdContainerText"> 推薦給朋友{{ getSetting('REFERAL_AMOUNT') }}點，您就可以獲得{{ getSetting('BOUNS_AMOUNT') }}點! </div>
          <div class="refFdContainerButton">
            <div class="refFdButton"> <a id="refFdOrig" href="" class="referral-show">馬上推薦</a> </div>
          </div>
        </div>
        <div class="referral_box" style="display: none;">
          <div class="col-md-6">
            <img src="/assets/dist/img/referral.png">
          </div>
          <div class="col-md-6">
            <div class="share-promo">
              <span>分享您的推薦碼</span>
              <h4>{{ Auth::user()->referal_code}}</h4>
            </div>
            <form action="/member/referrals/send" method="post">
            {!! csrf_field() !!}
              <textarea name="referral_emails" placeholder="輸入朋友的Email, 用逗點分隔開不同的Email" required oninvalid="this.setCustomValidity('請輸入Email')"></textarea>
              <button>Email分享推薦碼</button>
            </form>
          </div>
          <div style="clear: both;"></div>
        </div>
		
		
		
		<!--Apply Referral code here-->
		<?php if ($referral_check ) { ?>
		
		   <div class="morebox-questions"><span class="morebox-yellowBottom">使用推薦碼</span></div>
		 <div class="refFdContainer">
          <div class="refFdContainerText"> 登錄優惠碼，送您{{ getSetting('REFERAL_AMOUNT') }}點! </div>
          <div class="refFdContainerButton">
            <div class="refFdButton"> <a id="apply-referral" href="" class="referral-show">馬上兌換</a> </div>
          </div>
        </div>		
        <div class="referral_box fngfgf" id="apply_referral_box" style="display: none;">
          <div class="col-md-6">
            <img src="/assets/dist/img/referral.png">
          </div>
          <div class="col-md-6">
            <div class="share-promo">
              <span>登錄推薦碼</span>
              <h4>{{ Auth::user()->coupon_code}}</h4>
            </div>
            <form action="/member/referrals/apply" method="post">
            {!! csrf_field() !!}
              <input type="text" name="referral_code" placeholder="請輸入推薦碼" required>
              <button>兌換</button>
            </form>
          </div>
          <div style="clear: both;"></div>
        </div>    
    
		 <?php } ?>
		
        <div class="morebox-questions"><span class="morebox-yellowBottom">推薦碼</span>紀錄</div>
        <div class="summaryContainer">
            <table class="table table-striped table-bordered table-hover" style="margin:20px auto">
              <thead>
                <tr>
                  <th>推薦給</th><!-- receiver person Email -->
				  <th>推薦人</th><!-- Referral person Email -->
                  <th>推薦金額</th><!-- referral_amount -->
                  <th>紅利點數</th><!-- bonus_amount -->
                  <th>朋友使用日期</th><!-- date -->
                </tr>
              </thead>
              <tbody>
				  @foreach($referrals as $referral)
				  <tr>
					<td>{{App\User::find(($referral->user_id))->email}}</td>
					<td>{{App\User::find(($referral->referral_id))->email}}</td>
					<td>{{$referral->referral_amount}}</td>
					<td>{{$referral->bouns_ammount}}</td>
					<td>{{$referral->created_at}}</td>
				  </tr>
				  @endforeach
                </tbody>

            </table>
        </div>
      </div>
    </div>		

 
  </div>
</div>
@endsection
@section('js')
{!! Html::script('/assets/plugins/lightbox/js/lightbox.js') !!}
<script src="{{ url('/assets/dist/js/jquery.twzipcode.min.js') }}" type="text/javascript"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.15.0/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.15.0/additional-methods.min.js"></script>
<script>
/*window.onload = function() {
    // short timeout
    setTimeout(function() {
        $(document.body).scrollTop(0);
    }, 15);
};*/
$(function(){
	$('body,html').animate({
		scrollTop: 0
	}, 800);
	return false;
});
$( document ).ready(function() {
    $( "#refFd" ).click(function() {
      $('.fngfgf').show('fast');
      return false;
    });	
    
    $( "#refFdOrig" ).click(function() {
      $('.referral_box').show('fast');
      return false;
    }); 
	
	$( "#apply-referral" ).click(function() {
      $('#apply_referral_box').show('fast');
      return false;
    });    
	
	 $( ".referral-show-two" ).click(function() {
      $('.boxtworef').show('fast');
      return false;
    });	
	var screen_W=$(window).width();
	$(".table-responsive#scroll_table").css("width",screen_W); 
	
});

/* Javascript */
  $('#twzipcode').twzipcode();

 /* jQuery(document).ready(function($){

    $('input[name="password_confirm"]').change(function(e) {

            if($(this).val() !== $('input[name="password"]').val()) alert('Password missmatch!!!')
        });
  }) */
  
	jQuery.validator.setDefaults({
	  debug: true,
	  success: "valid"
	});
	
	$( "#member-profile-update" ).validate({
		ignore: '*:not([name])',
	  rules: {
		name: {
			required : true,
		},
		mobile: {
			required : true,
			minlength: 8,
			maxlength: 15
		}
	  },
	  messages : {
		  name : {
				required : "欄位必填"
			},
		  mobile : {
				required : '欄位必填',
		  }
		},
	  submitHandler: function(form) {
		  $.ajax({
			  'url' : "{!! URL::to('member/profile') !!}",
			  'method' : 'put',
			  'data' : $(form).serialize(),
			  'success' : function(response){
				  if(response.status == "true"){
					  $('#alert-success-profile-update').removeClass('alert-danger');
					  $('#alert-success-profile-update').addClass('alert-success');
					  $('#alert-success-profile-update').html('');
					  $('#alert-success-profile-update').html(response.message);
					  $('#alert-success-profile-update').show();
					  /*setTimeout(function() {						  
					  $('#alert-success-update').html('');
					  $('#alert-success-update').html(response.message);
					  $('#alert-success-update').show();
					  // $('#alert-success-update').slideUp('slow');
					}, 5000);*/
				  } else{
					  $('#alert-success-profile-update').removeClass('alert-success');
					  $('#alert-success-profile-update').addClass('alert-danger');
					  $('#alert-success-profile-update').html(response.message);
					  $('#alert-success-profile-update').show();
				  }
			  }
		  });
	  }
	});
	
	$( "#member-address" ).validate({
		ignore: '*:not([name])',
	  rules: {
		county: {
			required : true,
		},
		district: {
			required : true,
		},
		zipcode: {
			required: true,
		}
	  },
	  messages : {
		  county : {
				required : "欄位必填"
			},
		  district : {
				required : '欄位必填'
		  },
		  zipcode : {
				required : '欄位必填'
			},
		},
	  submitHandler: function(form) {
		  $.ajax({
			  'url' : "{!! URL::to('member/profile') !!}",
			  'method' : 'put',
			  'data' : $(form).serialize(),
			  'success' : function(response){
				  if(response.status == "true"){
					  $('#alert-success-address').removeClass('alert-danger');
					  $('#alert-success-address').addClass('alert-success');
					  $('#alert-success-address').html('');
					  $('#alert-success-address').html(response.message);
					  $('#alert-success-address').show();
					  /*setTimeout(function() {						  
					  $('#alert-success-address').html('');
					  $('#alert-success-address').html(response.message);
					  $('#alert-success-address').show();
					   //$('#alert-success-address').slideUp('slow');
					}, 5000);						*/
				  } else{
					  $('#alert-success-address').removeClass('alert-success');
					  $('#alert-success-address').addClass('alert-danger');
					  $('#alert-success-address').html(response.message);
					  $('#alert-success-address').show();
				  }
			  }
		  });
	  }
	});
	
	$( "#member-profile" ).validate({
		ignore: '*:not([name])',
	  rules: {
		current_password: {
			required : true,
		},
		password: {
			required : false,
			minlength: 6,
			maxlength: 12,
			pattern: /^.*(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\X]).*$/,
		},
		password_confirm: {
			required: false,
			equalTo: "#password",
			minlength: 6,
			maxlength: 12,
			pattern: /^.*(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\X]).*$/,
			
		}
	  },
	  messages : {
		  current_password : {
				required : "欄位必填"
			},
		  password : {
				required : '欄位必填',
				minlength : '您的密碼格式不正確，請重新輸入！ 僅可輸入6~12位英數字組合，大小寫有區別，不含特殊符號',
				maxlength : '您的密碼格式不正確，請重新輸入！ 僅可輸入6~12位英數字組合，大小寫有區別，不含特殊符號',
				pattern : '您的密碼格式不正確，請重新輸入！ 僅可輸入6~12位英數字組合，大小寫有區別，不含特殊符號',
		  },
		  password_confirm : {
				required : '欄位必填',
				equalTo : '請確認密碼輸入一致',
				minlength : '您的密碼格式不正確，請重新輸入！ 僅可輸入6~12位英數字組合，大小寫有區別，不含特殊符號',
				maxlength : '您的密碼格式不正確，請重新輸入！ 僅可輸入6~12位英數字組合，大小寫有區別，不含特殊符號',
				pattern : '您的密碼格式不正確，請重新輸入！ 僅可輸入6~12位英數字組合，大小寫有區別，不含特殊符號',
			},
		},
	  submitHandler: function(form) {
		  var old = $("input[name=current_password]").val();
		  var newpass = $("input[name=password]").val();
		  $.ajax({
			  'url' : "{!! URL::to('member/profile/changepassword') !!}",
			  'method' : 'get',
			  'data' : { 'current_password' : old, 'password' : newpass },
			  'success' : function(response){
				  if(response.status == "true"){
					  $('#alert-success-profile').removeClass('alert-danger');
					  $('#alert-success-profile').addClass('alert-success');
					  setTimeout(function() {						  
					  $('#alert-success-profile').html('');
					  $('#alert-success-profile').html(response.message);
					  $('#alert-success-profile').show();
					  var url = "{!! URL::to('/logout') !!}";
						//location.herf = url;
					   $('#alert-success').slideUp('slow', window.location.replace(url));
					}, 5000);						
				  } else{
					  $('#alert-success-profile').removeClass('alert-success');
					  $('#alert-success-profile').addClass('alert-danger');
					  $('#alert-success-profile').html(response.message);
					  $('#alert-success-profile').show();
				  }
			  }
		  });
	  }
	});
</script>
@endsection

