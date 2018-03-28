<?php

namespace Tests\Feature\Api;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ParentLoginTest extends TestCase
{
    public function testLogin()
    {
        $this->withHeader('Accept', 'application/json')
             ->post('/api/auth/login', [
             	 'username' => 'admin1',
                 'password' => '123',
	             'entity' => 'parent',
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
}
