<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Yajra\DataTables\Facades\DataTables;
use App\Models\AdminActivityLog;

class RoleController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $roles = Role::with('permissions')->select('roles.*');
            return DataTables::of($roles)
                ->addColumn('permissions', function($row) {
                    return $row->permissions->pluck('name')->map(function($name) {
                        return '<span class="badge bg-secondary me-1">' . e($name) . '</span>';
                    })->implode('') ?: '<span class="text-muted">None</span>';
                })
                ->addColumn('action', function($row) {
                    $editBtn = '<a href="' . route('admin.roles.edit', $row->id) . '" class="btn btn-sm btn-light me-1 rounded-circle"><i class="fas fa-edit text-warning"></i></a>';
                    $deleteBtn = '';
                    if ($row->name !== 'Super Admin') {
                        $deleteBtn = '<button class="btn btn-sm btn-light rounded-circle delete-role" data-id="' . $row->id . '"><i class="fas fa-trash text-danger"></i></button>';
                    }
                    return $editBtn . $deleteBtn;
                })
                ->rawColumns(['permissions', 'action'])
                ->make(true);
        }

        return view('admin.roles.index');
    }

    public function create()
    {
        // Define some standard permissions if none exist
        if (Permission::count() === 0) {
            $defaultPermissions = [
                'manage roles', 'manage admins', 'manage products', 
                'manage categories', 'manage orders', 'manage customers', 'manage settings'
            ];
            foreach ($defaultPermissions as $perm) {
                Permission::findOrCreate($perm);
            }
        }
        
        $permissions = Permission::all();
        return view('admin.roles.create', compact('permissions'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:roles,name',
            'permissions' => 'nullable|array'
        ]);

        $role = Role::create(['name' => $request->name]);
        if ($request->has('permissions')) {
            $role->syncPermissions($request->permissions);
        }

        AdminActivityLog::create([
            'user_id' => auth()->id(),
            'action' => 'create_role',
            'details' => "Created role: {$role->name}",
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);

        return redirect()->route('admin.roles.index')->with('success', 'Role created successfully.');
    }

    public function edit(Role $role)
    {
        $permissions = Permission::all();
        $rolePermissions = $role->permissions->pluck('id')->toArray();
        return view('admin.roles.edit', compact('role', 'permissions', 'rolePermissions'));
    }

    public function update(Request $request, Role $role)
    {
        $request->validate([
            'name' => 'required|unique:roles,name,' . $role->id,
            'permissions' => 'nullable|array'
        ]);

        if ($role->name === 'Super Admin' && $request->name !== 'Super Admin') {
            return back()->withErrors(['name' => 'Cannot rename the Super Admin role.']);
        }

        $role->update(['name' => $request->name]);
        
        if ($role->name !== 'Super Admin') {
            $role->syncPermissions($request->permissions ?? []);
        }

        AdminActivityLog::create([
            'user_id' => auth()->id(),
            'action' => 'update_role',
            'details' => "Updated role: {$role->name}",
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);

        return redirect()->route('admin.roles.index')->with('success', 'Role updated successfully.');
    }

    public function destroy(Request $request, Role $role)
    {
        if ($role->name === 'Super Admin') {
            return response()->json(['success' => false, 'message' => 'Cannot delete Super Admin role.'], 403);
        }

        AdminActivityLog::create([
            'user_id' => auth()->id(),
            'action' => 'delete_role',
            'details' => "Deleted role: {$role->name}",
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);

        $role->delete();

        return response()->json(['success' => true, 'message' => 'Role deleted successfully.']);
    }
}
