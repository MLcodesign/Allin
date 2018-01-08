@extends('layouts.admin.app')

@section('title', 'Profile')

@section('css')

@endsection

@section('content')
        <!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Deposit Details
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ url('admin/dashboard') }}"><i class="fa fa-dashboard"></i> 管理介面</a></li>
        <li><a href="{{ url('admin/deposits') }}"><i class="fa fa-money"></i> 儲值</a></li>
        <li class="active"><i class="fa fa-deposit"></i> </li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <!-- Default box -->
    <div class="box">
        <div class="box-header with-bdeposit">
            <h3 class="box-title">{{ $deposit->id. ' details' }}</h3>
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
                    <div class="col-md-9">
                        <div class="table-responsive no-padding">
                            <table class="table">
                                <tbody>
                                <tr>
                                    <td style="width: 15%;"><span class="text-muted">序號:</span></td>
                                    <td><b class="text-info">#{{ $deposit->id }}</b></td>
                                </tr>
								<tr>
                                    <td><span class="text-muted">會員ID:</span></td>
                                    <td><b class="text-info">{{ $deposit->id_user }}</b></td>
                                </tr>
                                <tr>
                                    <td><span class="text-muted">狀態:</span></td>
                                    <td><b class="text-info">{{ $deposit->status }}</b></td>
                                </tr>

								 <tr>
                                    <td><span class="text-muted">時間:</span></td>
                                    <td>
									<b class="text-info">{{ $deposit->payment_time }}</b>
									</td>
									
				
		
                                </tr>
                                <tr>
                                    <td><span class="text-muted">儲值金額:</span></td>
                                    <td><b class="text-info">{{ $deposit->amount }}</b></td>
                                </tr>
                                <tr>
                                    <td><span class="text-muted">點數:</span></td>
                                    <td><b class="text-info">{{ $deposit->total_payment}}</b></td>
                                </tr>
                                <tr>
                                    <td><span class="text-muted">儲值方式:</span></td>
                                    <td><b class="text-info">{{ $deposit->payment_type }}</b>
									</td>
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
		
    </script>
@endsection
