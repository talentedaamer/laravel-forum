@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                Create New Question
            </div>
            <div class="card-body">
                <form action="{{ route( 'questions.store' )  }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="question-title">Question Title:</label>
                        <input
                            type="text"
                            name="title"
                            id="question-title"
                            class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}"
                            value="{{ old( 'title' )  }}"
                        />
                        @if( $errors->has('title') )
                            <div class="invalid-feedback">{{ $errors->first('title') }}</div>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="question-body">Question Body</label>
                        <textarea
                            name="body"
                            id="question-body"
                            class="form-control{{ $errors->has('body') ? ' is-invalid' : ''  }}"
                            rows="10"
                        >{{ old('body') }}</textarea>
                        @if( $errors->has('body') )
                            <div class="invalid-feedback">{{ $errors->first('body') }}</div>
                        @endif
                    </div>
                    <div class="form-group mb-0">
                        <button type="submit" class="btn btn-secondary">Create Question</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
