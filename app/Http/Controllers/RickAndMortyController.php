<?php

namespace App\Http\Controllers;

use App\Classes\RickAndMortyApi;
use App\Http\Resources\RickAndMortyResource;
use App\Http\Resources\RickAndMortyShowResource;
use Illuminate\Support\Facades\Log;

class RickAndMortyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($page = null)
    {
        $data = (new RickAndMortyApi())->getData('character', $page ? ['page' => $page] : null);
        return RickAndMortyResource::collection((isset($data['results']) ? $data['results'] : []));
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $data = (new RickAndMortyApi())->getData('character', ['id' => $id]);
        return $data ? (new RickAndMortyShowResource($data)) : [];
    }
}
