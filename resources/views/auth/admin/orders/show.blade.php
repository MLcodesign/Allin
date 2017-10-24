@extends('layouts.admin.app')

@section('title', 'Profile')

@section('css')

@endsection

@section('content')
        <!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Order Details
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ url('admin/dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="{{ url('admin/orders') }}"><i class="fa fa-orders"></i> Orders</a></li>
        <li class="active"><i class="fa fa-order"></i> Details</li>
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
                    <div class="col-md-9">
                        <div class="table-responsive no-padding">
                            <table class="table">
                                <tbody>

								<tr>
                                    <td><span class="text-muted">Pricing :</span></td>
                                    <td>{{ $order->getPricing(true) }}</td>
                                </tr>
                                <tr>
                                    <td><span class="text-muted">Quantity:</span></td>
                                    <td><b class="text-info">{{ $order->quantity }}</b></td>
                                </tr>

								 <tr>
                                    <td><span class="text-muted">Boxes:</span></td>
                                    <td>
									<table style="border-spacing:10px; border-collapse: separate;"><tbody>
									@foreach($boxes as $i => $box)
									<tr>
										<td>@if('' !== $box->image)<img height="25px" src="/uploads/boxes/{{$box->image}}" />@endif</td>
										<td>{{$box->name}}</td>
										<td>
										<form method="get" action="{{ url('/admin/orders/'.$order->id.'/edit') }}">
										{!! csrf_field() !!}
										<input type="hidden" name="action" value="update_box"/>
										<input type="hidden" name="box_id" value="{{$box->box_id}}"/>
										<input type="checkbox" class="check-arrived" value="arrived" name="arrived" @if($box->arrived) checked @endif /> 進倉確認
										</form>
										</td>
									
									</tr>
									@endforeach
									</tbody></table>
									</td>
                                </tr>
                                <tr>
                                    <td><span class="text-muted">影像加值:</span></td>
                                    <td><b class="text-info">{{ $order->amt_service }}</b></td>
                                </tr>
 
                                <tr>
                                    <td><span class="text-muted">Address:</span></td>
                                    <td> <span class="text-info"> {{ $order->county }} {{ $order->district }} {{ $order->zipcode }}</span>
									<br/><b class="text-info">{{ $order->address }}</b>
									</td>
                                </tr>
								<tr>
                                    <td><span class="text-muted">Shipping Fee:</span></td>
                                    <td><b class="text-info">{{ $order->shipping_fee }}</b></td>
                                </tr>
								<tr>
                                    <td><span class="text-muted">Monthly Cost:</span></td>
                                    <td><b class="text-info">{{ $order->monthly_cost }}</b></td>
                                </tr>
                                <tr>
                                    <td><span class="text-muted">Remaining Credit:</span></td>
                                    <td><b class="text-info">{{ round($user->total_credit) }}</b></td>
                                </tr>
								<tr>
                                    <td><span class="text-muted">Pickup at:</span></td>
                                    <td><b class="text-info">{{ $order->pickup_date }}</b>/ {{ $order->pickup_time }}</td>
                                </tr>
								<tr>
                                    <td><span class="text-muted">Ship at:</span></td>
                                    <td><b class="text-info">@if('0000-00-00' !== $order->shipping_date){{ $order->shipping_date }}</b>/ {{ $order->shipping_time }}@else - @endif</td>
                                </tr>
								<tr>
                                    <td><span class="text-muted">Created at:</span></td>
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
		$('input.check-arrived').change(function(){
			
			$(this)[0].form.submit();
		})
    </script>
@endsection
