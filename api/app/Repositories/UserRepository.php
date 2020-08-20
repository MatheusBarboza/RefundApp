<?php

namespace App\Repositories;

use App\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Auth;

class UserRepository {
    /**
     * Create a user.
     *
     * @param int
     * @param array
     */
    public function create(array $user)
    {
        return User::create([
            'name' => $user['name'],
            'email' => $user['email'],
            'password' => bcrypt($user['password']),
            'role'     => $user['role']
        ]);
    }

    public function signIn($data)
    {
        if (Auth::attempt(['email' => $data['email'], 'password' => $data['password']])) {
            $user = auth()->user();

            $response = [
                'message' => 'Welcome!',
                'user' => $user,
                'token' => $user->createToken($user->email)->accessToken
            ];

            return [ 'response' => $response, 'code' => 200 ];

        } else {
            $response = [
                'message' => 'Login failed',
                'errors' => [ 'login' => [ 'Invalid email or password' ]]
            ];

            return [ 'response' => $response, 'code' => 422 ];
        }
    }
}
