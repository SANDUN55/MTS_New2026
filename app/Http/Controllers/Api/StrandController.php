<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Strand;
use Illuminate\Http\Request;

class StrandController extends Controller
{
    public function index()
    {
        $strands = Strand::orderBy('name')->get();

        return response()->json([
            'success' => true,
            'data' => $strands,
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'code' => 'required|string|max:20|unique:strands,code',
            'name' => 'required|string|max:100',
            'is_active' => 'boolean',
        ]);

        $strand = Strand::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Strand created successfully',
            'data' => $strand,
        ], 201);
    }

    public function show(Strand $strand)
    {
        return response()->json([
            'success' => true,
            'data' => $strand,
        ]);
    }

    public function update(Request $request, Strand $strand)
    {
        $validated = $request->validate([
            'code' => 'sometimes|string|max:20|unique:strands,code,' . $strand->id,
            'name' => 'sometimes|string|max:100',
            'is_active' => 'boolean',
        ]);

        $strand->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Strand updated successfully',
            'data' => $strand,
        ]);
    }

    public function destroy(Strand $strand)
    {
        $strand->delete();

        return response()->json([
            'success' => true,
            'message' => 'Strand deleted successfully',
        ]);
    }
}