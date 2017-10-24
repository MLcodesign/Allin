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
	
	
	<h3>
        <i class="fa fa-edit"></i><font><font class=""> 編輯最新消息

    </font></font></h3>
	
	
	
        <!-- Default box -->
        <div class="box">
            
            <div class="box-body">
              
			    {!! Form::open(array('url' => url('/admin/save-top-news'),'data-parsley-validate' =>'',  'files' => true)) !!}
			  <div class="form-group">
				<label for="email">Edit News:</label>
				<textarea value="" type="text" rows="5" class="form-control" name="topnews">{{ $news->text }}</textarea>
			  </div>
			 
			<a href="#" class="btn btn-primary btn-large" onclick="document.getElementById('edm').click()">Change EDM</a>
                <input type="file" style="display:none" name="edm" id="edm">

			  <button type="submit" class="btn btn-default">儲存</button>
			</form>
			  
			  
			  
            </div><!-- /.box-body -->
          
        </div><!-- /.box -->
		
		<h3>
        <i class="fa fa-edit"></i><font><font class=""> All Post

    </font></font> <a href="posts/create" class="btn btn-primary pull-right"> <i class="fa fa-plus"></i> Create New Post</a>"</h3>
		
		<br>
		
		<div class="box">
            
            <div class="box-body">
		
		      <table class="table">
    <thead>
      <tr>
        <th>#</th>
        <th>Title</th>
        <th>Body</th>
		<th>Created At</th>
        <th></th>
      </tr>
    </thead>
    <tbody>
	@foreach ($posts as $post)
      <tr>
        <td>{{$post->id}}</td>
        <td>{{$post->title}}</td>
        <td>{{ substr($post->body, 0, 50)}}</td>
		<td>{{date('M j, Y h:ia',strtotime($post->created_at))}}</td>
        <td>
		
		  <a href="/blog/{{$post->id}}" class="btn btn-sm btn-default">View</a>
		  <a href="edit-post/{{$post->id}}" class="btn btn-sm btn-default">Edit</a>
		  <a href="destroy-post/{{$post->id}}" class="btn btn-sm btn-danger">Remove</a>
	
		</td>
      </tr>
	   @endforeach
     
    </tbody>
  </table>
	   
	  <div class="text-center"> {!!$posts->links()!!}</div>
		
		
		  </div><!-- /.box-body -->
          
        </div><!-- /.box -->
		
    </section><!-- /.content -->
@endsection

@section('js')
<script type="text/javascript">

</script>
@endsection
