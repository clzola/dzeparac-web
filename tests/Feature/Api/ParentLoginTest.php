<?php

namespace Tests\Feature\Api;

use Dzeparac\User;
use Tests\TestCase;

use Illuminate\Foundation\Testing\RefreshDatabase;

class ParentLoginTest extends TestCase
{
	use RefreshDatabase;

    public function testLogin()
    {
	    $this->createTestUser();

        $this->withHeader('Accept', 'application/json')
             ->post('/api/auth/login', [
	             'entity'   => 'parent',
	             'username' => 'parent',
                 'password' => '123',
             ])
             ->assertStatus(200)
             ->assertJsonStructure([
                 'access_token',
	             'token_type',
	             'expires_in'
             ]);
    }


    public function testWrongCredentials()
    {
    	$this->createTestUser();

	    $this->withHeader('Accept', 'application/json')
	         ->post('/api/auth/login', [
		         'username' => 'admin',
		         'password' => '1235',
		         'entity' => 'parent',
	         ])
	         ->assertStatus(401)
	         ->assertJsonStructure([
	         	 'error'
	         ]);
    }


    public function testValidation()
    {
	    $this->createTestUser();

	    $this->withHeader('Accept', 'application/json')
	         ->post('/api/auth/login', [
		         'username' => 'admin',
		         'password' => '1235',
	         ])
	         ->assertStatus(422)
	         ->assertJsonValidationErrors('entity');

	    $this->withHeader('Accept', 'application/json')
	         ->post('/api/auth/login', [
		         'entity' => 'parent'
	         ])
		    ->assertStatus(422)
		    ->assertJsonValidationErrors(['username', 'password']);
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
