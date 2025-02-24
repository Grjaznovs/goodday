<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateSectionPageRequest;
use App\Http\Resources\SectionPageShowResource;
use App\Http\Resources\SectionPageIndexResource;
use App\Models\Blog;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $blogs = Blog::query()->with(['user'])->orderBy('created_at', 'desc')->get();

        return Inertia::render('SectionPage/SectionPage', [
            'value' => Inertia::always(SectionPageIndexResource::collection($blogs)),
            'route' => 'blog',
            'isManage' => Auth::user()->hasPermissionTo(Permission::BLOG_M)
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateSectionPageRequest $request)
    {
        $blog = $request->validated();
        Auth::user()->blog()->save(new Blog($blog));

        return ['data' => true];
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $blog = Blog::query()->with('user')->where('id', $id)->first();
        return Inertia::render('SectionPage/ShowSectionPage', [
            'blog' => Inertia::always(new SectionPageShowResource($blog)),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CreateSectionPageRequest $request, Blog $blog)
    {
        if (Auth::user()->id === $blog->user_id || Auth::user()->hasRole(Role::ADMIN)) {
            $data = $request->validated();
            $blog->fill($data);
            $blog->save();
        }

        return ['data' => true];
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Blog $blog)
    {
        if (Auth::user()->id === $blog->user_id || Auth::user()->hasRole(Role::ADMIN)) {
            $blog->delete();
        }
    }
}
