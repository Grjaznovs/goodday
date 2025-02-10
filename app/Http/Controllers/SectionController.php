<?php

namespace App\Http\Controllers;

use App\Http\Resources\SectionIndexResource;
use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class SectionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $userPermissions = Auth::user()->getAllPermissions()->pluck('name');
        $section = Section::query()->orderBy('name', 'asc')->with('permissions')
            ->whereHas('permissions', function ($q) use ($userPermissions) {
                $q->whereIn('name', $userPermissions);
            })
            ->get()
        ;

        return SectionIndexResource::collection($section);
    }
}
