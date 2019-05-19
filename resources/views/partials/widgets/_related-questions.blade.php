<div class="card">
    <div class="card-header">{{ $title }}</div>
    <div class="card-body">
        @forelse ($questions as $question)
            <div class="relate-q-item mb-2 media">
                <div class="ans mr-2">
                    <span class="badge badge-secondary badge-md {{ $question->status }}">{{$question->answers_count}}</span>
                </div>
                <div class="media-body">
                    <a href="{{ $question->url }}" class="mb-0">{{ $question->title }}</a>
                </div>
            </div>
        @empty
            <p class="text-warning mb-0 text-center">No Related Questions</p>
        @endforelse
    </div>
</div>