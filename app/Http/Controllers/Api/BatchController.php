<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Batch;
use Illuminate\Http\Request;

class BatchController extends Controller
{
    public function index()
    {
        $batches = Batch::orderByDesc('academic_year')->get();

        return response()->json([
            'success' => true,
            'data' => $batches,
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'code' => 'required|string|max:10|unique:batches,code',
            'academic_year' => 'required|string|max:20',
            'current_year' => 'nullable|integer|min:1|max:6',
            'is_active' => 'boolean',
        ]);

        $batch = Batch::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Batch created successfully',
            'data' => $batch,
        ], 201);
    }

    public function show(Batch $batch)
    {
        return response()->json([
            'success' => true,
            'data' => $batch->load('modules'),
        ]);
    }

    public function update(Request $request, Batch $batch)
    {
        $validated = $request->validate([
            'code' => 'sometimes|string|max:10|unique:batches,code,' . $batch->id,
            'academic_year' => 'sometimes|string|max:20',
            'current_year' => 'nullable|integer|min:1|max:6',
            'is_active' => 'boolean',
        ]);

        $batch->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Batch updated successfully',
            'data' => $batch,
        ]);
    }

    public function destroy(Batch $batch)
    {
        $batch->delete();

        return response()->json([
            'success' => true,
            'message' => 'Batch deleted successfully',
        ]);
    }
}