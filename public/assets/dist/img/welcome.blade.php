@extends('layouts.frontend.single')

@section('title', 'Welcome to '.getSetting('SITE_TITLE'))

@section('css')

{!! Html::style('assets/dist/css/flexslider.css') !!}

<style type="text/css">
#review, #review div[class^=col], #review .container {
    padding: 0 10px;
}
.flexslider{max-height: 650px;}
.flexslider .slides img {
    width: auto;

}
.flex-direction-nav a{overflow:visible}


.tabelimg{
	padding-bottom: 15px;
    width: 700px;
    margin: 30px auto;
    display: block;
	
}




</style>
@endsection

    @section('content')
            <!-- start home -->

<!-- slider section starts here-->

<section id="slider">
   <div class="container">
      <div class="row">
	    <div class="col-md-12">

    <div class="thumbnail1">
        <img src="/assets/dist/img/box.png" alt="" class="img-responsive slider-box center-block">
        <div class="caption1">
            <div class="row">
			   <div class="col-md-12 wow swing"  data-wow-duration="2s">
			    <img src="/assets/dist/img/cloud.png" class="center-block">
				</div>
				<div class="col-md-12  text-center">
				<h1>懶人倉</h1>
				<h4>On-Demand Storage</h4>
				<h4>到府收送 雲端倉儲</h4>
				</div>
				<div class="btn1box">
                @if (Auth::guest())
				<div class="fl">
				   <a href="/login" class="btn box-btn1 btn-sm">會員登入</a>
				</div>
				<div class="fr">
				   <a href="/register" class="btn box-btn2 btn-sm">立即預約</a>
				</div>
                @endif
				</div>
             </div>
        </div>

</div>

		</div>
	  </div>
   </div>
</section>
<!-- Servicce Section -->
<span class="anchor" id="nav_service"></span>
<section id="service">
<div class="container">
  <div class="row">
    <div class="col-md-12 text-center" style="padding-bottom:12px;">
	   <h1><b>服務流程</b></h1>
	   <h4 class="subtitle">HOW IT WORKS</h4>
	   <p class="y_line"></p>
	</div>
	<div class="col-md-12 text-center">
	   <div class="row">
	      <div class="col-md-3 text-center wow flipInX"  data-wow-duration="1s">
	         <h3><span class="number">1.</span>建立帳號</h3>
		     <img src="/assets/dist/img/1.png">
			 <h5>預約您的專屬收納箱</h5>
		  </div>
		  <div class="col-md-3 wow flipInX"  data-wow-duration="2s">
		      <h3><span class="number">2.</span>打包裝箱</h3>
		      <img src="/assets/dist/img/2.png">
			  <h5>
			  <p>專人到府收件</p>
			  <p>所有物品一次All in</p>
			  </h5>
		  </div>
		  <div class="col-md-3 wow flipInX"  data-wow-duration="3s">
		      <h3><span class="number">3.</span>入倉存放</h3>
		      <img src="/assets/dist/img/3.png">
			  <h5>
			  <p>媲美藝術品保存等級</p>
			  <p>24小時嚴密監控</p>
			  <p>比放在家/辦公室還安全!</p>
			  </h5>
		  </div>
		  <div class="col-md-3 wow flipInX"  data-wow-duration="4s">
		     <h3><span class="number">4.</span>專人送回</h3>
		     <img src="/assets/dist/img/4.png">
			 <h5>
			 <p>雲端管理您的倉儲</p>
			 <p>不用出門就能取回物品</p>
			 </h5>
		  </div>
	   </div>
	</div>
  </div>
</div>
</section>
<!-- ============= Security Section Starts Here =============================-->
<span class="anchor" id="nav_security" ></span>
<section id="security" >
 <div class="container">
       <h1 style="text-align:center;"><b>安全監控</b></h1>
	   <h4 class="subtitle">SECURITY</h4>
	   <p class="y_line"></p>

  <div class="row">
	<div class="col-md-12 text-left">
	   <div class="row">
	      <div class="col-md-4 text-left wow flipInX"  data-wow-duration="1s">
            <div class="row box6">
               <div class="col-sm-3">
		       <img src="/assets/dist/img/icon_s01.png">
               </div>
               <div class="col-sm-8">
               <h3>保全系統</h3>
			   <h5>中興保全，防盜防災一把罩 </h5>
               </div>
            </div>
            <div class="row">
               <div class="col-sm-3">
		       <img src="/assets/dist/img/icon_s02.png">
               </div>
               <div class="col-sm-8">
               <h3>24小時監視系統</h3>
			   <h5>先進IP Camera，白天黑夜零死角 </h5>
               </div>
            </div>
		  </div>
		  <div class="col-md-4 wow flipInX"  data-wow-duration="2s">
            <div class="row box6">
               <div class="col-sm-3">
		       <img src="/assets/dist/img/icon_s03.png">
               </div>
               <div class="col-sm-8">
               <h3>保全封條</h3>
			   <h5>瑞士第一品牌，隱私機密不洩漏 </h5>
               </div>
            </div>
            <div class="row">
               <div class="col-sm-3">
		       <img src="/assets/dist/img/icon_s04.png">
               </div>
               <div class="col-sm-8">
               <h3>防火設備</h3>
			   <h5>完善消防系統，未雨綢繆最安心</h5>
               </div>
            </div>
		  </div>
		  <div class="col-md-4 wow flipInX"  data-wow-duration="3s">
            <div class="row box6">
               <div class="col-sm-3">
		       <img src="/assets/dist/img/icon_s05.png">
               </div>
               <div class="col-sm-8">
               <h3>門禁管制</h3>
			   <h5>倉庫不對外開放，員工限定好管理  </h5>
               </div>
            </div>
            <div class="row">
               <div class="col-sm-3">
		       <img src="/assets/dist/img/icon_s06.png">
               </div>
               <div class="col-sm-8">
               <h3>溫濕控制</h3>
			   <h5>嚴控溫度濕度，衣物書籍最放心 </h5>
               </div>
            </div>
		  </div>

	   </div>
 </div>
</section>
<!-- ============= Pricing table Starts Here =============================-->
<span class="anchor" id="nav_pricing" ></span>
<section id="pricing" >
 <div class="container">
       <h1 style="text-align:center;"><b>收費方式</b></h1>
	   <h4 class="subtitle">PRICING</h4>
	   <p class="y_line"></p>
   <div class="row">

    @foreach($packages as $i => $package)

      <div class="col-md-4 col-md-offset-{{
		  ($i == 0) ? 4-count($packages) : 0}}" >

	     <div class="inner">
		   <div class="row">
		      <div class="col-md-12">
			     <img src="{{ $package->features[3]->pivot->spec }}" class="img-responsive center-block" @if(isset($package->features[4]) && $package->features[4]->isActive()) width="{{ $package->features[4]->pivot->spec }}"  @endif >
			  </div>
		      <div class="col-md-12">
			     <h1 class="text-center" id="inner-head">{{ $package->name }}</h1>
			  </div>
		      <div class="col-md-12 text-center">
			     <h2> 月租 <b>{{ round($package->cost) }}{{ getSetting('DEFAULT_CURRENCY') }}</b>  <span class="small">/{{ $package->cost_per }}</span></h2>
				 <small>{{ $package->features[0]->pivot->spec }}</small>
				 <hr>
			  </div>
		      <div class="col-md-12 text-center">
			  <div class="inner-icon">
			    <i class="fa fa-cog" aria-hidden="true"></i>&nbsp;&nbsp;
				<span>{{ $package->features[1]->pivot->spec }}</span><br>
				<i class="fa fa-star" aria-hidden="true"></i>&nbsp;&nbsp;
				<span>{{ $package->features[2]->pivot->spec }}</span>
				</div>
			  </div>

		      <div class="col-md-12">
			  <form action="{{ url('/booking/1') }}" method="post">
				 {!! csrf_field() !!}
			     <input type="hidden" value="{{ $package->id }}" name="package_id" />
				 <input type="submit" class="btn btn-link text-uppercase" id="inner-button" value="立即預約">
			  </form>
			  </div>
		   </div>
		 </div>
	  </div>

	@endforeach

</div>
 <div class="row pricebox2">
            <div class="col-md-6 ">
               <div class="col-sm-3">
		       <img src="/assets/dist/img/box5_s.png" class="img-responsive center-block">
               </div>
               <div class="col-sm-9">
               <h3>運費</h3>
				 <small>
				 <p>空箱一律免運費。 <br>您取回物品後，該箱物品若打算再次入倉存放可享免運費。</p></small>

               </div>
               <div class="col-sm-12 pbox">
                 <img src="/assets/dist/img/box_fee.jpg" class="img-responsive center-block">
               </div>
            </div>
            <div class="col-md-6">
               <div class="col-sm-3">
		       <img src="/assets/dist/img/icon_p02.png" class="img-responsive center-block">
               </div>
               <div class="col-sm-9">
               <h3>即時影像加值服務</h3>
				 <small>
				 <p>大型物品每件只要加100點/月，即享有即時影像觀看權限，<br>讓您隨時隨地都可透過手機關心寶貝物品即時狀態。</p>
				 </small>
               </div>
               <div class="col-sm-12 pbox">
			     <h3><b>100點</b> <span class="small">/月/件</span></h3>
               </div>
            </div>
 </div>

 <div class="row notes" >
    <div class="col-md-12">基本費用=入倉運費+倉儲費+出倉運費</div>
 </div>



   </div>
 <div class="row notes" >
    <div class="col-md-4 icon_notes" >免簽長約，按實際用量彈性收費</div>
    <div class="col-md-3 icon_notes" >免費運送空箱</div>
    <div class="col-md-5 icon_notes" >免費保險(每箱或每件大型物品最高理賠5000元)</div>
 </div>

<img class="tabelimg" src="/assets/dist/img/table.jpg">



 </div>
</section>

<!-- ============= visit Section Starts Here =============================-->
<span class="anchor" id="nav_visit"></span>
<section id="visit">
     <div class="container">
	   <div class="row">
	      <div class="col-md-6">
		     <img src="/assets/dist/img/box3.png" class="pull-right wow slideInLeft" data-wow-duration="1s">
		  </div>
		  <div class="col-md-6">
		     <h3>企業儲存服務 </h3>
			 <p>企業客戶或有大量文件倉儲需求的客戶，請直接聯絡我們，價錢另議。
			 </p>
			 <a href="/contact-us" class="img-responsive btn btn-lg yel-btn wow slideInRight" data-wow-duration="1s" >聯絡我們</a>
		  </div>
	   </div>
	 </div>
</section>
<!-- ============= Reviews Section Starts Here =============================-->
<span class="anchor" id="nav_review"></span>
<section id="review">
     <div class="container">


	      <div class="row">

		           <div class="col-md-12">
				     <h2 class="text-center text-uppercase"><b>客戶見證</b></h2>
					 <h4 class="subtitle">Customer Reviews</h4>
					 <p class="y_line"></p>
	              </div><!--/*Col 1*/-->


		           <div class="col-md-7">
				     <div class="container"  style="max-width:100%">
    <div class="row">
            <div id="myCarousel" class="carousel slide vertical  flexslider reviewbox">
                <!-- Carousel items -->
                <ul class=" slides ">
                    <li class=" item ">
                        <!--testimonial stuff here -->
						<div class="row">
					     <div class="col-md-12">
						     <div class="col-md-2">
							     <img src="/assets/dist/img/kudi.png" class="img-responsive">
							 </div><!-- inner image-->

							 <div class="col-md-10">
							  <p><blockquote>
							  <span class="review">
							  小朋友的嬰兒車、學步車，通通放All in，等二胎出生再拿回來用，誰說養小孩家裡會一團亂
							  </span>

							  <div class="review2">Jessica 32歲 職業婦女</div>
							  </blockquote></p>

							 </div><!-- inner text-->
						 </div><!-- first review-->

						 <div class="col-md-12">
						     <div class="col-md-2">
							     <img src="/assets/dist/img/kudi.png" class="img-responsive">
							 </div><!-- inner image-->

							 <div class="col-md-10">
							  <p><blockquote>
							   <span class="review">
							  衣櫃終於不用再被冬天的棉被、毛衣、外套塞滿，衣服們也終於可以好好收進衣櫃不用堆滿房間~
							  </span>

							   <div class="review2">Mickey 34歲 銀行行員</div>
							  </blockquote></p>

							 </div><!-- inner text-->
						 </div><!-- first review-->

						 <div class="col-md-12">
						     <div class="col-md-2">
							     <img src="/assets/dist/img/kudi.png" class="img-responsive">
							 </div><!-- inner image-->

							 <div class="col-md-10">
							  <p><blockquote>
							   <span class="review">
							  家裡要重新裝潢，設計師推薦All in讓我們短期存放物品，不僅省了一筆租房間放家當的費用，雲端管理超方便的啦！
							  </span>

							   <div class="review2">Justin 36歲 準新郎</div>
							  </blockquote></p>

							 </div><!-- inner text-->
						 </div><!-- first review-->

					  </div>
					  <!--testimonial stuff ends here -->
                    </li>

                    <li class="item ">
                        <!--testimonial stuff here -->
						<div class="row">
					     <div class="col-md-12">
						     <div class="col-md-2">
							     <img src="/assets/dist/img/kudi.png" class="img-responsive">
							 </div><!-- inner image-->

							 <div class="col-md-10">
							  <p><blockquote>
							   <span class="review">
							  把出國才會用到的滑雪板跟行李箱放在All in懶人倉，家裡變得好清爽~
							  </span>

							   <div class="review2">Eric  35歲 工程師</div>
							  </blockquote></p>

							 </div><!-- inner text-->
						 </div><!-- first review-->

						 <div class="col-md-12">
						     <div class="col-md-2">
							     <img src="/assets/dist/img/kudi.png" class="img-responsive">
							 </div><!-- inner image-->

							 <div class="col-md-10">
							  <p><blockquote>
							   <span class="review">
							  寒暑假搬宿舍的成本我算過，運費、管理費，外加打包的時間，把宿舍家當存放在All in比搬回家還划算，還可以避免搬行李造成肌肉拉傷的風險唷~~
							  </span>

							   <div class="review2">精打細算會計系學生</div>
							  </blockquote></p>

							 </div><!-- inner text-->
						 </div><!-- first review-->

						 <div class="col-md-12">
						     <div class="col-md-2">
							     <img src="/assets/dist/img/kudi.png" class="img-responsive">
							 </div><!-- inner image-->

							 <div class="col-md-10">
							  <p><blockquote>
							  <span class="review">
							  從國外扛回來的原廠頂級球桿，隨時用手機開「倉儲即時影像」關愛一下~放在All in 比放在家(被小孩蹂躪)安心 ！
							  </span>

							   <div class="review2">我承認愛小白勝過小孩</div>
							  </blockquote></p>

							 </div><!-- inner text-->
						 </div><!-- first review-->

					  </div>
					  <!--testimonial stuff ends here -->
                    </li>

                    <li class="item">
                        <!--testimonial stuff here -->
						<div class="row">
					     <div class="col-md-12">
						     <div class="col-md-2">
							     <img src="/assets/dist/img/kudi.png" class="img-responsive">
							 </div><!-- inner image-->

							 <div class="col-md-10">
							  <p><blockquote>
							  <span class="review">
							  我跟老公兩人都愛書成癡，看過的書堆得滿屋子到處都是，但都捨不得賣掉或送人，幸好有All in 懶人倉，為我們妥善存放這些愛書，讓家裡有空間容納更多好書~真是太棒了!
							  </span>

							  <div class="review2">25歲愛書人妻</div>
							  </blockquote></p>

							 </div><!-- inner text-->
						 </div><!-- first review-->


					  </div>
					  <!--testimonial stuff ends here -->
                    </li>

                </ul>
                <!-- Carousel nav -->

            </div>

    </div>
</div>
	               </div><!--/* Container*/-->


				   <div class="col-md-5 wow slideInRight" data-wow-duration="1s">
				       <img class="img-responsive" src="/assets/dist/img/box2.png">
	               </div><!--/* Container*/-->


	      </div><!--/* Row*/-->
	 </div><!--/* Container*/-->
  </section>
  <!-- ============= Reviews Section Ends Here =============================-->

@endsection

@section('js')
{!! Html::script('/assets/dist/js/carouseller.js') !!}

{!! Html::script('/assets/dist/js/modernizr.js') !!}
{!! Html::script('/assets/dist/js/jquery.flexslider.js') !!}

{!! Html::script('/assets/dist/js/jquery.mousewheel.js') !!}

<script type="text/javascript">

(function($) {
      $(window).load(function(){
      $('.flexslider').flexslider({
        animation: "slide",
       	prevText : "",
		nextText : ""
      });
    });
   })(jQuery);
</script>
@endsection
