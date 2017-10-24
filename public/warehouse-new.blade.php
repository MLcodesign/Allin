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
                        <a data-toggle="tab" href="#tab1">
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
                            <a data-toggle="tab" href="#tab2">
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
                        <li>
                            <a data-toggle="tab" href="#tab3">
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
                        <li id="tabfourtli">
                            <a href="#tab2" data-toggle="tab">
                                <div class="tab_dv cart">
                                    <div class="top_head">
                                        <div class="top_num">
                                            <div class="num_inner">
                                                <span class="numfourth">0</span>
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
                    </ul>
                </div>
                <div class="lines_div">
                </div>
                <div class="tab-content box_tab_content">
                    <div id="tab1" style="z-index: 99;" class="tab-pane fade in active">    
                        <div class="bottom_section">
                            <div class="top_arrow_text">
                                <div class="top_arrow">
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
                                </div>
                                <div class="bottom_box_images">
                                   @foreach($largeBoxes as $box)
                                   @include('member.warehouse-new-box',['box' => $box]) 
                                   @endforeach
                                </div>
                            </div>
                            <!-- slider-->
                            <div id="tab1_slider" class="carousel slide" data-ride="carousel">
                                <!-- Indicators -->
                                <ol class="carousel-indicators">
                                 @foreach($boxes as $i => $box)
                                 <li data-target="#tab1_slider" data-slide-to="{{$box->id}}" class="<?php if ($i == 0) { echo 'active'; }?>"></li>
                                 @endforeach
                                </ol>

                                <!-- Wrapper for slides -->
                                <div class="carousel-inner" style="z-index:99;position:relative" role="listbox">
                                  @foreach($boxes as $i => $box)
                                  @include('member.warehouse-new-box-slide',['box' => $box]) 
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
								<div class="sub_title">編輯完成後，別忘了到下方點選”確認訂單”唷</div>
							{{ csrf_field() }}
                                <div class="box_images">
                                    <div class="top_box_images">
                                    <?php $counc = 1; ?>
                                    <?php $totalCnt = count($boxes) + count($boxestabs) + count($largeBoxes); ?>
                                     @for($x = 0; $x < $totalCnt; $x++)
                                        <div class="box_imgs">
                                            <div id="box_div_<?php echo $counc; ?>" class="droptarget" ondrop="drop(event,<?php echo $counc++; ?>)" ondragover="allowDrop(event)"></div>
                                            
                                        </div>
                                     @endfor
                                    </div>
                                    <?php $last=$totalCnt;?>
                                    <div class="bottom_box_images"> 
                                        <div class="box_imgss">
                                            <div id="box_div_<?php echo $last; ?>" class="droptarget" ondrop="drop(event,<?php echo $last; ?>)" ondragover="allowDrop(event)"></div>
                                        </div>
                                    </div>
                                    <div class="btm_buttons">
                                        <button type="submit" class="submit_btns" name="submit_btn" id="submit_btn" disabled>確認訂單</button>
                                        <input type="hidden" name="action" id="submit_action" value="結帳" />
                                        <input type="hidden" name="wareHouseType" id="wareHouseType" value="" />
                                    </div>
                                </div> 
                            </form>
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
                                <div class="checkout_btn">
                                    <button type="button" class="submit_btns" name="submit_btn">結帳</button>
                                </div>
                            </div>
                            <!-- slider -->
                        </div>
                    </div>
                    <!-- tab3 contents-->
                    <div id="tab3" class="tab-pane fade">
                        <div class="bottom_section_3" style="">
                            <div class="top_arrow_text">
                                <div class="top_arrow">
                                    <img src="/assets/dist/img/warehouse/back_arrow.png">
                                </div>
                                <div class="arrow_text_3">
                                    <p>請將箱子拖曳至我的位置標籤，即可申請退倉</p>
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
                                  <li data-target="#tab3_slider" data-slide-to="0" class="active"></li>
                                  <li data-target="#tab3_slider" data-slide-to="1"></li>
                                  <li data-target="#tab3_slider" data-slide-to="2"></li>
                                 
                                </ol>

                                <!-- Wrapper for slides -->
                                <div class="carousel-inner" role="listbox">
                                  <div class="item active">
                                    <div class="box_select">
                                        <button type="submit" class="add_to_cart" id="" data-title="tab3_box">移到貨車</button>
                                    </div>
                                    <div class="box_title">
                                        <p>冬天衣服</p>
                                    </div>
                                    <div class="box_img_block">
                                        <img src="/assets/dist/img/warehouse/newone.png" alt="Chania" width="460" height="345" data-toggle="modal" data-target="#tab3_modal_284">
                                    </div>
                                  </div>

                                  <div class="item">
                                    <div class="box_select">
                                        <button type="submit" class="add_to_cart" id="" data-title="tab3_box">移到貨車</button>
                                    </div>
                                    <div class="box_title">
                                        <p>冬天衣服</p>
                                    </div>
                                    <div class="box_img_block">
                                        <img src="/assets/dist/img/warehouse/newone.png" alt="Chania" width="460" height="345" data-toggle="modal" data-target="##tab3_modal_284">
                                    </div>
                                  </div>
                                
                                  <div class="item">
                                    <div class="box_select">
                                        <button type="submit" class="add_to_cart" id="" data-title="tab3_box">移到貨車</button>
                                    </div>
                                    <div class="box_title">
                                        <p>冬天衣服</p>
                                    </div>
                                    <div class="box_img_block">
                                        <img src="/assets/dist/img/warehouse/newone.png" alt="Flower" width="460" height="345" data-toggle="modal" data-target="##tab3_modal_284">
                                    </div>
                                  </div>

                                  
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
                                    <button style="display:none" type="button" class="checkout_btn" name="checkout_btn">退倉</button>
                                </div>
                            </div>
                            <!-- slider -->
                        </div>    
                    </div>

                    <div id="tab4" style="height: 0;" class="tab-pane fade">
                    
                        <div class="bottom_sections">
                            <div class="arrow_texts">
                                <p>待運送物品</p>
                            </div>
                            <div class="box_images">
                                <div class="top_box_images">
                                    <div class="box_imgs">
                                        <div id="box_div_1" class="droptarget" ondrop="drop(event,1)" ondragover="allowDrop(event)"></div>
                                        <!--
                                        <input id="box_div_file1" type='file' onchange="readURL(this,1);" />
                                        <div class="uploadable_div upload1" id="1">
                                            <img id="blah1" src="#" alt="your image" />
                                            <p class="upload_text upload_txt_1">上傳照片</p>
                                        </div>
                                        -->
                                    </div>
                                    <div class="box_imgs">
                                        <div id="box_div_2" class="droptarget" ondrop="drop(event,2)" ondragover="allowDrop(event)"></div>
                                        
                                    </div>
                                    <div class="box_imgs">
                                        <div id="box_div_3" class="droptarget" ondrop="drop(event,3)" ondragover="allowDrop(event)"></div>
                                        
                                    </div>
                                    <div class="box_imgs">
                                        <div id="box_div_4" class="droptarget" ondrop="drop(event,4)" ondragover="allowDrop(event)"></div>
                                        
                                    </div>
                                    
                                </div>
                                <div class="bottom_box_images">
                                    <div class="box_imgss">
                                        <div id="box_div_5" class="droptarget" ondrop="drop(event,5)" ondragover="allowDrop(event)"></div>
                                        
                                    </div>
                                </div>    
                                <div class="btm_buttons">
                                    <button type="button" class="submit_btns" name="submit_btn">結帳</button>
                                </div>
                            </div> 
                            <!-- slider-->
							<div id="tab7_slider" class="carousel slide" data-ride="carousel">
                                <!-- Indicators -->
                                <ol class="carousel-indicators">
                                  <li data-target="#tab7_slider" data-slide-to="0" class="active"></li>
                                  <li data-target="#tab7_slider" data-slide-to="1"></li>
                                  <li data-target="#tab7_slider" data-slide-to="2"></li>
                                  <li data-target="#tab7_slider" data-slide-to="3"></li>
                                </ol>

                                <!-- Wrapper for slides -->
                                <div class="carousel-inner" role="listbox">
                                  <div class="item active">
                                    <div class="box_select">
                                        <button type="submit" class="add_to_cart" id="">移到貨車</button>
                                    </div>
                                    <div class="box_img_block" id="m21">
                                        <img src="/assets/dist/img/warehouse/box.png" alt="Chania" width="460" height="345">
                                        <input id="thumb_uploadm21" class="none_block" type='file' onchange="upload(this,'m21');" />
                                        <div class="thumb_u_img thumb_u_m21" id="m21">
                                            <div class="thumb_text">
                                                <p class="upload_text thumb_txt_m21"> 上傳照片</p>
                                            </div>
                                            <img id="thumbm21" class="none_block thumb" src="#" alt="your image" />
                                        </div>
                                    </div>
                                  </div>

                                  <div class="item">
                                    <div class="box_select">
                                        <button type="submit" class="add_to_cart" id="">移到貨車</button>
                                    </div>
                                    <div class="box_img_block" id="m22">
                                        <img src="/assets/dist/img/warehouse/box.png" alt="Chania" width="460" height="345">
                                        <input id="thumb_uploadm22" class="none_block" type='file' onchange="upload(this,'m22');" />
                                        <div class="thumb_u_img thumb_u_m22" id="m22">
                                            <div class="thumb_text">
                                                <p class="upload_text thumb_txt_m22"> 上傳照片</p>
                                            </div>
                                            <img id="thumbm22" class="none_block thumb" src="#" alt="your image" />
                                        </div>
                                    </div>
                                  </div>
                                
                                  <div class="item">
                                    <div class="box_select">
                                        <button type="submit" class="add_to_cart" id="">移到貨車</button>
                                    </div>
                                    <div class="box_img_block" id="m23">
                                        <img src="/assets/dist/img/warehouse/box.png" alt="Chania" width="460" height="345">
                                        <input id="thumb_uploadm23" class="none_block" type='file' onchange="upload(this,'m23');" />
                                        <div class="thumb_u_img thumb_u_m23" id="m23">
                                            <div class="thumb_text">
                                                <p class="upload_text thumb_txt_m23"> 上傳照片</p>
                                            </div>
                                            <img id="thumbm23" class="none_block thumb" src="#" alt="your image" />
                                        </div>
                                    </div>
                                  </div>

                                  <div class="item">
                                    <div class="box_select">
                                        <button type="submit" class="add_to_cart" id="">移到貨車</button>
                                    </div>
                                    <div class="box_img_block" id="m24">
                                        <img src="/assets/dist/img/warehouse/box.png" alt="Chania" width="460" height="345">
                                        <input id="thumb_uploadm24" class="none_block" type='file' onchange="upload(this,'m24');" />
                                        <div class="thumb_u_img thumb_u_m24" id="m24">
                                            <div class="thumb_text">
                                                <p class="upload_text thumb_txt_m24"> 上傳照片</p>
                                            </div>
                                            <img id="thumbm24" class="none_block thumb" src="#" alt="your image" />
                                        </div>
                                    </div>
                                  </div>
								   
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
                                <div class="checkout_btn">
                                        <button type="submit" class="submit_btns" name="submit_btn" id="submit_btn" disabled>確認訂單</button>
                                        <input type="hidden" name="action" id="submit_action" value="結帳" />
                                        <input type="hidden" name="wareHouseType" id="wareHouseType" value="" />
                                    </div>
                                
                            </div>
                            
                            <!-- slider -->
                            
                        </div>
                    </div> 
                </div><!-- tab content-->
        </div>
        
  </div>

        
@foreach($boxestabs as $i => $box)
@include('member.warehouse-new-modal', ['box' => $box])
@endforeach

@foreach($orders as $key => $ary)
<div style="display:none">
    <p id="order_cnt_{{$key}}">{{$ary['cnt']}}</p>
    <p id="actual_order_cnt_{{$key}}">0</p>
</div>
@endforeach

@endsection
@section('js')
    {!! Html::script('/assets/dist/js/box_drag.js') !!}
 
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
          
          
    
    $("body .add_to_cart").click(function(){
        var tab_type=$(this).attr("data-title");
        $(this).prop("disabled",true);
        var target_tab=$("#tab4 .mob_block").attr("data-title");
        if(tab_type==target_tab || !target_tab){
            html = $(this).closest('.item').find('.box_img_block').html();
            //$('#tab4 #tab2_slider .carousel-inner').append('<div class="box_img_block tab4box" id="m1">'+html+'</div>');
            var no_items=$('#tab2 #tab2_slider .carousel-inner').children().length;
            if(no_items > 0){
                $('#tab2 #tab2_slider .carousel-inner').append('<div class="item"><div class="box_img_block mob_block" id="m1" data-title="'+tab_type+'">'+html+'</div></div>');
                $('#tab2 #tab2_slider .carousel-indicators').append('<li data-target="#tab2_slider" data-slide-to="'+no_items+'" class="active"></li>');
                
            }else{
                $('#tab2 #tab2_slider .carousel-indicators').append('<li data-target="#tab2_slider" data-slide-to="'+no_items+'"></li>');
                $('#tab2 #tab2_slider .carousel-inner').append('<div class="item active"><div class="box_img_block mob_block" id="m1" data-title="'+tab_type+'">'+html+'</div></div>');
            }
            //$('#tab4 .carousel-inner').append(html);
            num = parseInt($('.numfourth').text());
            $('.numfourth').text(num+1);
			tab3 = parseInt($('.topnum3 span').text());
			$('.topnum3 span').text(tab3 - 1);
        }else{
            alert("抱歉！只能單向拖曳！請先完成目前預約程序再進行下一筆預約！");
        }
    });
    
    
        $("body .updateboxname").click(function(){
            id = $(this).data('id');
            name = $('#box_'+id+'_name').val();
            
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
                var box_id = id;
                var reader = new FileReader();
                reader.onload = function (e) {
                $('#thumb'+box_id)
                    .attr('src', e.target.result)
                    .width(140)
                    .height(140);
                };
                reader.readAsDataURL(input.files[0]);
            }
            $("#thumb"+box_id).removeClass('dfdvg');
            //$(".thumb_txt_"+box_id).hide();
            
            
            var data = new FormData();
            data.append('pictureFile', input.files[0] );
            data.append('box_id', uid );
            // append other variables to data if you want: data.append('field_name_x', field_value_x);

            
            
            $.ajax({
                type: 'POST',               
                processData: false, // important
                contentType: false,
                // important
                data: data,
                url: "{{url('/updateboximgajax')}}",
               success: function(data){
                   alert("上傳成功!!");
                }
                
            }); 
            
            
        }    
    
        $("#tab2submit").click(function () {
            window.location.href = '{{url('/schedule-pickup')}}';
            return false;
        });
        $(document).ready(function(){
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
                var reader = new FileReader();
                reader.onload = function (e) {
                $('#main_img_'+box_id)
                    .attr('src', e.target.result)
                    .width("100%")
                    .height("100%");
                }
                reader.readAsDataURL(this.files[0]);
                //$("#modal_thumb"+box_id).removeClass('dfdvg');   
            })  
             
            
            $('.modal_upload').click(function(){
                $('#thumb_upload_modal_' + $(this).data('id')).click();
            })     
            
            if ($(window).width() < 768) {
            
            htmltablast  = $('#tabfourtli').html();
            
            $( "<li>"+htmltablast+"</li>" ).insertAfter( "#tabonetli" );
            
            $('#tabfourtli').remove();
            
            $('#tabtwoli').css('display', 'none');
            
            $('body .tab_dv').css('width', '33%');
             
             $('body').css('overflow', 'hidden');
             
               $('#topbar').css('display', 'none');
              
            } else {
                
                 $('#tab7_slider').css('display', 'none'); 
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
    
        
    </script>
    
@endsection