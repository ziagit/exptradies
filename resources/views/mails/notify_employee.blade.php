@extends('layouts.mail')

@section('content')
        <div class="content">
            <p>Dear {{$name}},</p>
            <br>
            <p>We hope this email finds you well. We would like to inform you about an exciting new job opportunity that has recently been posted on our platform.</p>
            <p>Job title: {{$title}}</p>
            <p>Location: {{$location}}</p>
            <p><a href="https://exptradies.com/employee/leads">View </a>more details on Exptradies portal.</p>
            <p>We believe that your expertise and skills align perfectly with the requirements of this job. It would be great to have you on board for this project.</p>
            <p>If you are interested and available to take up this job, please log in to our platform and be the first to accept it.</p>
            <p>For any further clarification or information, please do not hesitate to reach out our <a href="https://exptradies.com/help">support</a> team.</p>
            <br>
            <p>Best regards,</p>
            <br>
            <p>Exptradies support</p>

        </div>
     
 @endsection