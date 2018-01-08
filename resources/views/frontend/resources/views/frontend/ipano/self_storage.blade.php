@extends('layouts.frontend.self_storage')

@section('title', 'Welcome to '.getSetting('SITE_TITLE'))

@section('css')

    {!! Html::style('assets/dist/css/flexslider.css') !!}
    {!! Html::style('assets/dist/css/self_storage.css') !!}
    <style type="text/css">
        #review, #review div[class^=col], #review .container {
            padding: 0 10px;
        }

        .flexslider {
            max-height: 650px;
        }

        .flexslider .slides img {
            width: auto;

        }

        .flex-direction-nav a {
            overflow: visible
        }

        .tabelimg {
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
                                <div class="col-md-12 wow swing" data-wow-duration="2s">
                                    <img src="/assets/dist/img/truck.png" class="center-block">
                                </div>
                                <div class="col-md-12  text-center">
                                    <h1>迷你倉</h1>
                                    <h4>Self Storage</h4>
                                    <h4>專業倉儲，到府收送</h4>
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
                    <p class="y_line slef_store"></p>
                </div>
                <div class="col-md-12 text-center">
                    <div class="row">
                        <div class="col-md-3 text-center wow flipInX" data-wow-duration="1s">
                            <h3><span class="number"> <span style="color:#FA8072;">1.</span></span>來電諮詢</h3>
                            <img src="/assets/dist/img/5.png">
                            <h5>文案文案文案文案</h5>
							<p>文案文案文案文案</p>
                        </div>
                        <div class="col-md-3 wow flipInX" data-wow-duration="2s">
                            <h3><span class="number"><span style="color:#FA8072;">2.</span></span>到府估價</h3>
                            <img src="/assets/dist/img/6.png">
                            <h5>
                                <p>文案文案文案文案</p>
                                <p>文案文案文案文案</p>
                            </h5>
                        </div>
                        <div class="col-md-3 wow flipInX" data-wow-duration="3s">
                            <h3><span class="number"><span style="color:#FA8072;">3.</span></span>入倉簽約</h3>
                            <img src="/assets/dist/img/7.png">
                            <h5>
                                <p>文案文案文案文案</p>
                                <p>文案文案文案文案</p>
                            </h5>
                        </div>
                        <div class="col-md-3 wow flipInX" data-wow-duration="4s">
                            <h3><span class="number"><span style="color:#FA8072;">4.</span></span>專人送回</h3>
                            <img src="/assets/dist/img/4.png">
                            <h5>
                                <p>文案文案文案文案</p>
                                <p>文案文案文案文案</p>
                            </h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- ============= Pricing table Starts Here =============================-->
    <span class="anchor" id="nav_pricing"></span>
    <section id="pricing">
        <div class="container">
            <h1 style="text-align:center;"><b>收費方式</b></h1>
            <h4 class="subtitle">PRICING</h4>
            <p class="y_line slef_store"></p>

            <div class="row notes">
                <div class="col-md-12 f_pink">基本費用=倉儲費+入倉運費+出倉運費</div>
                <div class="col-sm-12">
                    <img src="/assets/dist/img/nox6.png" class="img-responsive center-block">
                </div>
            </div>


        </div>
        <div class="row notes">
            <div class="col-md-4 icon_notes">文案文案文案文案文案</div>
            <div class="col-md-3 icon_notes">文案文案文案文案文案</div>
            <div class="col-md-5 icon_notes">文案文案文案文案文案</div>
        </div>
                </div>
            </div>
        </div>
        </div>
    </section>


    <!-- ============= Security Section Starts Here =============================-->
   <span class="anchor" id="nav_security"></span>
    <section id="security">
        <div class="container">
            <h1 style="text-align:center;"><b>安全監控</b></h1>
            <h4 class="subtitle">SECURITY</h4>
            <p class="y_line slef_store"></p>

            <div class="row">
                <div class="col-md-12 text-left">
                    <div class="row">
                        <div class="col-md-4 text-left wow flipInX" data-wow-duration="1s">
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
                        <div class="col-md-4 wow flipInX" data-wow-duration="2s">
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
                        <div class="col-md-4 wow flipInX" data-wow-duration="3s">
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
    <!-- ============= visit Section Starts Here =============================-->
    <span class="anchor" id="nav_visit"></span>
    <section id="visit">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <img src="/assets/dist/img/box3.png" class="pull-right wow slideInLeft" data-wow-duration="1s">
                </div>
                <div class="col-md-6">
                    <h3>迷你倉儲存方案 </h3>
                    <p>
                    </p>
                    <a href="/contact-us" class="img-responsive btn btn-lg yel-btn wow slideInRight"
                       data-wow-duration="1s">聯絡我們</a>
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
                    <p class="y_line slef_store"></p>
                </div><!--/*Col 1*/-->


                <div class="col-md-7">
                    <div class="container" style="max-width:100%">
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
                                                    <p>
                                                    <blockquote>
							  <span class="review">
							  小朋友的嬰兒車、學步車，通通放All in，等二胎出生再拿回來用，誰說養小孩家裡會一團亂
							  </span>

                                                        <div class="review2">Jessica 32歲 職業婦女</div>
                                                    </blockquote>
                                                    </p>

                                                </div><!-- inner text-->
                                            </div><!-- first review-->

                                            <div class="col-md-12">
                                                <div class="col-md-2">
                                                    <img src="/assets/dist/img/kudi.png" class="img-responsive">
                                                </div><!-- inner image-->

                                                <div class="col-md-10">
                                                    <p>
                                                    <blockquote>
							   <span class="review">
							  衣櫃終於不用再被冬天的棉被、毛衣、外套塞滿，衣服們也終於可以好好收進衣櫃不用堆滿房間~
							  </span>

                                                        <div class="review2">Mickey 34歲 銀行行員</div>
                                                    </blockquote>
                                                    </p>

                                                </div><!-- inner text-->
                                            </div><!-- first review-->

                                            <div class="col-md-12">
                                                <div class="col-md-2">
                                                    <img src="/assets/dist/img/kudi.png" class="img-responsive">
                                                </div><!-- inner image-->

                                                <div class="col-md-10">
                                                    <p>
                                                    <blockquote>
							   <span class="review">
							  家裡要重新裝潢，設計師推薦All in讓我們短期存放物品，不僅省了一筆租房間放家當的費用，雲端管理超方便的啦！
							  </span>

                                                        <div class="review2">Justin 36歲 準新郎</div>
                                                    </blockquote>
                                                    </p>

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
                                                    <p>
                                                    <blockquote>
							   <span class="review">
							  把出國才會用到的滑雪板跟行李箱放在All in懶人倉，家裡變得好清爽~
							  </span>

                                                        <div class="review2">Eric 35歲 工程師</div>
                                                    </blockquote>
                                                    </p>

                                                </div><!-- inner text-->
                                            </div><!-- first review-->

                                            <div class="col-md-12">
                                                <div class="col-md-2">
                                                    <img src="/assets/dist/img/kudi.png" class="img-responsive">
                                                </div><!-- inner image-->

                                                <div class="col-md-10">
                                                    <p>
                                                    <blockquote>
							   <span class="review">
							  寒暑假搬宿舍的成本我算過，運費、管理費，外加打包的時間，把宿舍家當存放在All in比搬回家還划算，還可以避免搬行李造成肌肉拉傷的風險唷~~
							  </span>

                                                        <div class="review2">精打細算會計系學生</div>
                                                    </blockquote>
                                                    </p>

                                                </div><!-- inner text-->
                                            </div><!-- first review-->

                                            <div class="col-md-12">
                                                <div class="col-md-2">
                                                    <img src="/assets/dist/img/kudi.png" class="img-responsive">
                                                </div><!-- inner image-->

                                                <div class="col-md-10">
                                                    <p>
                                                    <blockquote>
							  <span class="review">
							  從國外扛回來的原廠頂級球桿，隨時用手機開「倉儲即時影像」關愛一下~放在All in 比放在家(被小孩蹂躪)安心 ！
							  </span>

                                                        <div class="review2">我承認愛小白勝過小孩</div>
                                                    </blockquote>
                                                    </p>

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
                                                    <p>
                                                    <blockquote>
							  <span class="review">
							  我跟老公兩人都愛書成癡，看過的書堆得滿屋子到處都是，但都捨不得賣掉或送人，幸好有All in 懶人倉，為我們妥善存放這些愛書，讓家裡有空間容納更多好書~真是太棒了!
							  </span>

                                                        <div class="review2">25歲愛書人妻</div>
                                                    </blockquote>
                                                    </p>

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

        (function ($) {
            $(window).load(function () {
                $('.flexslider').flexslider({
                    animation: "slide",
                    prevText: "",
                    nextText: ""
                });
            });
        })(jQuery);
    </script>
@endsection
