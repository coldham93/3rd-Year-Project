@extends('app')

@section('content')

<div class="page-header">
    <h1>Profile <small>{{ ucfirst($user->first_name) }}</small></h1>
</div>

@stop