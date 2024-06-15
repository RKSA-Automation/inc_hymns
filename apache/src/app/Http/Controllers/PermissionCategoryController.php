<?php

namespace App\Http\Controllers;

use App\Helpers\ActivityLogHelper;
use App\Models\PermissionCategory;
use Illuminate\Http\Request;

class PermissionCategoryController extends Controller
{
    public function index()
    {
        $categories = PermissionCategory::whereNotNull('name')->get();
        return view('permission_categories.index', compact('categories'));
    }
    

    public function create()
    {
        return view('permission_categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        PermissionCategory::create($request->all());

        ActivityLogHelper::log('created', 'Permission Category', 1, null);

        return redirect()->route('permission_categories.index')
                         ->with('success', 'Category created successfully.');
    }

    public function edit(PermissionCategory $permissionCategory)
    {
        return view('permission_categories.edit', compact('permissionCategory'));
    }

    public function update(Request $request, PermissionCategory $permissionCategory)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $permissionCategory->update($request->all());

        

        
    ActivityLogHelper::log('updated', 'Permission Category', $request->id,  'update the category');
        return redirect()->route('permission_categories.index')
                         ->with('success', 'Category updated successfully.');
    }

    public function destroy(PermissionCategory $permissionCategory)
    {
        $permissionCategory->delete();

        return redirect()->route('permission_categories.index')
                         ->with('success', 'Category deleted successfully.');
    }
}
