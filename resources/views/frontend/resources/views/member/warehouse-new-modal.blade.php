                                    <div class="modal fade item_popup" id="tab3_modal_{{$prefix}}{{$box->id}}" role="dialog">
                                        <div class="modal-dialog">
                                        <!-- Modal content-->
                                            <div class="modal-content" id="modal-content-{{$prefix}}{{$box->id}}">
                                                <div class="modal-header">
                                                    <button type="button" class="close" id="modal_close{{$box->id}}" data-dismiss="modal">&times;</button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="pop_top_div">
                                                        <div class="img_section">
                                                            <div class="box_img_block">                                         
                                                                @if($box->image != "")

                                                                <img id="main_img_{{$box->id}}" class="box_img main_img_{{$box->id}}" src="/uploads/boxes/{{$box->image}}">                                                     
                                                                @else
                                                                @if($box->package_id == 1)
                                                                <img id="main_img_{{$box->id}}" class="box_img main_img_{{$box->id}}" src="/assets/dist/img/warehouse/popup1.png">
                                                                @else
                                                                <img id="main_img_{{$box->id}}" class="box_img main_img_{{$box->id}}" src="/assets/dist/img/warehouse/popup1.png">
                                                                @endif
                                                                @endif
                                                                <!--<div class="thumb_img">   
                                                                    <img id="modal_thumb{{$box->id}}"  class="nexa thumb dfdvg utiuplod_{{$box->id}} thumb{{$box->id}}" src="#" />
                                                                </div>-->
                                                            </div>
                                                            <!--<div class="pop_imgs">
                                                                <div class="pop_imag">
                                                                    <img id="1" class="small_img" src="/assets/dist/img/warehouse/popup1.png">
                                                                </div>
                                                                <div class="pop_imag">
                                                                    <img id="4" class="small_img" src="/assets/dist/img/warehouse/tab1_bg.png">
                                                                </div>
                                                                <div class="pop_imag">
                                                                    <img id="3" class="small_img" src="/assets/dist/img/warehouse/tab3_bg.png">
                                                                </div>
                                                            </div>-->
                                                        </div>
                                                        <div class="pop_txt">
                                                            <div class="pop_title">
                                                                <p>箱子號</p>
                                                            </div>
                                                            <div class="pop_desc">
                                                                <p>{{$box->id}}</p>
                                                            </div> 
                                                            <div class="pop_title">
                                                                <p>箱子編號</p>
                                                            </div>
                                                            <div class="pop_desc">
                                                                <p>{{$box->admin_id}}</p>
                                                            </div>                                    
                                                            <div class="pop_title">
                                                                <p>箱子名稱</p>
                                                            </div>
                                                            <div class="pop_desc">
                                                                <p><input type="text" id="{{$prefix}}modal_box_{{$box->id}}_name" value="{{$box->name}}"  class="boxname boxname-slide  boxname-slide-{{$box->id}}" placeholder=""></p>
                                                            </div>
                                                            <div class="pop_title">
                                                                <p>倉儲方案</p>
                                                            </div>
                                                            <div class="pop_desc">
                                                                <p>
                                                                @if($box->package_id == 1)
                                                                    標準箱
                                                                @else
                                                                    大型物品
                                                                @endif
                                                                </p>
                                                            </div>
                                                            <div class="pop_title">
                                                                <p>起租日期</p>
                                                            </div>
                                                            <div class="pop_desc">
                                                                <p>{{$box->pickup_date}}</p>
                                                            </div>

                                                            <div class="pop_up_btn">
                                                                <button type="button" data-id="{{$box->id}}" data-name="{{$box->name}}" data-is-modal="1" data-type="{{$dataType}}" class="modal_btn_upload updateboxname">儲存/編輯內容</button>
                                                            </div>
                                                            <div class="pop_up_btn_1">
                                                                <input id="thumb_upload_modal_{{$box->id}}" class="none_block ajaximg modal_upload_obj" data-id="{{$box->id}}" type='file' />
                                                                <button type="button" data-id="{{$box->id}}" class="modal_btn_upload modal_upload">上傳/編輯照片</button>
                                                            </div>
                                                            <div class="pop_home_img">
                                                                <img class="add_cart" id="tab3_{{$box->id}}" data-type="{{$dataType}}" data-is-modal="1" data-title="tab3_box" data-box-id="{{$box->id}}" src="/assets/dist/img/warehouse/pop_home.png">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                            
                                            </div>
                          
                                        </div>
                                    </div><!---model --->