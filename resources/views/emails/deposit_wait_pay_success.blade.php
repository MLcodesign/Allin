@extends('emails.allin')

@section('title', '{{$data->subject}}')

@section('css')
@endsection

@section('content')

您好，付款方式: {{$data->payment_type}} 待付款通知，請於 {{$data->expireDate}} {{$data->expireTime}} 期限內完成付款!! <a href="{{url('/')}}">連回首頁</a>，謝謝！
@if($data->payment_type_code == "VACC")
銀行代碼：{{$data->bankCode}}
轉帳帳號：{{$data->codeNo}}
@endif
@if($data->payment_type_code == "CVS")
超商繳費代碼：{{$data->codeNo}}
@endif
@if($data->payment_type_code == "BARCODE")
BarCode1：{{$data->barCode1}}
BarCode2：{{$data->barCode2}}
BarCode3：{{$data->barCode3}}
@endif
繳費金額：{{$data->amt}}
@endsection