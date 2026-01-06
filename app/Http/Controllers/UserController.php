<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class UserController extends Controller
{
    /**
     * Display a listing of all users.
     */
    public function index(): View
    {
        $users = User::paginate(10);
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for editing the specified user's role.
     */
    public function edit(User $user): View
    {
        $roles = ['user', 'manager', 'seniormanager', 'generalmanager', 'admin'];
        return view('admin.users.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified user's role.
     */
    public function update(Request $request, User $user): RedirectResponse
    {
        $request->validate([
            'role' => ['required', 'in:user,manager,seniormanager,generalmanager,admin'],
        ]);

        $user->update([
            'role' => $request->role,
        ]);

        return redirect()->route('admin.users.index')
                        ->with('success', "Role untuk user '{$user->name}' berhasil diperbarui menjadi '{$user->role}'.");
    }

    /**
     * Delete the specified user.
     */
    public function destroy(User $user): RedirectResponse
    {
        $userName = $user->name;
        $user->delete();

        return redirect()->route('admin.users.index')
                        ->with('success', "User '{$userName}' berhasil dihapus.");
    }

    /**
     * Display role management statistics.
     */
    public function stats(): View
    {
        $roleStats = User::selectRaw('role, COUNT(*) as count')
                        ->groupBy('role')
                        ->get();

        $totalUsers = User::count();
        $admins = User::where('role', 'admin')->count();
        $users = User::where('role', 'user')->count();

        return view('admin.users.stats', compact('roleStats', 'totalUsers', 'admins', 'users'));
    }
}
