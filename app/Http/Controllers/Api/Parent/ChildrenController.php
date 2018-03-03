<?php

namespace App\Http\Controllers\Api\Parent;

use App\Child;
use App\Support\UserProvider;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ChildrenController extends Controller
{
	/**
	 * @param Request $request
	 *
	 * @return array
	 */
    public function children(Request $request)
    {
    	$parent = UserProvider::parentt($request);

    	$children = $parent->children->each(function (Child $child) {
    		$child->setAttribute('wishes_count', $child->wishes()->where('flag_fulfilled', false)->count());
		    $child->setAttribute('tasks_count', $child->tasks()->where('fulfilled', false)->count());
		    $child->setAttribute('completed_tasks_count', $child->tasks()->where('child_completed', true)->where('parent_completed', false)->count());
	    });

    	return [ "data" => $children ];
    }


	/**
	 * @param Request $request
	 * @param Child $child
	 *
	 * @return array
	 */
    public function child(Request $request, Child $child)
    {
    	return [ "data" => $child ];;
    }


	/**
	 * @param Request $request
	 *
	 * @return array
	 */
    public function store(Request $request)
    {
	    $parent = UserProvider::parentt($request);
    	$child = new Child();

    	$filename = basename($request->file('photo')->store('children/photos'));

    	$child->parent_id = $parent->id;
    	$child->name = $request->get('name');
    	$child->photo_url = "http://dzeparac.me/children/photos/{$filename}";
    	$child->code = str_random(10);
    	$child->save();

    	return [ "data" => $child ];
    }


	/**
	 * @param Request $request
	 * @param Child $child
	 *
	 * @return array
	 */
    public function update(Request $request, Child $child)
    {
	    $filename = basename($request->file('photo')->store('children/photos'));

	    $child->name = $request->get('name');
	    $child->photo_url = "http://dzeparac.me/children/photos/{$filename}";
	    $child->code = str_random(10);
	    $child->save();

	    return [ "data" => $child ];
    }
}
