@extends('layouts.app')

@section('content')
<div class="container">
    <postfeed :auth-user="{{Auth::user()}}"></postfeed>
</div>
@endsection
