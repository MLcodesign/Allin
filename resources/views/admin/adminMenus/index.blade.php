@extends('layouts.admin.app')

@section('title', 'Menus')

@section('css')
    <!-- iCheck for checkboxes and radio inputs -->
    {!! Html::style('assets/plugins/iCheck/all.css') !!}
@endsection

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <i class="fa fa-list-alt"></i> Edit Admin Menu
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ url('admin/dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="{{ url('admin/adminMenus') }}"><i class="fa fa-list-alt"></i>Admin Menus</a></li>
            <li class="active"><i class="fa fa-pencil"></i>Edit Menu </li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Menu Details Form</h3>
                <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i
                                class="fa fa-minus"></i></button>
                </div>
            </div>
            <div class="box-body">
                {!! Form::open(['url' => URL::to('admin/adminMenus') , 'method' => 'post', 'class' => 'form-horizontal', 'id'=>'validate']) !!}
                <div class="col-md-12">
                    @foreach($menus as $menu)
                    <div class="form-group">
                        {!! Form::label('title', ucfirst($menu->name), ['class' => 'control-label col-md-2']) !!}
                        <div class="col-md-6 col-xs-12">
                            <input type="text" name="menus[{{ $menu->id }}]" value="{{ $menu->title }}" class="form-control validate[required]" placeholder="{{ $menu->name }}">
                        </div>
                    </div>
                    @endforeach
                    <div class="form-group">
                        <div class="col-md-12">
                            {!! Form::submit( 'Update Menu', ['class'=>'btn btn-primary']) !!}
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

    <!-- iCheck 1.0.1 -->
    {!! Html::script('assets/plugins/iCheck/icheck.min.js') !!}

    {!! Html::script('assets/plugins/validationengine/languages/jquery.validationEngine-en.js') !!}

    {!! Html::script('assets/plugins/validationengine/jquery.validationEngine.js') !!}

    <script type="text/javascript">
        $(document).ready(function () {

            $('input[type="checkbox"].minimal').iCheck({
                checkboxClass: 'icheckbox_minimal-blue'
            });

            //Initialize Select2 Elements
            $(".select2").select2();

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