<?php

namespace App\Http\Controllers;

use App\Http\Requests\QuestionRequest;
use App\Models\Question;
use Illuminate\Support\Facades\Auth;

class QuestionController extends Controller
{
    public function index()
    {
        return view('question.index')->with(['questions' => Question::latest()->get()]);
    }

    public function create()
    {
        return view('question.create');
    }

    public function store(QuestionRequest $request)
    {
        Question::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'description' => $request->description,
        ]);
        return redirect()->route('question.index')->with('success', 'Savolingiz muvofiqatli qabul qilindi');
    }
    public function show(Question $question)
    {
        return view('question.show')->with(['question' => $question]);
    }


    public function destroy(Question $question)
    {
        if (Auth::id() === $question->user_id || Auth::user()->hasRole('admin')) {
            $question->delete();
        } else {
            abort(403, 'Unauthorized action.');
        }

        return redirect()->route('question.index')->with('success', "Savolingiz Muvoffaqqiyatli o'chirli");
    }
}
