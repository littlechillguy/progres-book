<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Services\ActivityLogger;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $query = User::query();

        if ($request->filled('search')) {

            $query->where(function ($q) use ($request) {

                $q->where('name', 'like', '%' . $request->search . '%')
                    ->orWhere('email', 'like', '%' . $request->search . '%');

            });

        }

        $users = $query
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('users.index', compact('users'));
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users,email',
            'role' => 'required|in:admin,superadmin',
            'password' => 'required|min:6|confirmed',
        ]);

        $validated['password'] = Hash::make($validated['password']);

        $user = User::create($validated);

        ActivityLogger::log(
            'User',
            'Tambah',
            $user->id,
            'Menambahkan akun ' . $user->name,
            [],
            $user->toArray()
        );

        return redirect()
            ->route('users.index')
            ->with('success', 'User berhasil ditambahkan.');
    }

    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'role' => 'required|in:admin,superadmin',
        ]);

        $old = $user->toArray();

        $user->update($validated);

        ActivityLogger::log(
            'User',
            'Edit',
            $user->id,
            'Mengubah akun "' . $user->name . '"',
            $old,
            $user->fresh()->toArray()
        );

        return redirect()
            ->route('users.index')
            ->with('success', 'User berhasil diperbarui.');
    }

    public function destroy(User $user)
    {
        // Tidak boleh menghapus akun sendiri
        if (auth()->id() == $user->id) {

            return back()->with(
                'error',
                'Anda tidak dapat menghapus akun sendiri.'
            );

        }

        // Tidak boleh menghapus Super Admin terakhir
        if (
            $user->role == 'superadmin' &&
            User::where('role', 'superadmin')->count() == 1
        ) {

            return back()->with(
                'error',
                'Minimal harus ada satu Super Admin.'
            );

        }

        $old = $user->toArray();

        ActivityLogger::log(
            'User',
            'Hapus',
            $user->id,
            'Menghapus akun "' . $user->name . '"',
            $old
        );

        $user->delete();

        return redirect()
            ->route('users.index')
            ->with('success', 'User berhasil dihapus.');
    }

    public function resetPassword(User $user)
    {
        $user->update([
            'password' => Hash::make('admin123')
        ]);

        ActivityLogger::log(
            'User',
            'Reset Password',
            $user->id,
            'Mereset password akun "' . $user->name . '"'
        );

        return back()->with(
            'success',
            'Password berhasil direset menjadi: admin123'
        );
    }
}