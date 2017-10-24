@extends('layouts.admin.app')

@section('title', 'Profile')

@section('css')

@endsection

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            訂單明細
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ url('admin/dashboard') }}"><i class="fa fa-dashboard"></i> 管理介面</a></li>
            <li><a href="{{ url('admin/orders') }}"><i class="fa fa-orders"></i> 訂單</a></li>
            <li class="active"><i class="fa fa-order"></i> 訂單明細</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">{{ $user->name }} 的懶人倉資訊</h3>
                <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i
                                class="fa fa-minus"></i></button>
                </div>
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-md-12">
                        @if (session('status'))
                            <div class="alert alert-success"> {{ session('status') }} </div>
                        @endif
                        @if (session('warning'))
                            <div class="alert alert-warning"> {{ session('warning') }} </div>
                        @endif
                        <div class="alert alert-success" id="ordererror" style="display:none;"></div>
                        <div class="col-md-9">
                            <div class="table-responsive no-padding">
                                <table class="table">
                                    <tbody>
                                    <tr>
                                        <td><span class="text-muted">方案 :</span></td>
                                        <td>{{ $order->getPricing(true) }}</td>
                                    </tr>
                                    <tr>
                                        <td><span class="text-muted">訂單狀態:</span></td>
                                        <td>{{ $order->getOrderStatus(true) }}</td>
                                    </tr>
                                    <tr>
                                        <td><span class="text-muted">箱數:</span></td>
                                        <td>
										
                                            <div class="table" style="border-spacing:10px; border-collapse: separate;">
                                                <div class="tbody">
                                                <?php $k = 1; ?>
                                                @foreach($boxes as $i => $box)
												<form method="put"
                                                              action="{{ url('/admin/orders/'.$order->id) }}"
                                                              class="form-inline tr" id="frmboxupdate-{{$k}}">
                                                            {!! csrf_field() !!}
                                                    
                                                        <div class="td">@if('' !== $box->image)<img height="25px"
                                                                                        src="/uploads/boxes/{{$box->image}}"/>@endif
                                                        </div>
                                                        
                                                            <div class="td">{{$box->name}}<input type="text" class="form-control"
                                                                       value="{{$box->admin_id}}" name="box_admin_id-{{$k}}" id="admin_id-{{$box->box_id}}">
                                                            </div>
                                                            <div class="td">
                                                                    <input type="checkbox" class="check-canceled" data-id="{{$box->box_id}}" id="canceled-{{$box->box_id}}" name="canceled-{{$k}}"
                                                                           @if($box->canceled) checked disabled
                                                                           @elseif($box->arrived == "1") disabled title="已入倉不能取消"
                                                                           @else
                                                                           @endif /> 強制取消
                                                            </div>
                                                            <div class="td">
                                                                    <input type="checkbox" class="check-boxed" data-id="{{$box->box_id}}" id="boxed-{{$box->box_id}}" name="boxed-{{$k}}"
                                                                           @if($box->boxed) checked disabled 
                                                                           @else
                                                                               @if($box->canceled) disabled
                                                                               @endif
                                                                           @endif /> 空箱寄達確認
                                                            </div>
                                                            <div class="td">
                                                                <input type="hidden" name="action" value="update_box"/>
                                                                <input type="hidden" name="box_id-{{$k}}"
                                                                       value="{{$box->box_id}}"/>
                                                                <input type="checkbox" class="check-arrived"
                                                                        name="arrived-{{$k}}"
                                                                       @if($box->arrived) checked disabled 
                                                                       @elseif($box->boxed == "0" || $box->picked == "0") disabled title="空箱尚未寄達或客戶尚未預約取件"
                                                                       @else
                                                                       @endif /> 進倉確認
                                                            </div>
                                                            <div class="td">
                                                                    <input type="checkbox" class="check-rtn_cf" name="rtn_cf-{{$k}}"
                                                                           @if($box->rtn_cf) checked disabled /> 出倉確認
                                                                           @elseif($box->boxed == "0" || $box->rtn == "0" || $box->arrived == "0" || $box->picked == "0") disabled  title="未完成入倉程序或使用者未提出退倉需求" /> 出倉確認
                                                                           @else
                                                                      /> <label class="label label-danger">出倉確認</label>   
                                                                           @endif
                                                            </div>
                                                            <div class="td">
                                                                    <input type="checkbox" class="check-terminated" name="terminated-{{$k}}"
                                                                           @if($box->closed) checked disabled /> 終止確認
                                                                           @elseif($box->boxed == "0" || $box->rtn == "0" || $box->arrived == "0" || $box->picked == "0" || $box->rtn_cf == "0")  ''  title="未完成入倉程序或使用者未提出退倉需求或尚未進行出倉確認" /> 終止確認
                                                                           @else
                                                                      /> <label class="label label-danger">終止確認</label>   
                                                                           @endif
                                                            </div>
                                                            <!--{{$box->closed}}:{{$box->rtn}}:{{$box->arrived}}:{{$box->picked}}-->
                                                            <input type="hidden" name="actionType" value="ajax"/>
                                                       
                                                        <div class="td">
                                                            <button type="button" onclick="btnboxupdate('{{$k}}');"
                                                                    class="btn btn-sm btn-warning" @if($box->canceled) disabled @endif >更新
                                                            </button>
                                                        </div>
                                                    
													</form>
                                                    <?php $k++; ?>
                                                @endforeach
                                               
                                            </div>
											 
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><span class="text-muted">地址:</span></td>
                                        <td>
                                            <span class="text-info"> {{ $order->county }} {{ $order->district }} {{ $order->zipcode }}</span>
                                            <br/><b class="text-info">{{ $order->address }}</b>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><span class="text-muted">運費:</span></td>
                                        <td><b class="text-info">{{ $order->shipping_fee }}</b></td>
                                    </tr>
                                    <tr>
                                        <td><span class="text-muted">月租費:</span></td>
                                        <td><b class="text-info">{{ $order->monthly_cost }}<br>
                                        <?php
                                            $tmpCost = $order->monthly_cost;
                                        ?>
                                        @foreach($refunds as $refund)
                                        <?php
                                            $refund->cost += 0;
                                            if(false !== strpos($refund->api_memo_note, "含影像處理費")){
                                                $refund->cost += 100;
                                            }
                                            $tmpCost = $tmpCost - $refund->cost;
                                            $tmpCost = ($tmpCost < 0) ? 0 : $tmpCost;
                                            
                                        ?>
                                        <p style="color: red">{{ $tmpCost }}</p> {{ $refund->created_at }}{{ $refund->name }}{{ $refund->api_memo_note }} ({{ $refund->cost }})<br>
                                        @endforeach
                                        </b>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><span class="text-muted">剩餘點數:</span></td>
                                        <td><b class="text-info">{{ round($user->total_credit) }}</b></td>
                                    </tr>
                                    <tr>
                                        <td><span class="text-muted">派箱日期:</span></td>
                                        <td>
                                            <b class="text-info">{{ $order->newbox_date }}</b>/ {{ $order->newbox_time }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><span class="text-muted">取件日期:</span></td>
                                        <td>
                                            <b class="text-info">@if('0000-00-00' !== $order->pickup_date){{ $order->pickup_date }}</b>/ {{ $order->pickup_time }}@else
                                                - @endif</td>
                                    </tr>
                                    <tr>
                                        <td><span class="text-muted">訂單建立:</span></td>
                                        <td><b class="text-info">{{ $order->created_at }}</b></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- /.box-body -->
            <div class="box-footer">
            </div><!-- /.box-footer-->
        </div><!-- /.box -->
    </section><!-- /.content -->
@endsection

@section('js')
    <script>
	

	
        $('form input[type="checkbox"]').on('change', function () {
            $('input[name="' + this.name + '"]').not(this).prop('checked', false);
        });
        var base_url = "{!! URL::to('/') !!}";
        $("#orderifbtn").click(function () {
            var quantity = $("#quantity").val();
            var token = $("input[name=_token]").val();
            if (quantity.length > 0) {
                $.ajax({
                    url: base_url + '/admin/orders/{{$order->id}}',
                    method: 'PUT',
                    data: {'quantity': quantity, '_token': token},
                    success: function (response) {
                        $("#ordererror").html('');
                        $("#ordererror").addClass('alert-success');
                        $("#ordererror").html(response.success);
                        $("#ordererror").show();
                    }
                });
            } else {
                $("#ordererror").html('');
                $("#ordererror").removeClass('alert-success');
                $("#ordererror").html("欄位必填");
                $("#ordererror").show();
            }
            return false;
        });

        function btnboxupdate(i) {
            var box_id = $("input[name='box_id-" + i + "']").val();
            var box_admin_id = $("input[name='box_admin_id-" + i + "']").val();
            var arrived = $("input[name='arrived-" + i + "']").prop("checked");
            var rtn_cf = $("input[name='rtn_cf-" + i + "']").prop("checked");
            var terminated = $("input[name='terminated-" + i + "']").prop("checked");
            var boxed = $("input[name='boxed-" + i + "']").prop("checked");
            var canceled = $("input[name='canceled-" + i + "']").prop("checked");
            var token = $("input[name='_token']").val();
            var actionType = $("input[name='actionType']").val();

            if (box_id.length > 0 && box_admin_id.length > 0) {
                $.ajax({
                    url: $("#frmboxupdate-" + i).attr('action'),
                    method: $("#frmboxupdate-" + i).attr('method'),
                    data: {'box_id': box_id, 'box_admin_id': box_admin_id, 'arrived': arrived, 'terminated' : terminated , 'rtn_cf' : rtn_cf, 'boxed' : boxed, 'canceled' : canceled,  '_token': token, 'actionType': actionType},
                    success: function (response) {
                        $("#ordererror").html('');
                        $("#ordererror").addClass('alert-success');
                        $("#ordererror").html(response.success);
                        $("#ordererror").show();
                        location.reload();
                    }
                });
            } else {
                $("#ordererror").html('');
                $("#ordererror").removeClass('alert-success');
                $("#ordererror").html("欄位必填");
                $("#ordererror").show();
            }

            return false;
        }
        $(document).ready(function(){
            $(".btn").click(function(){
                $(this).prop("disabled", true);
                $.blockUI({ css: { 
                    border: 'none', 
                    padding: '15px', 
                    backgroundColor: '#000', 
                    '-webkit-border-radius': '10px', 
                    '-moz-border-radius': '10px', 
                    opacity: .5, 
                    color: '#fff' 
                } });

                setTimeout($.unblockUI, 15000);
                setTimeout('$(this).prop("disabled",false)', 15000);         
            });  
        })
        $(document).ready(function(){
            $('.check-canceled').click(function(){
                var box_id = $(this).data('id');
                if($(this).prop('checked') == true){
                    $('#boxed-' + box_id).prop("checked",false);
                    $('#boxed-' + box_id).prop("disabled", true);
                    $('#admin_id-' + box_id).prop("value","canceled");
                }else{
                    $('#boxed-' + box_id).prop("disabled", false);
                    $('#admin_id-' + box_id).prop("value","");
                }
            });
            $('.check-boxed').click(function(){
                var box_id = $(this).data('id');
                if($(this).prop('checked') == true){
                    $('#canceled-' + box_id).prop("checked",false);
                    $('#canceled-' + box_id).prop("disabled", true);
                    //$('#admin_id-' + box_id).prop("value","canceled");
                }else{
                    $('#canceled-' + box_id).prop("disabled", false);
                    //$('#admin_id-' + box_id).prop("value","");
                }
            });   
        })
    </script>
@endsection
