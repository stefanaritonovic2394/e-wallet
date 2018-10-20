<?php

use Faker\Generator as Faker;
use App\ExpenseCategories\ExpenseCategory;
use Carbon\Carbon;

$factory->define(ExpenseCategory::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'created_by_id' => random_int(1, 4),
        'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
    ];
});
