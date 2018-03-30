<?php

namespace Dzeparac\Http\Controllers\Api\Parent;

use Dzeparac\Child;
use Dzeparac\Http\Requests\Api\Parent\CreateChildRequest;
use Dzeparac\Http\Requests\Api\Parent\UpdateChildRequest;
use Dzeparac\Support\UserProvider;
use Dzeparac\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use Dzeparac\Http\Controllers\Controller;

class ChildrenController extends Controller
{
	/**
	 * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Support\Collection|static[]
	 * @throws AuthorizationException
	 */
    public function children()
    {
    	$this->authorize('children', User::class);

		return User::whereParentId(auth()->id())->get();
    }


	/**
	 * @param CreateChildRequest $request
	 *
	 * @return User
	 * @throws AuthorizationException
	 */
    public function store(CreateChildRequest $request)
    {
		$this->authorize('addChild', User::class);

    	$child = new User($request->all());
	    $child->photo_filename = $request->file('photo')->store('public/children/images');
    	$child->parent_id = auth()->id();
    	$child->code = strtoupper(str_random(6));
    	$child->save();

    	return $child;
    }

	/**
	 * @param User $child
	 *
	 * @return User
	 * @throws AuthorizationException
	 */
	public function child(User $child)
	{
		$this->authorize('showChild', $child);

		return $child;
	}


	/**
	 * @param UpdateChildRequest $request
	 * @param User $child
	 *
	 * @return User
	 */
    public function update(UpdateChildRequest $request, User $child)
    {
		$child->name = $request->get('name');

		if( $request->has("photo") )
			$child->photo_filename = $request->file('photo')->store('public/children/images');

	    $child->save();

	    return $child;
    }
}
