@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="questions-area col-md-9">
                <div class="media question">
                    <div class="question-info mr-3">
                        {{--votes--}}
                        <div class="q-votes btn-group-vertical">
                            <a href="#" class="btn"><i class="icon-thumbs-up"></i></a>
                            <span class="btn {{ $question->vote_status }}">{{ $question->votes }}</span>
                            <a href="#" class="btn"><i class="icon-thumbs-down"></i></a>
                        </div>
                    </div>
                    <div class="media-body question-content">
                        <h5 class="mt-0 mb-3">{{ $question->title }}</h5>
                        {!! $question->body_html !!}
                        <ul class="question-meta list-inline mt-3 p-3">
                            <li class="list-inline-item">
                                <i class="icon-share"></i> <a href="#">Share</a>
                            </li>
                            <li class="list-inline-item">
                                <i class="icon-user"></i> {{ $question->user->name }}</a>
                            </li>
                            {{--show if user can update question--}}
                            @can( 'update', $question )
                            <li class="list-inline-item">
                                <a href="{{ route( 'questions.edit', $question->id ) }}"><i class="icon-edit"></i> Edit</a>
                            </li>
                            @endcan
                            {{--show if user can delete question--}}
                            @can( 'delete', $question )
                            <li class="list-inline-item">
                                <a onclick="deleteQuestion(event)" href="#"><i class="icon-trash"></i> Delete</a>
                                <form id="deleteQuestion" action="{{ route( 'questions.destroy', $question->id ) }}" method="POST" style="display: none;">
                                    @method('DELETE')
                                    @csrf
                                    <input type="submit" value="delete">
                                </form>
                            </li>
                            @endcan
                        </ul>
                    </div>
                </div>
            </div>
            <div class="sidebar-area col-md-3">
                <div class="sidebar-widget question-info-meta mb-3">
                    <ul class="list-group">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span><i class="icon-eye"></i> Views</span>
                            <span class="badge badge-primary badge-pill">{{ $question->views }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span><i class="icon-calendar"></i> Asked</span>
                            <span class="text-muted">{{ $question->created_date }}</span>
                        </li>
                    </ul>
                </div>
                <div class="sidebar-widge related-questions mb-3">
                    @include( 'partials.widgets._related-questions', [
                        'title' => 'Related Posts',
                        'questions' => $questions,
                    ] )
                </div>
            </div>
        </div>
    </div>
@endsection

<script>
    function deleteQuestion ( event ) {
		event.preventDefault();
		if ( confirm( "Are you sure you want to delete this?" ) ) {
			// get delete form
			var deleteForm = document.getElementById( 'deleteQuestion' );
			// submit delete form
			deleteForm.submit();
		} else {
			return false;
		}
	}
</script>
