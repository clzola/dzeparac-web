<?php

namespace Tests\Feature\Api\Parent;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RegisterTest extends TestCase
{
    public function testRegister()
    {
	    $response = $this->post('/api/parent/register', [
		    'username' => 'admin1',
		    'email' => 'admin@test.com',
		    'password' => '123'
	    ]);

	    $response->assertStatus(200)
	             ->assertJsonStructure([
	             	 "id",
		             "username",
		             "email"
	             ])
	             ->assertJson([
                    "id" => 1,
	                "username" => "admin1",
	                "email" => "admin@test.com",
	             ]);
    }


    public function testRegisterWithUsedEmail()
    {
	    $response = $this->withHeader('Accept', 'application/json')
	                     ->post('/api/parent/register', [
	                     	'username' => 'admin2',
	                        'email' => 'admin@test.com',
	                        'password' => '123'
	                     ]);

	    $response->assertStatus(422)
	             ->assertJsonValidationErrors("email");
    }


	public function testRegisterWithUsedUsername()
	{
		$response = $this->withHeader('Accept', 'application/json')
		                 ->post('/api/parent/register', [
		                 	'username' => 'admin1',
		                    'email' => 'admin2@test.com',
		                    'password' => '123'
		                 ]);

		$response->assertStatus(422)
		         ->assertJsonValidationErrors("username");
	}
}
