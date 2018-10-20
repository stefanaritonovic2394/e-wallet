<?php

namespace App\Repositories;

use App\Users\User;
use App\Exceptions\CreateUserErrorException;
use App\Exceptions\UpdateUserErrorException;
use App\Exceptions\UserNotFoundException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;

class UserRepository
{
    protected $model;

    /**
     * UserRepository constructor.
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->model = $user;
    }
    /**
     * @param array $data
     * @return User
     * @throws CreateUserErrorException
     */
    public function createUser(array $data) : User
    {
        try {
            return $this->model->create($data);
        } catch (QueryException $e) {
            throw new CreateUserErrorException($e);
        }
    }
    /**
     * @param int $id
     * @return User
     * @throws UserNotFoundException
     */
    public function findUser(int $id) : User
    {
        try {
            return $this->model->findOrFail($id);
        } catch (ModelNotFoundException $e) {
            throw new UserNotFoundException($e);
        }
    }

    /**
     * @param array $data
     * @return bool
     * @throws UpdateUserErrorException
     */
    public function updateUser(array $data) : bool
    {
        try {
            return $this->model->update($data);
        } catch (QueryException $e) {
            throw new UpdateUserErrorException($e);
        }
    }

    /**
     * @return bool
     */
    public function deleteUser() : bool
    {
        return $this->model->delete();
    }

}