<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ActivityController extends Controller
{
    public function create(Subject $subject): View
    {
        return view('activities.create', compact('subject'));
    }

    public function store(Request $request, Subject $subject): RedirectResponse
    {
        $data = $request->validate([
            'type'  => 'required|string|max:100',
            'grade' => 'required|numeric|min:0|max:10',
            'date'  => 'required|date',
            'notes' => 'nullable|string',
        ]);

        $subject->activities()->create($data);

        return redirect()->route('subjects.show', $subject)
                         ->with('success', '¡Actividad guardada!');
    }

    public function edit(Subject $subject, Activity $activity): View
    {
        return view('activities.edit', compact('subject', 'activity'));
    }

    public function update(Request $request, Subject $subject, Activity $activity): RedirectResponse
    {
        $data = $request->validate([
            'type'  => 'required|string|max:100',
            'grade' => 'required|numeric|min:0|max:10',
            'date'  => 'required|date',
            'notes' => 'nullable|string',
        ]);

        $activity->update($data);

        return redirect()->route('subjects.show', $subject)
                         ->with('success', '¡Actividad actualizada!');
    }

    public function destroy(Subject $subject, Activity $activity): RedirectResponse
    {
        $activity->delete();

        return redirect()->route('subjects.show', $subject)
                         ->with('success', '¡Actividad eliminada!');
    }
}