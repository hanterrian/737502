<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ApiPublisherStoreRequest;
use App\Http\Requests\ApiPublisherUpdateRequest;
use App\Http\Resources\PublisherListCollection;
use App\Http\Resources\PublisherViewResource;
use App\Models\Publisher;
use App\Repositories\PublisherRepository;

class PublisherController extends Controller
{
    public function __construct(private PublisherRepository $publisherRepository)
    {
    }

    public function index()
    {
        return new PublisherListCollection($this->publisherRepository->all());
    }

    public function store(ApiPublisherStoreRequest $request)
    {
        return $this->publisherRepository->create($request);
    }

    public function show(Publisher $author)
    {
        return new PublisherViewResource($author);
    }

    public function update(ApiPublisherUpdateRequest $request, Publisher $author)
    {
        return $this->publisherRepository->update($author, $request);
    }

    public function destroy(Publisher $author)
    {
        return $author->delete();
    }
}
