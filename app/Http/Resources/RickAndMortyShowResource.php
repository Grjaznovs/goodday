<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RickAndMortyShowResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this['id'],
            'name' => $this['name'],
            'status' => $this['status'],
            'species' => $this['species'],
            'gender' => $this['gender'],
            'image' => $this['image'],
            'location' => [
                'name' => $this['location']['name'],
                'url' => $this['location']['url']
            ],
            'url' => $this['url']
        ];
    }
}
