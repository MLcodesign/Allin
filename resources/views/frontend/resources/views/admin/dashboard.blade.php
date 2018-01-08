@extends('layouts.admin.app')

@section('title', 'Dashboard')

@section('css')
{!! Html::style('assets/dist/css/ionicons.min.css') !!}
@endsection


@section('content')
        <!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        <i class="fa fa-dashboard"></i> 管理介面
    </h1>
    <ol class="breadcrumb">
        <li class="active"><i class="fa fa-dashboard"></i> 管理介面</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <!-- Default box -->
            <div class="box">
                <div class="box-header with-border">
                    <!--<h3 class="box-title">Admin Dashboard</h3>-->
                    <div class="box-tools pull-right">
                        <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                            <i class="fa fa-minus"></i></button>
                    </div>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-aqua">
                                <div class="inner">
                                    <h3>{{ $users }}</h3>
                                    <p>會員</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-person"></i>
                                </div>
                                <a href="{{ url('admin/users') }}" class="small-box-footer">更多... <i
                                            class="fa fa-arrow-circle-right"></i></a>
                            </div>
                        </div><!-- ./col -->
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-yellow">
                                <div class="inner">
                                    <h3>{{ $packages }}</h3>
                                    <p>方案</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-briefcase"></i>
                                </div>
                                <a href="{{ url('admin/packages') }}" class="small-box-footer">更多... <i
                                            class="fa fa-arrow-circle-right"></i></a>
                            </div>
                        </div><!-- ./col -->
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-green">
                                <div class="inner">
                                    <h3>{{ $orders }}</h3>
                                    <p>訂單</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-star"></i>
                                </div>
                                <a href="{{ url('admin/orders') }}" class="small-box-footer">更多... <i
                                            class="fa fa-arrow-circle-right"></i></a>
                            </div>
                        </div><!-- ./col -->
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-gray">
                                <div class="inner">
                                    <h3>{{ $pages }}</h3>
                                    <p>頁面</p>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-files-o"></i>
                                </div>
                                <a href="{{ url('admin/pages') }}" class="small-box-footer">更多... <i
                                            class="fa fa-arrow-circle-right"></i></a>
                            </div>
                        </div><!-- ./col -->
                    </div><!-- /.row -->
                </div><!-- /.box-body -->
                <div class="box-footer">
                </div><!-- /.box-footer-->
            </div><!-- /.box -->
        </div><!-- /.col-md-12 -->
    </div> <!-- /.row -->
</section><!-- /.content -->
@endsection

@section('js')
    <script type="text/javascript">

    </script>
@endsection
