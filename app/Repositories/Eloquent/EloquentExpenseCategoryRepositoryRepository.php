<?php

namespace App\Repositories\Eloquent;

use App\ExpenseCategoryRepository;
use App\Repositories\Contracts\ExpenseCategoryRepositoryRepository;

use Kurt\Repoist\Repositories\Eloquent\AbstractRepository;

class EloquentExpenseCategoryRepositoryRepository extends AbstractRepository implements ExpenseCategoryRepositoryRepository
{
    public function entity()
    {
        return ExpenseCategoryRepository::class;
    }
}
