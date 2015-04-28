@extends('app')

@section('content')

<div class="page-header">
    @if(Auth::check() and Auth::user()->id == $user->id)
    <a href="{{ route('users.books.create', Auth::user()->username) }}"
       class="btn btn-primary pull-right">
        <i class="fa fa-plus" style="padding-right:5px"></i> Post
    </a>
    @endif
    <h1>Books <small>{{ ucfirst($user->first_name) }}</small></h1>
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
                @if(Auth::check() and (Auth::user()->id == $user->id))
                <hr>
                <a href="{{ route('users.books.edit', [$user->username, $book->slug]) }}"
                   class="btn btn-primary btn-sm" style="width:100%">
                    <i class="fa fa-edit" style="padding-right:5px"></i> Edit
                </a>
                @endif
            </div>
        </div>
    </div>
    
    @endforeach
    
</div>

@else

<div class="jumbotron">
    <h1>Hmm...</h1>
    @unless(Auth::check() and (Auth::user()->id == $user->id))
    <p>{{ ucfirst($user->first_name) }} doesn't have any books for sale at the moment.</p>
    @else
    <p>You don't have any books for sale at the moment.</p>
    @endunless
</div>

@endif

@stop