<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class SubjectController extends Controller
{
    public function index(): View
    {
        $subjects = Subject::withCount('activities')
                           ->withAvg('activities', 'grade')
                           ->get();
        return view('subjects.index', compact('subjects'));
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate(['name' => 'required|string|max:255']);
        Subject::create($request->only('name', 'teacher'));
        return back()->with('success', '¡Materia agregada!');
    }

    public function show(Subject $subject): View
    {
        $activities = $subject->activities()->orderByDesc('date')->get();
        return view('subjects.show', compact('subject', 'activities'));
    }

    public function destroy(Subject $subject): RedirectResponse
    {
        $subject->delete();
        return redirect()->route('subjects.index')
                         ->with('success', '¡Materia eliminada!');
    }
}