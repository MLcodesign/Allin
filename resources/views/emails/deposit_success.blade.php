@extends('emails.allin')

@section('title', '{{$data->subject}}')

@section('css')
@endsection

@section('content')

您好，付款方式: {{$data->payment_type}}，點數 {{$data->total_payment}} 點已儲值成功!! <a href="{{url('/')}}">連回首頁</a>，謝謝！
@endsection