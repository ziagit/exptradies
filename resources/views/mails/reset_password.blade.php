@extends('layouts.mail')

@section('content')
        <div class="content">
            <p>Hello {{$name}}</p>
            <br>
            <p>We have received a request to reset the password for your account. If you did not initiate this request, please disregard this email.</p>
            <p>Verification code: <b>{{$code}}</b></p>
            <br>
            <p>
                Please note that the password reset code is valid for a limited time for security purposes. If the code expires, you can initiate another password reset request from our website.
            </p>
            <p>
            If you require any assistance or have any concerns, please feel free to reach out our <a href="https://exptradies.com/help">support</a>. We are here to guide you through the process and address any questions you may have.
            </p>
            <p>Thank you for your attention to this matter. We apologize for any inconvenience caused.</p>
            <br>
            <p>Best regards,</p>
            <br>
            <p>Exptradies support</p>
        </div>
        @endsection