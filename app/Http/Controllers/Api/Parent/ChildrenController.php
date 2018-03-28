<?php

namespace Dzeparac\Http\Controllers\Api\Parent;

use Dzeparac\Child;
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

		return User::whereParentId(auth()->id())->get()->map(function (User $user) {
			return [
				'id' => $user->id,
				'name' => $user->name,
				'photo_url' => $user->photo_url
			];
		});
    }


	/**
	 * @param Request $request
	 *
	 * @return array
	 * @throws AuthorizationException
	 */
    public function store(Request $request)
    {
		$this->authorize('addChild', User::class);

    	$child = new User($request->all());
    	$filename = $request->file('photo')->store('public/children/photos');

    	$child->parent_id = auth()->id();
    	$child->photo_filename = basename($filename);
    	$child->code = strtoupper(str_random(6));
    	$child->save();

    	return [
    		'id' => $child->id,
		    'name' => $child->name,
		    'photo_url' => $child->photo_url,
	    ];
    }

	/**
	 * @param User $child
	 *
	 * @return array
	 * @throws AuthorizationException
	 */
	public function child(User $child)
	{
		$this->authorize('showChild', $child);

		return [
			'id' => $child->id,
			'name' => $child->name,
			'photo_url' => $child->photo_url,
		];
	}


	/**
	 * @param Request $request
	 * @param User $child
	 *
	 * @return array
	 */
    public function update(Request $request, User $child)
    {

		$child->name = request('name');

		if( $request->has("photo") ) {
			$filename = $request->file('photo')->store('children/photos');
			$child->photo_filename = basename($filename);
		}

	    $child->save();

	    return [
		    'id' => $child->id,
		    'name' => $child->name,
		    'photo_url' => $child->photo_url,
	    ];
    }
}
