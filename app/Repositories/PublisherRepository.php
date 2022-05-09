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
        return Publisher::paginate();
    }

    public function one(int $id): ?Publisher
    {
        return Publisher::whereId($id)->first();
    }

    public function create(ApiPublisherStoreRequest $request): Publisher
    {
        return Publisher::create($request->toArray());
    }

    public function update(Publisher $author, ApiPublisherUpdateRequest $request): bool
    {
        return $author->update($request->toArray());
    }

    public function delete(int $id): int
    {
        return Publisher::destroy($id);
    }
}
