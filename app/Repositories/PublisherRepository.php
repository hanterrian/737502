<?php

namespace App\Repositories;

use App\Models\Publisher;
use Illuminate\Pagination\LengthAwarePaginator;

class PublisherRepository
{
    public function all(): LengthAwarePaginator
    {
        return Publisher::paginate();
    }

    public function one(int $id): ?Publisher
    {
        return Publisher::whereId($id)->first();
    }

    public function create(array $params): Publisher
    {
        return Publisher::create($params);
    }

    public function update(int $id, array $params): bool
    {
        return Publisher::whereId($id)->update($params);
    }

    public function delete(int $id): int
    {
        return Publisher::destroy($id);
    }
}
