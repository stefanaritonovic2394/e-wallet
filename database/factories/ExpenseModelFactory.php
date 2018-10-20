<?php

use Faker\Generator as Faker;
use App\Expenses\Expense;
use Carbon\Carbon;

$factory->define(Expense::class, function (Faker $faker) {
    return [
        'entry_date' => Carbon::now()->format('Y-m-d'),
        'amount' => $this->faker->randomNumber(4),
        'expense_category_id' => random_int(1, 3),
        'currency_id' => random_int(1, 3),
        'created_by_id' => random_int(1, 4),
        'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
    ];
});
