<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdatePermissionRequest;
use App\Http\Resources\SectionResource;
use App\Models\Role;
use App\Models\Section;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class PermissionController extends Controller
{
    /**
     * Show the form for editing the specified resource.
     */
    public function edit($roleId)
    {
        $role = Role::findOrFail($roleId);
        $sections = Section::query();
        if ($role->name === Role::USER) {
            $sections->whereNotIn('code', [Section::ROLE, Section::USER]);
        }
        $sections = $sections->orderBy('order')->get();

        return ['data' => [
            'sections' => SectionResource::collection($sections),
            'permissions' => $role->permissions->pluck('name')
        ]];
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePermissionRequest $request, $id)
    {
        $role = Role::findOrFail($id);
        foreach ($request->sections as $row) {
            foreach ($row['permissions'] as $permission) {
                $role->hasPermissionTo($permission['name']);
                if ($role->hasPermissionTo($permission['name']) && !$permission['checked']) {
                    $role->revokePermissionTo($permission['name']);
                } else if ($permission['checked']) {
                    $role->givePermissionTo($permission['name']);
                }
            }
        }

        return ['data' => true];
    }
}
