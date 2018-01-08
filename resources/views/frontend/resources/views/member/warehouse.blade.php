@extends('layouts.frontend.member.app')

@section('title', 'ALL IN Warehouse')

@section('css')
    {!! Html::style('/assets/plugins/lightbox/css/lightbox.css') !!}
    {!! Html::style('/assets/warehouse/css/style.css') !!}
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
        <div class="col-md-12 text-center" style="padding-bottom:12px;">
            <h1><b>我的懶人倉</b></h1>
            <h4 class="subtitle">ALL IN Warehouse</h4>
            <p class="y_line"></p>
            <?php /*<h3 class="text-center">您還有 {{ round($credit) }} 剩餘點數</h3>*/ ?>
        </div>
        <div class="col-md-12 text-center" style="padding-bottom:0px; padding-right: 0;
    padding-left: 0;">
            <div class="top_section" style="margin: 0 auto;float: none; width: 50%;">
                <ul id="tabs" class="nav nav-tabs">
                    <li class="active">
                        <a data-toggle="tab" href="#homewarehouse">
                            <div class="tab_dv">
                                <div class="top_head">
                                    <div class="top_num">
                                        <div class="num_inner">
                                            <span class="num"
                                                  id="tab1num"> {{ $countboxes != "" ? count($countboxes) : "" }} </span>
                                        </div>
                                    </div>
                                    <div class="top_img">
                                        <img src="{!! asset('assets/warehouse/images/home.png') !!}">
                                    </div>
                                    <div class="top_text">
                                        <p>我的位置</p>
                                    </div>

                                </div>

                            </div>
                        </a>
                    </li>
                    <li>
                        <a data-toggle="tab" href="#tab1">
                            <div class="tab_dv" ondrop="drop(event)" ondragover="allowDrop(event)" id="drag">
                                <div class="top_heads">
                                    <div class="top_num">
                                        <div class="num_inner">
                                            <span class="num" id="tab2num"> 0 </span>
                                        </div>
                                    </div>
                                    <div class="top_img">
                                        <img class="truck_img" src="{!! asset('assets/warehouse/images/truck.png') !!}">
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
                                    <div class="top_num">
                                        <div class="num_inner">
                                            <span class="num"> {{ count($all_boxes) }}  </span>
                                        </div>
                                    </div>
                                    <div class="top_img">
                                        <img src="{!! asset('assets/warehouse/images/home2.png') !!}">
                                    </div>
                                    <div class="top_text">
                                        <p>懶人倉</p>
                                    </div>

                                </div>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <div class="tab_dv cart">
                                <div class="top_head">
                                    <div class="top_num">
                                        <div class="num_inner">
                                            <span class="num">3</span>
                                        </div>
                                    </div>
                                    <div class="top_img cart_img">
                                        <img src="{!! asset('assets/warehouse/images/icon_cart.png') !!}">
                                    </div>
                                </div>
                            </div>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="lines_div">
            </div>
            <div class="tab-content">
                <div id="homewarehouse" class="tab-pane fade in active">
                    <div id="tabimp" class="bottom_section" style="background: url();    height: 674px;">
					
					<img id="tabimgonec" src="/assets/warehouse/images/tab1_bg.png" style="
    width: 100%;
    left: 0;
    top: 110px;
    position: absolute;
">
                        <div class="top_arrow_text">
                            <div class="top_arrow" style="width: 46%;">
                                <img src="{!! asset('assets/warehouse/images/arrow.png') !!}">
                            </div>
                            <div style="z-index: 9999999;
    color: #000;
    font-weight: bold;
    position: relative;" class="arrow_text">
                                <p>請將箱子拖曳至貨車標籤，即可申請入倉</p>
                            </div>
                        </div>
                        <div class="box_images">
                            <div class="top_box_images">
                                @if(count($countboxes) > 0)
                                    <?php $i = 1; ?>
                                    @foreach($countboxes as $item)
                                        <div class="single_imgae_box">
                                            <div class="box_img_block" id="{{ $i }}" draggable="true"
                                                 ondragstart="drag(event)">
                                                <img style="left: 0;" id="{{ $i }}" class="box_img"
                                                     src="{!! asset('assets/warehouse/images/box.png') !!}">
                                                <input id="thumb_upload{{ $i }}" class="none_block" type='file'
                                                       onchange="return imageupload(this,'{{ $i }}');"/>
                                                <div class="thumb_u_img thumb_u_{{ $i }}" id="{{ $i }}">
                                                    <div class="thumb_text">
													    <p style="top: 115%;color: #000;background: white;border: 1px solid #535353;" class="upload_text">Name Here</p>
                                                        <p class="upload_text thumb_txt_{{ $i }}"> 上傳照片</p>
                                                    </div>
                                                    <img id="thumb{{ $i }}" class="none_block thumb" src="#"
                                                         alt="your image"/>
                                                </div>
                                            </div>
                                        </div>
                                        <?php $i++; ?>
                                    @endforeach
                                @endif
                                <?php /*<div class="single_imgae_box">
										<div class="box_img_block" id="2" draggable="true" ondragstart="drag(event)">
											<img id="2" class="box_img" src="{!! asset('assets/warehouse/images/box.png') !!}">
											<input id="thumb_upload2" class="none_block" type='file' onchange="imageupload(this,2);" />
											<div class="thumb_u_img thumb_u_2" id="2">
												<div class="thumb_text">
													<p class="upload_text thumb_txt_2"> 上傳照片</p>
												</div>
												<img id="thumb2" class="none_block thumb" src="#" alt="your image" />
											</div>
										</div>
									</div>
									<div class="single_imgae_box">
										<div class="box_img_block" id="3" draggable="true" ondragstart="drag(event)">
											<img id="3" class="box_img" src="{!! asset('assets/warehouse/images/box.png') !!}">
											<input id="thumb_upload3" class="none_block" type='file' onchange="imageupload(this,3);" />
											<div class="thumb_u_img thumb_u_3" id="3">
												<div class="thumb_text">
													<p class="upload_text thumb_txt_3"> 上傳照片</p>
												</div>
												<img id="thumb3" class="none_block thumb" src="#" alt="your image" />
											</div>
										</div>
									</div>
									<div class="single_imgae_box">
										<div class="box_img_block" id="4" draggable="true" ondragstart="drag(event)">
											<img id="4" class="box_img" src="{!! asset('assets/warehouse/images/box.png') !!}">
											<input id="thumb_upload4" class="none_block" type='file' onchange="imageupload(this,4);" />
											<div class="thumb_u_img thumb_u_4" id="4">
												<div class="thumb_text">
													<p class="upload_text thumb_txt_4"> 上傳照片</p>
												</div>
												<img id="thumb4" class="none_block thumb" src="#" alt="your image" />
											</div>
										</div>
									</div> */ ?>
                            </div>
                            <div class="bottom_box_images">
                                <div class="single_imgae_boxs">
                                    <div class="box_img_block" id="5" draggable="true" ondragstart="drag(event)">
                                        <img id="5" class="box_img"
                                             src="{!! asset('assets/warehouse/images/large_box.png') !!}">
                                        <input id="thumb_upload5" class="none_block" type='file'
                                               onchange="imageupload(this,5);"/>
                                        <div class="thumb_u_img thumb_u_5" id="5">
                                            <div class="thumb_text">
                                                <p class="upload_text thumb_txt_5"> 上傳照片</p>
                                            </div>
                                            <img id="thumb5" class="none_block thumb" src="#" alt="your image"/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="btm_button" style="right: 50px;
    position: absolute;">
                                <button type="button" class="submit_btn" name="submit_btn">下一頁</button>
                            </div>
                        </div>
                        <!-- slider-->
                        <div id="tab1_slider" class="carousel slide" data-ride="carousel">
                            <!-- Indicators -->
                            <ol class="carousel-indicators">
                                <li data-target="#tab1_slider" data-slide-to="0" class="active"></li>
                                <li data-target="#tab1_slider" data-slide-to="1"></li>
                                <li data-target="#tab1_slider" data-slide-to="2"></li>
                                <li data-target="#tab1_slider" data-slide-to="3"></li>
                            </ol>

                            <!-- Wrapper for slides -->
                            <div class="carousel-inner" role="listbox">
                                <div class="item active">
                                    <div class="box_select">
                                        <button type="submit" class="add_to_cart" id="">加入貨車</button>
                                    </div>

                                    <div class="box_img_block" id="m1">
                                        <img src="{!! asset('assets/warehouse/images/box.png') !!}" alt="Chania"
                                             width="460" height="345">
                                        <input id="thumb_uploadm1" class="none_block" type='file'
                                               onchange="imageupload(this,'m1');"/>
                                        <div class="thumb_u_img thumb_u_m1" id="m1">
                                            <div class="thumb_text">
                                                <p class="upload_text thumb_txt_m1"> 上傳照片</p>
                                            </div>
                                            <img id="thumbm1" class="none_block thumb" src="#" alt="your image"/>
                                        </div>
                                    </div>
                                </div>

                                <div class="item">
                                    <div class="box_select">
                                        <button type="submit" class="add_to_cart" id="">加入貨車</button>
                                    </div>
                                    <div class="box_img_block" id="m2">
                                        <img src="{!! asset('assets/warehouse/images/box.png') !!}" alt="Chania"
                                             width="460" height="345">
                                        <input id="thumb_uploadm2" class="none_block" type='file'
                                               onchange="imageupload(this,'m2');"/>
                                        <div class="thumb_u_img thumb_u_m2" id="m2">
                                            <div class="thumb_text">
                                                <p class="upload_text thumb_txt_m2"> 上傳照片</p>
                                            </div>
                                            <img id="thumbm2" class="none_block thumb" src="#" alt="your image"/>
                                        </div>
                                    </div>
                                </div>

                                <div class="item">
                                    <div class="box_select">
                                        <button type="submit" class="add_to_cart" id="">加入貨車</button>
                                    </div>
                                    <div class="box_img_block" id="m3">
                                        <img src="{!! asset('assets/warehouse/images/box.png') !!}" alt="Chania"
                                             width="460" height="345">
                                        <input id="thumb_uploadm3" class="none_block" type='file'
                                               onchange="imageupload(this,'m3');"/>
                                        <div class="thumb_u_img thumb_u_m3" id="m3">
                                            <div class="thumb_text">
                                                <p class="upload_text thumb_txt_m3"> 上傳照片</p>
                                            </div>
                                            <img id="thumbm3" class="none_block thumb" src="#" alt="your image"/>
                                        </div>
                                    </div>
                                </div>

                                <div class="item">
                                    <div class="box_select">
                                        <button type="submit" class="add_to_cart" id="">加入貨車</button>
                                    </div>
                                    <div class="box_img_block" id="m4">
                                        <img src="{!! asset('assets/warehouse/images/box.png') !!}" alt="Chania"
                                             width="460" height="345">
                                        <input id="thumb_uploadm4" class="none_block" type='file'
                                               onchange="imageupload(this,'m4');"/>
                                        <div class="thumb_u_img thumb_u_m4" id="m4">
                                            <div class="thumb_text">
                                                <p class="upload_text thumb_txt_m4"> 上傳照片</p>
                                            </div>
                                            <img id="thumbm4" class="none_block thumb" src="#" alt="your image"/>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Left and right controls -->
                            <a class="left" href="#tab1_slider" role="button" data-slide="prev">
                                <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                                <span class="sr-only">上一頁</span>
                            </a>
                            <a class="right" href="#tab1_slider" role="button" data-slide="next">
                                <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                                <span class="sr-only">下一頁</span>
                            </a>
                            <div class="checkout_btns">
                                <button type="button" class="checkout_btn" name="checkout_btn">進倉</button>
                            </div>
                        </div>
                        <!-- slider -->

                    </div>
                </div><!-- homepage-->
                <!-- tab2 contents-->
                <div id="tab1" class="tab-pane fade">
                    <div class="bottom_sections">
                        <div class="arrow_texts">
                            <p style="padding: 0.5% 0% 0%;font-size: 14px;">待運送物品<br>編輯完成後，別忘了到下方點選「確認訂單」唷。</p>
                        </div>
						<div class="arrow_text_3">
                                <p></p>
                            </div>
                        <div class="box_images">
                            <div class="top_box_images">
                                @if(count($countboxes) > 0)
                                    <?php $i = 1; ?>
                                    @foreach($countboxes as $item)
                                        <div class="box_imgs">
                                            <div id="box_div_{{$i}}" class="droptarget" ondrop="drop(event,{{$i}})"
                                                 ondragover="allowDrop(event)"></div>
                                        </div>
                                        <?php $i++; ?>
                                    @endforeach
                                @endif
                                <?php /*<div class="box_imgs">
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
										
									</div> */ ?>

                            </div>
                            <div class="bottom_box_images">
                                <div class="box_imgss">
                                    <div id="box_div_5" class="droptarget" ondrop="drop(event,5)"
                                         ondragover="allowDrop(event)"></div>

                                </div>
                            </div>
                            <div class="btm_buttons">
                                <button type="button" id="tab2submit" class="submit_btns" name="submit_btn">確認訂單</button>
                            </div>
                        </div>
                        <!-- slider-->
                        <div id="tab2_slider" class="carousel slide" data-ride="carousel">
                            <!-- Indicators -->
                            <ol class="carousel-indicators">
                                <li data-target="#tab2_slider" data-slide-to="0" class="active"></li>
                                <li data-target="#tab2_slider" data-slide-to="1"></li>
                                <li data-target="#tab2_slider" data-slide-to="2"></li>
                                <li data-target="#tab2_slider" data-slide-to="3"></li>
                            </ol>

                            <!-- Wrapper for slides -->
                            <div class="carousel-inner" role="listbox">
                                <div class="item active">
                                    <div class="box_select">
                                        <button type="submit" class="add_to_cart" id="">加入貨車</button>
                                    </div>
                                    <div class="box_img_block" id="m21">
                                        <img src="{!! asset('assets/warehouse/images/box.png') !!}" alt="Chania"
                                             width="460" height="345">
                                        <input id="thumb_uploadm21" class="none_block" type='file'
                                               onchange="imageupload(this,'m21');"/>
                                        <div class="thumb_u_img thumb_u_m21" id="m21">
                                            <div class="thumb_text">
                                                <p class="upload_text thumb_txt_m21"> 上傳照片</p>
                                            </div>
                                            <img id="thumbm21" class="none_block thumb" src="#" alt="your image"/>
                                        </div>
                                    </div>
                                </div>

                                <div class="item">
                                    <div class="box_select">
                                        <button type="submit" class="add_to_cart" id="">加入貨車</button>
                                    </div>
                                    <div class="box_img_block" id="m22">
                                        <img src="{!! asset('assets/warehouse/images/box.png') !!}" alt="Chania"
                                             width="460" height="345">
                                        <input id="thumb_uploadm22" class="none_block" type='file'
                                               onchange="imageupload(this,'m22');"/>
                                        <div class="thumb_u_img thumb_u_m22" id="m22">
                                            <div class="thumb_text">
                                                <p class="upload_text thumb_txt_m22"> 上傳照片</p>
                                            </div>
                                            <img id="thumbm22" class="none_block thumb" src="#" alt="your image"/>
                                        </div>
                                    </div>
                                </div>

                                <div class="item">
                                    <div class="box_select">
                                        <button type="submit" class="add_to_cart" id="">加入貨車</button>
                                    </div>
                                    <div class="box_img_block" id="m23">
                                        <img src="{!! asset('assets/warehouse/images/box.png') !!}" alt="Chania"
                                             width="460" height="345">
                                        <input id="thumb_uploadm23" class="none_block" type='file'
                                               onchange="imageupload(this,'m23');"/>
                                        <div class="thumb_u_img thumb_u_m23" id="m23">
                                            <div class="thumb_text">
                                                <p class="upload_text thumb_txt_m23"> 上傳照片</p>
                                            </div>
                                            <img id="thumbm23" class="none_block thumb" src="#" alt="your image"/>
                                        </div>
                                    </div>
                                </div>

                                <div class="item">
                                    <div class="box_select">
                                        <button type="submit" class="add_to_cart" id="">加入貨車</button>
                                    </div>
                                    <div class="box_img_block" id="m24">
                                        <img src="{!! asset('assets/warehouse/images/box.png') !!}" alt="Chania"
                                             width="460" height="345">
                                        <input id="thumb_uploadm24" class="none_block" type='file'
                                               onchange="imageupload(this,'m24');"/>
                                        <div class="thumb_u_img thumb_u_m24" id="m24">
                                            <div class="thumb_text">
                                                <p class="upload_text thumb_txt_m24"> 上傳照片</p>
                                            </div>
                                            <img id="thumbm24" class="none_block thumb" src="#" alt="your image"/>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Left and right controls -->
                            <a class="left" href="#tab2_slider" role="button" data-slide="prev">
                                <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                                <span class="sr-only">上一頁</span>
                            </a>
                            <a class="right" href="#tab2_slider" role="button" data-slide="next">
                                <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                                <span class="sr-only">下一頁</span>
                            </a>
                        </div>
                        <!-- slider -->

                    </div>
                </div>
                <!-- tab3 contents-->
                <div id="tab3" class="tab-pane fade">
                    <div class="bottom_section_3">
					
									<img id="tabimgtwoc" src="/assets/warehouse/images/tab3_bg.png" style="
    width: 100%;
    left: 0;
    top: 110px;
    position: absolute;
">
					
                        <div class="top_arrow_text" style="position: absolute;z-index: 999999;">
                            <div class="top_arrow" style="width: 47%;">
                                <img src="{!! asset('assets/warehouse/images/back_arrow.png') !!}">
                            </div>
                            <div class="arrow_text_3">
                                <p>請將箱子拖曳至貨車標籤，即可申請出倉</p>
                            </div>
                        </div>
                        <div class="box_images">
                            <div class="top_box_images">
                                @if(count($orders) > 0)
                                    <?php $j =0; ?>
                                    @foreach($orders as $i => $order)
                                        <div class="single_imgae_box">
                                            <div class="box_img_block" id="{{ $i }}" draggable="false"
                                                 ondragstart="drag(event)">
                                                <img id="{{ $i }}" class="box_img"
                                                     src="{!! asset('assets/warehouse/images/box.png') !!}">
                                                <?php /*<input id="thumb_upload{{ $i }}" class="none_block" type='file' onchange="return imageupload(this,'{{ $i }}');" /> */ ?>
                                                <div class="thumb_u_img thumb_u_{{ $i }}" id="{{ $i }}">
                                                    <?php /*<div class="thumb_text">
														<p class="upload_text thumb_txt_{{ $i }}"> 上傳照片</p>
													</div>*/ ?>
                                                    <div style="display: table-cell;">
                                                        @foreach($boxes[$order->id] as $box)
                                                            <p>{{ $box->name }}</p>
                                                            <img id="thumb{{ $i }}" style="width: 50px; height: 50px;"
                                                                 src="@if('' !== $box->image)/uploads/boxes/{{ $box->image }} @else {{ url('/assets/dist/img/box5_s.png') }} @endif"
                                                                 alt="your image"/>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php $j++; ?>
                                    @endforeach
                                @endif
                            </div>

                            <div class="btm_button_3">
                                <button type="button" class="submit_btn" name="submit_btn" data-toggle="modal"
                                        data-target="#myModal">下一頁
                                </button>
                            </div>
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
                                        <button type="submit" class="add_to_cart" id="">加入貨車</button>
                                    </div>
                                    <div class="box_title">
                                        <p>冬天衣服</p>
                                    </div>
                                    <img src="{!! asset('assets/warehouse/images/newone.png') !!}" alt="Chania"
                                         width="460" height="345" data-toggle="modal" data-target="#myModal">
                                </div>

                                <div class="item">
                                    <div class="box_select">
                                        <button type="submit" class="add_to_cart" id="">加入貨車</button>
                                    </div>
                                    <div class="box_title">
                                        <p>冬天衣服</p>
                                    </div>
                                    <img src="{!! asset('assets/warehouse/images/newone.png') !!}" alt="Chania"
                                         width="460" height="345" data-toggle="modal" data-target="#myModal">
                                </div>

                                <div class="item">
                                    <div class="box_select">
                                        <button type="submit" class="add_to_cart" id="">加入貨車</button>
                                    </div>
                                    <div class="box_title">
                                        <p>冬天衣服</p>
                                    </div>
                                    <img src="{!! asset('assets/warehouse/images/newone.png') !!}" alt="Flower"
                                         width="460" height="345" data-toggle="modal" data-target="#myModal">
                                </div>

                                <div class="item">
                                    <div class="box_select">
                                        <button type="submit" class="add_to_cart" id="">加入貨車</button>
                                    </div>
                                    <div class="box_title">
                                        <p>冬天衣服</p>
                                    </div>
                                    <img src="{!! asset('assets/warehouse/images/newone.png') !!}" alt="Flower"
                                         width="460" height="345" data-toggle="modal" data-target="#myModal">
                                </div>
                            </div>

                            <!-- Left and right controls -->
                            <a class="left" href="#tab3_slider" role="button" data-slide="prev">
                                <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                                <span class="sr-only">上一頁</span>
                            </a>
                            <a class="right" href="#tab3_slider" role="button" data-slide="next">
                                <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                                <span class="sr-only">下一頁</span>
                            </a>
                   上一頁         <div class="checkout_btns">
                                <button type="button" class="checkout_btn" name="checkout_btn">退倉</button>
                            </div>
                        </div>
                        <!-- slider -->

                    </div>
                </div>
                <!-- -->
                <!-- tabLast Contents -->
                <div id="tablast" class="none_block tab-pane fade"></div>
                <!-- -->
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
                                        <img id="main_img" src="{!! asset('assets/warehouse/images/popup1.png') !!}">
                                    </div>
                                    <div class="pop_imgs">
                                        <div class="pop_imag">
                                            <img id="1" class="small_img"
                                                 src="{!! asset('assets/warehouse/images/popup1.png') !!}">
                                        </div>
                                        <div class="pop_imag">
                                            <img id="4" class="small_img"
                                                 src="{!! asset('assets/warehouse/images/tab1_bg.png') !!}">
                                        </div>
                                        <div class="pop_imag">
                                            <img id="3" class="small_img"
                                                 src="{!! asset('assets/warehouse/images/tab3_bg.png') !!}">
                                        </div>
                                    </div>
                                </div>
                                <div class="pop_txt">
                                    <div class="pop_title">
                                        <p>冬天衣服</p>
                                    </div>
                                    <div class="pop_desc">
                                        <p>即可申請退倉</p>
                                    </div>
                                    <div class="pop_title">
                                        <p>冬天衣服</p>
                                    </div>
                                    <div class="pop_desc">
                                        <p>199即/可
                                    </div>
                                    <div class="pop_title">
                                        <p>冬天衣服</p>
                                    </div>
                                    <div class="pop_desc">
                                        <p> 2016/09/12</p>
                                    </div>
                                    <div class="pop_title">
                                        <p>冬天衣服</p>
                                    </div>
                                    <div class="pop_desc">
                                        <p>即可申請退倉</p>
                                    </div>
                                    <div class="pop_up_btn">
                                        <button type="button" class="modal_btn1">微信支付</button>
                                    </div>
                                    <div class="pop_up_btn_1">
                                        <button type="button" class="modal_btn1">即可申請退倉</button>
                                    </div>
                                    <div class="pop_home_img">
                                        <img src="{!! asset('assets/warehouse/images/pop_home.png') !!}">
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
            </div><!---model --->
        </div>


        <?php /*
  <div id="tabs">
    <div id="schedule">
      <div class="div-table" style="width: 100%; padding-top: 0px;">
        <div class="div-tr">
          <div id="cardInfoForm" class="div-td schedule">
            <div class="morebox-questions"><span class="morebox-yellowBottom">懶人倉</span>租用中</div>
            <div class="table-responsive">
              <table class="table table-striped table-bordered table-hover" style="margin:20px auto">
                <thead>
                  <tr>
                    <th>訂單編號</th>
                    <th>狀態</th>
                    <th>空箱日期</th>
					<th>起租日期</th>

                    <th>箱子名稱</th>
                    <th>照片預覽</th>
					<th>月租費</th>
                    <th>倉庫清點</th>
                    <th>即時影像</th>
                  </tr>
                </thead>
                <tbody>

                @foreach($orders as $i => $order)
                <?php if($order->status == 3) continue; ?>
                <tr>
                  <td># {{$order->id}}</td>
                  <td><label class="label label-{{$order_status_color[$order_status[$order->status]]}}">{{ $order_status[$order->status] }}</label></td>
                  <td style="">{{$order->pickup_date}}</td>
          <td style="">{{$order->shipping_date}}</td>

                  <td><ul style="margin:0; list-style:none; padding:0">
                      @foreach($boxes[$order->id] as $box)
                      <li style="line-height:30px">{{ $box->name }}</li>
                      @endforeach
                    </ul></td>
                  <td><ul style="margin:0; list-style:none; padding:0">
                      @foreach($boxes[$order->id] as $box)
                     <li><a href="@if('' !== $box->image)/uploads/boxes/{{ $box->image }} @else {{ url('/assets/dist/img/box5_s.png')}} @endif" data-lightbox="example-1"><img src="@if('' !== $box->image)/uploads/boxes/{{ $box->image }} @else {{ url('/assets/dist/img/box5_s.png') }} @endif" style="height:24px; margin:3px" width="auto" height="20"/></a></li>
                      @endforeach
                    </ul></td>
					<td>{{ $order->monthly_cost }}</td>
                  <td><ul style="margin:0; list-style:none; padding:0">
                      @foreach($boxes[$order->id] as $box)
                      <li style="line-height:30px">
                        <input type="checkbox" @if($box->
                        arrived) {{ 'checked' }} @endif disabled /></li>
                      @endforeach
                    </ul></td>
                  <td><label class="label label-info">{{ $order->amt_service }}</label></td>
                </tr>
                @endforeach
                  </tbody>

              </table>
            </div>
            <div class="morebox-questions"><span class="morebox-yellowBottom">懶人倉</span>使用狀態</div>
            <div class="div-table" style="width:100%">
              <div class="div-tr">
                <div class="div-td"> <span id="boxAmt"> 您有 <span id="boxAmts" style="color: #00c5b4">{{ count($all_boxes) }}</span> 箱正在懶人倉 </span> </div>
              </div>
            </div>
            <br>
            <br>
            <div class="clear"></div>
            <div class="morebox-questions"><span class="morebox-yellowBottom">歷史</span>紀錄</div>
            <div class="table-responsive">
              <table class="table table-striped table-bordered table-hover" style="margin:20px auto">
                <thead>
                  <tr>
                    <th>訂單編號</th>
                    <th>狀態</th>
                    <th>空箱日期</th>
					<th>起租日期</th>

                    <th>箱子名稱</th>
                    <th>照片預覽</th>
					<th>月租費</th>
                    <th>倉庫清點</th>
                    <th>即時影像</th>
                  </tr>
                </thead>
                <tbody>

                @foreach($orders as $i => $order)
                <?php if($order->status != 3) continue; ?>
                <tr>
                  <td># {{$order->id}}</td>
                  <td><label class="label label-{{$order_status_color[$order_status[$order->status]]}}">{{ $order_status[$order->status] }}</label></td>
                  <td style="">@if($order->pickup_date !== ''){{$order->pickup_date}} @else - @endif</td>
					<td style="">@if($order->shipping_date !== '') {{$order->shipping_date}} @else - @endif</td>

                  <td><ul style="margin:0; list-style:none; padding:0">
                      @foreach($boxes[$order->id] as $box)
                      <li style="line-height:30px">{{ $box->name }}</li>
                      @endforeach
                    </ul></td>
                  <td><ul style="margin:0; list-style:none; padding:0">
                      @foreach($boxes[$order->id] as $box)
                      <li><a href="@if('' !== $box->image)/uploads/boxes/{{ $box->image }}@endif" data-lightbox="example-1"><img src="@if('' !== $box->image)/uploads/boxes/{{ $box->image }}@endif" style="height:24px; margin:3px" width="auto" height="20"/></a></li>
                      @endforeach
                    </ul></td>
					<td>{{ $order->monthly_cost }}</td>
                  <td><ul style="margin:0; list-style:none; padding:0">
                      @foreach($boxes[$order->id] as $box)
                      <li style="line-height:30px">
                        <input type="checkbox" @if($box->
                        arrived) {{ 'checked' }} @endif disabled /></li>
                      @endforeach
                    </ul></td>
                  <td><label class="label label-info">{{ $order->amt_service }}</label></td>
                </tr>
                @endforeach
                  </tbody>

              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div> */ ?>
    </div>
@endsection
@section('js')
    {!! Html::script('/assets/plugins/lightbox/js/lightbox.js') !!}
    {!! Html::script('/assets/warehouse/js/box_drag.js') !!}
    <script>
        $('#tabs a').click(function (e) {
            e.preventDefault();
            $(this).tab('show');
        });
    </script>
    <?php /*
<script src="{{ url('/assets/dist/js/jquery.twzipcode.min.js') }}" type="text/javascript"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.15.0/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.15.0/additional-methods.min.js"></script>
<script>
$( document ).ready(function() {
    $( ".referral-show" ).click(function() {
      $('.referral_box').show('fast');
      return false;
    });
});

/* Javascript 
  $('#twzipcode').twzipcode();

 /* jQuery(document).ready(function($){

    $('input[name="password_confirm"]').change(function(e) {

            if($(this).val() !== $('input[name="password"]').val()) alert('Password missmatch!!!')
        });
  }) 
  console.log("{!! URL::to('/logout') !!}");
	jQuery.validator.setDefaults({
	  debug: true,
	  success: "valid"
	});
	$( "#member-profile" ).validate({
	  rules: {
		current_password: "required",
		password: "required",
		password_confirm: {
		  required: true,
		  equalTo: "#password"
		}
	  },
	  submitHandler: function(form) {
		  var old = $("input[name=current_password]").val();
		  var newpass = $("input[name=password]").val();
		  $.ajax({
			  'url' : "{!! URL::to('member/profile/changepassword') !!}",
			  'method' : 'get',
			  'data' : { 'current_password' : old, 'password' : newpass },
			  'success' : function(response){
				  if(response.status == "true"){
					  $('#alert-success').removeClass('alert-danger');
					  $('#alert-success').addClass('alert-success');
					  setTimeout(function() {						  
					  $('#alert-success').html('');
					  $('#alert-success').html(response.message);
					  $('#alert-success').show();
					  var url = "{!! URL::to('/logout') !!}";
						//location.herf = url;
					   $('#alert-success').slideUp('slow', window.location.replace(url));
					}, 5000);						
				  } else{
					  $('#alert-success').removeClass('alert-success');
					  $('#alert-success').addClass('alert-danger');
					  $('#alert-success').html(response.message);
					  $('#alert-success').show();
				  }
			  }
		  });
	  }
	});
</script> */ ?>
    <script>
	
	
        $("#tab2submit").click(function () {
            window.location.href = '{{url('/schedule-pickup')}}';
            return false;
        });
    </script>
	
	 <script>
	$(document).ready(function(){
		
	
	  var height = $('#tabimgonec').height();
	  
	   $('#tabimp').css('height', height+'px');
	 
	 var height3 = $('#tabimgtwoc').height();
	  
	   $('.bottom_section_3').css('height', height+'px');
	  
	  
	  //$('html').css('overflow','scroll');
	
	
	});
	
	</script>
	
	
@endsection
