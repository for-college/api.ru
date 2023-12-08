<?php

namespace App\Http\Controllers;

use App\Exceptions\ApiException;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index(): JsonResponse
    {
        $user = User::all();
        return response()->json($user)->setStatusCode(200, 'OK');
    }

    public function create(UserRequest $request)
    {
        return User::create($request->all());
    }

    public function update(UserRequest $request, string $id): JsonResponse
    {
        $user = User::where('id', '=', $id)->first();

        if (!isset($user)) {
            return response()->json()->setStatusCode(404, 'Not Found');
        }

        $user->lastname = $request->lastname;
        $user->name = $request->name;
        $user->sex = $request->sex;
        $user->birth = $request->birth;
        $user->login = $request->login;
        $user->password = $request->password;
        $user->email = $request->email;

        isset($request->patronymic) && $user->patronymic = $request->patronymic;

        $user->save();

        return response()->json($user)->setStatusCode(200, 'OK');
    }

    public function delete(string $id): JsonResponse
    {
        $user = User::where('id', '=', $id)->delete();
        return response()->json($user)->setStatusCode(200, 'OK');
    }

    public function view(string $id)
    {
        return User::where('id', '=', $id)->first();
    }

    public function login(LoginRequest $request)
    {
        $user = User::where($request->all())->first();

        if (!$user) {
            throw new ApiException(401, "Авторизация провалена");
        }

        Auth::login($user);
        return [
            'data' => [
                'user_token' => Auth::user()->generateToken()
            ]
        ];

    }

    public function logout(Request $request)
    {
    }
}
