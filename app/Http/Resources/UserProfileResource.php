<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin \App\Models\User */
class UserProfileResource extends JsonResource
{
    /**
     * @param Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'name' => $this->name,
            'email' => $this->email,

            'favorites' => BookFavoriteListResource::collection($this->whenLoaded('favorites')),
            'viewed' => BookViewedListResource::collection($this->whenLoaded('viewed')),
        ];
    }
}
