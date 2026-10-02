<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    /**
     * Get all departments
     */
    public function index()
    {
        $departments = Department::orderBy('name', 'asc')->get();

        return response()->json([
            'success' => true,
            'message' => 'Departments retrieved successfully',
            'data' => $departments,
        ], 200);
    }

    /**
     * Create a new department
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'code' => 'required|string|max:20|unique:departments,code',
            'name' => 'required|string|max:150',
            'is_active' => 'sometimes|boolean',
        ]);

        // Default to active if not provided
        $validated['is_active'] = $validated['is_active'] ?? true;

        $department = Department::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Department created successfully',
            'data' => $department,
        ], 201);
    }

    /**
     * Get a single department
     */
    public function show(Department $department)
    {
        $department->load([
            'staff',
            'laboratories',
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Department retrieved successfully',
            'data' => $department,
        ], 200);
    }

    /**
     * Update a department
     */
    public function update(Request $request, Department $department)
    {
        $validated = $request->validate([
            'code' => 'sometimes|required|string|max:20|unique:departments,code,' . $department->id,
            'name' => 'sometimes|required|string|max:150',
            'is_active' => 'sometimes|boolean',
        ]);

        $department->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Department updated successfully',
            'data' => $department->fresh(),
        ], 200);
    }

    /**
     * Delete a department
     */
    public function destroy(Department $department)
    {
        $department->delete();

        return response()->json([
            'success' => true,
            'message' => 'Department deleted successfully',
        ], 200);
    }
}