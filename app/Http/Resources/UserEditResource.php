<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Log;

class UserEditResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $user = [
            'name' => $this->name,
            'roles' => []
        ];

        foreach ($this->roleList as $role) {
            $checked = false;
            foreach ($this->roles as $userRole) {
                if ($userRole->name === $role) {
                    $checked = true;
                }
            }
            $user['roles'][] = [
                'name' => $role,
                'checked' => $checked
            ];
        }

        return $user;
    }
}
