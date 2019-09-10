@extends('layouts.app')

@section('content')
<div class="container">
    <postfeed :auth-user="{{Auth::user()}}" :user="{{$user}}"></postfeed>
</div>
@endsection
