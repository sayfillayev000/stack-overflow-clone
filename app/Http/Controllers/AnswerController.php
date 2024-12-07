<?php

namespace App\Http\Controllers;

use App\Http\Requests\AnswerRequest;
use App\Models\Answer;
use Illuminate\Support\Facades\Auth;

class AnswerController extends Controller
{
    public function store(AnswerRequest $request)
    {
        Answer::create([
            'user_id' => Auth::id(),
            'question_id' => $request->question_id,
            'content' => $request->content
        ]);

        return back()->with('success', 'Javobingiz muvofiqatli qabul qilindi');
    }

    public function destroy(Answer $answer)
    {
        if (Auth::id() === $answer->user_id || Auth::user()->hasRole('admin')) {
            $answer->delete();
        } else {
            abort(403, 'Unauthorized action.');
        }
        return redirect()->route('question.show', $answer->question_id)->with('success', "Javobingiz muvofaqqiyatli o'chirildi");
    }
}
