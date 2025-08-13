<?php

namespace App\Http\Controllers\Api;

use App\Models\TrainingModule;
use App\Models\TrainingLesson;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TrainingModuleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $modules = TrainingModule::all();
        return response()->json($modules);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // return view('training_modules.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        $requestData = $request->all();
        
        //dd($requestData);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $moduleData['title']       = $request->title;
        $moduleData['description'] = $request->description;

        $module = TrainingModule::create($moduleData);

        $lessonData['question']      = $request->question;
        $lessonData['question_type'] = $request->question_type;
        $lessonData['training_id']   = $module->id;
        $lessonData['type']          = $request->question_type;
        $lessonData['options']       = json_encode($request->options);

        $module = TrainingLesson::create($lessonData);

        //return response()->json($module, 201);
        return response()->json([
            'success' => true,
            'message' => 'Training lesson created successfully.',
            'data' => []
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(TrainingModule $trainingModule)
    {
        return response()->json($trainingModule);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TrainingModule $trainingModule)
    {
        // return view('training_modules.edit', compact('trainingModule'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TrainingModule $trainingModule)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $trainingModule->update($validated);

        return response()->json($trainingModule);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TrainingModule $trainingModule)
    {
        $trainingModule->delete();
        return response()->json(null, 204);
    }
}
