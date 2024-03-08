@extends('layouts.mail')

@section('content')
        <div class="content">
            <p>Dear {{$name}},</p>
            <br>
            <p>Thank you for signing up for our website. To complete your registration, please use the following verification code:</p>
            <br>
            <h4>{{$code}}</h4>
            <br>
            <p>If you did not sign up for our website, please ignore this email.</p>
            <br>
            <p>Best regards,</p>
            <br>
            <p>Exptradies support</p>
        </div>
@endsection
