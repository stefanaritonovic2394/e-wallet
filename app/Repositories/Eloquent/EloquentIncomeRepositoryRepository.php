<?php

namespace App\Repositories\Eloquent;

use App\IncomeRepository;
use App\Repositories\Contracts\IncomeRepositoryRepository;

use Kurt\Repoist\Repositories\Eloquent\AbstractRepository;

class EloquentIncomeRepositoryRepository extends AbstractRepository implements IncomeRepositoryRepository
{
    public function entity()
    {
        return IncomeRepository::class;
    }
}
