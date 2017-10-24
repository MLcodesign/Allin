                                   <div class="single_imgae_box tabonecount">
                                        <div class="box_img_block" data-title="tab3_box" id="tab3_{{$box->id}}" data-box-id="{{$box->id}}"  draggable="true" ondragstart="drag(event)">
                                            <div class="row" style="margin: 0 auto;width: 178px;border-radius: 5px;background-color: rgba(255, 255, 255, 0.62);">
                                               <div class="col-md-12" style="padding: 0;">
                                               {{$box->admin_id}}
                                                </div>
                                                <div class="col-md-12 label-name-{{$box->id}}" style="padding: 0;">
                                                {{$box->name}} 
                                                </div>
                                                <!--{{$box->id}} / {{$box->name}} / {{$box->order_id}} / {{$box->admin_id}}-->
                                                <input boxid="{{$box->id}}"  type="hidden"  id="bkey{{$box->id}}input" class="boxname" name="boxesbase[{{$box->id}}][name]" value="{{$box->name}}"><input type="hidden"  id="bid{{$box->id}}input" name="boxesbase[{{$box->id}}][id]" value="{{$box->id}}"><input type="hidden"  id="badminid{{$box->id}}input" name="boxesbase[{{$box->id}}][admin_id]" value="{{$box->admin_id}}">
                                            </div>
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
                                            <input id="thumb_upload{{$box->id}}" class="none_block ajaximg" data-box-id="{{$box->id}}" data-type="img" type='file' onchange="upload(this,'{{$box->id}}','{{$box->id}}');" />
                                            <div class="thumb_u_img thumb_u_{{$box->id}}" id="modal_{{$box->id}}">
                                                <div class="thumb_text" data-toggle="modal" data-target="#tab3_modal_{{$box->id}}">
                                                    <p class="upload_text thumb_txt_{{$box->id}}"> 編輯內容</p>
                                                </div>
                                                
                                            </div>
                                        </div> 
                                    </div>