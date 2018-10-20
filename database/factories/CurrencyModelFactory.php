<?php

use Faker\Generator as Faker;
use App\Currencies\Currency;
use Carbon\Carbon;

$factory->define(Currency::class, function (Faker $faker) {
    return [
        'title' => $faker->word,
        'symbol' => $faker->currencyCode,
        'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        'deleted_at' => Carbon::now()->format('Y-m-d H:i:s'),
    ];
});
