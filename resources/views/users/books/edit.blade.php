@extends('app')

@section('content')

<div class="page-header">
    <h1>Edit <small>Book</small></h1>
</div>

<div class="row">
    <div class="col-md-6">
        @if(isset($errors->all()[0]))
        <div class="alert alert-danger" role="alert">
            <p><strong>Whoops!</strong> <span>{{ $errors->all()[0] }}</span></p>
        </div>
        @endif
        <form action="{{ route('users.books.update', [$user->username, $book->slug]) }}" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="hidden" name="_method" value="PATCH">
            <div class="row">
                <div class="col-md-2">
                    <label for="book[image]" class="control-label">Image</label>
                </div>
                <div class="col-md-10">
                    <input type="file" name="book[image]">
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-2">
                    <label for="book[title]" class="control-label">Title</label>
                </div>
                <div class="col-md-10">
                    <input type="text" name="book[title]" class="form-control" value="{{ old('book.title', $book->title) }}">
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-2">
                    <label for="book[author]" class="control-label">Author</label>
                </div>
                <div class="col-md-10">
                    <input type="text" name="book[author]" class="form-control" value="{{ old('book.author', $book->author) }}">
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-2">
                    <label for="book[subject_id]" class="control-label">Subject</label>
                </div>
                <div class="col-md-10">
                    <select name="book[subject_id]" style="width:100%">
                        <optgroup label="Subjects">
                            @foreach($subjects as $subject)
                            <option value="{{ $subject->id }}" @if(old('book.subject_id', $book->subject->id) == $subject->id) selected @endif>
                                {{ $subject->name }}
                            </option>
                            @endforeach
                        </optgroup>
                    </select>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-2">
                    <label for="book[isbn]" class="control-label">ISBN</label>
                </div>
                <div class="col-md-10">
                    <input type="text" name="book[isbn]" class="form-control" value="{{ old('book.isbn', $book->isbn) }}">
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-2">
                    <label for="book[description]" class="control-label">Description</label>
                </div>
                <div class="col-md-10">
                    <textarea name="book[description]" class="form-control" style="width:100%;height:150px" maxlength="420">{{ old('book.description', $book->description) }}</textarea>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-10">
                    <label for="book[description][count]" class="control-label">{{ strlen(old('book.description', $book->description)) }} / 420</label>
                    <button type="submit" class="btn btn-primary pull-right">Update</a>
                </div>
            </div>
        </form>
    </div>
</div>

@stop

@section('js')

<script>
    $(function(){
        $('[name="book[subject_id]"]').select2({
            minimumResultsForSearch: Infinity
        });
        $('textarea[name="book[description]"]').on("change paste keyup", function() {
            $('label[for="book[description][count]"]').text($(this).val().length + ' / 420');
        });
    });
</script>

@append