<?php

namespace App\Http\Controllers\Api\Parent;

use App\Parentt;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
