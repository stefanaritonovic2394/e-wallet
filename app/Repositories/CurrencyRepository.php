<?php

namespace App\Repositories;

use App\Currencies\Currency;
use App\Exceptions\CreateCurrencyErrorException;
use App\Exceptions\UpdateCurrencyErrorException;
use App\Exceptions\CurrencyNotFoundException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;

class CurrencyRepository
{
    protected $model;

    /**
     * CurrencyRepository constructor.
     * @param Currency $currency
     */
    public function __construct(Currency $currency)
    {
        $this->model = $currency;
    }
    /**
     * @param array $data
     * @return Currency
     * @throws CreateCurrencyErrorException
     */
    public function createCurrency(array $data) : Currency
    {
        try {
            return $this->model->create($data);
        } catch (QueryException $e) {
            throw new CreateCurrencyErrorException($e);
        }
    }

    /**
     * @param int $id
     * @return Currency
     * @throws CurrencyNotFoundException
     */
    public function findCurrency(int $id) : Currency
    {
        try {
            return $this->model->findOrFail($id);
        } catch (ModelNotFoundException $e) {
            throw new CurrencyNotFoundException($e);
        }
    }

    /**
     * @param array $data
     * @return bool
     * @throws UpdateCurrencyErrorException
     */
    public function updateCurrency(array $data) : bool
    {
        try {
            return $this->model->update($data);
        } catch (QueryException $e) {
            throw new UpdateCurrencyErrorException($e);
        }
    }

    /**
     * @return bool
     */
    public function deleteCurrency() : bool
    {
        return $this->model->delete();
    }

}