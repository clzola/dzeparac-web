<?php

namespace Dzeparac\Http\Middleware\Api;

use Dzeparac\Child;
use Dzeparac\Parentt;
use Closure;

class XUserMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user = null;
        $xUserHeader = $request->header('X-User', null);

        if(!is_null($xUserHeader)) {
            $auth = explode(':', $xUserHeader);
            if($auth[0] === "parent")
                $user = Parentt::findOrFail($auth[1]);
            else $user = Child::findOrFail($auth[1]);
            $request->attributes->add(["user" => $user]);
        }

        return $next($request);
    }
}
