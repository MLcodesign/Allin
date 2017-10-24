@extends('layouts.admin.app')

@section('title', 'Orders')

@section('css')
        <!-- DataTables -->
{!! Html::style('assets/dist/css/datatable/dataTables.bootstrap.min.css') !!}

{!! Html::style('assets/dist/css/datatable/responsive.bootstrap.min.css') !!}

{!! Html::style('assets/dist/css/datatable/dataTablesCustom.css') !!}

@endsection

@section('content')
        <!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        <i class="fa fa-users"></i> 訂單
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ url('admin/dashboard') }}"><i class="fa fa-dashboard"></i> 管理介面</a></li>
        <li class="active"><i class="fa fa-database"></i> 訂單</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <!-- Default box -->
    <div class="box"> 
        <div class="box-header with-border">
            <h3 class="box-title">訂單明細</h3>
            <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i
                            class="fa fa-minus"></i></button>
            </div>
        </div>
        <div class="box-body">
            <table id="data_table" class="table datatable dt-responsive" style="width:100%;">
                <thead>
                <tr>
                    <th>訂單編號</th>
                    <th>會員姓名</th>
					<th>方案</th>
                    <th>狀態</th>
                   
					<th>運費</th>
					<th>月租費</th>
					<th>空箱派送日期</th>
                    <th>預約取件日期</th>
                    <th>帳單週期</th>
                    <th>編輯</th>
                </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div><!-- /.box-body -->
        <div class="box-footer">
            <p class="text-muted small">
                <i class="fa fa-pencil"></i> 編輯 |
                <i class="fa fa-remove"></i> 刪除
            </p>
        </div><!-- /.box-footer-->
    </div><!-- /.box -->
</section><!-- /.content -->

@include('layouts.admin.includes.message_boxes', ['item' => 'Order', 'delete' => true])

@endsection

@section('js')
        <!-- DataTables -->
{!! Html::script('assets/dist/js/datatable/jquery.dataTables.min.js') !!}

{!! Html::script('assets/dist/js/datatable/dataTables.bootstrap.min.js') !!}

{!! Html::script('assets/dist/js/datatable/dataTables.responsive.min.js') !!}

{!! Html::script('assets/dist/js/datatable/responsive.bootstrap.min.js') !!}

<script type="text/javascript">
    jQuery(document).ready(function ($) {
        var table = $("#data_table").DataTable({
            processing: true, 
            serverSide: true,
            ajax: '{!! url("admin/datatables/orders") !!}',
            columns: [
                {data: 'id', name: 'id', orderable: true, searchable: false},
				{data: 'name', name: 'name'},
				{data: 'packages', name: 'packages'},
				{data: 'status', name: 'status'},

				{data: 'shipping_fee', name: 'shipping_fee'},
				{data: 'monthly_cost', name: 'monthly_cost'},
				{data: 'newbox_date', name: 'newbox_date'},
                {data: 'pickup_date', name: 'pickup_date'},
                {data: 'billing_period', name: 'billing_period'},
                {data: 'actions', name: 'actions', orderable: false, searchable: false}
            ]
        });
        table.column('0:visible').order('desc').draw();
    });
</script>
@endsection