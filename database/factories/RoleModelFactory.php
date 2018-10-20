<?php

use Faker\Generator as Faker;
use App\Roles\Role;

$factory->define(Role::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
    ];
});
