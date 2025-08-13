<?php

namespace App\Http\Controllers\Api;

use App\Models\TrainingLesson;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TrainingLessonController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $lessons = TrainingLesson::all();
        return response()->json($lessons);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // return view('training_lessons.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'nullable|string',
            'training_module_id' => 'required|exists:training_modules,id', // Foreign key example
        ]);

        $lesson = TrainingLesson::create($validated);

        return response()->json($lesson, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(TrainingLesson $trainingLesson)
    {
        return response()->json($trainingLesson);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TrainingLesson $trainingLesson)
    {
        // return view('training_lessons.edit', compact('trainingLesson'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TrainingLesson $trainingLesson)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'nullable|string',
            'training_module_id' => 'required|exists:training_modules,id',
        ]);

        $t
