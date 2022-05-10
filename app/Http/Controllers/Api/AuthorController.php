<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ApiAuthorStoreRequest;
use App\Http\Requests\ApiAuthorUpdateRequest;
use App\Http\Resources\AuthorListCollection;
use App\Http\Resources\AuthorViewResource;
use App\Models\Author;
use App\Repositories\AuthorRepository;

class AuthorController extends Controller
{
    public function __construct(private AuthorRepository $authorRepository)
    {
    }

    public function index()
    {
        return new AuthorListCollection($this->authorRepository->all());
    }

    public function store(ApiAuthorStoreRequest $request)
    {
        return $this->authorRepository->create($request);
    }

    public function show(Author $author)
    {
        return new AuthorViewResource($author);
    }

    public function update(ApiAuthorUpdateRequest $request, Author $author)
    {
        return $this->authorRepository->update($author, $request);
    }

    public function destroy(Author $author)
    {
        return $author->delete();
    }
}
