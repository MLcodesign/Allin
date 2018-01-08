<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ALL IN 精品倉儲 | Welcome to ALL IN 精品倉儲</title>
    <link href="/allin_enter/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="/allin_enter/css/style.css" rel="stylesheet" type="text/css">
    <link rel="shortcut icon" href="/allin_enter/images/favicon.png">
</head>

<body>
<nav class="navbar navbar-default navbar-fixed-top bg">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header page-scroll">
            <button type="button" class="navbar-toggle" data-toggle="collapse"
                    data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#"><big><big><b>{{ $entry->header_left->data }}</b></big></big></a>
        </div>


        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right">
                <li class="hidden">
                    <a href="#"></a>
                </li>
                <li class="page-scroll">
                    <a href="https://allin-storage.com/ipanoallin/allin.html">倉庫實景</a>
                </li>
                <li class="page-scroll">
                    <a href="https://allin-storage.com/page/about-us">關於ALL IN</a>
                </li>
                <li class="page-scroll">
                    <a href="https://allin-storage.com/contact-us">聯絡我們</a>
                </li>
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container-fluid -->
</nav>
<section>
    <div class="container-fluid text-center">
        <div class="row">
            <div class="col-md-12">
                <div class="logo"><a href="/"><img src="/allin_enter/images/logo.png" alt=""></a></div>
            </div>
        </div>
    </div>
</section>


<section>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6 space padd0">

                <div class="col-md-12 padd0">
                    <img src="/allin_enter/images/books-1.jpg" width="100%" height="auto">
                </div>
                <div class="display width100">
                    <div class="col-md-4 col-sm-4 col-xs-4 padd0 display"><img src="/allin_enter/images/shirt-img.jpg"
                                                                               width="100%" height="auto" alt=""></div>
                    <div class="col-md-8 col-sm-8 col-xs-8 padd0 display">
                        <a href="https://allin-storage.com/ondemandstorage" class="shirt-box">
                            <h1>{!!  $entry->ondemandstorage->data !!}</h1>
                            <div class="btn1 ">{{ $entry->ondemandstorage_button->data }}</div>
                        </a>
                    </div>
                </div>

                <div class="col-md-12 padd0">
                    <img src="/allin_enter/images/new-paper.jpg" width="100%" height="auto">
                </div>

            </div>

            <div class="col-md-6 space1 padd0">
                <div class="col-md-12 padd0">
                    <img src="/allin_enter/images/sofa.jpg" width="100%" height="auto">
                </div>


                <div class="display padd0 width100">
                    <div class="col-md-8 col-sm-8 col-xs-8 display padd0">
                        <a href="https://allin-storage.com/selfstorage" class="almira">
                            <h2>{!! $entry->selfstorage->data !!}</h2>
                            <div class="btn2 go-right">{{ $entry->selfstorage_button->data }}</div>
                        </a>
                    </div>
                    <div class="col-md-4 col-sm-4 col-sx-4 padd0 display"><img src="/allin_enter/images/almira.jpg"
                                                                               width="100%" height="auto" alt=""></div>
                </div>


                <div class="col-md-12 padd0">
                    <img src="/allin_enter/images/room.jpg" width="100%" height="auto" alt="">
                </div>
            </div>


        </div>


    </div>
</section>

<div class="footer-bottom">

    <div class="container-fluid">

        <div class="row">

            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">

                <ul class="design">
                    <li><a href="https://allin-storage.com/page/privacy">私隱權政策</a></li>
                    <li><a href="https://allin-storage.com/page/terms">懶人倉服務協議</a></li>
                    <li><a href="https://allin-storage.com/page/terms-self-storage">迷你倉服務協議</a></li>
                </ul>

            </div>


            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 text-right">

                <div class="copyright">Copyright © 2016. ALL IN. All rights reserved.</div>

            </div>

        </div>

    </div>

</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
<script src="/allin_enter/js/bootstrap.min.js"></script>
</body>
</html>
