<?php

namespace App\Http\Controllers;

use App\Events\Registared;
use App\Http\Requests\RegisterRequest;
use App\Models\Rol_user;
use App\Models\Role;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function index()
    {
        return view('auth.register');
    }

    public function store(RegisterRequest $request)
    {
        $data = $request->validated();

        return DB::transaction(function () use ($data) {
            $user = User::create([
                'name' => trim($data['name'] . ' ' . $data['last_name']),
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'is_active' => true,
                'password_changed_at' => now(),
            ]);

            $role = Role::where('slug', 'candidato')->firstOrFail();

            $user->roles()->attach($role->id);


            // Enviar email

            event(new Registered($user));

            Auth::login($user);


           return redirect()->route('verification.notice');
        });
    }
}
