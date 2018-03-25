<?php

namespace Dzeparac\Http\Controllers\Api\Parent;

use Dzeparac\Parentt;
use Illuminate\Http\Request;
use Dzeparac\Http\Controllers\Controller;

class LoginController extends Controller
{
    public function login(Request $request)
    {
      if($request->has("id")) {
        return ["data" => Parentt::findOrFail($request->get("id"))];
      }
    	return Parentt::whereUsername($request->get('username'))->firstOrFail();
    }
}
