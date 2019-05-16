@extends('layouts.app')

@section('content')
    <div class="container">
        @foreach( $questions as $question )
        <div class="card mb-3">
            <div class="card-body">
                <div class="media">
                    <div class="media-body">
                        <h4><a href="{{ $question->url }}">{{ $question->title }}</a></h4>
                        {{ Str::limit( $question->body, 255 ) }}
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <ul class="q-status list-inline mb-0 mr-2 d-inline-block">
                    <li class="q-status-votes list-inline-item">
                        <span class="badge badge-secondary badge-md {{ $question->VoteStatus }}">{{$question->votes}} <span class="d-block">{{ Str::plural( 'Vote', $question->votes) }}</span></span>
                    </li>
                    <li class="q-status-views list-inline-item">
                        <span class="badge badge-primary badge-md {{ $question->ViewStatus }}">{{$question->views}} <span class="d-block">{{ Str::plural( 'View', $question->views) }}</span></span>
                    </li>
                    <li class="q-status-ans list-inline-item">
                        <span class="badge badge-secondary badge-md {{ $question->status }}">{{$question->answers}} <span class="d-block">{{ Str::plural( 'Answer', $question->answers) }}</span></span>
                    </li>
                </ul>
                <p class="d-inline-block mb-0">Asked By <a href="{{ $question->user->url }}">{{ $question->user->name }}</a> - {{ $question->created_date }}</p>
            </div>
        </div>
        @endforeach
        {{$questions->links()}}
    </div>
@endsection
