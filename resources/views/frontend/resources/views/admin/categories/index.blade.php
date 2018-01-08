@extends('layouts.admin.app')

@section('title', 'Logistics')

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
        <i class="fa fa-users"></i> 物流單
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ url('admin/dashboard') }}"><i class="fa fa-dashboard"></i> 管理介面</a></li>
        <li class="active"><i class="fa fa-database"></i> 物流單</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <!-- Default box -->
    <div class="box"> 
        <div class="box-header with-border">
            <h3 class="box-title">物流單明細</h3>
            <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i
                            class="fa fa-minus"></i></button>
            </div>
        </div>
        <div class="box-body">
            <table id="data_table" class="table datatable dt-responsive" style="width:100%;">
                <thead>
                <tr>
                    <th>物流單編號</th>
                    <th>訂單編號</th>
                    <th>會員姓名</th>
                    <th>狀態</th>
                   
					<th>物流類別</th>
					<th>使用者預約日期</th>
                    <th>實際寄達日期</th>
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

@include('layouts.admin.includes.message_boxes', ['item' => 'Logistic', 'delete' => true])

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
            ajax: '{!! url("admin/datatables/logistics") !!}',
            columns: [
                {data: 'id', name: 'id', orderable: true, searchable: false},
                {data: 'order_id', name: 'order_id'},
				{data: 'user_id', name: 'user_id'},
				{data: 'status', name: 'status'},

				{data: 'topic', name: 'topic'},
				{data: 'user_shipping_date', name: 'user_shipping_date'},
				{data: 'actual_shipping_date', name: 'actual_shipping_date'},
                {data: 'actions', name: 'actions', orderable: false, searchable: false}
            ],
            order: [ [0, 'desc'] ]
        });
        table.column('0:visible').draw();
    });
</script>
@endsection