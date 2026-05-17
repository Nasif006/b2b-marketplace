<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;

class UserManagementController extends Controller
{
    public function index()
    {
        $users = User::with('role')->latest()->paginate(20);
        $roles = Role::all();
        return view('admin.users.index', compact('users', 'roles'));
    }

    public function updateRole(Request $request, $id)
    {
        $request->validate(['role_id' => 'required|exists:roles,id']);

        $user = User::findOrFail($id);

        // Prevent changing own role
        if ($user->id === auth()->id()) {
            return redirect()->back()->with('error', 'You cannot change your own role.');
        }

        $user->update(['role_id' => $request->role_id]);

        return redirect()->back()->with('success', 'User role updated.');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);

        if ($user->id === auth()->id()) {
            return redirect()->back()->with('error', 'You cannot delete your own account.');
        }

        $user->delete();
        return redirect()->back()->with('success', 'User deleted.');
    }
}
