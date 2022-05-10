<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ApiBookStoreRequest;
use App\Http\Requests\ApiBookUpdateRequest;
use App\Http\Resources\BookListCollection;
use App\Http\Resources\BookViewResource;
use App\Models\Book;
use App\Repositories\BookRepository;
use Illuminate\Support\Facades\Auth;

class BookController extends Controller
{
    public function __construct(private BookRepository $bookRepository)
    {
    }

    public function index()
    {
        return new BookListCollection($this->bookRepository->all());
    }

    public function store(ApiBookStoreRequest $request)
    {
        return $this->bookRepository->create($request);
    }

    public function show(Book $book)
    {
        $this->bookRepository->viewed($book, Auth::user());

        return new BookViewResource($book);
    }

    public function update(ApiBookUpdateRequest $request, Book $book)
    {
        return $this->bookRepository->update($book, $request);
    }

    public function destroy(Book $book)
    {
        return $book->delete();
    }
}
