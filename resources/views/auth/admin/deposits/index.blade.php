@extends('layouts.admin.app')

@section('title', 'Deposits')

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
        <i class="fa fa-money"></i> 儲值
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ url('admin/dashboard') }}"><i class="fa fa-dashboard"></i> 管理介面</a></li>
        <li class="active"><i class="fa fa-database"></i> 儲值</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <!-- Default box -->
    <div class="box"> 
        <div class="box-header with-bdeposit">
            <h3 class="box-title">儲值清單</h3>
            <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i
                            class="fa fa-minus"></i></button>
            </div>
        </div>
        <div class="box-body">
            <table id="data_table" class="table datatable dt-responsive" style="width:100%;">
                <thead>
                <tr>
                    <th>序號</th>
                    <th>姓名</th>
					<th>儲值金額</th>
                    <th>點數</th>
					<th>儲值方式</th>
					<th>日期</th>
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

@include('layouts.admin.includes.message_boxes', ['item' => 'Deposit', 'delete' => true])

@endsection

@section('js')
        <!-- DataTables -->
{!! Html::script('assets/dist/js/datatable/jquery.dataTables.min.js') !!}

{!! Html::script('assets/dist/js/datatable/dataTables.bootstrap.min.js') !!}

{!! Html::script('assets/dist/js/datatable/dataTables.responsive.min.js') !!}

{!! Html::script('assets/dist/js/datatable/responsive.bootstrap.min.js') !!}

<script type="text/javascript">
    $(document).ready(function () {
        var table = $("#data_table").DataTable({
            processing: true, 
            serverSide: true,
            ajax: '{!! url("admin/datatables/deposits") !!}',
            columns: [
                {data: 'id', name: 'id', orderable: false, searchable: false},
				{data: 'id_user', name: 'id_user'},
				{data: 'amount', name: 'amount'},
				{data: 'total_payment', name: 'total_payment'},
				{data: 'payment_type', name: 'payment_type'},
				{data: 'payment_time', name: 'payment_time'},
                {data: 'actions', name: 'actions', orderable: false, searchable: false}
            ]
        });
        table.column('4:visible').order('asc').draw();
    });
</script>
@endsection