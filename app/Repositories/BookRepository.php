<?php

namespace App\Repositories;

use App\Http\Requests\ApiBookStoreRequest;
use App\Http\Requests\ApiBookUpdateRequest;
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

    public function create(ApiBookStoreRequest $request): Book
    {
        return Book::create($request->toArray());
    }

    public function update(Book $author, ApiBookUpdateRequest $request): bool
    {
        return $author->update($request->toArray());
    }

    public function delete(int $id): int
    {
        return Book::destroy($id);
    }
}
