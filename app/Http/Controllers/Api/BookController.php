<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ApiBookStoreRequest;
use App\Http\Requests\ApiBookUpdateRequest;
use App\Http\Resources\BookListCollection;
use App\Http\Resources\BookViewResource;
use App\Models\Book;
use App\Repositories\BookRepository;

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

    public function show(Book $author)
    {
        return new BookViewResource($author);
    }

    public function update(ApiBookUpdateRequest $request, Book $author)
    {
        return $this->bookRepository->update($author, $request);
    }

    public function destroy(Book $author)
    {
        return $author->delete();
    }
}
