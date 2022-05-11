<?php

namespace App\Repositories;

use App\Http\Requests\ApiBookStoreRequest;
use App\Http\Requests\ApiBookUpdateRequest;
use App\Models\Book;
use App\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

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
        $model = Book::create($request->except(['image', 'authors']));

        return $this->saveApiRecord($model, $request);
    }

    public function update(Book $author, ApiBookUpdateRequest $request): Book
    {
        $author->update($request->except(['image', 'authors']));

        return $this->saveApiRecord($author, $request);
    }

    public function delete(int $id): int
    {
        return Book::destroy($id);
    }

    protected function saveApiRecord(Book $model, ApiBookStoreRequest|ApiBookUpdateRequest $request): Book
    {
        $file = $request->file('image');

        if ($file) {
            $fileName = Str::random().'.'.$file->extension();

            Storage::disk('public')->putFileAs('books/', $file, $fileName);

            $model->update(['image' => $fileName]);
        }

        foreach ($request->authors as $author) {
            $model->authors()->attach($author);
        }

        $model->refresh();

        $model->load(['publisher', 'authors']);

        return $model;
    }
}
