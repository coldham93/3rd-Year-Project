@extends('app')

@section('content')

<div class="page-header">
    @if(Auth::check() and (Auth::user()->id == $book->user->id))
    <a href="{{ route('users.books.edit', [$book->user->username, $book->slug]) }}"
       class="btn btn-primary btn-sm pull-right" style="margin-top:5px">
        Edit
    </a>
    @endif
    <h1>{{ $book->title }} <small>By {{ $book->author }}</small></h1>
</div>

<div class="row">
    <div class="col-md-6 col-sm-6">
        <a href="{{ route('books.show', $book->slug) }}">
            <img src="/books/{{ $book->id }}/img" width="100%">
        </a>
    </div>
    <div class="col-md-6 col-sm-6">
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
                <b>ISBN</b>
            </div>
            <div class="col-md-10 col-xs-10" style="text-align:right">
                <a href="http://www.amazon.co.uk/s/ref=sr_adv_b?field-isbn={{ $book->isbn }}" target="_blank">{{ $book->isbn }}</a>
            </div>
        </div>
        <hr>
        <b>Description</b>
        <br><br>
        <p>{{ $book->description }}</p>
        <hr>
        <div class="row">
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-2 col-xs-2">
                        <b>Posted</b>
                    </div>
                    <div class="col-md-10 col-xs-10" style="text-align:right">
                        {{ $book->created_at->diffForHumans() }}
                    </div>
                </div>
                <hr>
            </div>
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-2 col-xs-2">
                        <b>Seller</b>
                    </div>
                    <div class="col-md-10 col-xs-10" style="text-align:right">
                        <a href="{{ route('users.show', $book->user->username) }}">{{ ucfirst($book->user->first_name) }}</a>
                    </div>
                </div>
                <hr>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-2 col-xs-2">
                        <b>Price</b>
                    </div>
                    <div class="col-md-10 col-xs-10" style="text-align:right">
                        £{{ $book->price }}
                    </div>
                </div>
                <hr>
            </div>
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-6 col-xs-6">
                        @if(Auth::check() and Auth::user()->id != $book->user->id)
                        <form action="{{ route('users.show', Auth::user()->username) }}/wishlist/{{ $book->id }}" method="POST">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <button type="submit" class="btn btn-primary btn-sm" style="width:100%; margin:-10px 0">
                                @if(Auth::user()->wishlist->contains($book->id))
                                <input type="hidden" name="_method" value="DELETE">
                                <i class="fa fa-check" style="padding-right:5px"></i> Wishlist
                                @else
                                <i class="fa fa-plus" style="padding-right:5px"></i> Wishlist
                                @endif
                            </button>
                        </form>
                        @else
                        <a href="/auth/login" class="btn btn-primary btn-sm" style="width:100%; margin:-10px 0">
                            <i class="fa fa-plus" style="padding-right:5px"></i> Wishlist
                        </a>
                        @endif
                    </div>
                    <div class="col-md-6 col-xs-6" style="text-align:right">
                        <a href="{{ route('users.show', $book->user->username) }}/contact"
                           class="btn btn-primary btn-sm" style="width:100%; margin:-10px 0">
                            <i class="fa fa-envelope" style="padding-right:5px"></i> Contact
                        </a>
                    </div>
                </div>
                <hr>
            </div>
        </div>
    </div>
</div>

@stop