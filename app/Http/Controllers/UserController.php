<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function registrationPage()
    {
        return view('admin.user.registration');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3|max:15',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:4',
            'password_confirmation' => 'same:password',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('user.login')->with('reqister_success', 'Вы успешно зарегистрировались! Войдите в аккаунт!');
    }

    public function loginPage()
    {
        return view('admin.user.login');
    }

    public function authUser(Request $request)
    {
        $credential = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credential)) {
            $request->session()->regenerate();
            return redirect()->intended('/');
        }

        return back()->withErrors([
            'email' => 'Email или пароль введен не верный!'
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->intended('/');
    }

    public function listUsers()
    {
        return view('admin.user.list-users', [
            'users' => User::all()->sortBy('name'),
        ]);
    }

    public function editUser($userId)
    {
        return view('admin.user.edit-users', [
            'user' => User::find($userId),
            'roles' => Role::all()->sortBy('name'),
        ]);
    }

    public function updateUser(Request $request, $userId)
    {
        $request->validate([
            'name' => 'required|min:3|max:15',
            'email' => 'required|email',
        ]);

        $user = User::find($userId);
        $user->syncRoles($request->input('roles'));
        $user->update($request->all());

        return redirect()->route('list.user');
    }

    public function delete($userId)
    {
        $user = User::find($userId);
        $user->delete();
        return back();
    }
}
