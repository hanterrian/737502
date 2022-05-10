<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ApiFavoriteRequest;
use App\Http\Requests\UserLoginRequest;
use App\Http\Resources\UserProfileResource;
use App\Models\User;
use App\Repositories\BookRepository;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
    public function __construct(private UserRepository $userRepository, private BookRepository $bookRepository)
    {
    }

    public function login(UserLoginRequest $request)
    {
        $user = User::where('email', $request->email)->first();

        if (! $user || ! Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        $token = $user->createToken('secret-token');

        return ['token' => $token->plainTextToken];
    }

    public function logout(): bool|null
    {
        return Auth::user()->currentAccessToken()->delete();
    }

    public function profile()
    {
        return new UserProfileResource(Auth::user());
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
