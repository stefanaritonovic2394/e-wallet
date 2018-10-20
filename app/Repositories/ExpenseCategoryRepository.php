<?php

namespace App\Repositories;

use App\ExpenseCategories\ExpenseCategory;
use App\Exceptions\CreateExpenseCategoryErrorException;
use App\Exceptions\UpdateExpenseCategoryErrorException;
use App\Exceptions\ExpenseCategoryNotFoundException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;

class ExpenseCategoryRepository
{
    protected $model;

    /**
     * ExpenseCategoryRepository constructor.
     * @param ExpenseCategory $expenseCategory
     */
    public function __construct(ExpenseCategory $expenseCategory)
    {
        $this->model = $expenseCategory;
    }

    /**
     * @param array $data
     * @return ExpenseCategory
     * @throws CreateExpenseCategoryErrorException
     */
    public function createExpenseCategory(array $data) : ExpenseCategory
    {
        try {
            return $this->model->create($data);
        } catch (QueryException $e) {
            throw new CreateExpenseCategoryErrorException($e);
        }
    }

    /**
     * @param int $id
     * @return ExpenseCategory
     * @throws ExpenseCategoryNotFoundException
     */
    public function findExpenseCategory(int $id) : ExpenseCategory
    {
        try {
            return $this->model->findOrFail($id);
        } catch (ModelNotFoundException $e) {
            throw new ExpenseCategoryNotFoundException($e);
        }
    }

    /**
     * @param array $data
     * @return bool
     * @throws UpdateExpenseCategoryErrorException
     */
    public function updateExpenseCategory(array $data) : bool
    {
        try {
            return $this->model->update($data);
        } catch (QueryException $e) {
            throw new UpdateExpenseCategoryErrorException($e);
        }
    }

    /**
     * @return bool
     */
    public function deleteExpenseCategory() : bool
    {
        return $this->model->delete();
    }

}