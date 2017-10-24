@extends('layouts.frontend.self_storage')

@section('title', $page->title)

@section('meta_desc', $page->meta_desc)

@section('meta_keywords', $page->meta_keywords)

@section('css')

@endsection
<style>
    header .container-fluid{
        background: #4e4744 !important;
    }
    header .container-fluid .row .text-right span a{
        color: #ffe207;
    }

    #edm-trigger span{font-size: 14px}
</style>
@section('content')



    {!! $page->content !!}


@endsection

@section('js')

@endsection
