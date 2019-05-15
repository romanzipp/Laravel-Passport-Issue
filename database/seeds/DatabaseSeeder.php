<?php

use App\User;
use Illuminate\Database\Seeder;
use Laravel\Passport\Token;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        factory(User::class, 5)->create()->each(function ($user) {
            $user->tokens()->save(
                factory(Token::class)->make()
            );
        });
    }
}
