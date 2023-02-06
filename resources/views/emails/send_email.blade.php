@extends('layouts.emails')
@section('content')


    <h3> Dear :{{ $customer->name }}</h3>

    <h4> Message</h4>

    <p> {{$message_replay}}</p>
@endsection
