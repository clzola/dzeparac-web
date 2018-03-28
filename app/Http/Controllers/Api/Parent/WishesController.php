<?php

namespace Dzeparac\Http\Controllers\Api\Parent;

use Dzeparac\Child;
use Dzeparac\Http\Controllers\Controller;
use Dzeparac\User;
use Dzeparac\Wish;


class WishesController extends Controller
{

	/**
	 * @param User $child
	 *
	 * @return array
	 * @throws \Illuminate\Auth\Access\AuthorizationException
	 */
    public function wishes(User $child)
    {
    	$this->authorize('wishes', [Wish::class, $child]);

    	$wishes = $child->wishes()
	                    ->where('is_fulfilled', false)
	                    ->with(['tasks', 'child', 'category'])
	                    ->get();

    	return $wishes;
    }
}
