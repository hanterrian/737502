<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ApiBookStoreRequest;
use App\Http\Requests\ApiBookUpdateRequest;
use App\Models\Book;
use App\Repositories\BookRepository;

class BookController extends Controller
{
    public function __construct(private BookRepository $bookRepository)
    {
    }

    public function index()
    {
        return $this->bookRepository->all();
    }

    public function store(ApiBookStoreRequest $request)
    {
        return $this->bookRepository->create($request);
    }

    public function show(Book $author)
    {
        return $author;
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
