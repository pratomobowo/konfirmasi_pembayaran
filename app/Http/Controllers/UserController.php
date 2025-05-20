<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class UserController extends Controller
{
    /**
     * Display a listing of the users.
     */
    public function index(Request $request)
    {
        // If super admin, show all users
        // If finance admin, show only finance admins
        $perPage = $request->input('per_page', 10);
        
        if ($request->user()->isSuperAdmin()) {
            $users = User::latest()->paginate($perPage)->withQueryString();
        } else {
            $users = User::where('role', User::ROLE_ADMIN_KEUANGAN)->latest()->paginate($perPage)->withQueryString();
        }
        
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new user.
     */
    public function create(Request $request)
    {
        // Get roles that can be assigned by the current user
        $assignableRoles = User::getAssignableRoles($request->user());
        
        return view('admin.users.create', compact('assignableRoles'));
    }

    /**
     * Store a newly created user in storage.
     */
    public function store(Request $request)
    {
        // Get roles that can be assigned by the current user
        $assignableRoles = User::getAssignableRoles($request->user());
        
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role' => ['required', 'string', 'in:' . implode(',', array_keys($assignableRoles))],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        return redirect()->route('admin.users.index')
            ->with('success', 'User berhasil dibuat.');
    }

    /**
     * Show the form for editing the specified user.
     */
    public function edit(Request $request, User $user)
    {
        // For security, ensure the user has appropriate permissions
        // Super admin can edit any user
        // Finance admin can only edit finance admin users
        if ($request->user()->isSuperAdmin() || 
            ($request->user()->isFinanceAdmin() && $user->role === User::ROLE_ADMIN_KEUANGAN)) {
            
            // Get roles that can be assigned by the current user
            $assignableRoles = User::getAssignableRoles($request->user());
            
            return view('admin.users.edit', compact('user', 'assignableRoles'));
        }
        
        // If we get here, the user doesn't have permission
        abort(403, 'Unauthorized action. You do not have permission to edit this user.');
    }

    /**
     * Update the specified user in storage.
     */
    public function update(Request $request, User $user)
    {
        // For security, ensure the user has appropriate permissions
        if (!($request->user()->isSuperAdmin() || 
            ($request->user()->isFinanceAdmin() && $user->role === User::ROLE_ADMIN_KEUANGAN))) {
            abort(403, 'Unauthorized action. You do not have permission to update this user.');
        }
        
        // Get roles that can be assigned by the current user
        $assignableRoles = User::getAssignableRoles($request->user());
        
        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $user->id],
        ];
        
        // Only allow role change if the user has permission
        if (count($assignableRoles) > 0) {
            $rules['role'] = ['required', 'string', 'in:' . implode(',', array_keys($assignableRoles))];
        }
        
        // Only validate password if it's provided
        if ($request->filled('password')) {
            $rules['password'] = ['confirmed', Rules\Password::defaults()];
        }
        
        $request->validate($rules);
        
        $userData = [
            'name' => $request->name,
            'email' => $request->email,
        ];
        
        if (isset($rules['role'])) {
            $userData['role'] = $request->role;
        }
        
        if ($request->filled('password')) {
            $userData['password'] = Hash::make($request->password);
        }
        
        $user->update($userData);
        
        return redirect()->route('admin.users.index')
            ->with('success', 'User berhasil diperbarui.');
    }

    /**
     * Remove the specified user from storage.
     */
    public function destroy(Request $request, User $user)
    {
        // For security, ensure the user has appropriate permissions
        if (!($request->user()->isSuperAdmin() || 
            ($request->user()->isFinanceAdmin() && $user->role === User::ROLE_ADMIN_KEUANGAN))) {
            abort(403, 'Unauthorized action. You do not have permission to delete this user.');
        }
        
        // Prevent self-deletion
        if ($request->user()->id === $user->id) {
            return redirect()->route('admin.users.index')
                ->with('error', 'Anda tidak dapat menghapus akun Anda sendiri.');
        }
        
        $user->delete();
        
        return redirect()->route('admin.users.index')
            ->with('success', 'User berhasil dihapus.');
    }
} 