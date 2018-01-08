@extends('layouts.admin.app')

@section('title', '折扣碼')

@section('css')
<!-- tags in input field -->
{!! Html::style('assets/plugins/jquery-tagit-master/css/tagit.css') !!}
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
@endsection

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        <i class="fa fa-barcode"></i> {{ isset($coupon) ? 'Edit' : 'Add' }} 折扣碼
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ url('admin/home') }}"><i class="fa fa-dashboard"></i> 管理介面</a></li>
        <li><a href="{{ url('admin/settings') }}"><i class="fa fa-barcode"></i> 折扣碼</a></li>
        <li class="active"><i class="fa {{ isset($setting) ? 'fa-pencil' : 'fa-plus' }}"></i> {{ isset($coupon) ? 'Edit' : 'Add' }} 折扣碼</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <!-- Default box -->
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">折扣碼</h3>
            <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
            </div>
        </div>
        <div class="box-body">
            {!! Form::open(['url' => isset($coupon) ? URL::to('admin/coupon/'.$coupon->coupon_id )  :  URL::to('admin/coupon') ,'files' => false, 'method' => isset($coupon) ? 'put': 'post', 'class' => 'form-horizontal', 'id'=>'validate']) !!}
            {!! Form::hidden('coupon_id', isset($coupon) ? $coupon->coupon_id: null) !!}
            <div class="col-md-12">
				<div class="form-group">
					{!! Form::label('code', '折扣碼 *', ['class' => 'control-label col-md-2']) !!}
					<div class="col-md-8">
						@if(isset($coupon))
							{!! Form::text('code', old('code', isset($coupon) ? $coupon->code : null), ['class' => 'form-control validate[required]', 'placeholder'=>'折扣碼']) !!}
						@else
							{!! Form::text('code', old('code'), ['class' => 'form-control validate[required]', 'placeholder'=>'折扣碼']) !!}
						@endif
					</div>
				</div>
				<div class="form-group">
					{!! Form::label('code', '折扣期限  *', ['class' => 'control-label col-md-2']) !!}
					<div class="col-md-8">
						<div class="col-md-6" style="padding: 0">
							@if(isset($coupon))
								{!! Form::text('from_date', old('from_date', isset($coupon) ? $coupon->from_date : null), ['class' => 'form-control validate[required]', 'placeholder'=>'起始日期', 'id' => 'fdatepicker']) !!}
							@else
								{!! Form::text('from_date', old('from_date'), ['class' => 'form-control validate[required]', 'placeholder'=>'起始日期', 'id' => 'fdatepicker']) !!}
							@endif
						</div>
						<div class="col-md-6" style="padding: 0">
							@if(isset($coupon))
								{!! Form::text('to_date', old('to_date', isset($coupon) ? $coupon->to_date : null), ['class' => 'form-control', 'placeholder'=>'截止日期', 'id' => 'tdatepicker']) !!}
							@else
								{!! Form::text('to_date', old('to_date'), ['class' => 'form-control', 'placeholder'=>'截止日期', 'id' => 'tdatepicker']) !!}
							@endif
						</div>
					</div>
				</div>
				<div class="form-group">
					{!! Form::label('point', '點數 *', ['class' => 'control-label col-md-2']) !!}
					<div class="col-md-8">
						@if(isset($coupon))
							{!! Form::text('point', old('point', isset($coupon) ? $coupon->point : null), ['class' => 'form-control validate[required]', 'placeholder'=>'點數']) !!}
						@else
							{!! Form::text('point', old('point'), ['class' => 'form-control validate[required]', 'placeholder'=>'點數']) !!}
						@endif
					</div>
				</div>
				@if(isset($coupon))
					<div class="form-group">
						{!! Form::label('status', '狀態 *', ['class' => 'control-label col-md-2']) !!}
						<div class="col-md-8">
							<select class="form-control validate[required]" name="status">
								<option vlaue="0" @if($coupon->status == 0) Selected @endif>Active</option>
								<option vlaue="1" @if($coupon->status == 1) Selected @endif>Deactive</option>
							</select>
						</div>
					</div>
				@endif
				
				@if(isset($coupon))
				 
			   @else
			 <div class="form-group">
				 <div class="col-md-8 col-md-offset-2">
				 <label for="sel1">優惠碼類型 *</label>
				
				<div class="radio">
				  <label><input value="normal" type="radio" required checked name="coupntype">一般優惠碼</label>
				</div>
				 <div class="radio">
				  <label><input value="newuser" type="radio" required name="coupntype">首次登入使用</label>
				</div>
				
				</div>
				</div>
				@endif
				
                <div class="form-group">
                    <div class="col-md-8 col-md-offset-2">
                        {!! Form::submit( (isset($coupon) ? '更新': '新增') . ' 設定', ['class'=>'btn btn-primary']) !!}
                    </div>
                </div>
            </div><!-- .col-md-12 -->
            {!! Form::close() !!}
        </div><!-- /.box-body -->
        <div class="box-footer">
        </div><!-- /.box-footer-->
    </div><!-- /.box -->
</section><!-- /.content -->
@endsection


@section('js')

{!! Html::script('assets/plugins/validationengine/languages/jquery.validationEngine-en.js') !!}

{!! Html::script('assets/plugins/validationengine/jquery.validationEngine.js') !!}

{!! Html::script('assets/plugins/jquery-tagit-master/lib/jquery.tagit.js') !!}
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script type="text/javascript">
	//Date range picker
    $("#fdatepicker").datepicker({
		dateFormat: "yy-mm-dd",
		minDate: new Date(),
		onSelect: function(selected){
			var dt = new Date(selected);
			dt.setDate(dt.getDate() + 1);
			$("#tdatepicker").datepicker("option", "minDate", dt);
		}
	});
	$("#tdatepicker").datepicker({
		dateFormat: "yy-mm-dd",
		onSelect: function(selected){
			var dt = new Date(selected);
			dt.setDate(dt.getDate() - 1);
			$("#fdatepicker").datepicker("option", "maxDate", dt);
		}
	});
    $(document).ready(function () {

        if ($("#options-select").length > 0)
        {
            var options = [];

            $("#options-select").tagit({
                tags: options,
                field: "value[]"
            });

            var values = $("#options-select").data("values");
            if (values.length > 0)
            {
                $.each(values, function (i, e) {
                    $("#options-select").tagit("addTag", e);
                });
            }
        }
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