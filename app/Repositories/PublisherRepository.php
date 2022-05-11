<?php

namespace App\Repositories;

use App\Http\Requests\ApiPublisherStoreRequest;
use App\Http\Requests\ApiPublisherUpdateRequest;
use App\Models\Publisher;
use Illuminate\Pagination\LengthAwarePaginator;

class PublisherRepository
{
    public function all(): LengthAwarePaginator
    {
        return Publisher::wherePublished(true)->orderBy('sort')->paginate();
    }

    public function one(int $id): ?Publisher
    {
        return Publisher::whereId($id)->wherePublished(true)->first();
    }

    public function create(ApiPublisherStoreRequest $request): Publisher
    {
        return Publisher::create($request->toArray());
    }

    public function update(Publisher $author, ApiPublisherUpdateRequest $request): Publisher
    {
        $author->update($request->toArray());

        $author->refresh();

        return $author;
    }

    public function delete(int $id): int
    {
        return Publisher::destroy($id);
    }
}
