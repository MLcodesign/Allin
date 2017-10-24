@extends('layouts.admin.app')

@section('title', 'Blank')

@section('css')

@endsection

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
       
        <ol class="breadcrumb">
            <li><a href="{{ url('admin/dashboard') }}"><i class="fa fa-dashboard"></i> ????</a></li>
            <li class="active"><i class="fa fa-file"></i> Blank</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
	
	<div class="flash-message">
    @foreach (['danger', 'warning', 'success', 'info'] as $msg)
      @if(Session::has('alert-' . $msg))

      <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
      @endif
    @endforeach
  </div>
	
	

	
	
 <style>
 .blog-main {
	background: #fff;
    box-shadow: 0 4px 4px 0 rgba(0,0,0,.1),0 2px 4px 0 rgba(0,0,0,.02);
    padding: 20px;
    margin-bottom: 100px;
}
</style>



  <div class="row">

     <div class="col-md-8 col-md-offset-2">
	
	 <h4>Create New Post</h4><br>
	 
    {!! Form::open(array('url' => url('/admin/save-new-post'),'data-parsley-validate' =>'')) !!}
	      <br>
		 {{Form::label('title','Title:')}}
		 {{Form::text('title', null,array('class'=>'form-control','required'=>'','maxlength'=>'255','id'=>'title'))}}
		  <br>
		
	
		 
		
		 
		 {{Form::label('body','Post body:')}}
		 {{Form::textarea('body', null,array('class'=>'form-control','required'=>''))}}
		
		 {{Form::submit('Create post',array('class'=>'btn btn-success btn-lg btn-block','style'=>'margin:20px 0px'))}}
		 
		 
	 {!! Form::close() !!}
      </div>
	 </div>
        
	
		
    </section><!-- /.content -->
@endsection

@section('js')
	  <script src="//cdn.ckeditor.com/4.5.11/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace( 'body' );
    </script>
@endsection
