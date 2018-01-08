<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"/>
    <meta name="description" content="@yield('meta_desc')"/>
    <meta name="keywords" content="@yield('met_keywords')"/>
    <meta name="author" content=""/>
    <!--[if IE]>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <![endif]-->
    <title> {{ getSetting('SITE_TITLE') }} | @yield('title') </title>
    <!-- Bootstrap 3.3.5 -->
{!! Html::style('assets/bootstrap/css/bootstrap.min.css') !!}
<!-- Font Awesome -->
    {!! Html::style('assets/dist/css/font-awesome.min.css') !!}

    {!! Html::style('assets/dist/css/animate.css') !!}


    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,400italic,700,800' rel='stylesheet'
          type='text/css'>

    {!! Html::style('assets/dist/css/testimonial-slider.css') !!}

    {!! Html::style('assets/dist/css/frontend.css') !!}

    {!! Html::style('assets/dist/css/theme.css') !!}


    {!! Html::style('assets/dist/css/normalize.css') !!}
    {!! Html::style('assets/dist/css/formstyle.css') !!}



    {!! Html::style('assets/dist/css/custom-navbar.css') !!}

    <style>
        label {
            position: static;
        }
    </style>

    @yield('css')
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <link rel="apple-touch-icon" href="/favicon.ico">
	
</head>
<body id="top">
<!-- start preloader -->
<div class="preloader">
    <div class="sk-spinner sk-spinner-rotating-plane"></div>
</div>
<!-- end preloader -->

@include('layouts.frontend.includes.header')

<section id="inner_content">
    <div class="container">

        @yield('content')

    </div>
</section>
<!-- ============= Contact Section Starts Here =============================-->
<span class="anchor" id="nav_contact"></span>
<section id="contact">
    <div class="container">
        <div class="row">
            <div class="col-md-3"><h3><a href="{{url('/contact-us')}}">請聯絡我們</a></h3></div>
            <div class="col-md-5 text-right"><h3><img src="/assets/dist/img/icon_email.png"><a
                            href="mailto:{{ getSetting('INFO_EMAIL') }}">{{ getSetting('INFO_EMAIL') }}</a></h3></div>
            <div class="col-md-3 text-right"><h3><img
                            src="/assets/dist/img/icon_phone.png">{{ getSetting('SUPPORT_PHONE') }}</h3></div>
        </div><!--/* Container*/-->
</section>
<!-- ============= Contact Section Ends Here =============================-->

<!-- CONTENT-WRAPPER SECTION END-->
@include('layouts.frontend.includes.footer')
<!-- jQuery 2.1.4 -->
<?php /* {!! Html::script('https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js') !!}*/ ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>

{!! Html::script('assets/plugins/jQueryUI/jquery-ui.min.js') !!}
<!-- Bootstrap 3.3.5 -->
{!! Html::script('assets/bootstrap/js/bootstrap.min.js') !!}

{!! Html::script('assets/dist/js/form.js') !!}

<script>
    jQuery(document).ready(function ($) {

        // hide #back-top first
        $("#back-top").hide();

        // fade in #back-top
       

            // scroll body to 0px on click
            $('#back-top a').click(function () {
                $('body,html').animate({
                    scrollTop: 0
                }, 800);
                return false;
            });
        });

   
</script>
<script>
    /*----------------------------------------------------
     /*  Small Logo Upon Scroll
     /* ------------------------------------------------- */
    jQuery(document).ready(function ($) {
        jQuery(window).scroll(function () {
            if (jQuery(this).scrollTop() > 40) {
                jQuery('.s5_logo').addClass('small-logo');
				jQuery('.blackbar').slideUp();
            } else {
                jQuery('.s5_logo').removeClass('small-logo');
				jQuery('.blackbar').slideDown();
            }
        });

        $('*:not(nav)').click(function () {
            if ($('body').width() > 768) return;
            if ($('.navbar-collapse').css('display') !== 'none')
                $('.navbar-collapse').collapse('toggle');
        })
    });
</script>
<script>
    $(function () {
        $('a[href*="#"]:not([href="#"])').click(function () {
            if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && location.hostname == this.hostname) {
                var target = $(this.hash);
                target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
                if (target.length) {
                    $('html, body').animate({
                        //scrollTop: target.offset().top
                    }, 1000);
                    return false;
                }
            }
        });
    });
</script>

<script type="text/javascript">
    $(document).ready(function () {
        $('.preloader').fadeOut(1000); // set duration in brackets
    })
</script>

<script>
    $('.carousel').carousel({
        interval: 6000
    });


    // hing side menu
    function showSideMenu() {
        //jQuery("div#ct-parallaxtop").css({"margin-right": jQuery("div#sideMenu").width() - 30});
        if (jQuery(this).width() < 768) {
            jQuery("div.boxful-header-promo").css({"right": jQuery("div#sideMenu").width() - 10});
        } else {
            jQuery("div#ct-parallaxtop").css({"margin-right": jQuery("div#sideMenu").width() - 30});
        }
        jQuery("div#sideMenu").show("slide", {direction: "left"}, 150);
        jQuery("div#blackLayer").show();
    }

    function hideSideMenu() {
        jQuery("div.boxful-header-promo").css({"left": "0px"});
        jQuery("div#ct-parallaxtop").css({"margin-left": "0px"});
        jQuery("div#sideMenu").hide("slide", {direction: "left"}, 150);
        jQuery("div#blackLayer").hide();
    }
    // end

    //hing 17/06
    jQuery("a#sidebarAction").click(function (event) {
        event.preventDefault();
        if (!jQuery("div#sideMenu").is(":visible")) {
            showSideMenu();
        } else {
            hideSideMenu();
        }
    });

    jQuery('div:not("div#sideMenu")').click(function () {
        hideSideMenu();
    })

    jQuery("div#blackLayer").click(function (event) {
        if (jQuery("div#sideMenu").is(":visible")) {
            hideSideMenu();
        }
    });


    jQuery("a#closeSidemenu").click(function (event) {
        event.preventDefault();
        if (jQuery("div#sideMenu").is(":visible")) {
            hideSideMenu();
        }
    });
    // end


    jQuery(document).ready(function ($) {
        $("#tabs").tabs();
    });

   // hideSideMenu();//Asif
</script>


@yield('js')

</body>
</html>
