@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Session Expired</h1>
        <p>Your session has expired. Please <a href="{{ route('login') }}">log in again</a>.</p>
    </div>
@endsection
