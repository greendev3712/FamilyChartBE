<?php

use Faker\Generator as Faker;
use LaravelEnso\Core\Models\UserGroup;

$factory->define(UserGroup::class, fn (Faker $faker) => [
    'name' => $faker->name,
    'description' => $faker->sentence,
]);
