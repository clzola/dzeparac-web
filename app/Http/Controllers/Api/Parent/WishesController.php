<?php

namespace App\Http\Controllers\Api\Parent;

use App\Child;
use App\Http\Controllers\Controller;
use App\Wish;


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
