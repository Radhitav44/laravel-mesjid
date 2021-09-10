<?php

namespace App\Http\Controllers;

use App\Models\Division;
use App\Models\Feedback;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class FeedbackController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $feedbacks = Feedback::query();
        $role = optional(auth()->user()->division)->name;
        if ($role == 'User') {
            $feedbacks->whereIn('status', ['request', 'answered']);
        } else {
            if ($role == 'Admin') {
                $feedbacks->whereIn('status', ['request', 'acc', 'answered']);
            } else {
                $feedbacks->whereIn('status', ['acc', 'answered']);
            }
        }
        $feedbacks = $feedbacks->get();
        return view('dashboard.feedbacks.index', compact('feedbacks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $divisions = Division::all();
        return view('dashboard.feedbacks.create', compact('divisions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $feedback = $this->validate($request, [
            'question' => 'required|min:5',
            'division_id' => 'required|numeric',
        ]);

        if (auth()->user()->feedbacks()->create($feedback)) {
            return redirect(route('feedbacks.index'))->with('message', 'Data Saved');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Feedback  $feedback
     * @return \Illuminate\Http\Response
     */
    public function show(Feedback $feedback)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Feedback  $feedback
     * @return \Illuminate\Http\Response
     */
    public function edit(Feedback $feedback)
    {
        $divisions = Division::all();
        return view('dashboard.feedbacks.edit', compact('feedback', 'divisions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Feedback  $feedback
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Feedback $feedback)
    {
        $role = optional(auth()->user()->division)->name;
        if ($role == 'User') {
            $feedbackData = $this->validate($request, [
                'question' => 'required|min:5',
                'division_id' => 'required|numeric',
            ]);
        } else {
            if ($role == 'Admin') {
                $feedbackData = $this->validate($request, [
                    'question' => 'required|min:5',
                    'division_id' => 'required|numeric',
                ]);
                $feedbackData['status'] = 'acc';
            } else {
                $feedbackData = $this->validate($request, [
                    'question' => 'required|min:5',
                    'division_id' => 'required|numeric',
                    'answer' => 'required|min:5',
                ]);
                $feedbackData['status'] = 'answered';
            }
        }

        if ($feedback->update($feedbackData)) {
            return redirect(route('feedbacks.index'))->with('message', 'Data Saved');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Feedback  $feedback
     * @return \Illuminate\Http\Response
     */
    public function destroy(Feedback $feedback)
    {
        if ($feedback->delete()) {
            return back();
        }
    }
}
