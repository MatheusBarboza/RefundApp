<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\UserRepository;
use App\Http\Requests\User\SignUpUser as SignUpUserValidator;
use App\Http\Requests\User\SignInUser as SignInUserValidator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
     /**
     * @var UserRepository
     */
    protected $repository;

    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    public function signIn(SignInUserValidator $request)
    {
        try {
            $data = $request->validated();
            $response = $this->repository->signIn($data);

            return response($response['response'], $response['code']);
        } catch (\Exception $ex) {
            Log::error($ex->getMessage());
            return response(['message' => $ex->getMessage()]);
        }
    }

    public function signUp(SignUpUserValidator $request)
    {
        $data = $request->validated();

        $user = $this->repository->create($data);

        $user->token = $user->createToken($user->email)->accessToken;

        return response(['message' => 'user created', 'data' => $user]);
    }

    public function signOut()
    {
        auth()->user()->token()->revoke();
    }
}
