@extends('app')

@section('content')

<div class="page-header">
    <h1>Contact <small>{{ ucfirst($user->first_name) }}</small></h1>
</div>

<div class="row">
    <div class="col-md-6">
        <form action="{{ route('users.show', $user->username) }}/contact" method="POST">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="row">
                <div class="col-md-2">
                    <label class="control-label">About</label>
                </div>
                <div class="col-md-10">
                    <select name="contact[book_id]" style="width:100%">
                        <optgroup label="Seller's Books">
                            @foreach($user->books()->forSale()->get() as $book)
                            <option value="{{ $book->id }}">{{ $book->title }}</option>
                            @endforeach
                        </optgroup>
                    </select>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-2">
                    <label class="control-label">Message</label>
                </div>
                <div class="col-md-10">
                    <textarea name="contact[text]" class="form-control" style="width:100%;height:150px" maxlength="420"></textarea>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-10">
                    <label for="contact[text]" class="control-label">0 / 420</label>
                    <button type="submit" class="btn btn-primary pull-right">Send</a>
                </div>
            </div>
        </form>
    </div>
</div>

@stop

@section('js')

<script>
    $(function(){
        $('[name="contact[book_id]"]').select2({
            minimumResultsForSearch: Infinity
        });
        $('textarea[name="contact[text]"]').on("change paste keyup", function() {
            $('label[for="contact[text]"]').text($(this).val().length + ' / 420');
        });
    });
</script>

@append