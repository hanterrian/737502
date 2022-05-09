<?php

namespace App\Repositories;

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

    public function create(array $params): Author
    {
        return Author::create($params);
    }

    public function update(int $id, array $params): bool
    {
        return Author::whereId($id)->update($params);
    }

    public function delete(int $id): int
    {
        return Author::destroy($id);
    }
}
