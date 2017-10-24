@extends('layouts.admin.app')

@section('title', 'Package')

@section('css')

@endsection

@section('content')
        <!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        檔案
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ url('admin/dashboard') }}"><i class="fa fa-dashboard"></i> 管理介面</a></li>
        <li><a href="{{ url('admin/packages') }}"><i class="fa fa-briefcase"></i> 方案</a></li>
        <li class="active"><i class="fa fa-briefcase"></i> 方案</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <!-- Default box -->
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">{{ $package->name. ' Pricing' }}</h3>
            <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i
                            class="fa fa-minus"></i></button>
            </div>
        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="col-md-6">
                        <h4>Pricing Details</h4>
                        <div class="table-responsive no-padding">
                            <table class="table">
                                <tbody>
                                <tr>
                                    <td style="width: 30%;">
                                        <small class="text-muted">名稱:</small>
                                    </td>
                                    <td><b class="text-info">{{ $package->name }}</b></td>
                                </tr>
                                <tr>
                                    <td>
                                        <small class="text-muted">費用:</small>
                                    </td>
                                    <td>
                                        <b class="text-info">{{ $package->cost .'/'.$package->cost_per. ' '. getSetting('DEFAULT_CURRENCY') }}</b>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <small class="text-muted">方案:</small>
                                    </td>
                                    <td><b class="text-info">{{ $package->plan }}</b></td>
                                </tr>
                                <tr>
                                    <td>
                                        <small class="text-muted">狀態:</small>
                                    </td>
                                    <td>
                                        <b class="text-info">{{ $package->status }}</b>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <small class="text-muted">細項:</small>
                                    </td>
                                    <td>
                                        <b class="text-info">{{ $package->featured }}</b>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <small class="text-muted">順序:</small>
                                    </td>
                                    <td><b class="text-info">{{ $package->pricing_order }}</b></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <h4>細項清單</h4>
                        <ul>
                            @foreach($package->features as $feature)
                                <li>
                                    {{ $feature->name }}
                                    <p>{{ $feature->pivot->spec }}</p>
                                </li>
                            @endforeach
                        </ul>
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
