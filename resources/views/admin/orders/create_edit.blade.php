@extends('layouts.admin.app')

@section('title', 'Orders')

@section('css')
{!! Html::style('/assets/plugins/lightbox/css/lightbox.css') !!}
@endsection


@section('content')
        <!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        <i class="fa fa-database"></i> {{ isset($order) ? '編輯' : '新增' }} Order
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ url('admin/dashboard') }}"><i class="fa fa-dashboard"></i> 管理介面</a></li>
        <li><a href="{{ url('admin/orders') }}"><i class="fa fa-database"></i> 訂單</a></li>
        <li class="active"><i
                    class="fa {{ isset($user) ? 'fa-pencil' : 'fa-plus' }}"></i> {{ isset($order) ? '編輯' : '新增' }}
            訂單
        </li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <!-- Default box -->
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title"></h3>
            <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i
                            class="fa fa-minus"></i></button>
            </div>
        </div>
        <div class="box-body">
            {!! Form::open(['url' =>  isset($order) ? 'admin/orders/'.$order->id  :  'admin/orders', 'method' => isset($order) ? 'put' : 'post', 'files' => true, 'class' => 'form-horizontal', 'id'=>'validate']) !!}
            {!! Form::hidden('user_id', isset($order) ? $order->id: null) !!}
            <fieldset>
                <legend>聯絡資料</legend>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('mobile', '電話', ['class' => 'control-label col-md-3']) !!}
                            <div class="col-md-9">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-mobile"></i></span>
                                    {!! Form::text('phone', old('phone', isset($order) ? $order->phone: null), ['class' => 'form-control', 'placeholder'=>'手機']) !!}
                                </div>
                            </div>
                        </div>
						<div class="form-group">
							{!! Form::label('address', '地址 *', ['class' => 'control-label col-md-3']) !!}
                            <div class="col-md-9">
								<div id="twzipcode">
									<div class="col-md-4" style="padding: 0;">
									<div data-role="county"
									   data-name="county"
									   id = "county"
									   data-value="{{ $order->county }}"
									   data-style="county form-control"> </div>
									</div>
									<div class="col-md-4" style="padding: 0;">
									<div data-role="district"
									   id = "district"
									   data-name="district"
									   data-value="{{ $order->district }}"
									   data-style="district form-control"> </div>
									</div>
									<div class="col-md-4" style="padding: 0;">
									<div data-role="zipcode"
									   data-name="zipcode"
									   id = "zipcode"
									   data-value="{{ $order->zipcode }}"
									   data-style="zipcode form-control"> </div>
									</div>
								</div>
							</div>
                        </div>
                        <div class="form-group">
                            {!! Form::label('address', '地址 *', ['class' => 'control-label col-md-3']) !!}
                            <div class="col-md-9">
                                {!! Form::text('address', old('address', isset($order) ? $order->address: null), ['class' => 'form-control validate[required]', 'placeholder'=>'地址']) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-9 col-md-offset-3">
                                {!! Form::submit((isset($order)?'Update': '新增'). ' 訂單', ['class'=>'btn btn-primary']) !!}
                            </div>
                        </div>
                    </div><!-- .col-md-6 -->
                </div><!-- .row -->
            </fieldset>
            {!! Form::close() !!}
        </div><!-- /.box-body -->
        <div class="box-footer">
        </div><!-- /.box-footer-->
    </div><!-- /.box -->
</section><!-- /.content -->
@endsection


@section('js')
{!! Html::script('/assets/plugins/lightbox/js/lightbox.js') !!}

<script src="{{ url('/assets/dist/js/jquery.twzipcode.min.js') }}" type="text/javascript"></script>
        <!-- iCheck 1.0.1 -->
{!! Html::script('assets/plugins/iCheck/icheck.min.js') !!}

{!! Html::script('assets/plugins/validationengine/languages/jquery.validationEngine-en.js') !!}

{!! Html::script('assets/plugins/validationengine/jquery.validationEngine.js') !!}

<script type="text/javascript">

$('#twzipcode').twzipcode();

    $(document).ready(function () {
        //Initialize Select2 Elements
        $(".select2").select2({
            placeholder: "Please Select",
            allowClear: true
        });

        // Validation Engine init
        var prefix = 's2id_';
        $("form[id^='validate']").validationEngine('attach',
                {
                    promptPosition: "bottomRight", scroll: false,
                    prettySelect: true,
                    usePrefix: prefix
                });
    });
</script>
@endsection
