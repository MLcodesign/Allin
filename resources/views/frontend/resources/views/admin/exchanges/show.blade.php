@extends('layouts.admin.app')

@section('title', 'Logistic')

@section('css')

@endsection

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            物流單明細
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ url('admin/dashboard') }}"><i class="fa fa-dashboard"></i> 管理介面</a></li>
            <li><a href="{{ url('admin/logistic') }}"><i class="fa fa-logistics"></i> 物流單</a></li>
            <li class="active"><i class="fa fa-logistic"></i> 物流單明細</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">{{ $user->name }} 的物流單資訊</h3>
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
                                        <td><span class="text-muted">物流單編號 :</span></td>
                                        <td>{{ $logistic->id }}</td>
                                    </tr>
                                    <tr>
                                        <td><span class="text-muted">訂單編號 :</span></td>
                                        <td>{{ $logistic->order_id }}</td>
                                    </tr>
                                    <tr>
                                        <td><span class="text-muted">物流單類別 :</span></td>
                                        <td>{{ $logistic->topic }}</td>
                                    </tr>
                                    <tr>
                                        <td><span class="text-muted">物流單狀態:</span></td>
                                        <td>{{ $logistic->getStatus(true) }}</td>
                                    </tr>
                                    <tr>
                                        <td><span class="text-muted">物流項目:</span></td>
                                        <td>
                                            <table style="border-spacing:10px; border-collapse: separate;">
                                                <tbody>
                                                <?php $k = 1; ?>
                                                @foreach($logistic->getShippingItems() as $i => $box)
                                                    <tr>
                                                        <td>No. {{$i++}}
                                                        </td>
                                                        <td>{{$box->name}} {{$box->admin_id}}
                                                        </td>
                                                        <!--<td>
                                                            <button type="button" onclick="btnboxupdate('{{$k}}');"
                                                                    class="btn btn-sm btn-warning">更新
                                                            </button>
                                                        </td>-->
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
                                            <span class="text-info"> {{ $logistic->county }} {{ $logistic->district }} {{ $logistic->zipcode }}</span>
                                            <br/><b class="text-info">{{ $logistic->address }}</b>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><span class="text-muted">運費:</span></td>
                                        <td><b class="text-info">{{ $logistic->shipping_fee }}</b></td>
                                    </tr>
                                    <tr>
                                        <td><span class="text-muted">使用者預約日期:</span></td>
                                        <td>
                                            <b class="text-info">{{ $logistic->user_shipping_date }}</b>/ {{ $logistic->user_shipping_date }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><span class="text-muted">實際寄達日期:</span></td>
                                        <td>
                                            <b class="text-info">@if('0000-00-00' !== $logistic->actual_shipping_date){{ $logistic->actual_shipping_date }}</b>/ {{ $logistic->actual_shipping_time }}@else
                                                - @endif</td>
                                    </tr>
                                    <tr>
                                        <td><span class="text-muted">訂單建立:</span></td>
                                        <td><b class="text-info">{{ $logistic->getOrder()->created_at }}</b></td>
                                    </tr>
                                    <tr>
                                        <td><span class="text-muted">物流單建立:</span></td>
                                        <td><b class="text-info">{{ $logistic->created_at }}</b></td>
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
                    url: base_url + '/admin/logistics/{{$logistic->id}}',
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
            var terminated = $("input[name='terminated-" + i + "']").prop("checked");
            var boxed = $("input[name='boxed-" + i + "']").prop("checked");
            var token = $("input[name='_token']").val();

            if (box_id.length > 0 && box_admin_id.length > 0) {
                $.ajax({
                    url: $("#frmboxupdate-" + i).attr('action'),
                    method: $("#frmboxupdate-" + i).attr('method'),
                    data: {'box_id': box_id, 'box_admin_id': box_admin_id, 'arrived': arrived, 'terminated' : terminated , 'boxed' : boxed,  '_token': token},
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
