<?php

namespace App\Repositories;

use App\Models\Book;
use Illuminate\Pagination\LengthAwarePaginator;

class BookRepository
{
    public function all(): LengthAwarePaginator
    {
        return Book::paginate();
    }

    public function one(int $id): ?Book
    {
        return Book::whereId($id)->first();
    }

    public function create(array $params): Book
    {
        return Book::create($params);
    }

    public function update(int $id, array $params): bool
    {
        return Book::whereId($id)->update($params);
    }

    public function delete(int $id): int
    {
        return Book::destroy($id);
    }
}
