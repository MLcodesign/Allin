                                  <div class="item <?php if ($x == 0) { echo 'active'; }?>">
                                    <div class="box_select">
                                        <button type="button" class="add_cart add_to_cart" id="tab_add_to_cart_btn_{{$box->id}}" data-type="slide" data-is-modal="0" data-box-id="{{$box->id}}" data-order-id="{{$box->order_id}}" data-title="tab1_box" data-is-rtn="{{$box->rtnFlag}}" style="cursor: pointer;z-index: 9999;" @if($box->dragFlag === "false") disabled @endif >移到貨車@if($box->dragFlag ==="false") [仍有空箱未送達] @endif</button>
                                    </div>
                                    <div class="box_img_block mob_block" id="box_img_block_slide_{{$box->id}}" data-title="tab1_box">
                                        <div class="row" style="margin: 0 auto;width: 178px;border-radius: 5px;background-color: rgba(255, 255, 255, 0.62);z-index: -1;">
                                            <div class="col-md-12" style="padding: 0;">
                                                {{$box->admin_id}}@if($box->dragFlag == "false") <br>[有空箱未送達,無法入倉] @endif
                                            </div>
                                        </div> 
                                        <div class="row" style="margin: 0 auto;width: 178px;">
                                           <div class="col-md-8 save_input" style="padding: 0;"><input style="position: inherit;z-index: 9999;" boxid="{{$box->id}}"  type="text"  id="slide_box_{{$box->id}}_name" class="boxname boxname-slide  boxname-slide-{{$box->id}}" data-box-id="{{$box->id}}" name="boxesbase[{{$box->id}}][name]" value="{{$box->name}}"><input type="hidden"  id="bid{{$box->id}}input" name="boxesbase[{{$box->id}}][id]" value="{{$box->id}}"><input type="hidden"  id="box_{{$box->id}}_rtnFlag" name="boxesbase[{{$box->id}}][rtnFlag]" value="{{$box->rtnFlag}}"><input type="hidden"  id="badminid{{$box->id}}input" name="boxesbase[{{$box->id}}][admin_id]" value="{{$box->admin_id}}"> </div>
                                           <div class="col-md-4 save_btn" style="padding: 0;"> <button style="margin-left: 2px;line-height: 14px;height: 28px;position: inherit;z-index: 9999;" type="button" id="bkey{{$box->id}}"  idx="{{$box->id}}" data-id="{{$box->id}}" data-type="slide" data-is-modal="0" data-name="{{$box->name}}" class="btn updateboxname btn-block btn-warning">儲存</button></div>
                                        </div>
                                        @if($box->package_id == 1)
                                            <img id="box_slide_img_{{$box->id}}" class="box_img" alt="Chania" width="460" height="345" src="/assets/dist/img/warehouse/box.png">
                                        @else
                                            <img id="box_slide_img_{{$box->id}}" class="box_img" alt="Chania" width="460" height="345" src="/assets/dist/img/warehouse/large_box.png">
                                        @endif
                                        <input id="thumb_uploadtab1_slide_{{$box->id}}" class="none_block" data-box-id="{{$box->id}}" type='file' onchange="upload(this,'{{$box->id}}','{{$box->id}}');" />
                                        <div class="thumb_u_img thumb_u_{{$box->id}}" id="tab1_slide_{{$box->id}}">
                                            <div class="thumb_text">
                                                <p class="upload_text thumb_txt_slide{{$box->id}}" style="z-index: 9999;" >上傳照片 <!--{{$box->name}}--> </p>
                                            </div>
                                        @if($box->image != "")
                                            <img id="thumb{{$box->id}}" class="nexa thumb utiuplod_{{$box->id}} thumb{{$box->id}}" src="/uploads/boxes/{{$box->image}}">
                                        @else
                                            <img id="thumb{{$box->id}}"  class="nexa thumb dfdvg utiuplod_{{$box->id}} thumb{{$box->id}}" src="#"  />
                                        @endif
                                        </div>
                                    </div>
                                  </div>