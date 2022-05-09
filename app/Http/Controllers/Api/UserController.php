<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ApiFavoriteRequest;
use App\Models\Book;
use App\Models\Publisher;
use App\Models\User;
use App\Repositories\BookRepository;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct(private UserRepository $userRepository, private BookRepository $bookRepository)
    {
    }

    public function favorite(ApiFavoriteRequest $request)
    {
        $user = $this->userRepository->one($request->user_id);
        $book = $this->bookRepository->one($request->book_id);

        $this->userRepository->favorite($user, $book);
    }

    public function unFavorite(ApiFavoriteRequest $request)
    {
        $user = $this->userRepository->one($request->user_id);
        $book = $this->bookRepository->one($request->book_id);

        $this->userRepository->unFavorite($user, $book);
    }
}
