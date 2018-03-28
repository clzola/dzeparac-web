<?php

namespace Tests\Feature\Api\Parent;

use Dzeparac\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RegisterTest extends TestCase
{
	use RefreshDatabase;

    public function testRegister()
    {
	    $response = $this->withHeader('Accept', 'application/json')
	                     ->post('/api/parent/register', [
	                     	'username' => 'parent',
	                        'email' => 'parent@test.com',
	                        'password' => '123'
	                     ]);

	    $response->assertStatus(200)
	             ->assertJsonStructure([
	             	 "id",
		             "username",
		             "email"
	             ]);
    }


    public function testRegisterWithUsedEmail()
    {
    	$this->createTestUser();

	    $response = $this->withHeader('Accept', 'application/json')
	                     ->post('/api/parent/register', [
		                     'username' => 'parent1',
		                     'email' => 'parent@test.com',
		                     'password' => '123'
	                     ]);

	    $response->assertStatus(422)
	             ->assertJsonValidationErrors("email");
    }


	public function testRegisterWithUsedUsername()
	{
		$this->createTestUser();

		$response = $this->withHeader('Accept', 'application/json')
		                 ->post('/api/parent/register', [
			                 'username' => 'parent',
			                 'email' => 'parent1@test.com',
			                 'password' => '123'
		                 ]);

		$response->assertStatus(422)
		         ->assertJsonValidationErrors("username");
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
