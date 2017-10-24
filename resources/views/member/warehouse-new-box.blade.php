                                   <div class="single_imgae_box tabonecount">
                                        <div class="box_img_block" data-title="tab1_box" id="tab1_{{$box->id}}" data-order-id="{{$box->order_id}}" draggable="{{$box->dragFlag}}" data-box-id="{{$box->id}}" data-is-rtn="{{$box->rtnFlag}}" ondragstart="drag(event)">
                                            <div class="row" style="margin: 0 auto;width: 178px;border-radius: 5px;min-height:50px;">
                                               <div class="col-md-12" style="padding: 0; background-color: rgba(255, 255, 255, 0.62);min-height: auto;">
                                               {{$box->admin_id}}@if($box->dragFlag == "false")
                                                    @if($box->rtnFlag == "false")
                                                        <br>[有空箱未送達,無法入倉] 
                                                    @else
                                                        <br>[本品項為出倉待確認, 收箱人員會和您確認是否重新入倉] 
                                                    @endif
                                                @endif
                                               </div>
                                            </div> 
                                            <div class="row" style="margin: 0 auto;width: 178px;">
												<div class="col-md-8" style="padding: 0;"> <input style="position: inherit;z-index: 9999;" boxid="{{$box->id}}"  type="text"  id="box_{{$box->id}}_name" class="boxname" name="boxesbase[{{$box->id}}][name]" value="{{$box->name}}"><input type="hidden"  id="box_{{$box->id}}_id" name="boxesbase[{{$box->id}}][id]" value="{{$box->id}}"><input type="hidden"  id="box_{{$box->id}}_rtnFlag" name="boxesbase[{{$box->id}}][rtnFlag]" value="{{$box->rtnFlag}}"><input type="hidden"  id="box_{{$box->id}}_admin_id" name="boxesbase[{{$box->id}}][admin_id]" value="{{$box->admin_id}}">
													<!--<input type="hidden" value="{{$box->package_id}}" name="boxesbase[{{$box->id}}][box_type]">-->
												</div>
												<div class="col-md-4" style="padding: 0;"> <button style="margin-left: 2px;line-height: 14px;height: 28px;position: inherit;z-index: 9999;" type="button" data-id="{{$box->id}}" data-type="img" data-is-modal="0" class="btn updateboxname btn-block btn-warning">儲存</button></div>
                                            </div>
                                            <!--<div class="row" style="margin: 0 auto;width: 178px;">
                                                <div class="col-md-12" style="padding: 0;">
                                                {{$box->order_id}} / {{$box->admin_id}} 
                                                </div>
                                            </div>-->
                                            @if($box->package_id == 1)
                                            <img id="box_img_{{$box->id}}" class="box_img" src="/assets/dist/img/warehouse/box.png">
                                            @else
                                            <img id="box_img_{{$box->id}}" class="box_img" src="/assets/dist/img/warehouse/large_box.png">
                                            @endif
                                            <div class="thumb_img">
                                            @if($box->image != "")
                                                <img id="thumb{{$box->id}}" class="nexa thumb utiuplod_{{$box->id}} thumb{{$box->id}}" width="140" height="140" src="/uploads/boxes/{{$box->image}}">
                                            @else
                                                <img id="thumb{{$box->id}}"  class="nexa thumb dfdvg utiuplod_{{$box->id}} thumb{{$box->id}}" src="#"  />
                                            @endif
                                            </div>
											
                                            <input id="thumb_upload{{$box->id}}" class="none_block ajaximg" data-box-id="{{$box->id}}" type='file' onchange="upload(this,'{{$box->id}}','{{$box->id}}');" />
                                            <div class="thumb_u_img thumb_u_{{$box->id}}" id="{{$box->id}}">
                                                <div class="thumb_text">
                                                    <p class="upload_text thumb_txt_{{$box->id}}"> 上傳照片</p>
                                                </div>
                                                
                                            </div>
                                        </div> 
                                    </div>