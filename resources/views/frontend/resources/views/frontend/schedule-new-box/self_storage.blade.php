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
                        <img src="/assets/dist/img/sofa.png" alt="" class="img-responsive slider-box center-block">
                        <div class="caption1">
                            <div class="row">
                                <div class="col-md-12 wow swing" data-wow-duration="2s">
                                    <img src="/assets/dist/img/track.png" class="center-block">
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
                        <div class="col-md-5ths col-xs-12 text-center wow flipInX" data-wow-duration="1s">
                            <h3><span class="number"> <span style="color:#FA8072;">1.</span></span>聯絡ALL IN</h3>
                            <img src="/assets/dist/img/5.png">
                            <h5>來電、LINE@洽詢</h5>
                        </div>
                        <div class="col-md-5ths col-xs-12 wow flipInX" data-wow-duration="2s">
                            <h3><span class="number"><span style="color:#FA8072;">2.</span></span>專人免費估價</h3>
                            <img src="/assets/dist/img/6.png">
                            <h5>
                                <p>現場評估、預約搬運時間</p>
                            </h5>
                        </div>
                        <div class="col-md-5ths col-xs-12 wow flipInX" data-wow-duration="3s">
                            <h3><span class="number"><span style="color:#FA8072;">3.</span></span>搬運入倉</h3>
                            <img src="/assets/dist/img/8.png">
                            <h5>
                                <p>將所有物品搬運入倉</p>
                            </h5>
                        </div>
                        <div class="col-md-5ths col-xs-12 wow flipInX" data-wow-duration="4s">
                            <h3><span class="number"><span style="color:#FA8072;">4.</span></span>線上簽約付款</h3>
                            <img src="/assets/dist/img/7.png">
                            <h5>
                                <p>確認金額、線上簽約、匯款</p>
								</h5>
						</div>
						<div class="col-md-5ths col-xs-12 text-center wow flipInX" data-wow-duration="5s">
                            <h3><span class="number"> <span style="color:#FA8072;">5.</span></span>出倉送回</h3>
                            <img src="/assets/dist/img/4.png">
                            <h5>將所有物品送回給您</h5>
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

			    <div class="row">
                <div class="col-sm-12 hidden-xs">
                    <img src="/assets/dist/img/box_fee7.png" class="img-responsive center-block">
                </div>
                <div class="col-xs-12 visible-xs text-center">
                    <img src="/assets/dist/img/box_fee4.png" class="img-responsive center-block">
					</p>
                    <img src="/assets/dist/img/box_fee5.png" class="img-responsive center-block">
					</p>
                    <img src="/assets/dist/img/box_fee6.png" class="img-responsive center-block">
                </div>
            </div>


        </div>
        <div class="row notes2">
            <div class="col-md-4 icon_notes">季繳95折優惠</div>
            <div class="col-md-3 icon_notes">半年繳9折優惠</div>
            <div class="col-md-5 icon_notes">年繳8折優惠</div>
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
                    <img src="/assets/dist/img/book.png" class="pull-right wow slideInLeft" data-wow-duration="1s">
                </div>
                <div class="col-md-6">
                    <h3>文件儲存方案 </h3>
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
							  因工作需派外半年時間，租屋處的家當都需要找地方存放，幸好有ALLIN解決我倉庫的問題，又可以直接到家中收送物品，省掉很多時間跟麻煩。

							  </span>

                                                        <div class="review2">Mina 37歲 行銷總監</div>
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
							  學校暑假宿舍一堆東西懶的搬回家，剛好有ALLIN倉庫服務，直接用LINE線上聯絡就幫我處理好宿舍的東西，還能去便利商店繳費真的超方便的。

							  </span>

                                                        <div class="review2">Lin 20歲 大學生</div>
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
							  服務態度很好，會針對客戶需求提出最適合的方案。從外縣市遷進可以事先溝通由專人幫忙卸貨，作業完成也會進行報備。整體服務令人滿意!!
							  </span>

                                                        <div class="review2">Candice 28歲 人資主管</div>
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
							  家裡雜物太多，想找個迷你倉庫放置，沒有交通工具家裡又有小朋友很麻煩，剛好有ALLIN能到家裡收送物品的服務，讓我可以更輕鬆的解決問題，真的是很方便。
							  </span>

                                                        <div class="review2">27歲梁小姐</div>
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
							  房子裝修需要一個臨時的地方放置家裡的大大小小東西，ALLIN提供倉庫之外還提供搬運服務，整個下來節省了我很多時間。
							  </span>

                                                        <div class="review2">Daniel 35歲 娛樂業</div>
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
							  可以免去搬來搬去的辛苦，尤其對女生來說省去很多力氣。專人到府收箱子第一次嘗試真的很不錯！而且是個管理非常有彈性的倉儲，提出建議立刻改善相當貼心客戶需求的商家！滿意！推薦！
							  </span>

                                                        <div class="review2">Ellen 36歲 室內設計師</div>
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
							  店面要重新裝潢，生財器具需要找個地方暫存，ALLIN搬運跟倉庫只要找一家就一次把問題都解決了。
							  </span>

                                                        <div class="review2">42歲早餐店老闆</div>
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
							  謝謝All in 提供這麼貼心的服務，不僅僅到府收件也會主動告知進度，很不錯喲!推薦給家裡有需要倉庫的人喲。
							  </span>

                                                        <div class="review2">Zany 49歲 木雕師傅</div>
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
							  公司歷年會計文件越堆越多，把辦公室壓迫的很不舒服，剛好有這種小型倉庫可以存放那些東西，讓辦公環境舒服很多，價格也很實惠。
							  </span>

                                                        <div class="review2">Cindy 33歲 建築公司會計</div>
                                                    </blockquote>
                                                    </p>

                                                </div><!-- inner text-->
                                            </div><!-- first review-->

                                        </div>
                                        <!--testimonial stuff ends here -->
                                    </li>

                                        </div>
                                        <!--testimonial stuff ends here -->
                                    </li>

                                </ul>
                                <!-- Carousel nav -->

                            </div>

                        </div>
                    </div>

                <div class="col-md-5 wow slideInRight" data-wow-duration="1s">
                    <img class="img-responsive" src="/assets/dist/img/truck2.png">
                </div><!--/* Container*/-->
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


        jQuery(document).ready(function($){
            $('#edm-trigger').slideUp('fast');
            $('.edm-container').slideToggle('fast');
            $('header').css({position: 'relative'})

            $('#edm-trigger').click(function(e){
                $(this).slideUp('fast');
                $('header').css({position: 'relative'})
                $('.edm-container').slideToggle('fast');


            });
            $('.edm-close').click(function(e){
                e.preventDefault();
                $('.edm-container').slideUp('fast');
                $('#edm-trigger').slideDown('fast');
                $('header').css({position: 'fixed'})
            });
        });
    </script>
@endsection
