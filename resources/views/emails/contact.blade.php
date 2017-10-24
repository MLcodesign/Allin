@extends('emails.allin')

@section('title', 'Contact Email')

@section('css')
@endsection

@section('content')
You received a message from Contact Form:

<p>
    Name: {{ $name }}
</p>

<p>
    Email: {{ $email }}
</p>

<p>Phone Number: {{ $phone }}</p>

<p>
    Subject : {{ $subject }}
</p>

<p>
    Message: {{ $form_message }}
</p>
@endsection
