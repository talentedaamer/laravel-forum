@extends('layouts.app')

@section('content')
    <div class="container">
        @foreach( $questions as $question )
        <div class="card mb-3">
            <div class="card-header">
                <span class="badge badge-success">Votes : {{$question->votes}}</span>
                <span class="badge badge-primary">Views : {{$question->views}}</span>
                <span class="badge badge-warning">Answers : {{$question->answers}}</span>
                {{ $question->title }}
            </div>
            <div class="card-body">
                <div class="media">
                    <div class="media-body">
                        {{ Str::limit( $question->body, 255 ) }}
                    </div>
                </div>
            </div>
        </div>
        @endforeach
        {{$questions->links()}}
    </div>
@endsection
