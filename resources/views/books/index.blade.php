@extends('app')

@section('content')

<div class="page-header">
    <div class="hidden-xs pull-right" style="width:50%">@include('partials.searchbar')</div>
    <h1>Books <small>{{ $_subject ? $_subject->name : 'All Subjects' }}</small></h1>
</div>

<div class="visible-xs">
    @include('partials.searchbar')
    <hr>
</div>

@if(count($books) > 0)

<div class="row">

    @foreach($books as $book)
    
    <div class="col-xs-12 col-sm-6 col-md-4">
        <div class="thumbnail">
            <div class="caption">
                <a href="{{ route('books.show', $book->slug) }}">
                    <img src="/books/{{ $book->id }}/img" width="100%">
                </a><hr>
                <div class="row">
                    <div class="col-md-2 col-xs-2">
                        <b>Title</b>
                    </div>
                    <div class="col-md-10 col-xs-10" style="text-align:right">
                        {{ $book->title }}
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-2 col-xs-2">
                        <b>Author</b>
                    </div>
                    <div class="col-md-10 col-xs-10" style="text-align:right">
                        {{ $book->author }}
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-2 col-xs-2">
                        <b>Subject</b>
                    </div>
                    <div class="col-md-10 col-xs-10" style="text-align:right">
                        <a href="{{ route('books.index') }}?subject={{ $book->subject->slug }}">{{ $book->subject->name }}</a>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-2 col-xs-2">
                        <b>Price</b>
                    </div>
                    <div class="col-md-10 col-xs-10" style="text-align:right">
                        £{{ $book->price }}
                    </div>
                </div>
                <hr>
                <div class="row" style="margin-bottom:6px;">
                    <div class="col-md-6 col-xs-6">
                        <b>Posted</b> by <a href="{{ route('users.show', $book->user->username) }}">{{ ucfirst($book->user->first_name) }}</a>
                    </div>
                    <div class="col-md-6 col-xs-6" style="text-align:right">
                        {{ $book->created_at->diffForHumans() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    @endforeach
    
</div>

@else

<div class="jumbotron">
    <h1>Hmm...</h1>
    @if($_search)
    <p>There aren't any books under '{{ $_search }}' for sale at the moment.</p>
    @else
    <p>There aren't any books for sale at the moment.</p>
    @endif
</div>

@endif

<center>{!! $books->render() !!}</center>
<br>

@stop