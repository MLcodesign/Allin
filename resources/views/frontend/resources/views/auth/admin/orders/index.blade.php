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
        <i class="fa fa-users"></i> Orders
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ url('admin/dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active"><i class="fa fa-database"></i> Orders</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <!-- Default box -->
    <div class="box"> 
        <div class="box-header with-border">
            <h3 class="box-title">Orders List</h3>
            <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i
                            class="fa fa-minus"></i></button>
            </div>
        </div>
        <div class="box-body">
            <table id="data_table" class="table datatable dt-responsive" style="width:100%;">
                <thead>
                <tr>
                    <th>Order ID</th>
					<th>Pricing</th>
                    <th>Status</th>
                    <th>影像加值</th>
					<th>Shipping Fee</th>
					<th>Monthly Cost</th>
					<th>Remaining Credits</th>
					<th>New Box Date</th>
                    <th>Billing Period</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div><!-- /.box-body -->
        <div class="box-footer">
            <p class="text-muted small">
                <i class="fa fa-pencil"></i> Edit Storage |
                <i class="fa fa-remove"></i> Delete Storage
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
    $(document).ready(function () {
        var table = $("#data_table").DataTable({
            processing: true, 
            serverSide: true,
            ajax: '{!! url("admin/datatables/orders") !!}',
            columns: [
                {data: 'id', name: 'id', orderable: false, searchable: false},
				{data: 'package_id', name: 'package_id'},
				{data: 'status', name: 'status'},
				{data: 'amt_service', name: 'amt_service'},
				{data: 'shipping_fee', name: 'shipping_fee'},
				{data: 'monthly_cost', name: 'monthly_cost'},
				{data: 'remaining_credit', name: 'remaining_credit'},
				{data: 'pickup_date', name: 'pickup_date'},
                {data: 'billing_period', name: 'billing_period'},
                {data: 'actions', name: 'actions', orderable: false, searchable: false}
            ]
        });
        table.column('4:visible').order('asc').draw();
    });
</script>
@endsection