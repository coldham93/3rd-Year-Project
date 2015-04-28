@extends('app')

@section('content')

<div class="page-header">
    <h1>Wishlist <small>{{ $user->first_name }}</small></h1>
</div>

@if(count($wishlist) > 0)

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
                <form action="{{ route('users.show', $user->username) }}/wishlist/{{ $book->id }}" method="POST">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="_method" value="DELETE">
                    <button type="submit" class="btn btn-primary btn-sm" style="width:100%">
                        <i class="fa fa-close" style="padding-right:5px"></i> Remove
                    </button>
                </form>
                @endif
            </div>
        </div>
    </div>
    
    @endforeach
    
</div>

@else

<div class="jumbotron">
    <h1>Hmm...</h1>
    @if(Auth::check() and (Auth::user()->id == $user->id))
    <p>You have an empty wishlist.</p>
    @else
    <p>{{ ucfirst($user->first_name) }} has an empty wishlist.</p>
    @endif
</div>

@endif

<center>{!! $wishlist->render() !!}</center>
<br>

@stop