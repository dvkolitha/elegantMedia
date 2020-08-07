@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-body">
                   @guest()
                   	Welcome To Customer Support <a href="{{ route('login') }}">login here</a>
                   @endguest
                   @auth()
                   	Go To Customer Ticket <a href="{{ url('/dashboard') }}"> here</a>
                   @endauth
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
