<?php

namespace App\Repositories;

use App\Http\Requests\ApiBookStoreRequest;
use App\Http\Requests\ApiBookUpdateRequest;
use App\Models\Book;
use App\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;

class BookRepository
{
    public function all(): LengthAwarePaginator
    {
        return Book::wherePublished(true)->orderBy('sort')->paginate();
    }

    public function one(int $id): ?Book
    {
        return Book::whereId($id)->wherePublished(true)->first();
    }

    public function viewed(Book $book, ?User $user = null): void
    {
        if ($user === null) {
            return;
        }

        $book->viewers()->syncWithoutDetaching($user);

        $book->viewers()->newPivotQuery()
            ->where([
                'user_id' => $user->id,
                'book_id' => $book->id,
            ])
            ->increment('view');
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
