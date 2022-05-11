<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin \App\Models\Book */
class BookViewedListResource extends JsonResource
{
    /**
     * @param Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'image_url' => $this->image_url,
            'description' => $this->description,

            'views' => $this->pivot?->view,

            'publisher' => PublisherViewResource::make($this->whenLoaded('publisher')),

            'authors' => AuthorListResource::collection($this->whenLoaded('authors')),
        ];
    }
}
