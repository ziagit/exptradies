@extends('layouts.mail')

@section('content')
        <div class="content">
            <p>Dear {{$name}},</p>
            <br>
            <p>We are pleased to inform you that your quotation for the job opportunity with the title Tiler has been accepted by the employer. Congratulations!</p>
            <p>Job title: {{$title}}</p>
            <p>Job description: </p>
            <p><a href="https://exptradies.com/employee/posts">View </a>more details on Exptradies portal.</p>
            <p>The employer was impressed with your expertise, professionalism, and competitive pricing. They believe that you are the perfect fit for this project and are excited to work with you.</p>
            <p>If you have any questions or need any assistance throughout this process, please feel free to contact our <a href="https://exptradies.com/help">support</a>. We are here to support you and ensure a smooth collaboration with the employer.</p>
            <br>
            <p>Best regards,</p>
            <br>
            <p></p>
            <p>Exptradies support</p>
        </div>
@endsection