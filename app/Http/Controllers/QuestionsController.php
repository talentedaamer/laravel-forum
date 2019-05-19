<?php

namespace App\Http\Controllers;

use App\Question;
use Illuminate\Http\Request;
use App\Http\Requests\QuestionsRequest;

class QuestionsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except('index', 'show');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $questions = Question::with('user')->latest()->paginate(5);
        
        return view('questions.index', [
            'questions' => $questions
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view( 'questions.create' );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(QuestionsRequest $request)
    {
        $request->user()
                ->questions()
                ->create($request->only('title', 'body'));
    
        return redirect()
            ->route('questions.index')
            ->with('success', 'Question has been added successfully !');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function show(Question $question)
    {
        $questions = Question::inRandomOrder()
                             ->limit(5)
                             ->get();
        
        $question->increment('views');
        
        return view( 'questions.show', [
            'question' => $question,
            'questions' => $questions
        ] );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function edit(Question $question)
    {
        $this->authorize( 'update', $question );
        return view( 'questions.edit', [
            'question' => $question
        ] );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function update(QuestionsRequest $request, Question $question)
    {
        $this->authorize( 'update', $question );
        $question->update( $request->only( 'title', 'body' ) );
    
        return redirect()
            ->route('questions.index')
            ->with('success', 'Question has been updated successfully !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function destroy(Question $question)
    {
        $this->authorize( 'delete', $question );
        $question->delete();
    
        return redirect()
            ->route('questions.index')
            ->with('success', 'Question has been deleted successfully !');
    }
}
