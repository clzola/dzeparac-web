<?php

namespace Dzeparac\Http\Controllers\Api;

use Dzeparac\Http\Requests\Api\Parent\RegisterRequest;
use Dzeparac\User;
use Dzeparac\Http\Controllers\Controller;

class ParentRegisterController extends Controller
{
	/**
	 * @param RegisterRequest $request
	 *
	 * @return User
	 */
    public function register(RegisterRequest $request)
    {
    	$user = new User($request->all());
    	$user->password = bcrypt($request->get('password'));
    	$user->save();

    	return $user;
    }
}
