<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $q = trim((string) $request->query('q'));

        $data = User::query()
            ->when($q !== '', function ($query) use ($q) {
                $query->where(function ($w) use ($q) {
                    $w->where('username', 'like', "%$q%")
                      ->orWhere('nama', 'like', "%$q%");
                });
            })
            ->orderBy('id')
            ->paginate(10)
            ->withQueryString();

        return view('users.index', ['data' => $data, 'q' => $q]);
    }

    public function create()
    {
        return view('users.create', ['user' => new User()]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'username' => ['required', 'string', 'max:50', Rule::unique('users', 'username')],
            'nama'     => 'required|string|max:100',
            'password' => 'required|string|min:6|confirmed',
            'role'     => ['required', Rule::in(User::ROLES)],
        ]);

        User::create($validated); // password di-hash otomatis oleh cast 'hashed'

        return redirect()->route('users.index')->with('success', 'Data pengguna berhasil ditambahkan.');
    }

    public function edit(User $user)
    {
        return view('users.edit', ['user' => $user]);
    }

    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'username' => ['required', 'string', 'max:50', Rule::unique('users', 'username')->ignore($user->id)],
            'nama'     => 'required|string|max:100',
            'password' => 'nullable|string|min:6|confirmed',
            'role'     => ['required', Rule::in(User::ROLES)],
        ]);

        // Cegah admin mengunci diri sendiri dengan menurunkan role akunnya.
        if ($user->id === Auth::id() && $validated['role'] !== $user->role) {
            return back()->withInput()->with('error', 'Anda tidak dapat mengubah role akun yang sedang dipakai login.');
        }

        if (empty($validated['password'])) {
            unset($validated['password']); // kosong = password tidak diubah
        }

        $user->update($validated);

        return redirect()->route('users.index')->with('success', 'Data pengguna berhasil diperbarui.');
    }

    public function destroy(User $user)
    {
        if ($user->id === Auth::id()) {
            return redirect()->route('users.index')->with('error', 'Anda tidak bisa menghapus akun yang sedang dipakai login.');
        }

        $user->delete();

        return redirect()->route('users.index')->with('success', 'Data pengguna berhasil dihapus.');
    }
}
