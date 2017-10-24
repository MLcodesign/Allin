@extends('layouts.frontend.single')

@section('title', $page->title)

@section('meta_desc', $page->meta_desc)

@section('meta_keywords', $page->meta_keywords)

@section('css')

@endsection

@section('content')
	
	
	
{!! $page->content !!}


@endsection

@section('js')
    <script type="text/javascript">

    </script>
@endsection
