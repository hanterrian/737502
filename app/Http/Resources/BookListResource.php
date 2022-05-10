<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin \App\Models\Book */
class BookListResource extends JsonResource
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

            'publisher' => PublisherViewResource::make($this->whenLoaded('publisher')),

            'authors' => AuthorListCollection::collection($this->whenLoaded('authors')),
        ];
    }
}
