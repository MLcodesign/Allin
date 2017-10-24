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
            <li><a href="{{ url('admin/logistics') }}"><i class="fa fa-logistics"></i> 物流單</a></li>
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
                                        <td>
                                             <table style="border-spacing:10px; border-collapse: separate;">
                                                <tbody>
                                                    <tr>
                                                        <form method="put"
                                                              action="{{ url('/admin/logistics/'.$logistic->id) }}"
                                                              clas="form-inline" id="frmboxupdate">
                                                            {!! csrf_field() !!}
                                                            <td>{{ $logistic->getStatus(true) }}</td>
                                                            <td>
                                                                    <input type="radio" name="status" value="1" 
                                                                               @if($logistic->status >= 1) disabled
                                                                               @endif /> 已安排
                                                            </td>
                                                            <td>
                                                                    <input type="radio" name="status" value="2" @if($logistic->status >= 2) disabled
                                                                               @endif/> 已完成
                                                            </td>
                                                            <input type="hidden" name="actionType" value="ajax"/>
                                                        </form>
                                                        <td>
                                                            <button type="button" onclick="btnboxupdate();"
                                                                    class="btn btn-sm btn-warning" >更新
                                                            </button>
                                                        </td>
                                                    </tr>
                                                </tbody>

                                            </table>
                                        </td>
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
                                            <b class="text-info">{{ $logistic->user_shipping_date }}</b>/ {{ $logistic->user_shipping_time }}
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
        function btnboxupdate() {
            var status = $("input[name='status']:checked").val();
            var token = $("input[name='_token']").val();
            var actionType = $("input[name='actionType']").val();

            $.ajax({
                url: $("#frmboxupdate").attr('action'),
                method: $("#frmboxupdate").attr('method'),
                data: {'status': status,  '_token': token, 'actionType': actionType},
                success: function (response) {
                    $("#ordererror").html('');
                    $("#ordererror").addClass('alert-success');
                    $("#ordererror").html(response.success);
                    $("#ordererror").show();
                    location.reload();
                }
            });

            return false;
        }
    </script>
@endsection