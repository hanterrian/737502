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
            'notifications_count' => $this->notifications_count,
            'tokens_count' => $this->tokens_count,
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'email_verified_at' => $this->email_verified_at,
            'password' => $this->password,
            'remember_token' => $this->remember_token,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'favorites_count' => $this->favorites_count,
            'viewed_count' => $this->viewed_count,

            'favorites' => BookListCollection::collection($this->whenLoaded('favorites')),
            'viewed' => BookListCollection::collection($this->whenLoaded('viewed')),
        ];
    }
}
