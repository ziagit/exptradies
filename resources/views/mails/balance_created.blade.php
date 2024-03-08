@extends('layouts.mail')

@section('content')
        <div class="content">
            <p>Dear {{$name}},</p>
            <br>
            <p>Your balance added successfuly in your account at Exptradies.</p>
            <p>You will receive <b>%50</b> credit from Exptradies, enjoy accepting jobs.</p>
            <p>Current balance available: <b>${{$balance}}</b></p>
            <p>This balance is valid for next <b>30</b> days.</p>
            <br>
            <p>With regards,</p>
            <br>
            <p>Exptradies support</p>
        </div>
      
@endsection