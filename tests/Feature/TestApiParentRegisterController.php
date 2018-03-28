<?php

namespace Tests\Feature;

use Tests\TestCase;


class TestApiParentRegisterController extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testParentRegister()
    {
        $response = $this->post('/api/parent/register', [
        	'username' => 'admin1',
	        'email' => 'admin@test.com',
	        'password' => '123'
        ]);

        $response->assertStatus(200)
	        ->assertJson([
	        	'id' => true,
	        	'username' => true,
		        'email' => true,
	        ]);
    }
}
