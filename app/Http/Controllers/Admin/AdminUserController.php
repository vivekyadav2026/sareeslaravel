<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\Facades\DataTables;
use App\Models\AdminActivityLog;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class AdminUserController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $users = User::where('is_admin', true)->with('roles')->select('users.*');
            return DataTables::of($users)
                ->addColumn('roles', function($row) {
                    return $row->roles->pluck('name')->map(function($name) {
                        return '<span class="badge bg-primary me-1">' . e($name) . '</span>';
                    })->implode('') ?: '<span class="text-muted">None</span>';
                })
                ->addColumn('status', function($row) {
                    $class = $row->status === 'active' ? 'bg-success' : 'bg-danger';
                    return '<span class="badge ' . $class . '">' . e($row->status) . '</span>';
                })
                ->addColumn('action', function($row) {
                    $editBtn = '<a href="' . route('admin.users.edit', $row->id) . '" class="btn btn-sm btn-light me-1 rounded-circle"><i class="fas fa-edit text-warning"></i></a>';
                    $deleteBtn = '';
                    if ($row->id !== auth()->id()) {
                        $deleteBtn = '<button class="btn btn-sm btn-light rounded-circle delete-user" data-id="' . $row->id . '"><i class="fas fa-trash text-danger"></i></button>';
                    }
                    return $editBtn . $deleteBtn;
                })
                ->rawColumns(['roles', 'status', 'action'])
                ->make(true);
        }

        return view('admin.users.index');
    }

    public function create()
    {
        $roles = Role::all();
        return view('admin.users.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'status' => ['required', 'string', 'in:active,inactive'],
            'roles' => ['nullable', 'array']
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'is_admin' => true,
            'status' => $request->status,
        ]);

        if ($request->has('roles')) {
            $user->syncRoles($request->roles);
        }

        AdminActivityLog::create([
            'user_id' => auth()->id(),
            'action' => 'create_admin',
            'details' => "Created admin user: {$user->email}",
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);

        return redirect()->route('admin.users.index')->with('success', 'Admin user created successfully.');
    }

    public function edit(User $user)
    {
        $roles = Role::all();
        $userRoles = $user->roles->pluck('id')->toArray();
        return view('admin.users.edit', compact('user', 'roles', 'userRoles'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $user->id],
            'password' => ['nullable', 'confirmed', Rules\Password::defaults()],
            'status' => ['required', 'string', 'in:active,inactive'],
            'roles' => ['nullable', 'array']
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->status = $request->status;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        if ($request->has('roles')) {
            $user->syncRoles($request->roles);
        }

        AdminActivityLog::create([
            'user_id' => auth()->id(),
            'action' => 'update_admin',
            'details' => "Updated admin user: {$user->email}",
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);

        return redirect()->route('admin.users.index')->with('success', 'Admin user updated successfully.');
    }

    public function destroy(Request $request, User $user)
    {
        if ($user->id === auth()->id()) {
            return response()->json(['success' => false, 'message' => 'Cannot delete your own account.'], 403);
        }

        AdminActivityLog::create([
            'user_id' => auth()->id(),
            'action' => 'delete_admin',
            'details' => "Deleted admin user: {$user->email}",
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);

        $user->delete();

        return response()->json(['success' => true, 'message' => 'Admin user deleted successfully.']);
    }
}
