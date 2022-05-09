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
        return Author::paginate();
    }

    public function one(int $id): ?Author
    {
        return Author::whereId($id)->first();
    }

    public function create(ApiAuthorStoreRequest $request): Author
    {
        return Author::create($request->toArray());
    }

    public function update(Author $author, ApiAuthorUpdateRequest $request): bool
    {
        return $author->update($request->toArray());
    }

    public function delete(int $id): int
    {
        return Author::destroy($id);
    }
}
