<?php

namespace App\Repositories;

use App\IncomeCategories\IncomeCategory;
use App\Exceptions\CreateIncomeCategoryErrorException;
use App\Exceptions\UpdateIncomeCategoryErrorException;
use App\Exceptions\IncomeCategoryNotFoundException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;

class IncomeCategoryRepository
{
    protected $model;

    /**
     * IncomeCategoryRepository constructor.
     * @param IncomeCategory $incomeCategory
     */
    public function __construct(IncomeCategory $incomeCategory)
    {
        $this->model = $incomeCategory;
    }

    /**
     * @param array $data
     * @return IncomeCategory
     * @throws CreateIncomeCategoryErrorException
     */
    public function createIncomeCategory(array $data) : IncomeCategory
    {
        try {
            return $this->model->create($data);
        } catch (QueryException $e) {
            throw new CreateIncomeCategoryErrorException($e);
        }
    }

    /**
     * @param int $id
     * @return IncomeCategory
     * @throws IncomeCategoryNotFoundException
     */
    public function findIncomeCategory(int $id) : IncomeCategory
    {
        try {
            return $this->model->findOrFail($id);
        } catch (ModelNotFoundException $e) {
            throw new IncomeCategoryNotFoundException($e);
        }
    }

    /**
     * @param array $data
     * @return bool
     * @throws UpdateIncomeCategoryErrorException
     */
    public function updateIncomeCategory(array $data) : bool
    {
        try {
            return $this->model->update($data);
        } catch (QueryException $e) {
            throw new UpdateIncomeCategoryErrorException($e);
        }
    }

    /**
     * @return bool
     */
    public function deleteIncomeCategory() : bool
    {
        return $this->model->delete();
    }

}