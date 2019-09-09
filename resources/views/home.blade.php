@extends('layouts.app')

@section('content')
<div class="container">
    <posts :user="{{Auth::user()}}"></posts>
</div>
@endsection
