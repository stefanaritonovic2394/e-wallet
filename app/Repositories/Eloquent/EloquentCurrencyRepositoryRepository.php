<?php

namespace App\Repositories\Eloquent;

use App\CurrencyRepository;
use App\Repositories\Contracts\CurrencyRepositoryRepository;

use Kurt\Repoist\Repositories\Eloquent\AbstractRepository;

class EloquentCurrencyRepositoryRepository extends AbstractRepository implements CurrencyRepositoryRepository
{
    public function entity()
    {
        return CurrencyRepository::class;
    }
}
