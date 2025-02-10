<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateSectionPageRequest;
use App\Http\Resources\SectionPageIndexResource;
use App\Http\Resources\SectionPageShowResource;
use App\Models\News;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $news = News::query()->with(['user'])->orderBy('created_at', 'desc')->get();

        return Inertia::render('SectionPage/SectionPage', [
            'value' => Inertia::always(SectionPageIndexResource::collection($news)),
            'route' => 'news',
            'isManage' => Auth::user()->hasPermissionTo(Permission::NEWS_M)
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateSectionPageRequest $request)
    {
        $news = $request->validated();
        Auth::user()->news()->save(new News($news));

        return ['data' => true];
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $news = News::query()->with('user')->where('id', $id)->first();
        return Inertia::render('SectionPage/ShowSectionPage', [
            'blog' => Inertia::always(new SectionPageShowResource($news)),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CreateSectionPageRequest $request, News $news)
    {
        if (Auth::user()->id === $news->user_id || Auth::user()->hasRole(Role::ADMIN)) {
            $data = $request->validated();
            $news->fill($data);
            $news->save();
        }

        return ['data' => true];
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(News $news)
    {
        if (Auth::user()->id === $news->user_id || Auth::user()->hasRole(Role::ADMIN)) {
            $news->delete();
        }
    }
}
