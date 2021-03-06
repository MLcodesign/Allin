@extends('layouts.admin.app')

@section('title', 'Settings')

@section('css')
<!-- tags in input field -->
{!! Html::style('assets/plugins/jquery-tagit-master/css/tagit.css') !!}
@endsection

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        <i class="fa fa-gear"></i> {{ isset($setting) ? '編輯' : '增加' }} 設定
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ url('admin/home') }}"><i class="fa fa-dashboard"></i> 管理介面</a></li>
        <li><a href="{{ url('admin/settings') }}"><i class="fa fa-gears"></i> 設定</a></li>
        <li class="active"><i class="fa {{ isset($setting) ? 'fa-pencil' : 'fa-plus' }}"></i> {{ isset($setting) ? 'Edit' : 'Add' }} Setting</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <!-- Default box -->
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">設定內容</h3>
            <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
            </div>
        </div>
        <div class="box-body">
            {!! Form::open(['url' => isset($setting) ? URL::to('admin/settings/'.$setting->id )  :  URL::to('admin/settings') ,'files' => true, 'method' => isset($setting) ? 'put': 'post', 'class' => 'form-horizontal', 'id'=>'validate']) !!}
            {!! Form::hidden('setting_id', isset($setting) ? $setting->id: null) !!}
            <div class="col-md-12">
                <div class="form-group">
                    {!! Form::label('key_cd', '字串 *', ['class' => 'control-label col-md-2']) !!}
                    <div class="col-md-8">
						@if(isset($setting))
							{!! Form::text('key_cd', old('key_cd', isset($setting) ? $setting->key_cd : null), ['class' => 'form-control validate[required]', 'placeholder'=>'Key','readonly']) !!}
						@else
							{!! Form::text('key_cd', old('key_cd', isset($setting) ? $setting->key_cd : null), ['class' => 'form-control validate[required]', 'placeholder'=>'Key']) !!}
							
						@endif
				   </div>
                </div>
                <div class="form-group">
                    {!! Form::label('type', '格式 *', ['class' => 'control-label col-md-2']) !!}
                    <div class="col-md-8">
                        {!! Form::text('type', old('type', isset($setting) ? $setting->type : $type), ['class' => 'form-control validate[required]', 'placeholder'=>'Type', 'readonly']) !!}
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('display_value', '內容顯示 *', ['class' => 'control-label col-md-2']) !!}
                    <div class="col-md-8">
                        {!! Form::text('display_value', old('display_value', isset($setting) ? $setting->display_value : null), ['class' => 'form-control validate[required]', 'placeholder'=>'Display Value']) !!}
                    </div>
                </div>
                @if(isset($setting) && $setting->type == 'SELECT' || $type == 'SELECT' )
                <div class="form-group" id="type_select">
                    {!! Form::label('value', '內容 *', ['class' => 'control-label col-md-2']) !!}
                    <div class="col-md-8">
                        <ul id="options-select" class="fake-input" tabindex="1" style="width:100%;" data-values ="{{ isset($setting) ? $setting->getOriginal('value') : ''}}">

                        </ul>
                    </div>
                </div>
                @elseif(isset($setting) && $setting->type == 'FILE' || $type == 'FILE' )
                <div class="form-group" id="type_text">
                    {!! Form::label('value', '內容 *', ['class' => 'control-label col-md-2']) !!}
                    <div class="col-md-4">
						<span class="btn  btn-file  btn-primary">上傳 
                        {!! Form::file('value') !!}
						</span>
                    </div>
                    @if(isset($setting))
                    <div class="col-md-4">
                        <a class="btn btn-info" href="{{ url('admin/settings/download/'.$setting->id) }}"> 下載</a>
                    </div>
                    @endif
                </div>
                @else
                <div class="form-group" id="type_text">
                    {!! Form::label('value', '內容 *', ['class' => 'control-label col-md-2']) !!}
                    <div class="col-md-8">
                        {!! Form::textarea('value', old('value', isset($setting) ? $setting->value : null), ['class' => 'form-control']) !!}
                    </div>
                </div>
                @endif
                <div class="form-group">
                    <div class="col-md-8 col-md-offset-2">
                        {!! Form::submit( (isset($setting) ? '更新': '新增') . ' 設定', ['class'=>'btn btn-primary']) !!}
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

<script type="text/javascript">
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