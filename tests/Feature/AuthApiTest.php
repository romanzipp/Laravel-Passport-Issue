<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthApiTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $token = factory(User::class)->create()->createToken('UnitTest')->accessToken;

        $this->get('/api/route-that-requires-valid-auth', [
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . $token
        ]);
    }

    public function testUnauthorized()
    {
        $this
            ->get('/api/route-that-requires-valid-auth', [
                'Accept' => 'application/json'
            ])
            ->assertStatus(401);
    }

    public function testAuthorized()
    {
        $token = factory(User::class)->create()->createToken('UnitTest')->accessToken;

        $this
            ->get('/api/route-that-requires-valid-auth', [
                'Accept' => 'application/json',
                'Authorization' => 'Bearer ' . $token
            ])
            ->assertStatus(200);
    }

    public function testUnauthorizedAgain()
    {
        $this
            ->get('/api/route-that-requires-valid-auth', [
                'Accept' => 'application/json'
            ])
            ->assertStatus(401);
    }
}
