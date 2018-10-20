<?php

namespace App\Repositories\Eloquent;

use App\IncomeCategoryRepository;
use App\Repositories\Contracts\IncomeCategoryRepositoryRepository;

use Kurt\Repoist\Repositories\Eloquent\AbstractRepository;

class EloquentIncomeCategoryRepositoryRepository extends AbstractRepository implements IncomeCategoryRepositoryRepository
{
    public function entity()
    {
        return IncomeCategoryRepository::class;
    }
}
