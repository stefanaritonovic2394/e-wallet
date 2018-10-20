<?php

namespace App\Repositories;

use App\Incomes\Income;
use App\Exceptions\CreateIncomeErrorException;
use App\Exceptions\UpdateIncomeErrorException;
use App\Exceptions\IncomeNotFoundException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;

class IncomeRepository
{
    protected $model;

    /**
     * IncomeRepository constructor.
     * @param Income $income
     */
    public function __construct(Income $income)
    {
        $this->model = $income;
    }
    /**
     * @param array $data
     * @return Income
     * @throws CreateIncomeErrorException
     */
    public function createIncome(array $data) : Income
    {
        try {
            return $this->model->create($data);
        } catch (QueryException $e) {
            throw new CreateIncomeErrorException($e);
        }
    }

    /**
     * @param int $id
     * @return Income
     * @throws IncomeNotFoundException
     */
    public function findIncome(int $id) : Income
    {
        try {
            return $this->model->findOrFail($id);
        } catch (ModelNotFoundException $e) {
            throw new IncomeNotFoundException($e);
        }
    }

    /**
     * @param array $data
     * @return bool
     * @throws UpdateIncomeErrorException
     */
    public function updateIncome(array $data) : bool
    {
        try {
            return $this->model->update($data);
        } catch (QueryException $e) {
            throw new UpdateIncomeErrorException($e);
        }
    }

    /**
     * @return bool
     */
    public function deleteIncome() : bool
    {
        return $this->model->delete();
    }

}