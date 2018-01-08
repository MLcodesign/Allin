@extends('emails.allin')

@section('title', '{{$subject}}')

@section('css')
<style>.errorinput{outline:2px solid #f00;}.disableinput{background-color:#d3d3d3!important;}.boxes{width:100%;}.boxes div{height:150px;float:left;}.box_photo{width:200px;}.box_title{width:200px;}.box_description{width:200px;}.box_button{width:200px;}div.clear{clear:both;}a{color:#000;}input#boxful-card-continue{margin-top:30px;height:50px;min-width:210px;font-size:14px;font-weight:bold;display:none;}input#boxful-card-continue:hover{background-color:#d3b022!important;color:#fff;}div.paypalRedirect{display:block;border:1px solid #000;margin:15px 0;padding:3%;text-align:center;background-color:#e9f8f7;}div.boxful-card-agree{margin-bottom:0px;text-align:center;background-color:#f7d33e;padding:10px 0;font-size:15px;}div.boxful-card-agree div{max-width:400px;margin:auto;text-align:left;}div.boxful-card-agree.zh-TW div{max-width:200px;}div#billing{height:32%;}div.preview-right div.preview-block.textarea{height:23.5%;}div #boxful-card div.div-table{padding-bottom:25px;}.preview-right div.preview-block.payment{border:1px solid;background-color:#fff;margin-bottom:0;padding-bottom:30px;min-height:130px;}div.preview-block.payment div.block-title{color:#000;}div.preview-block.payment div.block-left{width:10%;text-align:center;}div.preview-block.payment div.block-right{width:90%;text-align:left;}div.paymentOption{display:inline-block;width:49.5%;}div.paymentOption.left{text-align:left;}div.paymentOption.right{text-align:right;float:right;}div.paymentOptionContent{display:inline-block;vertical-align:middle;width:85%;text-align:center;line-height:32px;}div.paymentOptionContent img{height:25px;padding-top:0px;padding-right:0;width:auto;}img.payment-img{display:none;}div.card,div.paypal{display:inline-block;padding:5px 11%;border:1px solid;vertical-align:text-top;width:97%;}input[type="radio"]{margin:0;}div#creditCard{text-align:right;}div.BTformItem,div.BTformContent{display:inline-block;vertical-align:middle;}div.BTformItem{width:20%;}div.BTformContent.braintree-hosted-fields-invalid{border:2px solid #f00;}div.BTformContent.braintree-hosted-fields-focused{border:2px solid #e6e7e8;}div#card-number{position:relative;}div.BTformContent{width:73%;padding:0 2%;height:30px;border:2px solid #e6e7e8;border-radius:5px;}div.BTformContent#expiration-date{width:26%;padding:0 2%;}div.BTformItem.cvv{width:24.5%;}div.BTformContent#cvv{width:16%;padding:0 2%;}div#creditCard div.formRow{padding-top:20px;}input#BTsubmit{display:none;}div.paymentForm{display:none;}.paymentOption div.active{background-color:#e9f8f7;}.paymentOption div.active img.payment-img{display:inline-block;}.paymentOption div.active img.payment-img-grey{display:none;}div#boxful-paymentTable{display:none;}div.preview-block.priceSummary div.block-content{padding-top:0px;}.div-td.preview-right div.preview-block.withSummary{margin-bottom:0;padding-bottom:20px;}.div-td.preview-right div.preview-block.priceSummary{min-height:0;padding:10px 20px;background-color:#efeff0;border:2px solid #ffe207;font-weight:bold;}.div-td.preview-right div.preview-block.materialSummary div.block-middle,.div-td.preview-right div.preview-block.xlSummary div.block-middle{width:10%;}.div-td.preview-right div.preview-block.materialSummary div.block-right,.div-td.preview-right div.preview-block.xlSummary div.block-right{width:80%;}.div-td.preview-right div.preview-block.materialSummary div.block-right span.item span#material_amtsTotal,.div-td.preview-right div.preview-block.xlSummary div.block-right span.item span#storage_amtsTotal{color:#000;}div.preview-block.priceSummary div#afterDiscountTotal{font-size:18px;font-weight:bold;}div.preview-block.priceSummary div.block-content-row{color:#a6a8aa;}div.preview-block.priceSummary div.block-content-row.total{padding-top:5px;color:#000;}div.preview-block.priceSummary div.block-content-row.total div.note{font-size:12px;font-weight:normal;}div.preview-block.materialSummary div.block-content-row.total div.note,div.preview-block.xlSummary div.block-content-row.total div.note{font-style:italic;}div.preview-block.priceSummary .block-right span.item{color:#a6a8aa;}div.preview-block.materialSummary .block-right span.item,div.preview-block.xlSummary .block-right span.item{font-weight:bold;}div.creditCardNote{padding:30px 0;text-align:left;}div.creditCardNote div{display:inline-block;vertical-align:middle;margin:-3px;}div.creditCardNote div.creditCardNoteImg{width:30%;text-align:center;}div.creditCardNote div.creditCardNoteImg img{width:110px;}div.creditCardNote div.creditCardNoteText{width:70%;}.payment-method-icon{background-repeat:no-repeat;background-size:86px auto;height:28px;width:44px;display:inline-block;margin-top:0px;position:absolute;left:auto;right:14px;text-indent:-15984px;}.visa{background-image:url(https://assets.braintreegateway.com/dropin/1.4.0/images/2x-sf9a66b4f5a.png);background-position:0px -184px;}.master-card{background-image:url(https://assets.braintreegateway.com/dropin/1.4.0/images/2x-sf9a66b4f5a.png);background-position:0px -128px;}.american-express{background-image:url(https://assets.braintreegateway.com/dropin/1.4.0/images/2x-sf9a66b4f5a.png);background-position:0px -72px;}.jcb{background-image:url(https://assets.braintreegateway.com/dropin/1.4.0/images/2x-sf9a66b4f5a.png);background-position:0px -98px;}.maestro{background-image:url(https://assets.braintreegateway.com/dropin/1.4.0/images/2x-sf9a66b4f5a.png);background-position:0px -155px;}.discover{background-image:url(https://assets.braintreegateway.com/dropin/1.4.0/images/2x-sf9a66b4f5a.png);background-position:0px -285px;}div.paymentOptionContent img.visa-img,div.paymentOptionContent img.master-img{height:32px;}div.paymentOptionContent img.payment-img+img.payment-img,div.paymentOptionContent img.payment-img-grey+img.payment-img-grey{padding-left:15px;}div.div-table.preview-boxes div#material,div.div-table.preview-boxes div#storage{display:none;}div.div-table.preview-boxes div#item{display:block;}div.div-table.preview-xl div#material,div.div-table.preview-xl div#storage{display:block;}div.div-table.preview-xl div#item{display:none;}div.div-table.preview-xl .XLHide{display:none;}div.div-table.preview-xl .XLShow{display:block;}div.div-table.preview-boxes .XLHide{display:block;}div.div-table.preview-boxes .XLShow{display:none;}div.div-table.preview-xl img.XLHide{display:none;}div.div-table.preview-xl img.XLShow{display:inline-block;}div.div-table.preview-boxes img.XLHide{display:inline-block;}div.div-table.preview-boxes img.XLShow{display:none;}.preview-right div.preview-block.payment.bt{border-bottom:none;padding-bottom:24px;}.div-td.preview-right div.preview-block.paymentNote{display:none;padding:0 20px;min-height:0;background-color:#e9f8f7;border-top:none;padding-bottom:1px solid #000;}div.preview-block.payment.bt+div.preview-block.paymentNote{display:block;}.div-td.preview-right div.preview-block.paymentNote div.block-content{padding:0;}div.pickupNote{font-size:13px;font-style:italic;}div#billing{display:none;}#boxful-card>div .payment img{padding-top:0;padding-right:0;}@media screen and (min-width: 768px) and (max-width: 980px) {div.paymentOptionContent img.visa-img,div.paymentOptionContent img.master-img{height:25px;}}@media screen and (max-width: 767px) {div.preview-block{font-size:12px;}div.preview-block.payment div.block-left{width:15%}div.preview-block.payment div.block-right{width:85%;}div.preview-block div.block-middle{width:72%;}div.preview-block div.block-left{width:15%;}.div-td.preview-right div.preview-block.priceSummary{padding:10px;}div #boxful-card div.div-table{padding-bottom:5%;}div.paymentOption{width:49%;}div.BTformItem{width:26%;}div.BTformContent{border:1px solid #c7c7cc;background-color:#fafafa;width:66%;}div.BTformItem.cvv{width:15.5%;}div.paymentOptionContent{width:auto;min-width:0;}div.card,div.paypal{text-align:center;width:95%;padding:5px 0;}div.paypalRedirect{padding:3% 0;width:100%;}div.creditCardNote div.creditCardNoteImg{width:20%;}div.creditCardNote div.creditCardNoteText{width:75%;padding-left:5%;}div.paymentOption input[type="radio"]{display:none;}div.preview-block.payment div.block-content{width:113%;position:relative;right:13%;}div.BTformContent.braintree-hosted-fields-focused{border:1px solid #c7c7cc;}div.BTformContainer{display:table;padding-top:15px;font-size:11px;}div#creditCard div.formRow{display:table-row;padding-top:10px;}div.BTformItem,div.BTformContent{display:table-cell;}div.BTformItem.cardNumTitle{width:14%;min-width:80px;max-width:80px;padding-right:5px;}div.BTformItem.expDateTitle{width:8%;min-width:80px;max-width:80px;padding-right:5px;}div.BTformItem.cvvTitle{padding-right:5px;}div.paymentOptionContent img.visa-img,div.paymentOptionContent img.master-img{height:25px;}div.preview-block.priceSummary div#afterDiscountTotal{font-size:15px;}div.preview-block.priceSummary div.block-content{padding-top:0px;}div.preview-block.priceSummary div.block-content-row.total div.note{font-size:9.5px;}div.block-middle div.block-title,div.block-middle div.block-content{padding-left:0px;}div.preview-block div.block-right{width:14%;}.div-td.preview-right div.preview-block:first-child{padding-bottom:0px;}div.pickupNote{font-size:12px;}div#material.preview-block.priceSummary div.block-left,div#material.preview-block.priceSummary div.block-middle,div#storage.preview-block.priceSummary div.block-left,div#storage.preview-block.priceSummary div.block-middle{display:none;}div#material.preview-block.priceSummary div.block-right,div#storage.preview-block.priceSummary div.block-right{width:100%;}}@media screen and (max-width: 320px){img.titleIcon{width:22px;}}</style>
@endsection

@section('content')
<section id="review">
	<div class="container">
		<div class="row">
			

			<div id="preview" class="div-table preview-boxes">
			  <div class="div-tr">
				<div class="div-td preview-left">
				  <div class="orderDetailState">
					<div class="orderDetailTitle">懶人倉租用清單</div>
					<div class="orderDetailTitleNote">請於結帳前再次確認您的帳單細節.</div>
				  </div>
				</div>
				<div class="div-td preview-right">
				  
				 
				  <div id="item" class="preview-block withSummary">
					<div class="block-left"> <img class="titleIcon" src="/assets/dist/img/item-icon.png"> </div>
					<div class="block-middle">
					  <div class="block-title">項目</div>
					  <div class="block-content">
						<div id="boxamt">
						  <div class="block-content-row">
							<div class="boxType">{{ $request->get('shipping') }}  X {{ $current_package->name }}</div>
						  </div>
						</div>
					  </div>
					</div>
					<div class="block-right">

					  <div class="block-content">
						<div id="boxprice">
						  <div class="block-content-row">
							<div class="boxSubtotal">${{ $current_package->cost }}</div>
						  </div>
						</div>
					  </div>
					</div>
				  </div>
				  
				  @if($request->get('camera') > 0)
				  <div id="item" class="preview-block withSummary">
					<div class="block-left"> <img class="titleIcon" src="/assets/dist/img/item-icon.png"> </div>
					<div class="block-middle">
					  <div class="block-title">加值服務</div>
					  <div class="block-content">
						<div id="boxamt">
						  <div class="block-content-row">
							<div class="boxType">{{ $request->get('camera') }}  X 即時影像加值服務</div>
						  </div>
						</div>
					  </div>
					</div>
					<div class="block-right">
					  <div class="block-content">
						<div id="boxprice">
						  <div class="block-content-row">
							<div class="boxSubtotal">$100</div>
						  </div>
						</div>
					  </div>
					</div>
				  </div>
				  @endif
				  <div id="item" class="preview-block priceSummary">
					<div class="block-left"> </div>
					<div class="block-middle">
					  <div class="block-content">
						<div class="block-content-row total"> <span class="item"> 月費試算<sup class="colorGreen">*</sup> </span> <br>
						  <div class="note"><sup class="colorGreen">*</sup>不含推薦碼折扣</div>
						</div>
					  </div>
					</div>
					<div class="block-right">
					  <div class="block-content">
						<div id="boxprice">
						  <div class="block-content-row total">
							<div class="boxSubtotal" id="boxamtsTotal">${{ $request->get('monthly_cost') }}</div>
						  </div>
						</div>
					  </div>
					</div>
				  </div>
				  
				  <div id="item" class="preview-block priceSummary">
					<div class="block-left"> </div>
					<div class="block-middle">
					  <div class="block-content">
						<div class="block-content-row total"> <span class="item"> Shipping Fee<sup class="colorGreen">*</sup> </span> <br>
						  <div class="note"><sup class="colorGreen">*</sup>{{ $current_package_features[7]->spec }}</div>
						</div>
					  </div>
					</div>
					<div class="block-right">
					  <div class="block-content">
						<div id="boxprice">
						  <div class="block-content-row total">
							<div class="boxSubtotal" id="boxamtsTotal">${{ $request->get('shipping_fee') }}</div>
						  </div>
						</div>
					  </div>
					</div>
				  </div>
				  
				  
				  
				  <div id="promoCode" class="preview-block">
					<div class="block-left"></div>
					<div class="block-middle">
					  <div class="block-title">推薦碼</div>
					  <div class="block-content">
						<div id="promo">
						  <div class="block-content-row">無推薦碼</div>
						</div>
					  </div>
					</div>

				  </div>
				  <div class="preview-block">
					<div class="block-left"> </div>
					<div class="block-middle">
					  <div class="block-title">地址</div>
					  <div class="block-content">
						<div class="block-content-row" id="dAddress1">{{ $request->get('county') }}</div>
						<div class="block-content-row" id="dAddress2">{{ $request->get('district') }}</div>
						<div class="block-content-row" id="dDistrict">{{ $request->get('zipcode') }}</div>
						<div class="block-content-row" id="dPhone">{{ $request->get('phone') }}</div>
					  </div>
					</div>
					<div class="block-right">
					  <div class="block-button"></div>
					</div>
				  </div>
				  <div id="dropoff" class="preview-block">
					<div class="block-left">  </div>
					<div class="block-middle">
					  <div class="block-title">派送空箱</div>
					  <div class="block-content">
						<div class="block-content-row" id="dropOffDate">{{ $request->get('dropOffDate') }}</div>
						<div class="block-content-row" id="dropOffTime">{{ $request->get('dropOffTime') }}</div>
						<div class="block-content-row"></div>
					  </div>
					</div>

				  </div>
				  <div id="pickup" class="preview-block last">
					<div class="block-left"> </div>
					<div class="block-middle">
					  <div class="block-title">預約取件</div>
					  <div class="block-content">
						<div id="pickUpDate">
						  <div class="block-content-row">{{ $request->get('scheduleOption') }}</div>
						  
						  <div class="block-content-row">
						  @if($request->get('scheduleOption') === '馬上取走')
								貨運公司會在外頭等您將箱子裝滿，當天取走
							@else
								請於一週內預約取件，起租日由本公司收回收納箱隔日或派送空箱後第8天起算，以較早日期計算。
							@endif 
							  </div>
						</div>
					  </div> 
					</div>
				  </div>
				</div>
			  </div>
			</div>
		</div>
		
		
	</div>
</section>
@endsection