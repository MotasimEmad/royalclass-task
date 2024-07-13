<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class NewPasswordController extends Controller
{
    /**
     * Display the password reset view.
     */
    public function create(Request $request): View
    {
        return view('auth.reset-password', ['request' => $request]);
    }

    /**
     * Handle an incoming new password request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'token' => ['required'],
                'phone_number' => ['required'],
                'password' => ['required', 'confirmed', Rules\Password::defaults()],
            ], [
                'token.required' => 'Link has been expired.',
                'phone_number.required' => 'Link has been expired.'
            ]);

            $user = User::where('phone_number', str_replace('971', '', $request->phone_number))->first();
            $user->password = Hash::make($request->password);
            $user->save();

            return view('password.success_password');
        } catch (\Throwable $exception) {
            return redirect()->back()->withErrors($exception->getMessage());
        }
    }
}
