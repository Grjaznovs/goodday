<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\UserEditResource;
use App\Http\Resources\UserIndexResource;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::query()->with(['roles', 'session'])->get();
//        Log::info($users);

        return Inertia::render('User/Index/UserList', [
            // ALWAYS included on standard visits
            // ALWAYS included on partial reloads
            // ALWAYS evaluated
            'users' => Inertia::always(UserIndexResource::collection($users)),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $role = Role::query()->pluck('name');
        $user->getRoleNames();
        $user->roleList = $role;
        return new UserEditResource($user);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        foreach ($request['user']['roles'] as $role) {
            if ($role['checked'] && !$user->hasRole($role['name'])) {
                $user->assignRole($role['name']);
            } else if (!$role['checked'] && $user->hasRole($role['name'])) {
                $user->removeRole($role['name']);
            }
        }

        return ['data' => true];
    }
}
