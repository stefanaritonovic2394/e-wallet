<?php

namespace App\Repositories;

use App\Roles\Role;
use App\Exceptions\CreateRoleErrorException;
use App\Exceptions\UpdateRoleErrorException;
use App\Exceptions\RoleNotFoundException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;

class RoleRepository
{
    protected $model;

    /**
     * RoleRepository constructor.
     * @param Role $role
     */
    public function __construct(Role $role)
    {
        $this->model = $role;
    }

    /**
     * @param array $data
     * @return Role
     * @throws CreateRoleErrorException
     */
    public function createRole(array $data) : Role
    {
        try {
            return $this->model->create($data);
        } catch (QueryException $e) {
            throw new CreateRoleErrorException($e);
        }
    }

    /**
     * @param int $id
     * @return Role
     * @throws RoleNotFoundException
     */
    public function findRole(int $id) : Role
    {
        try {
            return $this->model->findOrFail($id);
        } catch (ModelNotFoundException $e) {
            throw new RoleNotFoundException($e);
        }
    }

    /**
     * @param array $data
     * @return bool
     * @throws UpdateRoleErrorException
     */
    public function updateRole(array $data) : bool
    {
        try {
            return $this->model->update($data);
        } catch (QueryException $e) {
            throw new UpdateRoleErrorException($e);
        }
    }

    /**
     * @return bool
     */
    public function deleteRole() : bool
    {
        return $this->model->delete();
    }

}