@extends('app')

@section('content')

<div class="page-header">
    <h1>Orders <small>{{ $user->first_name }}</small></h1>
</div>

<div class="jumbotron">
    <h1>Hmm...</h1>
    <p>You haven't made any orders yet.</p>
</div>

@stop