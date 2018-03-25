<?php

namespace Dzeparac\Http\Controllers\Api\Child;

use Dzeparac\Child;
use Illuminate\Http\Request;
use Dzeparac\Http\Controllers\Controller;

class LoginController extends Controller
{
    /**
     * @param Request $request
     * @return array
     */
    public function login(Request $request)
    {
        if($request->has("id"))
          return ["data" => Child::findOrFail($request->get("id"))];

        $child = Child::whereCode($request->get("code", "1"))->first();

        if( is_null($child) ) {
            return ["error" => "Pogrešna lozinka"];
        }

        return ["data" => $child];
    }
}
