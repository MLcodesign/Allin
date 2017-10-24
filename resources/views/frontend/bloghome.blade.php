@extends('layouts.frontend.app')

@section('title', 'Blog')

@section('css')

@endsection

@section('content')
    <div class="row test">
        <div class=" col-md-offset-1 col-md-10 blogcontainer" style="">
		
		<div class="col-md-12 text-center" style="padding-bottom:12px;">
          <h1><b><font><font>最新消息</font></font></b></h1>

		  <h4  class="subtitle">Latest News</h4>
	<p class="y_line"></p></div>
	
	<ul style="line-height: 2;list-style-type: none;">
	@foreach ($posts as $post)
		<li style="border-bottom: 1px solid #dcdada;
    margin-bottom: 20px;
    padding-bottom: 15px;">
		   <span style="    font-size: 12px;    border: 1px solid #e6cb02;
    background: #ffe207;
    border-radius: 5px;
    color: #080707;
    padding: 5px 7px;
    margin-right: 10px;" class="label label-default">{{$post->created_at->format('m/d/Y') }}</span>  <a style="font-size: 15px;" href="{{ url('blog',$post->id) }}">{{$post->title}}</a> 
		</li>
		
		@endforeach
	 
		
	</ul>
	
	<div style="margin-top: 60px;" class="text-center"> {!!$posts->links()!!}</div>
	
	
	
        </div>
    </div>

@endsection

@section('js')
    <script type="text/javascript">

    </script>
@endsection
