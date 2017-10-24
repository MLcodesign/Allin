@extends('emails.allin')

@section('title', '點數餘額不足')

@section('css')
@endsection

@section('content')

您好，您的懶人倉點數已經用盡，請盡快進行加值 <a href="{{url('/deposit')}}">{{url('/deposit')}}</a>，謝謝！
@endsection