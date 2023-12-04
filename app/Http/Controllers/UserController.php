<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(): JsonResponse
    {
        $user = User::all();
        return response()->json($user)->setStatusCode(200, 'OK');
    }

    public function create(Request $request)
    {
        if (isset($request->lastname) &&
            isset($request->name) &&
            isset($request->sex) &&
            isset($request->birth) &&
            isset($request->login) &&
            isset($request->password) &&
            isset($request->email)
        ) {
            return User::create($request->all());
        } else {
            return response()->json('Invalid data')->setStatusCode(400, 'Bad Request');
        }
    }

    public function update(Request $request, string $id): JsonResponse
    {
        $user = User::where('id', '=', $id)->first();

        if (!isset($user)) {
            return response()->json()->setStatusCode(404, 'Not Found');
        }

        if (isset($request->lastname) &&
            isset($request->name) &&
            isset($request->sex) &&
            isset($request->birth) &&
            isset($request->login) &&
            isset($request->password) &&
            isset($request->email)
        ) {
            $user->lastname = $request->lastname;
            $user->name = $request->name;
            $user->sex = $request->sex;
            $user->birth = $request->birth;
            $user->login = $request->login;
            $user->password = $request->password;
            $user->email = $request->email;

            isset($request->patronymic) && $user->patronymic = $request->patronymic;
        } else {
            return response()->json('Invalid data')->setStatusCode(400, 'Bad Request');
        }

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
}
