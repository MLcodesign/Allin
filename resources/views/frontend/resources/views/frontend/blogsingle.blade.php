@extends('layouts.frontend.app')

@section('title', 'Blog')

@section('css')

@endsection

@section('content')
    <div class="row"><br><br>
        <div class=" col-md-offset-2 col-md-8 blogcontainer" style="">
           
	
	       <h2  class="subtitle"> {{$post->title}}</h2>
	<p class="y_line"></p>
	
	
	
	
	
	<span style="margin-botton:20px;font-size: 15px;background: #4e4744;
			border-radius: 5px;
			color: #fff;
			padding: 5px 7px;
			margin-right: 10px;" class="label label-default">{{$post->created_at->format('m/d/Y') }}</span> <br>
	
	
	<p style="margin-top: 15px;">
	{{$post->body}}
	
	</p>
	
	
	
	
	
        </div>
    </div>

@endsection

@section('js')
    <script type="text/javascript">

    </script>
@endsection
