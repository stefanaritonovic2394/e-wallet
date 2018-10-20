<?php

namespace App\Repositories\Eloquent;

use App\RoleRepository;
use App\Repositories\Contracts\RoleRepositoryRepository;

use Kurt\Repoist\Repositories\Eloquent\AbstractRepository;

class EloquentRoleRepositoryRepository extends AbstractRepository implements RoleRepositoryRepository
{
    public function entity()
    {
        return RoleRepository::class;
    }
}
