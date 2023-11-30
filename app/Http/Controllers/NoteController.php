<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class NoteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();

        $notes = Note::withTrashed()->where('user_id', $user->id)->get();

        return Inertia::render('Note/Index', [
            'notes' => $notes,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('note.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'title' => 'required|min:4|string|max:250|unique:'.Note::class,
            'body' => 'required|min:4|string',
        ]);

        Note::create([
            'title' => $request->title,
            'body' => $request->body,
            'user_id' => $user->id,
        ]);

        return Redirect::route('note.index')->with([
            'type' => 'success',
            'message' => 'Note '.$request->title.' created successfully',
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Note $note)
    {
        return Inertia::render('note.edit', [
            'note' => $note,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Note $note)
    {
        $validators = [
            'body' => 'required|min:4|string',
        ];

        if ($note->title !== $request->title) {
            $validators['title'] = 'required|min:4|string|max:250|unique:'.Note::class;
        }

        $request->validate($validators);

        $note->update([
            'title' => $request->title,
            'body' => $request->body,
        ]);

        return Redirect::route('note.index')->with([
            'type' => 'success',
            'message' => 'Note '.$note->title.' updated successfully',
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Note $note)
    {
        return Inertia::render('note.show', [
            'note' => $note,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Note $note)
    {
        $note->delete();

        return Redirect::route('note.index')->with([
            'type' => 'success',
            'message' => 'Note '.$note->title.' deleted successfully',
        ]);
    }

    /**
     * Restore the specified resource from storage.
     */
    public function restore(Request $request)
    {
        $note = Note::withTrashed()->find($request->id);
        $note->restore();

        return Redirect::route('note.index')->with([
            'type' => 'success',
            'message' => 'Note '.$note->title.' restored successfully',
        ]);
    }
}
