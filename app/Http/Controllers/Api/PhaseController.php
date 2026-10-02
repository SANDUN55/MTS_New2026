<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Phase;
use Illuminate\Http\Request;

class PhaseController extends Controller
{
    public function index()
    {
        $phases = Phase::orderBy('order')->get();

        return response()->json([
            'success' => true,
            'data' => $phases,
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'code'  => 'required|string|max:10|unique:phases,code',
            'name'  => 'required|string|max:100',
            'order' => 'nullable|integer|min:1',
            'is_active' => 'boolean',
        ]);

        $phase = Phase::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Phase created successfully',
            'data' => $phase,
        ], 201);
    }

    public function show(Phase $phase)
    {
        return response()->json([
            'success' => true,
            'data' => $phase,
        ]);
    }

    public function update(Request $request, Phase $phase)
    {
        $validated = $request->validate([
            'code'  => 'sometimes|string|max:10|unique:phases,code,' . $phase->id,
            'name'  => 'sometimes|string|max:100',
            'order' => 'nullable|integer|min:1',
            'is_active' => 'boolean',
        ]);

        $phase->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Phase updated successfully',
            'data' => $phase,
        ]);
    }

    public function destroy(Phase $phase)
    {
        $phase->delete();

        return response()->json([
            'success' => true,
            'message' => 'Phase deleted successfully',
        ]);
    }
}