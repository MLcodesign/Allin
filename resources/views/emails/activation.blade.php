@extends('emails.allin')

@section('title', 'Activation Email')

@section('css')
@endsection

@section('content')
您好！非常感謝您加入ALL IN 精品倉儲會員，請點選以下註冊驗證連結，驗證成功後將會另外發送會員註冊確認函，謝謝！ <a href="{{ $link }}">{{ $link }}</a>
@endsection