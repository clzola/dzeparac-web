<?php

namespace Tests\Feature\Api\Parent;

use Dzeparac\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MeTest extends TestCase
{
    use RefreshDatabase;

	public function testMeEndpoint()
    {
    	$this->createTestUser();

    	/** @var User $user */
    	$user = User::findOrFail(1);
    	$token = \JWTAuth::fromSubject($user);

        $this->withHeader('Accept', 'application/json')
             ->withHeader('Authorization', "Bearer {$token}")
             ->get('/api/auth/me')
             ->assertStatus(200)
             ->assertJsonStructure([
             	"id",
		        "username",
		        "email"
	         ]);
    }

    private function createTestUser()
    {
	    $user = new User([
		    'username' => 'parent',
		    'email' => 'parent@test.com',
	    ]);

	    $user->password = bcrypt('123');
	    $user->is_parent = true;
	    $user->save();
    }
}
