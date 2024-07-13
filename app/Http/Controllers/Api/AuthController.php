<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserCollection;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{

    public function user_sign_up(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_name' => ['required', 'string', 'alpha_dash', 'min:3', 'max:12'],
            'email' => ['required', 'unique:users'],
            'password' => 'required',
            'role' => 'required'
        ], [
            'user_name.required' => 'User name is required.',
            'email.required' => 'Email is required.',
            'email.unique' => 'There is already user account with this email.',
            'password.required' => 'Password is required.',
            'role.required' => 'User role is required.'
        ]);

        if ($validator->fails()) {
            return response()->error($validator->errors()->first(), 400);
        }

        $user = new User();
        $user->user_name = $request->user_name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->role = $request->role;
        $user->save();

        $accessToken = $user->createToken('API Token')->accessToken;

        return response()->success(UserCollection::collection(User::whereId($user->id)->get())->first())->header('Authorization', $accessToken);
    }

    public function login(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'email' => 'required',
                'password' => 'required',
            ], [
                'email.required' => 'Email is required.',
                'password.required' => 'Password is required.',
            ]);

            if ($validator->fails()) {
                return response()->error($validator->errors()->first(), 400);
            }

            $user = User::where('email', $request->email)->first();
            $user_password = $request->password;

            if (!$user || !Hash::check($user_password, $user->password)) {
                return response()->error('These credentials do not match our records', 400);
            }

            $user->tokens()->delete();

            $accessToken = $user->createToken('my-app-token')->accessToken;
            return response()->success(UserCollection::collection(User::whereId($user->id)->get())->first())->header('Authorization', $accessToken);
        } catch (\Throwable $exception) {
            return response()->error($exception->getMessage(), 500);
        }
    }
}
