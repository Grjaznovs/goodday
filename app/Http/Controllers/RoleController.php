<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;


class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('Role/Role', [
            'roles' => Role::query()->select('id', 'name', 'guard_name')->get()
        ]);
    }
}
