<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Department::with(['headUser']);

        // Search functionality
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('code', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        // Filter by status
        if ($request->filled('status')) {
            $query->where('is_active', $request->status === 'active');
        }

        // Sort
        $sortBy = $request->get('sort_by', 'name');
        $sortOrder = $request->get('sort_order', 'asc');
        $query->orderBy($sortBy, $sortOrder);

        $departments = $query->paginate(15);
        $users = User::all();

        return view('departments.index', compact('departments', 'users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::all();
        return view('departments.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'nullable|string|max:50|unique:departments,code',
            'description' => 'nullable|string',
            'budget' => 'nullable|numeric|min:0',
            'head_user_id' => 'nullable|exists:users,id',
            'is_active' => 'boolean',
        ]);

        Department::create($validated);

        return redirect()->route('departments.index')
            ->with('success', 'Department created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Department $department)
    {
        $department->load(['headUser', 'assets', 'users']);
        return view('departments.show', compact('department'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Department $department)
    {
        $users = User::all();
        return view('departments.edit', compact('department', 'users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Department $department)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'code' => [
                'nullable',
                'string',
                'max:50',
                Rule::unique('departments', 'code')->ignore($department->id),
            ],
            'description' => 'nullable|string',
            'budget' => 'nullable|numeric|min:0',
            'head_user_id' => 'nullable|exists:users,id',
            'is_active' => 'boolean',
        ]);

        $department->update($validated);

        return redirect()->route('departments.index')
            ->with('success', 'Department updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Department $department)
    {
        // Check if department has assets or users
        if ($department->assets()->count() > 0) {
            return back()->with('error', 'Cannot delete department that has assets assigned to it.');
        }

        if ($department->users()->count() > 0) {
            return back()->with('error', 'Cannot delete department that has users assigned to it.');
        }

        $department->delete();

        return redirect()->route('departments.index')
            ->with('success', 'Department deleted successfully.');
    }
}
