<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ActivityType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ActivityTypeController extends Controller
{
    /**
     * Get all activity types
     */
    public function index()
    {
        $types = DB::table('activity_types')
            ->orderBy('name', 'asc')
            ->get();

        return response()->json([
            'success' => true,
            'message' => 'Activity types retrieved successfully',
            'data' => $types,
        ], 200);
    }

    /**
     * Create activity type
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'code' => [
                'required',
                'string',
                'max:10',
                'unique:activity_types,code',
            ],
            'name' => [
                'required',
                'string',
                'max:100',
            ],
            'requires_lecturer' => [
                'sometimes',
                'boolean',
            ],
            'is_group_activity' => [
                'sometimes',
                'boolean',
            ],
            'is_active' => [
                'sometimes',
                'boolean',
            ],
        ]);

        $validated['requires_lecturer'] =
            $validated['requires_lecturer'] ?? false;

        $validated['is_group_activity'] =
            $validated['is_group_activity'] ?? false;

        $validated['is_active'] =
            $validated['is_active'] ?? true;

        $type = ActivityType::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Activity type created successfully',
            'data' => $type,
        ], 201);
    }

    /**
     * Get single activity type
     */
    public function show($id)
    {
        $type = ActivityType::find($id);

        if (!$type) {
            return response()->json([
                'success' => false,
                'message' => 'Activity type not found',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Activity type retrieved successfully',
            'data' => $type,
        ], 200);
    }

    /**
     * Update activity type
     */
    public function update(Request $request, $id)
    {
        $type = ActivityType::find($id);

        if (!$type) {
            return response()->json([
                'success' => false,
                'message' => 'Activity type not found',
            ], 404);
        }

        $validated = $request->validate([
            'code' => [
                'sometimes',
                'required',
                'string',
                'max:10',
                'unique:activity_types,code,' . $id,
            ],
            'name' => [
                'sometimes',
                'required',
                'string',
                'max:100',
            ],
            'requires_lecturer' => [
                'sometimes',
                'boolean',
            ],
            'is_group_activity' => [
                'sometimes',
                'boolean',
            ],
            'is_active' => [
                'sometimes',
                'boolean',
            ],
        ]);

        $type->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Activity type updated successfully',
            'data' => $type->fresh(),
        ], 200);
    }

    /**
     * Delete activity type
     */
    public function destroy($id)
    {
        $type = ActivityType::find($id);

        if (!$type) {
            return response()->json([
                'success' => false,
                'message' => 'Activity type not found',
            ], 404);
        }

        $type->delete();

        return response()->json([
            'success' => true,
            'message' => 'Activity type deleted successfully',
        ], 200);
    }
}