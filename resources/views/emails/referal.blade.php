@extends('emails.allin')

@section('title', 'Activation Email')

@section('css')
@endsection

@section('content')
您好！{{$referal_name}}推薦您使用ALL IN精品倉儲，請使用以下推薦碼就可以馬上獲得500點喔! <br/><span style="text-align: center;">{{$referal_code}}</span>
@endsection