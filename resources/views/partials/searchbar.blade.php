<form action="{{ route('books.index') }}" method="GET">
    <div class="input-group">
        <input type="text" class="form-control" placeholder="Search" name="search" value="{{ $_search }}">
        <div class="input-group-btn" style="width:50%">
            <select class="form-control" placeholder="Subject" name="subject" style="border-left-width:0">
                <option value="">All Subjects</option>
                <option disabled></option>
                @foreach($subjects as $subject)
                <option value="{{ $subject->slug }}" @if($subject == $_subject) selected @endif>{{ $subject->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="input-group-btn">
            <button class="btn btn-primary" type="submit">
                <i class="glyphicon glyphicon-search"></i>
            </button>
        </div>
    </div>
</form>