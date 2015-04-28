@extends('app')

@section('content')

<div class="page-header">
    <h1>Subjects</h1>
</div>

@foreach($data->chunk(4) as $_subjects)

<div class="row">
    
    @foreach($_subjects as $subjects)
    
        <div class="col-md-3">
            
            <div class="page-header">
                <h1><small>{{ ucfirst($subjects[0]->name{0}) }}</small></h1>
            </div>
            
            <div class="row">
                @foreach($subjects as $subject)
                <div class="col-md-12">
                    <a href="{{ route('books.index') }}?subject={{ $subject->slug }}">
                        <i class="fa fa-{{ $subject->icon }}" style="padding-right:15px"></i>{{ $subject->name }}
                    </a>
                </div>
                <br><br>
                @endforeach
            </div>
        </div>

    @endforeach

</div>

@endforeach

<br><br><br><br>

@stop