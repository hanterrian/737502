<?php

namespace App\Repositories;

use App\Models\Book;
use App\Models\User;

class UserRepository
{
    public function one(int $id): ?User
    {
        return User::whereId($id)->first();
    }

    public function favorite(User $user, Book $book): void
    {
        $user->favorites()->attach($book);
    }

    public function unFavorite(User $user, Book $book): void
    {
        $user->favorites()->detach($book);
    }
}
