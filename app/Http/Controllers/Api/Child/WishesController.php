<?php

namespace Dzeparac\Http\Controllers\Api\Child;

use Dzeparac\Child;
use Dzeparac\Http\Requests\Api\Child\CreateWishRequest;
use Dzeparac\Http\Requests\Api\Child\UpdateWishRequest;
use Dzeparac\Wish;
use Illuminate\Http\Request;
use Dzeparac\Http\Controllers\Controller;

class WishesController extends Controller
{

    /**
     * @return array
     */
    public function index()
    {
    	$child = \Auth::user();

        $wishes = $child->wishes()
	                    ->with(['tasks', 'category'])
	                    ->fulfilled(false)
                        ->get();

        return $wishes;
    }


	/**
	 * @param CreateWishRequest $request
	 *
	 * @return Wish
	 * @throws \Illuminate\Auth\Access\AuthorizationException
	 */
    public function store(CreateWishRequest $request)
    {
    	$this->authorize('create', Wish::class);

    	$child = \Auth::user();

        $wish = new Wish($request->only(['name', 'category_id', 'price', 'notes']));
	    $wish->photo_filename = basename($request->file('photo')->store('public/wishes/images'));
        $wish->child_id = $child->id;
        $wish->save();

        $wish->setRelation("tasks", collect());

        return $wish;
    }


	/**
	 * @param Wish $wish
	 *
	 * @return Wish
	 * @throws \Illuminate\Auth\Access\AuthorizationException
	 */
    public function show(Wish $wish)
    {
	    $this->authorize('show', $wish);

        $wish->load("tasks");
        return $wish;
    }


	/**
	 * @param UpdateWishRequest $request
	 * @param Wish $wish
	 *
	 * @return Wish
	 * @throws \Illuminate\Auth\Access\AuthorizationException
	 */
    public function update(UpdateWishRequest $request, Wish $wish)
    {
    	$this->authorize('update', $wish);

        $wish->fill($request->only(['name', 'category_id', 'price', 'notes']));

        if($request->hasFile('photo'))
	        $wish->photo_filename = basename($request->file('photo')->store('public/wishes/images'));

        $wish->save();
        $wish->load('tasks');

        return $wish;
    }
}
