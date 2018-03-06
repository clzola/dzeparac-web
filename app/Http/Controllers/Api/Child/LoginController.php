<?php

namespace App\Http\Controllers\Api\Child;

use App\Child;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LoginController extends Controller
{
    /**
     * @param Request $request
     * @return array
     */
    public function login(Request $request)
    {
        $child = Child::whereCode($request->get("code", "1"))->first();

        if( is_null($child) ) {
            return ["error" => "Pogrešna lozinka"];
        }

        return ["data" => $child];
    }
}
