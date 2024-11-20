<?php

namespace App\Http\Resources\Api;

use App\Http\Resources\Api\CityResource;
use App\Http\Resources\Api\OfficeSpaceBenefitsResource;
use App\Http\Resources\Api\OfficeSpacePhotoResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OfficeSpaceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'slug' => $this->slug,
            'duration' => $this->duration,
            'price' => $this->price,
            'thumbnail' => $this->thumbnail,
            'about'=> $this->about,
            'city' => new CityResource($this->whenLoaded('city')),
            'photos' => OfficeSpacePhotoResource::collection($this->whenLoaded('photos')),
            'benefits' => OfficeSpaceBenefitsResource::collection($this->whenLoaded('benefits')),
        ];
    }
}
