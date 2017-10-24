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
            
                background: url(http://139.162.20.250/assets/dist/img/warehouse/tab2_bg.png);
                height: 344px;
                float: left;
                width: 100%;
                background-repeat: no-repeat;
                background-size: 100% 100%;
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
                            <a href="#tab4" data-toggle="tab">
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
                                <?php $cnx = 1; ?>
                                   @foreach($boxes as $i => $box)
                                   <?php $cn = $i+1;  ?>
                                   <div class="single_imgae_box tabonecount">
                                        <div class="box_img_block" data-title="tab1_box" id="<?php echo $cnx ++ ?>"  draggable="true" ondragstart="drag(event)">
                                            <div class="row" style="margin: 0 auto;width: 178px;">
                                               <div class="col-md-8" style="padding: 0;"> <input style="position: inherit;z-index: 9999;" boxid="{{$box->id}}"  type="text"  id="bkey{{$cn}}input" class="boxname" name="boxesbase[{{$i}}][name]" value="{{$box->name}}"><input style="position: inherit;z-index: 9999;" type="hidden"  id="bid{{$cn}}input" name="boxesbase[{{$i}}][id]" value="{{$box->id}}"><input style="position: inherit;z-index: 9999;" type="hidden"  id="badminid{{$cn}}input" name="boxesbase[{{$i}}][admin_id]" value="{{$box->admin_id}}"></div>
                                               <div class="col-md-4" style="padding: 0;"> <button style="margin-left: 2px;line-height: 14px;height: 28px;position: inherit;z-index: 9999;" type="button" id="bkey{{$cn}}"  idx="{{$cn}}" class="btn updateboxname btn-block btn-warning">儲存</button></div>
                                            </div>
                                            <img id="{{$cn}}" class="box_img" src="/assets/dist/img/warehouse/box.png">
                                            <div class="thumb_img">
                                                <img id="thumb{{$cn}}"  class="nexa thumb dfdvg utiuplod_{{$cn}}" src="#"  />
                                            </div>
                                            <input id="thumb_upload{{$cn}}" name="file" onchange="upload(this,{{$cn}});" class="none_block" type='file'  />
                                            <div class="thumb_u_img thumb_u_{{$cn}}" id="{{$cn}}">
                                                <div class="thumb_text">
                                                    <p class="upload_text thumb_txt_{{$cn}}"> 上傳照片</p>
                                                </div>
                                            
                                            </div>
                                        </div> 
                                    </div>
                                   
                                  @endforeach
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                </div>
                                <?php $last=count($boxes)+1;?>
                                <div class="bottom_box_images">
                                    <div class="single_imgae_boxs tabonecount">
                                        <div class="box_img_block" id="<?php echo $last;?>" data-title="tab1_box" draggable="true" ondragstart="drag(event)">
                                            <div class="row" style="margin: 0 auto;width: 178px;">
                                               <div class="col-md-8" style="padding: 0;"> <input style="position: inherit;z-index: 9999;" boxid="<?php echo $last;?>"  type="text"  id="bkey<?php echo $last;?>input" class="boxname" name="boxname" value=""></div>
                                               <div class="col-md-4" style="padding: 0;"> <button style="margin-left: 2px;line-height: 14px;height: 28px;position: inherit;z-index: 9999;" type="button" id="bkey{{$cn}}"  idx="{{$cn}}" class="btn updateboxname btn-block btn-warning">儲存</button></div>
                                            </div>
                                            <img id="<?php echo $last;?>" class="box_img" src="/assets/dist/img/warehouse/large_box.png">
                                            <div class="thumb_img">
                                                <img id="thumb<?php echo $last;?>" class="nexa thumb dfdvg utiuplod_<?php echo $last;?>" src="#" alt="your image" />
                                            </div>
                                            <input id="thumb_upload<?php echo $last;?>" class="none_block" type='file' onchange="upload(this,<?php echo $last;?>);" />
                                            <div class="thumb_u_img thumb_u_<?php echo $last;?>" id="<?php echo $last;?>">
                                                <div class="thumb_text">
                                                    <p class="upload_text thumb_txt_<?php echo $last;?>"> 上傳照片</p>
                                                </div>
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>    
                                
                                 <div class="text-center"> {!!$boxes->links()!!}</div>
                                
                            
                            </div>
                            <!-- slider-->
                            <div id="tab1_slider" class="carousel slide" data-ride="carousel">
                                <!-- Indicators -->
                                <ol class="carousel-indicators">
                                 @foreach($boxes as $i => $box)
                                  <?php $cnn = $i; ?>
                                 <li data-target="#tab1_slider" data-slide-to="{{$cnn}}" class="<?php if ($cnn == 0) { echo 'active'; }?>"></li>
                                 
                                   @endforeach
                                </ol>

                                <!-- Wrapper for slides -->
                                <div class="carousel-inner" style="z-index:99;position:relative" role="listbox">
                                
                                @foreach($boxes as $i => $box)
                                 <?php $cnnn = $i; ?>
                                  <div class="item <?php if ($cnnn == 0) { echo 'active'; }?>">
                                    <div class="box_select">
                                        <button type="submit"  class="add_to_cart" id="" data-title="tab1_box">移到貨車</button>
                                    </div>
                                    
                                    <div class="box_img_block mob_block" id="m1" data-title="tab1_box">
                                        <div class="row" style="margin: 0 auto;width: 178px;">
                                           <div class="col-md-8 save_input" style="padding: 0;"> <input style="position: inherit;z-index: 9999;" boxid="{{$box->id}}"  type="text"  id="bkey{{$cn}}input" class="boxname" name="boxname" value="{{$box->name}}"></div>
                                           <div class="col-md-4 save_btn" style="padding: 0;"> <button style="margin-left: 2px;line-height: 14px;height: 28px;position: inherit;z-index: 9999;" type="button" id="bkey{{$cn}}"  idx="{{$cn}}" class="btn updateboxname btn-block btn-warning">儲存</button></div>
                                        </div>
                                        <img src="/assets/dist/img/warehouse/box.png" alt="Chania" width="460" height="345">
                                        <input id="thumb_uploadm1" class="none_block" type='file' onchange="upload(this,'m1');" />
                                        <div class="thumb_u_img thumb_u_m1" id="m1">
                                            <div class="thumb_text">
                                                <p class="upload_text thumb_txt_m1">上傳照片 <!--{{$box->name}}--> </p>
                                            </div>
                                            <img id="thumbm1" class="none_block thumb" src="#" alt="your image" />
                                        </div>
                                    </div>
                                  </div>

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
                                <p>進倉中的物品</p>
                            </div>
                            <form action="" name="tab2_form" method="POST">
                            {{ csrf_field() }}
                                <div class="box_images">
                                    <div class="top_box_images">
                                    <?php $counc = 1; ?>
                                     @foreach($boxes as $i => $box)
                                        <div class="box_imgs">
                                            <div id="box_div_<?php echo $counc; ?>" class="droptarget" ondrop="drop(event,<?php echo $counc++; ?>)" ondragover="allowDrop(event)"></div>
                                            
                                        </div>
                                     @endforeach
                                        
                                    
                                        
                                    </div>
                                    <?php $last=count($boxes)+1;?>
                                    <div class="bottom_box_images">
                                        <div class="box_imgss">
                                            <div id="box_div_<?php echo $last; ?>" class="droptarget" ondrop="drop(event,<?php echo $last; ?>)" ondragover="allowDrop(event)"></div>
                                            
                                        </div>
                                    </div>
                                    <div class="btm_buttons">
                                        <button type="submit" class="submit_btns" name="submit_btn">結帳</button>
                                    </div>
                                </div> 
                            </form>
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
                                    <?php 
                                    $box=6;
                                    for($i=1;$i<=$box;$i++){?>
                                    <div class="single_imgae_box tabonecount">
                                        <div class="box_img_block" id="tab3_<?php echo $i;?>" data-title="tab3_box"  draggable="true" ondragstart="drag(event)">
                                            <div class="box_title">
                                                <p>冬天衣服</p>
                                            </div>
                                            <?php if($i==$box){?>
                                                <img id="<?php echo $i;?>" class="box_img" src="/assets/dist/img/type2_box.png">
                                            <?php }else{ ?>
                                                <img id="<?php echo $i;?>" class="box_img" src="/assets/dist/img/warehouse/newone.png">
                                            <?php } ?>
                                            <div class="thumb_u_img" id="" data-toggle="modal" data-target="#tab3_modal_<?php echo $i;?>">
                                            </div>
                                        </div> 
                                        
                                        <div class="modal fade item_popup" id="tab3_modal_<?php echo $i;?>" role="dialog">
                                            <div class="modal-dialog">
                                            <!-- Modal content-->
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" id="modal_close" data-dismiss="modal">&times;</button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="pop_top_div">
                                                            <div class="img_section">
                                                                <div class="pop_img">
                                                                    <img id="main_img" src="/assets/dist/img/warehouse/popup1.png">
                                                                </div>
                                                                <div class="pop_imgs">
                                                                    <div class="pop_imag">
                                                                        <img id="1" class="small_img" src="/assets/dist/img/warehouse/popup1.png">
                                                                    </div>
                                                                    <div class="pop_imag">
                                                                        <img id="4" class="small_img" src="/assets/dist/img/warehouse/tab1_bg.png">
                                                                    </div>
                                                                    <div class="pop_imag">
                                                                        <img id="3" class="small_img" src="/assets/dist/img/warehouse/tab3_bg.png">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="pop_txt">
                                                                <div class="pop_title">
                                                                    <p>箱子編號</p>
                                                                </div>
                                                                <div class="pop_desc">
                                                                    <p>[boxes-number]</p>
                                                                </div>                                    
                                                                <div class="pop_title">
                                                                    <p>箱子名稱</p>
                                                                </div>
                                                                <div class="pop_desc">
                                                                    <p><input type="text" value="[boxes-name]" placeholder=""></p>
                                                                </div>
                                                                <div class="pop_title">
                                                                    <p>倉儲方案</p>
                                                                </div>
                                                                <div class="pop_desc">
                                                                    <p><input type="text" value="[packages-cost]" placeholder=""></p>
                                                                </div>
                                                                <div class="pop_title">
                                                                    <p>起租日期</p>
                                                                </div>
                                                                <div class="pop_desc">
                                                                    <p><input type="text" value="[orders-pickup date]" placeholder=""></p>
                                                                </div>

                                                                <div class="pop_up_btn">
                                                                    <button type="button" class="modal_btn1">儲存/編輯內容</button>
                                                                </div>
                                                                <div class="pop_up_btn_1">
                                                                    <button type="button" class="modal_btn1">上傳/編輯照片</button>
                                                                </div>
                                                                <div class="pop_home_img">
                                                                    <img class="add_cart" id="tab3_<?php echo $i;?>" data-title="" src="/assets/dist/img/warehouse/pop_home.png">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                
                                                </div>
                              
                                            </div>
                                        </div><!---model --->
                                    </div>
                                <?php } ?>
                                
                                   
                                <?php $counc = 1; ?>
                                
                                  @foreach($boxestabs as $i=>$boxtab)
                                  <div class="single_imgae_box tabonecount">
                        
                                        <div class="box_img_block" id="<?php echo $counc++; ?>" ondrop="drop(event,2)" draggable="true" ondragstart="drag(event)">
                                          
                                            <img id="1" class="box_img" src="/assets/dist/img/warehouse/newone.png">
                                            <input id="thumb_upload1" name="file" onchange="upload(this,1);" class="none_block" type="file">
                                            <div class="thumb_u_img thumb_u_1" id="1">
                                                <div class="thumb_text">
                                                    <p class="upload_text thumb_txt_1"><font><font> {{$boxtab->name}}</font></font></p>
                                                </div>
                                                <img id="thumb1" class="nexa thumb dfdvg utiuplod_1" src="#">
                                            </div>
                                            
                                            
                                            
                                            
                                            
                                            
                                        </div> 
                                    </div>
                                  
                                  

                                 
                                    @endforeach
                                    
                                    
                                
                                    
                                    
                                    
                                    
                                    
                                    
                                </div>
                                    
                                <!--<div class="btm_button_3">
                                    <button type="button" class="submit_btn" name="submit_btn" data-toggle="modal" data-target="#myModal">下一頁</button>
                                </div>-->
                                
                                
                                 <div class="text-center"> {!!$boxestabs->links()!!}</div>
                                
                                
                            </div>
                            <!-- slider-->
                            <div id="tab3_slider" class="carousel slide" data-ride="carousel">
                                <!-- Indicators -->
                                <ol class="carousel-indicators">
                                  <li data-target="#tab3_slider" data-slide-to="0" class="active"></li>
                                  <li data-target="#tab3_slider" data-slide-to="1"></li>
                                  <li data-target="#tab3_slider" data-slide-to="2"></li>
                                  <li data-target="#tab3_slider" data-slide-to="3"></li>
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
                                        <img src="/assets/dist/img/warehouse/newone.png" alt="Chania" width="460" height="345" data-toggle="modal" data-target="#myModal">
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
                                        <img src="/assets/dist/img/warehouse/newone.png" alt="Chania" width="460" height="345" data-toggle="modal" data-target="#myModal">
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
                                        <img src="/assets/dist/img/warehouse/newone.png" alt="Flower" width="460" height="345" data-toggle="modal" data-target="#myModal">
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
                                        <img src="/assets/dist/img/warehouse/newone.png" alt="Flower" width="460" height="345" data-toggle="modal" data-target="#myModal">
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
                    <!-- -->    



    <!-- tab3 contents-->
                    <div id="tab4" style="height: 0;" class="tab-pane fade">
                    
                        <div class="bottom_sections">
                            <div class="arrow_texts">
                                <p>進倉中的物品</p>
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
                            <div id="tab2_slider" class="carousel slide" data-ride="carousel">
                                <!-- Indicators -->
                                <ol class="carousel-indicators">
                                  
                                  <!--
                                    <li data-target="#tab2_slider" data-slide-to="0" class="active"></li>
                                    <li data-target="#tab2_slider" data-slide-to="1"></li>
                                    <li data-target="#tab2_slider" data-slide-to="2"></li>
                                    <li data-target="#tab2_slider" data-slide-to="3"></li>
                                    -->
                                </ol>

                                <!-- Wrapper for slides -->
                                <div class="carousel-inner" role="listbox">
                                  <!--<div class="item active">
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
                                  </div>-->
                                 
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

                    
                    
                </div><!-- tab content-->
                
                <div class="modal fade item_popup" id="myModal" role="dialog">
                    <div class="modal-dialog">
                    <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            <div class="modal-body">
                                <div class="pop_top_div">
                                    <div class="img_section">
                                        <div class="pop_img">
                                            <img id="main_img" src="/assets/dist/img/warehouse/popup1.png">
                                        </div>
                                        <div class="pop_imgs">
                                            <div class="pop_imag">
                                                <img id="1" class="small_img" src="/assets/dist/img/warehouse/popup1.png">
                                            </div>
                                            <div class="pop_imag">
                                                <img id="4" class="small_img" src="/assets/dist/img/warehouse/tab1_bg.png">
                                            </div>
                                            <div class="pop_imag">
                                                <img id="3" class="small_img" src="/assets/dist/img/warehouse/tab3_bg.png">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="pop_txt">
                                        <div class="pop_title">
                                            <p>箱子編號</p>
                                        </div>
                                        <div class="pop_desc">
                                            <p>[boxes-number]</p>
                                        </div>                                    
                                        <div class="pop_title">
                                            <p>箱子名稱</p>
                                        </div>
                                        <div class="pop_desc">
                                            <p><input type="text" value="[boxes-name]" placeholder=""></p>
                                        </div>
                                        <div class="pop_title">
                                            <p>倉儲方案</p>
                                        </div>
                                        <div class="pop_desc">
                                            <p><input type="text" value="[packages-cost]" placeholder=""></p>
                                        </div>
                                        <div class="pop_title">
                                            <p>起租日期</p>
                                        </div>
                                        <div class="pop_desc">
                                            <p><input type="text" value="[orders-pickup date]" placeholder=""></p>
                                        </div>

                                        <div class="pop_up_btn">
                                            <button type="button" class="modal_btn1">儲存/編輯內容</button>
                                        </div>
                                        <div class="pop_up_btn_1">
                                            <button type="button" class="modal_btn1">上傳/編輯照片</button>
                                        </div>
                                        <div class="pop_home_img">
                                            <img src="/assets/dist/img/warehouse/pop_home.png">
                                        </div>
                                    </div>
                                </div>
                            </div>
        
                        </div>
      
                    </div>
                </div><!---model --->
        </div>
        
  </div>



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
            var no_items=$('#tab4 #tab2_slider .carousel-inner').children().length;
            if(no_items > 0){
                $('#tab4 #tab2_slider .carousel-inner').append('<div class="item"><div class="box_img_block mob_block" id="m1" data-title="'+tab_type+'">'+html+'</div></div>');
                $('#tab4 #tab2_slider .carousel-indicators').append('<li data-target="#tab2_slider" data-slide-to="'+no_items+'" class="active"></li>');
                
            }else{
                $('#tab4 #tab2_slider .carousel-indicators').append('<li data-target="#tab2_slider" data-slide-to="'+no_items+'"></li>');
                $('#tab4 #tab2_slider .carousel-inner').append('<div class="item active"><div class="box_img_block mob_block" id="m1" data-title="'+tab_type+'">'+html+'</div></div>');
            }
            //$('#tab4 .carousel-inner').append(html);
            num = parseInt($('.numfourth').text());
            $('.numfourth').text(num+1);
        }else{
            alert("抱歉！只能單向拖曳！請先完成目前預約程序再進行下一筆預約！");
        }
    });
    
    
        $("body .updateboxname").click(function(){
            
            id = $(this).attr('id');
            idx = $(this).attr('idx');
            
            $('#thumb_upload'+idx+'').appendTo("#formactionsubmit");
            
            $('form#formactionsubmit').submit();
            
            bid = $('#'+id+'input').attr('boxid');
            name = $('#'+id+'input').val();
            
            
            
            $.get("{{url('/updateboxnameajax')}}",
            {
                id: bid,
                name: name
            },
            function(data, status){
                
                if (data == 'success') {
                    
                    //location.reload();
                }
                
                
            });
            
            
            
        });
    
        $("#tab2submit").click(function () {
            window.location.href = '{{url('/schedule-pickup')}}';
            return false;
        });
        $(document).ready(function(){
            
            
            
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