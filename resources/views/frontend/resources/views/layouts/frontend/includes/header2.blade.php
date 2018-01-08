<div class="edm-container">
    @if(isset($edm) && !empty($edm))
        <a href="#" class="edm-close"><i class="fa fa-close"></i> </a>
        <a href="#"><img src="{{ $edm }}" alt="EDM"></a>
    @endif
</div>
<!-- start navigation -->
<header>
    <!--<div style="    background: #4e4744;color:#fff" class="container-fluid blackbar" id="topbar">-->
    <div style="    background: #4e4744;color:#fff" class="container-fluid" id="topbar">
        <div class="row">

            <div class="col-md-12 text-center" id="edm-trigger">
		<span>
		{{ $topbarnews->text }}
		</span>


            </div>
        </div>
    </div>

    <div class="container-fluid" id="topbar">
        <div class="row">

            <div class="col-md-12 text-right table">
			
			<span>
		   <a href="{{url('/ondemandstorage')}}">前往懶人倉</a>
		</span>
                <span>
		   <a href="{{url('/ipano')}}" target="_blank">倉庫實景</a>
		</span>
                <span>
		   <a href="{{url('/page/about-us')}}">關於 ALL IN</a>
		</span>
                <span>
		   <a href="{{url('/contact-us')}}">聯絡我們</a>
		</span>
            </div>
        </div>
    </div>
    <!-- center collasped navbar-->
    <nav class="navbar navbar-default" role="navigation">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse-1">
                選單
            </button>

        </div>
        <a class="navbar-brand" href="/"><img src="/assets/dist/img/logo.png"
                                              class="center-block wow wobble s5_logo s5_logo_path"
                                              data-wow-duration="2s"></a>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="navbar-collapse-1">
            @if (Auth::guest())
                <ul class="nav navbar-nav navbar-left">

                    <li class="p15"><img src="/assets/dist/img/icon_phone_20.png"><font color="#000000"><big><big>客服專線：02-29520000</big></big></font>
                    </li>
                </ul>
            @endif
            @if (!Auth::guest())
                <ul class="nav navbar-nav navbar-left">

                    <li><a href="javascript:showSideMenu()">
                            <div class="sidemenu-toggle"><span class="icon-bar"></span><span
                                        class="icon-bar"></span><span class="icon-bar"></span></div>
                            打開選單</a></li>
                    <li><a href="{{url('/logout')}}"><img
                                    src="/assets/dist/img/icon_login.png">會員登出({{ Auth::user()->email }})</a></li>
                </ul>
            @endif
            <ul class="nav navbar-nav navbar-right">
                <li class="topfb"><a href="https://www.facebook.com/allinstorage/" target="_blank"><img
                                src="/assets/dist/img/icon_fb2.png"></a></li>
                <li><a href="{{url('/latest-news')}}">最新消息</a></li>
                <li><a href="{{url('#nav_service')}}">服務流程</a></li>
                <li><a href="{{url('#nav_pricing')}}">收費方式</a></li>
                <li><a href="{{url('#nav_review')}}">客戶見證</a></li>
                <li><a href="{{url('/page/faq')}}">常見問題</a></li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </nav>

    @if(!Auth::guest())
        <div id="sideMenu" style="display: none;">
            <div class="closeSidemenu"><a id="closeSidemenu" href="#"><i class="fa fa-close"></i></a></div>
            <div id="sideMenuContainer">
                <div class="sidemenu-username sidemenu-border-bottom">Hi! {{ Auth::user()->name }} 您好!</div>
                <ul class="sidemenu">
                    <li class="item-202 sidemenu-border-bottom">
                        <div><a href="/member/warehouse">我的懶人倉</a></div>
                    </li>
                    <li class="item-298">
                        <div><a href="/schedule-new-box">給我空箱</a></div>
                    </li>
                    <li class="item-245">
                        <div><a href="/member/warehouse">來收箱子</a></div>
                    </li>
                    <li class="item-246">
                        <div><a href="/member/warehouse">來收大型物品</a></div>
                    </li>
                    <li class="item-330 sidemenu-border-bottom">
                        <div><a href="/member/warehouse/back">給我物品</a></div>
                    </li>
                    <li class="item-115 sidemenu-border-bottom deeper parent">
                        <div><a href="/member/home">會員中心</a>
                            <ul class="nav-child unstyled">
                                <li class="item-264">
                                    <div><a href="/member/home/#desposit">會員儲值</a></div>
                                </li>
                                <li class="item-203">
                                    <div><a href="/member/home/#my-info">我的資料</a></div>
                                </li>
                                <li class="item-204">
                                    <div><a href="/member/home/#invoice">帳單紀錄</a></div>
                                </li>
                                <li class="item-236">
                                    <div><a href="/member/home/#coupon">優惠碼</a></div>
                                </li>
                                <li class="item-236">
                                    <div><a href="/member/home/#referal">推薦碼</a></div>
                                </li>
                            </ul>
                        </div>
                    </li>

                </ul>
            </div>
        </div>
    @endif
    <div class="qrcode">
        <a href="https://line.me/R/ti/p/%40allin123" target="_blank"><img src="/assets/dist/img/lineallin.png"
                                                                          class="img-responsive center-block"></a>
    </div>
    <!-- center collasped navbar-->

</header>

