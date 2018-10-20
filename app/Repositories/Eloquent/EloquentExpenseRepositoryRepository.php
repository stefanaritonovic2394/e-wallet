<?php

namespace App\Repositories\Eloquent;

use App\ExpenseRepository;
use App\Repositories\Contracts\ExpenseRepositoryRepository;

use Kurt\Repoist\Repositories\Eloquent\AbstractRepository;

class EloquentExpenseRepositoryRepository extends AbstractRepository implements ExpenseRepositoryRepository
{
    public function entity()
    {
        return ExpenseRepository::class;
    }
}
