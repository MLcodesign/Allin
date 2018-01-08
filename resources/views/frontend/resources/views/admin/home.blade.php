@extends('layouts.admin.app')

@section('title', 'Blank')

@section('css')

@endsection

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <i class="fa fa-file"></i> 編輯 首頁
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ url('admin/dashboard') }}"><i class="fa fa-dashboard"></i> 管理介面</a></li>
            <li class="active"><i class="fa fa-folder"></i> 文案</li>
			<li class="active"><i class="fa fa-file"></i> 首頁</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">首頁表單</h3>
                <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                </div>
            </div>
            <div class="box-body">
            {!! Form::open(['url' =>  'admin/home', 'method' => 'post', 'class' => 'form-horizontal', 'id'=>'validate']) !!}
            {!! Form::hidden('page_id', isset($page) ? $page->id: null) !!}
            <div class="col-md-12">
                <div class="form-group">
                    {!! Form::label('meta_keywords', 'Meta 關鍵字', ['class' => 'control-label col-md-2']) !!}
                    <div class="col-md-10">
                        {!! Form::textarea('meta_keywords', old('meta_keywords', isset($page) ? $page->meta_keywords : null), ['class' => 'form-control', 'rows'=> 3]) !!}
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('meta_desc', 'Meta 敘述', ['class' => 'control-label col-md-2']) !!}
                    <div class="col-md-10">
                        {!! Form::textarea('meta_desc', old('meta_desc', isset($page) ? $page->meta_desc : null), ['class' => 'form-control', 'rows'=> 3]) !!}
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('content', '內容', ['class' => 'control-label col-md-2']) !!}
                    <div class="col-md-10">
                        {!! Form::textarea('content', old('content', isset($page) ? $page->content : null), ['class' => 'form-control', 'id'=> 'editor']) !!}
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-10 col-md-offset-2">
                        {!! Form::submit( (isset($page) ? '編輯': '新增') . ' 內容', ['class'=>'btn btn-primary']) !!}
                    </div>
                </div>
            </div><!-- .col-md-12 -->
            {!! Form::close() !!}
        </div><!-- /.box-body -->
            <div class="box-footer">
                Footer
            </div><!-- /.box-footer-->
        </div><!-- /.box -->
    </section><!-- /.content -->
@endsection

@section('js')
<script type="text/javascript">

</script>
@endsection
