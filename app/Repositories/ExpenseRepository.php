<?php

namespace App\Repositories;

use App\Expenses\Expense;
use App\Exceptions\CreateExpenseErrorException;
use App\Exceptions\UpdateExpenseErrorException;
use App\Exceptions\ExpenseNotFoundException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;

class ExpenseRepository
{
    protected $model;

    /**
     * ExpenseRepository constructor.
     * @param Expense $expense
     */
    public function __construct(Expense $expense)
    {
        $this->model = $expense;
    }
    /**
     * @param array $data
     * @return Expense
     * @throws CreateExpenseErrorException
     */
    public function createExpense(array $data) : Expense
    {
        try {
            return $this->model->create($data);
        } catch (QueryException $e) {
            throw new CreateExpenseErrorException($e);
        }
    }

    /**
     * @param int $id
     * @return Expense
     * @throws ExpenseNotFoundException
     */
    public function findExpense(int $id) : Expense
    {
        try {
            return $this->model->findOrFail($id);
        } catch (ModelNotFoundException $e) {
            throw new ExpenseNotFoundException($e);
        }
    }

    /**
     * @param array $data
     * @return bool
     * @throws UpdateExpenseErrorException
     */
    public function updateExpense(array $data) : bool
    {
        try {
            return $this->model->update($data);
        } catch (QueryException $e) {
            throw new UpdateExpenseErrorException($e);
        }
    }

    /**
     * @return bool
     */
    public function deleteExpense() : bool
    {
        return $this->model->delete();
    }

}