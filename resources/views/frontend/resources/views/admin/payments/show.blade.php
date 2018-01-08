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
                                            <table style="border-spacing:10px; border-collapse: separate;">
                                                <tbody>
                                                <?php $k = 1; ?>
                                                @foreach($boxes as $i => $box)
                                                    <tr>
                                                        <td>@if('' !== $box->image)<img height="25px"
                                                                                        src="/uploads/boxes/{{$box->image}}"/>@endif
                                                        </td>
                                                        <form method="put"
                                                              action="{{ url('/admin/orders/'.$order->id) }}"
                                                              clas="form-inline" id="frmboxupdate-{{$k}}">
                                                            {!! csrf_field() !!}
                                                            <td>{{$box->name}}<input type="text" class="form-control"
                                                                       value="{{$box->admin_id}}" name="box_admin_id-{{$k}}">
                                                            </td>
                                                            <td>
                                                                <input type="hidden" name="action" value="update_box"/>
                                                                <input type="hidden" name="box_id-{{$k}}"
                                                                       value="{{$box->box_id}}"/>
                                                                <input type="checkbox" class="check-arrived"
                                                                        name="arrived-{{$k}}"
                                                                       @if($box->arrived) checked disabled @endif /> 進倉確認
                                                            </td>
                                                        </form>
                                                        <td>
                                                            <form method="get" action="{{ url('/admin/orders') }}">
                                                                <input type="checkbox" class="check-terminated"
                                                                       value="terminated" name="arrived"/> 出倉確認
                                                            </form>
                                                        </td>
                                                        <td>
                                                            <button type="button" onclick="btnboxupdate('{{$k}}');"
                                                                    class="btn btn-sm btn-warning">更新
                                                            </button>
                                                        </td>
                                                    </tr>
                                                    <?php $k++; ?>
                                                @endforeach
                                                </tbody>

                                            </table>
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
                                        <td><b class="text-info">{{ $order->monthly_cost }}</b></td>
                                    </tr>
                                    <tr>
                                        <td><span class="text-muted">剩餘點數:</span></td>
                                        <td><b class="text-info">{{ round($user->total_credit) }}</b></td>
                                    </tr>
                                    <tr>
                                        <td><span class="text-muted">派箱日期:</span></td>
                                        <td>
                                            <b class="text-info">{{ $order->pickup_date }}</b>/ {{ $order->pickup_time }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><span class="text-muted">取件日期:</span></td>
                                        <td>
                                            <b class="text-info">@if('0000-00-00' !== $order->shipping_date){{ $order->shipping_date }}</b>/ {{ $order->shipping_time }}@else
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
    <script type="text/javascript">
        /*$('input.check-arrived').change(function(){

         $(this)[0].form.submit();
         });*/
        $('input.check-terminated').change(function () {

            $(this)[0].form.submit();
        });
    </script>
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
            var token = $("input[name='_token']").val();

            if (box_id.length > 0 && box_admin_id.length > 0) {
                $.ajax({
                    url: $("#frmboxupdate-" + i).attr('action'),
                    method: $("#frmboxupdate-" + i).attr('method'),
                    data: {'box_id': box_id, 'box_admin_id': box_admin_id, 'arrived': arrived, '_token': token},
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
    </script>
@endsection
