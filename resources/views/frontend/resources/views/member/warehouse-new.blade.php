
@extends('layouts.frontend.member.app')

@section('title', 'ALL IN Warehouse')

@section('css')
    {!! Html::style('/assets/plugins/lightbox/css/lightbox.css') !!}
    {!! Html::style('assets/dist/css/warehouse_style.css') !!}
    <style>
        ul > li { 
            line-height: 30px
        }
        
         .container {
            width: 100%!important;
             padding-right: 0;
             padding-left: 0;
            
        }
        
         #inner_content {
                padding-bottom: 0;
            
        }
        @media all and (max-width:700px){
            .top_section{
                
                 width: 100%!important;
            }
            }
        
        .displaythum {
                display: block !important;
                width: 90px;
                height: 90px;
                position: relative;
        }
        
        .dfdvg{
            
            display:none!important;
        }
        
        .tab4box {
            
                width: 33%;
                top: 20px;
                float:left;
                padding: 5px;
                border: 1px dotted;
                
        }
           
         #inner_content {
             
                 overflow-y: hidden !important;
         }
         
         
        #tab4 {
            
                background: url(/assets/dist/img/warehouse/tab2_bg.png);
                height: 344px;
                float: left;
                width: 100%;
                background-repeat: no-repeat;
                background-size: 100% 100%;
        }   
        .sub_title {
			float: left;
			width: 100%;
			color: #fff;
		}
        .numfourth {
            
            color:#fff;
        }
        
        
           
        .right,.left{
            
                z-index: 900;
        }   
        
        @media screen and (max-width: 768px) {
            
            .top_num {
            width: 23%;
            display: block !important;
        }
        
        .num_inner span {
            
            font-weight:bold;
        }
            
        }
        
        
        
    
        
    </style>
@endsection

        
@section('content')
    <div class="row boxfulForm" style="padding-top:0px !important;max-width: 100%;padding-bottom: 0px;">
        @if (session('status'))
            <div class="alert alert-success"> {{ session('status') }} </div>
        @endif
        @if (session('warning'))
            <div class="alert alert-warning"> {{ session('warning') }} </div>
        @endif
        <div class="col-md-12 text-center" style="padding:0px;">
            <h1><b>我的懶人倉</b></h1>
            <h4 class="subtitle">ALL IN Warehouse</h4>
            <p class="y_line"></p>
            <?php /*<h3 class="text-center">您還有 {{ round($credit) }} 剩餘點數</h3>*/ ?>
        </div>
        
         
        
          <form style="display:none" id="formactionsubmit" method="post" enctype="multipart/form-data"  action="{{url('/updateboximgajax')}}">
              
              {{ csrf_field() }}
              
              <input type="file" name="image" id="fileToUpload">
           
              <button type="submit" id="btn">Upload Files!</button>
            </form>
        <div class="col-md-12 text-center" style="padding:0px;">
            <div class="top_section">
                    <ul style="position: relative;z-index: 99;" class="nav nav-tabs">
                        <li class="active" id="tabonetli">
                        <a data-toggle="tab" id="tabaone" href="#tab1">
                        <div class="tab_dv">
                            <div class="top_head">
                                <div class="top_num topnum1">
                                    <div class="num_inner">
                                        <span class="num">3</span>
                                    </div>
                                </div>
                                <div class="top_img">
                                    <img src="/assets/dist/img/warehouse/home.png">
                                </div>
                                <div class="top_text">
                                    <p>我的位置</p>
                                </div>
                                
                            </div>
                            
                        </div>
                        </a>
                        </li>
                        <li id="tabtwoli">
                            <a data-toggle="tab" id="tabatwo" href="#tab2">
                                <div class="tab_dv" ondrop="drop(event)" ondragover="allowDrop(event)" id="drag">
                                    <div class="top_heads">
                                        <div class="top_num topnum2">
                                            <div class="num_inner">
                                                <span class="num">0</span>
                                            </div>
                                        </div>
                                        <div class="top_img">
                                            <img class="truck_img" src="/assets/dist/img/warehouse/truck.png">
                                        </div>
                                        <div class="top_text">
                                            <p>貨車</p>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li id="tabthreeli">
                            <a data-toggle="tab" id="tabathree" href="#tab3">
                                <div class="tab_dv">
                                    <div class="top_head_3">
                                        <div class="top_num topnum3">
                                            <div class="num_inner">
                                                <span class="num">1</span>
                                            </div>
                                        </div>
                                        <div class="top_img">
                                            <img src="/assets/dist/img/warehouse/home2.png">
                                        </div>
                                        <div class="top_text">
                                            <p>懶人倉</p>
                                        </div>
                                        
                                    </div>
                                </div>
                            </a>
                        </li> 
                    </ul>
                </div>
                <div class="lines_div">
                </div>
                <div class="tab-content box_tab_content">
                    <div id="tab1" style="z-index: 99;" class="tab-pane fade in active">    
                        <div class="bottom_section">
                            <div class="top_arrow_text">
							
                                <div class="top_arrow">
									<div class="all_move all_move_1_2">
										全部入倉
									</div>
                                    <img src="/assets/dist/img/warehouse/arrow.png">
                                </div>
                                <div class="arrow_text">
                                    <p>請將箱子拖曳至貨車標籤，即可申請進倉</p>
                                </div>
                            </div>
                            <div class="box_images">
								
                                <div class="top_box_images">
                                   @foreach($boxes as $i => $box)
                                   @include('member.warehouse-new-box',['box' => $box]) 
                                   @endforeach    
                                   
                                   @foreach($largeBoxes as $box)
                                   @include('member.warehouse-new-box',['box' => $box]) 
                                   @endforeach
                                   
                                   @foreach($rtnBoxes as $box)
                                   @include('member.warehouse-new-box',['box' => $box]) 
                                   @endforeach
                                </div>
                                <div class="bottom_box_images">
                                </div>
                                <div class="rtn_box_images">
                                </div>
                            </div>
                            <!-- slider-->
                            <div id="tab1_slider" class="carousel slide" data-ride="carousel" data-interval="false">
                                <!-- Indicators -->
                                <ol class="carousel-indicators">
                                <?php $z = 0; ?>
                                 @foreach($boxes as $box)
                                 <li data-target="#tab1_slider" data-slide-to="<?php echo $z;?>" class="<?php if ($z == 0) { echo 'active'; }?>"></li>
                                 <?php $z ++; ?> 
                                 @endforeach
                                 @foreach($rtnBoxes as $box)
                                 <li data-target="#tab1_slider" data-slide-to="<?php echo $z;?>" class="<?php if ($z == 0) { echo 'active'; }?>"></li>
                                 <?php $z ++; ?> 
                                 @endforeach
                                 @foreach($largeBoxes as $box)
                                 <li data-target="#tab1_slider" data-slide-to="<?php echo $z;?>" class="<?php if ($z == 0) { echo 'active'; }?>"></li>
                                 <?php $z ++; ?>
                                 @endforeach
                                </ol>

                                <!-- Wrapper for slides -->
                                <?php
                                $x = 0;
                                ?>
                                <div class="carousel-inner" style="z-index:99;position:relative" role="listbox">
									<div class="all_move all_mobmove_1_2" data-mode="enable">
										全部入倉
									</div>
								  @foreach($boxes as $box)
                                  @include('member.warehouse-new-box-slide',['box' => $box]) 
                                  <?php $x ++; ?>
                                  @endforeach
                                  @foreach($rtnBoxes as $box)
                                  @include('member.warehouse-new-box-slide',['box' => $box]) 
                                  <?php $x ++; ?>
                                  @endforeach
                                  @foreach($largeBoxes as $box)
                                  @include('member.warehouse-new-box-slide',['box' => $box]) 
                                  <?php $x ++; ?>
                                  @endforeach
                                </div>

                                <!-- Left and right controls -->
                                <a class="left" href="#tab1_slider" role="button" data-slide="prev">
                                  <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                                  <span class="sr-only">Previous</span>
                                </a>
                                <a class="right" href="#tab1_slider" role="button" data-slide="next">
                                   <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                                  <span class="sr-only">Next</span>
                                </a>
                                <div class="checkout_btns">
                                    <button style="display:none" type="button" class="checkout_btn" name="checkout_btn">進倉</button>
                                </div>
                            </div> 
                            <!-- slider -->
                        </div>
                    </div><!-- homepage-->
                    <!-- tab2 contents-->
                    <div id="tab2" class="tab-pane fade">
                        <div class="bottom_sections">
                            <div class="arrow_texts">
                                <p id="submit_wording">待運送物品</p>
                            </div>
                            <form action="" name="tab2_form" id="submit_form" method="POST">
								<div class="sub_title">編輯完成後，別忘了到下方點選”<span id="submit_alert_button" align="center">確認訂單</span>”唷</div>
							{{ csrf_field() }}
                                <div class="box_images">
                                    <div class="top_box_images">
                                    <?php $counc = 1; ?>
                                    <?php $totalCnt = count($boxes) + count($boxestabs) + count($largeBoxes) + count($rtnBoxes); ?>
                                     @for($x = 0; $x < $totalCnt; $x++)
                                        <div class="box_imgs">
                                            <div id="box_div_<?php echo $counc; ?>" class="droptarget" ondrop="drop(event,<?php echo $counc++; ?>)" ondragover="allowDrop(event)"></div>
                                            
                                        </div>
                                     @endfor
                                    </div>
                                    <?php $last=$totalCnt+1;?>
                                    <div class="bottom_box_images"> 
                                        <div class="box_imgss">
                                            <div id="box_div_<?php echo $last; ?>" class="droptarget" ondrop="drop(event,<?php echo $last; ?>)" ondragover="allowDrop(event)"></div>
                                        </div>
                                    </div>
                                    <!--<div class="btm_buttons">
                                        <button type="submit" class="submit_btns" name="submit_btn" id="submit_btn" disabled>確認訂單</button>
                                        <input type="hidden" name="action" id="submit_action" value="結帳" />
                                        <input type="hidden" name="wareHouseType" id="wareHouseType" value="" />
                                    </div>-->
                                </div> 
                            
                            <!-- slider-->
                            <div id="tab2_slider" class="carousel slide" data-ride="carousel">
                                <!-- Indicators -->
                                <ol class="carousel-indicators">
                                  
                                </ol>
								
                                <!-- Wrapper for slides -->
                                <div class="carousel-inner" role="listbox">
                                  
                                 
                                </div>

                                <!-- Left and right controls -->
                                <a class="left" href="#tab2_slider" role="button" data-slide="prev">
                                  <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                                  <span class="sr-only">Previous</span>
                                </a>
                                <a class="right" href="#tab2_slider" role="button" data-slide="next">
                                  <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                                  <span class="sr-only">Next</span>
                                </a>
                                <!--<div class="checkout_btn">
                                    <button type="submit" class="submit_btns" name="submit_btn" disabled>結帳</button>
									<input type="hidden" name="action" id="submit_action" value="結帳" />
                                    <input type="hidden" name="wareHouseType" id="wareHouseType" value="" />
                                    
								</div>-->
								
                            </div>
							<div class="btm_buttons">
                                        <button type="button" class="submit_btns" name="submit_btn" id="submit_btn">確認訂單</button>
                                        <input type="hidden" name="action" id="submit_action" value="結帳" />
                                        <input type="hidden" name="wareHouseType" id="wareHouseType" value="" />
                                    </div>
							
							</form>
                            <!-- slider -->
                        </div>
                    </div>
                    <!-- tab3 contents-->
                    <div id="tab3" class="tab-pane fade">
                        <div class="bottom_section_3" style="">
                            <div class="top_arrow_text">
								<div class="all_move all_move_3_2">
									全部出倉
								</div>
                                <div class="top_arrow">
                                    <img src="/assets/dist/img/warehouse/back_arrow.png">
                                </div>
                                <div class="arrow_text_3">
                                    <p>請將箱子拖曳至貨車標籤，即可申請出倉</p>
                                </div>
                            </div>
                            <div class="box_images">
								
                                <div class="top_box_images">
                                   @foreach($boxestabs as $i => $box)
                                   @include('member.warehouse-new-tab3-box', ['box' => $box])
                                   @endforeach    
                                </div>          
                            </div>
                            <!-- slider-->
                            <div id="tab3_slider" class="carousel slide" data-ride="carousel">
                                <!-- Indicators -->
                                <ol class="carousel-indicators">
									@foreach($boxestabs as $i => $box)
									 <li data-target="#tab3_slider" data-slide-to="<?php echo $i;?>" class="<?php if($i==0){echo "active";} ?>"></li>
									@endforeach  
                                  <!--<li data-target="#tab3_slider" data-slide-to="0" class="active"></li>
                                  <li data-target="#tab3_slider" data-slide-to="1"></li>
                                  <li data-target="#tab3_slider" data-slide-to="2"></li>-->
                                 
                                </ol>

                                <!-- Wrapper for slides -->
                                <div class="carousel-inner" role="listbox">
									<div class="all_move all_mobmove_3_2" data-mode="enable">
										全部出倉
									</div>
								   <?php
                                    $x = 0;
                                    ?>
									@foreach($boxestabs as $i => $box)
                                    @include('member.warehouse-new-tab3-box-slide', ['box' => $box])
                                    <?php $x ++; ?>
									@endforeach
                                </div>

                                <!-- Left and right controls -->
                                <a class="left" href="#tab3_slider" role="button" data-slide="prev">
                                  <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                                  <span class="sr-only">Previous</span>
                                </a>
                                <a class="right" href="#tab3_slider" role="button" data-slide="next">
                                  <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                                  <span class="sr-only">Next</span>
                                </a>
                                <div class="checkout_btns">
                                    <button style="display:none" type="button" class="checkout_btn" name="checkout_btn">出倉</button>
                                </div>
                            </div>
                            <!-- slider -->
                        </div>    
                    </div>
                </div><!-- tab content-->
        </div>
        
  </div>


<?php
    $dataType = "img";
    $prefix = "";
?>        
@foreach($boxestabs as $i => $box)
@include('member.warehouse-new-modal', ['box' => $box])
@endforeach

<?php
    $dataType = "slide";
    $prefix = "slide_"
?>
@foreach($boxestabs as $i => $box)
@include('member.warehouse-new-modal', ['box' => $box])
@endforeach

@foreach($orders as $key => $ary)
<div style="display:none">
    <p id="order_cnt_{{$key}}">{{$ary['cnt']}}</p>
    <p id="actual_order_cnt_{{$key}}">0</p>
    <p id="order_complete">N</p>
</div>
@endforeach
<div style="display:none">
    <p id="inMode"></p>
</div>
@endsection
@section('js')
    <script>
    
    var tab1 = $('#tab1 .tabonecount').length
    var tab3 = $('#tab3 .tabonecount').length
    
    $('.topnum3 span').text(tab3);
    $('.topnum1 span').text(tab1);
    
    function readURL(input,id) {
        
        alert(id);
    

        $('.nexa').removeClass('dfdvg');
        
        
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
             
              
               $('#blah')
                    .attr('src', e.target.result)
                    .width(100)
                    .height(100);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }
    
    $("body .right").click(function(){

            $(this).closest(".carousel").carousel('next');

      });
      
      $("body .left").click(function(){

            $(this).closest(".carousel").carousel('prev');

      });
      
    /** box drag start */  
    $(".small_img").click(function(){
        var img_src=$(this).attr('src');
        $("#main_img").attr("src",img_src);
    });
    function allowDrops(event){ 
        //$("#drag").click(); 
		 return true;
    }
    function allowDrop(ev) {
        ev.preventDefault();
        //$("#drag").click();
        //$("#drag").css("background",'#f8d306;');
        return true;
    }
    function drag(ev) {
        var target=ev.target;
        var id=$(target).parents().attr('id');
        if(id){
            ev.dataTransfer.setData("text/plain", "no_drag");
        }else{
            ev.dataTransfer.setData("text/plain", ev.target.id);
        }
    }
    function drop(event,page,cal) {
        var target_id=data=event;
		console.log(event, page, cal);
        if(page!="add_modal" && page!="add_slide"){
            event.preventDefault();
            data =target_id= event.dataTransfer.getData("text");
        }

        var tab_type=$("#"+data).attr("data-title");
        var order_id=$("#"+data).data("order-id");
        var boxid = $("#"+data).data("box-id");
        var target_type=$("#tab2 .box_img_block").attr("data-title");
            console.log(tab_type, target_type);
        if(tab_type==target_type || !target_type){
            if(data.startsWith("tab3_")){
                $('#submit_btn').prop("disabled",false);
                $('#submit_btn').html("確認訂單");
                $('#submit_alert_button').html("確認訂單");
                $('#submit_wording').html("出倉中的物品");
                $('#submit_action').val("out");
                $('#submit_form').prop("action", "/schedule-item-post");
                $('#wareHouseType').val("rtn");
                target_id=data.substr(data.indexOf('tab3_')+5);
            }else{
                var isRtn = $("#"+data).data("is-rtn");
                var dataMode = $("#inMode").html();
                //alert(isRtn);
                //alert(dataMode);
                /*
                if(dataMode == ""){
                    if(isRtn == true){
                        $("#inMode").html("Rtn");
                    }else{
                        $("#inMode").html("New");
                    }
                }else{
                alert(dataMode);
                    if(isRtn == true && dataMode == "New"){
                        alert("只允許新建單入倉, 無法拖曳出倉從新入倉品項!!");
                        return;
                    }
                    if(isRtn == false && dataMode == "Rtn"){
                        alert("只允許出倉從新入倉, 無法拖曳出倉從新入倉品項!!"); 
                        return;                       
                    }
                }
                */
                $('#submit_btn').html("確認訂單");
                $('#submit_alert_button').html("確認訂單");
                $('#submit_wording').html("進倉中的物品");
                $('#submit_action').val("in");
                $('#submit_form').prop("action", "/schedule-pickup-post");
                $('#wareHouseType').val("pick");
            
                if(cal !== false){
                    var max_order_cnt = parseInt($('#order_cnt_' + order_id).html())
                    var current_cnt = parseInt($('#actual_order_cnt_' + order_id).html());
                    var compare_cnt = current_cnt + 1;
                    if(compare_cnt < max_order_cnt){
                        //alert("訂單編號 " + order_id + " 仍有箱子未預約!!");
                        $('#order_complete').html("N");
                        $('#actual_order_cnt_' + order_id).html(compare_cnt);
                        //$('#submit_btn').prop("disabled",true);
                        //exit();
                    }else{
                        $('#order_complete').html("Y");
                        //$('#submit_btn').prop("disabled",false);
                        $('#actual_order_cnt_' + order_id).html(compare_cnt);                
                    }
                }
            }
            if(page=="add_modal"){
                //alert("已將此物品移至貨車");
                $('#tab3_modal_'+target_id+' #modal_close').trigger('click');
            }

            for(var i=1;i<=100;i++){
                if(!document.getElementById("box_div_"+i).hasChildNodes()){
                    target_id=i;
                    break;
                }
            }
            if(data!="no_drag"){
                //alert(target_id);
                if(!document.getElementById("box_div_"+target_id).hasChildNodes()){
                    if(cal !== false){
                        tab1 = parseInt($('.topnum1 span').text());
                        tab2 = parseInt($('.topnum2 span').text());
                        tab3 = parseInt($('.topnum3 span').text());
                        if(data.startsWith("tab3_")){
                            $('.topnum3 span').text(tab3 - 1);
                        }else{
                            $('.topnum1 span').text(tab1 - 1);
                        }
                        $('.topnum2 span').text(tab2 + 1);
                    }
                }
            }

            if(cal !== false){
                slideObj = $("#tab_add_to_cart_btn_" + boxid);
                add_slide_cart(slideObj, false);
				//alert("已將此物品移至貨車!!");
            }
                  
            if(!document.getElementById("box_div_"+target_id).hasChildNodes()){
                $("#box_div_"+target_id).addClass("tab2_block");
                document.getElementById("box_div_"+target_id).appendChild(document.getElementById(data));
            }
			
			$('.single_imgae_box').each(function () {
				if(!$(this).children().length > 0){
					$(this).css("padding","0px");
				}
			});
        }else{
            alert("抱歉！只能單向拖曳！請先完成目前預約程序再進行下一筆預約！");
        }
        //$(".upload"+data).show();
        //$(".thumb_u_"+data).hide();
    }
    $(".tab-pane:not(#tab2) .box_img_block .thumb_u_img").click(function(){
        var img_id=$(this).attr('id');
        $("#thumb_upload"+img_id).trigger('click');
    }); 
	$(".all_mobmove_1_2").click(function(){
		var data_mode=$(this).attr("data-mode");
		if(data_mode=="enable"){
			var tab_type='';
			var target_tab='';
			$('#tab1_slider .item .box_select .add_cart').each(function () {
				tab_type=$(this).attr("data-title");   
				target_tab=$("#tab2 .mob_block").attr("data-title");
				if(tab_type==target_tab || !target_tab){
					$(this).trigger("click");
				}
                else{
                    alert("抱歉！只能單向拖曳！請先完成目前預約程序再進行下一筆預約！");
                    $(this).attr("data-mode","disable");
                    return false;
                }
			});

		}
		$(this).attr("data-mode","disable");
		
	});
	$(".all_mobmove_3_2").click(function(){
		var data_mode=$(this).attr("data-mode");
		if(data_mode=="enable"){
			var tab_type='';
			var target_tab='';
			$('#tab3_slider .item .box_select .add_cart').each(function () {
				tab_type=$(this).attr("data-title");   
				target_tab=$("#tab2 .mob_block").attr("data-title");
				if(tab_type==target_tab || !target_tab){
					$(this).trigger("click");
				}
                else{
                    alert("抱歉！只能單向拖曳！請先完成目前預約程序再進行下一筆預約！");
                    $(this).attr("data-mode","disable");
                    return false;
                }
			});

		}
		$(this).attr("data-mode","disable");
	});
	$(".all_move_1_2").click(function(){
		var box_type=$("#box_div_1 .box_img_block").attr('data-title');
		console.log(box_type);
		if(box_type!="tab3_box"){
			var all_boxes=[];
			var index=0;
			$('#tab1 .box_images .box_img_block').each(function () {
				var ar = this.id;
				var draggable = $(this).attr('draggable');
				//alert(data_is_rtn);
				if(draggable=="true"){
					all_boxes[index]=ar;
					console.log(ar);
					index++;
				}
			});
			var curr_cout=parseInt($('.topnum2 span').text());
			var topnum1_cout=parseInt($('.topnum1 span').text());
			//console.log(all_boxes.length);
			var no_boxes=all_boxes.length
			for(var i=0;i<no_boxes;i++){
				var data = all_boxes[i];
				
				document.getElementById("box_div_"+(i+1+curr_cout)).appendChild(document.getElementById(data));
			}
			$('#submit_form').prop("action", "/schedule-pickup-post");
			$('.topnum2 span').text(curr_cout+no_boxes);
			$('.topnum1 span').text(topnum1_cout-no_boxes);
			$('.single_imgae_box').each(function () {
				if(!$(this).children().length > 0){
					$(this).css("padding","0px");
				}
			});

		}else{
			alert("抱歉！只能單向拖曳！請先完成目前預約程序再進行下一筆預約！");
		}
    }); 
	$("#tab3 .all_move_3_2").click(function(){
		var box_type=$("#box_div_1 .box_img_block").attr('data-title');
		if(box_type!="tab1_box"){
			var all_boxes=[];
			var index=0;
			$('#tab3 .box_images .box_img_block').each(function () {
				var ar = this.id;
				all_boxes[index]=ar;
				//console.log(ar);
				index++;
			});
			var curr_cout=parseInt($('.topnum2 span').text());
			//console.log(all_boxes.length);
			var no_boxes=all_boxes.length
			for(var i=0;i<no_boxes;i++){
				var data = all_boxes[i];
				document.getElementById("box_div_"+(i+1+curr_cout)).appendChild(document.getElementById(data));
			}
			$('#submit_form').prop("action", "/schedule-item-post");
			$('.topnum2 span').text(no_boxes+curr_cout);
			$('.topnum3 span').text(0);
			$('.single_imgae_box').each(function () {
				if(!$(this).children().length > 0){
					$(this).css("padding","0px");
				}
			});
		}else{
			alert("抱歉！只能單向拖曳！請先完成目前預約程序再進行下一筆預約！");
		}
    }); 
	/** box drag end */ 

    
    function add_slide_cart(obj, cal){
        var boxid = obj.data('box-id');
        var myType = obj.data('type');
        var isModal = obj.data('is-modal');
        var origObj = obj;
        if(myType == "slide" && isModal == 1){
            obj = $("#tab_add_to_cart_btn_" + boxid);    
        }
        var tab_type=obj.attr("data-title");   
        var target_tab=$("#tab2 .mob_block").attr("data-title");
        if(tab_type==target_tab || !target_tab){
            html = obj.closest('.item').find('.box_img_block').html();
			obj.closest('.item').remove();
			if(tab_type=="tab1_box"){
				$("#tab1_slider .item" ).first().addClass("active");
				$("#tab1_slider .carousel-indicators li" ).first().remove();
				$("#tab1_slider .carousel-indicators li" ).first().addClass("active");
			}else{
				$("#tab3_slider .item" ).first().addClass("active");
				$("#tab3_slider .carousel-indicators li" ).first().remove();
				$("#tab3_slider .carousel-indicators li" ).first().addClass("active");
			}
            //$('#tab4 #tab2_slider .carousel-inner').append('<div class="box_img_block tab4box" id="m1">'+html+'</div>');
            var no_items=$('#tab2 #tab2_slider .carousel-inner').children().length;
            if(no_items > 0){
                $('#tab2 #tab2_slider .carousel-inner').append('<div class="item"><div class="box_img_block mob_block box_img_block_slide" id="m' + boxid + '" data-title="'+tab_type+'">'+html+'</div></div>');
                $('#tab2 #tab2_slider .carousel-indicators').append('<li data-target="#tab2_slider" data-slide-to="'+no_items+'"></li>');
            }else{
                $('#tab2 #tab2_slider .carousel-indicators').append('<li data-target="#tab2_slider" data-slide-to="'+no_items+'" class="active"></li>');
                $('#tab2 #tab2_slider .carousel-inner').append('<div class="item active"><div class="box_img_block mob_block box_img_block_slide" id="m' + boxid + '" data-title="'+tab_type+'">'+html+'</div></div>');
            }
        
            $(".box_img_block_slide .boxname-slide").change(function(){
                var boxid = $(this).data('box-id');
                var name = $(this).val();
                $(".updateboxname").data('name',name);    
            })            
            
            $(".box_img_block_slide .thumb_u_img").click(function(){
                var img_id=$(this).attr('id');
                $(".box_img_block_slide #thumb_upload"+img_id).trigger('click');
            });
                               
        
            $(".box_img_block_slide .updateboxname").click(function(){
                type = $(this).data('type');
                id = $(this).data('id');
                if(type == "slide"){
                    name = $(this).data('name');
                }else{
                    name = $('#box_'+id+'_name').val();                
                }
                
                $(".boxname-slide-" + id).prop("value", name)
                
                $.get("{{url('/updateboxnameajax')}}",
                {
                    id: id,
                    name: name
                },
                function(data, status){
                    
                    if (data == 'success') {
                        alert("更新成功!!");
                    }
                });
            });
             
            //$('#tab4 .carousel-inner').append(html);
            var order_id=obj.data("order-id");
            if(tab_type=="tab3_box"){
                
                $('#submit_btn').prop("disabled",false);
                $('#submit_btn').html("確認訂單");
                $('#submit_alert_button').html("確認訂單");
                $('#submit_wording').html("出倉中的物品");
                $('#submit_action').val("out");
                $('#submit_form').prop("action", "/schedule-item-post");
                $('#wareHouseType').val("rtn");
                
            }else{

                $('#submit_btn').html("確認訂單");
                $('#submit_alert_button').html("確認訂單");
                $('#submit_wording').html("進倉中的物品");
                $('#submit_action').val("in");
                $('#submit_form').prop("action", "/schedule-pickup-post");
                $('#wareHouseType').val("pick");
                if(cal !== false){
                    var max_order_cnt = parseInt($('#order_cnt_' + order_id).html())
                    var current_cnt = parseInt($('#actual_order_cnt_' + order_id).html());
                    var compare_cnt = current_cnt + 1;
                    if(compare_cnt < max_order_cnt){
                        //alert("訂單編號 " + order_id + " 仍有箱子未預約!!");
                        $('#order_complete').html("N");
                        //$('#submit_btn').prop("disabled",true);
                        $('#actual_order_cnt_' + order_id).html(compare_cnt);
                        //exit();
                    }else{
                        $('#order_complete').html("Y");
                        //$('#submit_btn').prop("disabled",false);
                        $('#actual_order_cnt_' + order_id).html(compare_cnt);                
                    }
                }
            }
   
            if(cal !== false){
                num = parseInt($('.topnum2 span').text());
                $('.topnum2 span').text(num+1);

                if(tab_type=="tab3_box"){         
                    tab3 = parseInt($('.topnum3 span').text());
                    if(tab3>0){
						$('.topnum3 span').text(tab3 - 1);  
					}					
                }else{
					
                    tab1 = parseInt($('.topnum1 span').text());
					if(tab1>0){
						$('.topnum1 span').text(tab1 - 1); 
					}					
                }
                //alert("已將此物品移至貨車!!");
            }
            
            var prefix = "";
            if(isModal == 1){
                prefix = "slide_";
                origObj.hide();
            }
            //alert("#tab3_modal_" + prefix + boxid);
            $("#tab3_modal_" + prefix + boxid).modal("hide");
                            
            obj.prop("disabled",true);
            obj.html("已移至貨車");
                 
        }else{
            alert("抱歉！只能單向拖曳！請先完成目前預約程序再進行下一筆預約！");
        }        
    }   
       
    function add_img_cart(obj, cal){
        var title = obj.data("title");
        var boxid = obj.data("box-id");   
        var id=obj.attr('id');
        //alert(id);
        if(title == "tab3_box"){
            drop(id,"add_modal",cal);
            $("#tab3_modal_"  + boxid).modal("hide");
        }else{
            id="tab1_" + boxid;
            drop(id,"add_slide",false);
        }   
    }
             
    $(".add_cart").click(function(event){
        var myType = $(this).data('type');
        var boxid = $(this).data('box-id');
        var title = $(this).data('title');
        if(myType == "slide") {
            //imgObj = $("#tab3_" + boxid);
            add_slide_cart($(this),true);
            if(title == "tab3_box"){
                imgObj = $("#modal-content-slide_"+boxid+" #tab3_" + boxid);
                add_img_cart(imgObj,false);
            }else{ 
                add_img_cart($(this),false);
            }   
        }else{ 
            add_img_cart($(this),true);  
        }
    });
    
    
        $(".updateboxname").click(function(){
            type = $(this).data('type');
            id = $(this).data('id');
            isModal = $(this).data('is-modal');
            if(type == "slide"){
                if(isModal == 1){
                    name = $('#slide_modal_box_'+id+'_name').val();
                }else{
                    name = $('#slide_box_'+id+'_name').val();
                }
            }else{
                if(isModal == 1){
                    name = $('#modal_box_'+id+'_name').val();
                }else{
                    name = $('#box_'+id+'_name').val();
                }                
            }
            
            $('.label-name-' +  id).html(name);
            
            $.get("{{url('/updateboxnameajax')}}",
            {
                id: id,
                name: name
            },
            function(data, status){
                
                if (data == 'success') {
                    alert("更新成功!!");
                }
            });
        });
                 
        function upload(input,id,uid){    
            
            if (input.files && input.files[0]) {
                var data = new FormData();
                data.append('pictureFile', input.files[0] );
                data.append('box_id', uid );     
               
                $.ajax({
                    type: 'POST',               
                    processData: false, // important
                    contentType: false,
                    // important
                    data: data,
                    url: "{{url('/updateboximgajax')}}",
                    success: function(data){
                        if(data.status == "success"){
                            var box_id = id;
                            var reader = new FileReader();
                            reader.onload = function (e) {
                                $('.thumb'+box_id)
                                    .attr('src', e.target.result)
                                    .width(140)
                                    .height(140);
                                $('.main_img_'+box_id)
                                    .attr('src', e.target.result)
                                    .width("100%")
                                    .height("100%");
                            };
                            reader.readAsDataURL(input.files[0]);
                            $(".thumb"+box_id).removeClass('dfdvg');
                            //$(".thumb_txt_"+box_id).hide();

                            // append other variables to data if you want: data.append('field_name_x', field_value_x);
                        }

                       alert(data.response);
                       //alert("上傳成功!!");
                    }
                    
                }); 
            }else{
                alert("資料格式有誤!!");
            }
            
            
        }    
    
        $("#tab2submit").click(function () {
            window.location.href = '{{url('/schedule-pickup')}}';
            return false;
        });
		$(window).resize(function() {
			var screen_W=$(window).width();
            $(".bottom_section").css("min-height",screen_W*.55);
            $(".bottom_section_3").css("min-height",screen_W*.55);
			
		});
        $(document).ready(function(){
            
            $('#submit_btn').click(function(){
                if($('#submit_action').val() == "in" && "N" == $('#order_complete').html()){
                    alert("我的位置 仍有箱子未預約!!");
                    return;
                }else{
                    $("#submit_form").submit();
                }
            })
                    
            var screen_W=$(window).width();
            $(".bottom_section").css("min-height",screen_W*.55);
            $(".bottom_section_3").css("min-height",screen_W*.55);
            /*
            $('.ajaximg').change(){
                alert($(this).props('id'));
            });
            */
             $.ajaxSetup(
            {
                headers:
                {
                    'X-CSRF-Token': $('input[name="_token"]').val()
                }
            });
            
            $('.modal_upload_obj').change(function(){
                var id = $(this).data('id');
                var box_id = id;
                upload(this,box_id, box_id);
                //$("#modal_thumb"+box_id).removeClass('dfdvg');   
            })  
             
            
            $('.modal_upload').click(function(){
                $('#thumb_upload_modal_' + $(this).data('id')).click();
            })     
            
            $('body .tab_dv').css('width', '33%');
            if ($(window).width() < 768) {            
             
             $('body').css('overflow', 'hidden');
             
               $('#topbar').css('display', 'none');
              
            }
            
            var height = $('#tabimgonec').height();
            $('#tabimp').css('height', height+'px');
            var height3 = $('#tabimgtwoc').height();
            //$('.bottom_section_3').css('height', height+'px');
            //$('html').css('overflow','scroll');
            
            $(".nav-tabs a").click(function(){
                $(this).tab('show');
            });
            
        });
		$.fn.selectRange = function(start, end) {
			return this.each(function() {
				if (this.setSelectionRange) {
					this.focus();
					this.setSelectionRange(start, end);
				} else if (this.createTextRange) {
					var range = this.createTextRange();
					range.collapse(true);
					range.moveEnd('character', end);
					range.moveStart('character', start);
					range.select();
				}
			});
		};


        $(document).ready(function(){




			$(".boxname").focus(function(){
				$(this).selectRange(100,100);
				
			});
			$(".carousel").carousel("pause");
			$("#tab3_slider").carousel("pause");
            
            @if($isBack == "Y")
            $("#tabathree").click();
            @endif
		});
    </script>
    
@endsection