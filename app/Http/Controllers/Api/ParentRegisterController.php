<?php

namespace Dzeparac\Http\Controllers\Api;

use Dzeparac\User;
use Illuminate\Http\Request;
use Dzeparac\Http\Controllers\Controller;

class ParentRegisterController extends Controller
{
	/**
	 * @return array
	 */
    public function register()
    {
    	$user = new User(request()->all());
    	$user->password = bcrypt(request('password'));
    	$user->save();

    	return [
    		'id' => $user->id,
		    'username' => $user->username,
		    'email' => $user->email,
	    ];
    }
}
