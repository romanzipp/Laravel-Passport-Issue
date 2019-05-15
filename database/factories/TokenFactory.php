<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;
use Laravel\Passport\Token;

$factory->define(Token::class, function (Faker $faker) {
    return [
        'id' => $faker->uuid(),
        'user_id' => null,
        'client_id' => 1,
        'name' => null,
        'scopes' => null,
        'revoked' => false,
        'expires_at' => null,
    ];
});
