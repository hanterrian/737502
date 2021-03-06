<?php

namespace App\Repositories;

use App\Http\Requests\ApiAuthorStoreRequest;
use App\Http\Requests\ApiAuthorUpdateRequest;
use App\Models\Author;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class AuthorRepository
{
    public function all(): LengthAwarePaginator
    {
        return Author::wherePublished(true)->orderBy('sort')->paginate();
    }

    public function one(int $id): ?Author
    {
        return Author::whereId($id)->wherePublished(true)->first();
    }

    public function create(ApiAuthorStoreRequest $request): Author
    {
        return Author::create($request->toArray());
    }

    public function update(Author $author, ApiAuthorUpdateRequest $request): Author
    {
        $author->update($request->toArray());

        $author->refresh();

        return $author;
    }

    public function delete(int $id): int
    {
        return Author::destroy($id);
    }
}
