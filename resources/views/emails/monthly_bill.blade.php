@extends('emails.allin')

@section('title', 'Monthly Bill')

@section('css')
@endsection

@section('content')
An amount of {{$order->monthly_cost}} credits have been deducted successfully from your account
@endsection