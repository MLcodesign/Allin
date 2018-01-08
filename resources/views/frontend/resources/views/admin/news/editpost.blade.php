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



<div class="row" style="margin: 10px;">


{!!Form::model($post,['url' => ['admin/edit-post-save', $post->id], 'method' => 'POST', 'files' => true])!!}
        <div class="col-sm-8 blog-main">
		{{Form::label('title','Title:')}}
		{{ Form::text('title', null, ["class" => 'form-control input-lg'])}}
		<br>
	
	
		
		
		{{Form::label('body','Body:', ['class' =>'form-spacing-top'])}}
	    {{Form::textarea('body', null, ["class" => 'form-control'])}}
            {{Form::file('edm', ['style' =>'display: none', 'id' => 'edm'])}}
    <br>
           <p> <a href="#" class="btn btn-primary btn-large" onclick="document.getElementById('edm').click()">Choose EDM</a></p>


         <br>
		</div>

  <div class="col-sm-3 col-sm-offset-1 blog-sidebar blog-main">
          <div class="sidebar-module sidebar-module-inset">
            <h4>About</h4>
           <dl>
			  <dt>Created At:</dt>
			  <dd>{{date('M j, Y h:ia',strtotime($post->created_at))}}</dd>
			  <dt>Last Updated</dt>
			  <dd>{{date('M j, Y h:ia',strtotime($post->updated_at))}}</dd>
			</dl>
			
		
			  
			  
			  
			 
		
			
			
			
			
			<hr>
			<div class="row">
			<div class="col-sm-6">
		
			<a class="btn btn-danger btn-block" type="submit" href="{{url('/admin/top-bar-news')}}">Cancel</a>
			
			</div>
			<div class="col-sm-6">
			{{Form::submit('Save',['class'=>'btn btn-success btn-block'])}}
			
			</div>
			</div>
          </div>
      
        </div>

		{!!Form::close()!!}
	   
	 </div>
        
		
	
		
	
		
    </section><!-- /.content -->
@endsection

@section('js')
	  <script src="//cdn.ckeditor.com/4.5.11/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace( 'body' );
    </script>
@endsection
