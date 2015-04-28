@extends('app')

@section('content')

<div class="page-header">
    <h1>Contact <small>{{ ucfirst($seller->first_name) }}</small></h1>
</div>

<div class="jumbotron">
    <h1>Success</h1>
    <p>Your message to {{ $seller->first_name }} has been sent.</p>
    <br>
    <a href="{{ route('books.index') }}" class="btn btn-primary">Continue Browsing</a>
</div>

@stop