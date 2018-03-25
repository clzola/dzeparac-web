<?php

namespace Dzeparac\Http\Controllers\Api\Parent;

use Dzeparac\Child;
use Dzeparac\Http\Controllers\Controller;
use Dzeparac\Wish;


class WishesController extends Controller
{
    public function wishes(Child $child)
    {

    	$wishes = $child->wishes()
	                    ->where('flag_fulfilled', false)
	                    ->with(['tasks', 'child', 'category'])
	                    ->get();

    	return [ "data" => $wishes ];
    }
}
