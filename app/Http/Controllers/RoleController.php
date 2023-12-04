<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index(): JsonResponse
    {
        $roles = Role::all();
        return response()->json($roles)->setStatusCode(200, 'OK');
    }

    public function create(Request $request)
    {
        return Role::create($request->all());
    }

    public function update(Request $request, string $id): JsonResponse
    {
        $role = Role::where('id', '=', $id)->first();

        if (!isset($role)) {
            return response()->json()->setStatusCode(404, 'Not Found');
        }

        if (isset($request->name)) {
            $role->name = $request->name;
        }

        if (isset($request->code)) {
            $role->code = $request->code;
        }

        $role->save();

        return response()->json($role)->setStatusCode(200, 'OK');
    }

    public function delete(string $id): JsonResponse
    {
        $role = Role::where('id', '=', $id)->delete();
        return response()->json($role)->setStatusCode(200, 'OK');
    }

    public function view(string $id)
    {
        return Role::where('id', '=', $id)->first();
    }
}
