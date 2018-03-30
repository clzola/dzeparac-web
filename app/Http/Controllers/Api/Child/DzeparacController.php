<?php

namespace Dzeparac\Http\Controllers\Api\Child;

use Dzeparac\Child;
use Dzeparac\HistoryEntry;
use Dzeparac\Http\Requests\Api\Child\AddMoneyRequest;
use Dzeparac\User;
use Illuminate\Http\Request;
use Dzeparac\Http\Controllers\Controller;

class DzeparacController extends Controller
{


	/**
	 * @return double
	 * @throws \Illuminate\Auth\Access\AuthorizationException
	 */
    public function status()
    {
    	$this->authorize('moneyStatus', User::class);

        return auth()->user()->money;
    }


	/**
	 * @param AddMoneyRequest $request
	 *
	 * @return HistoryEntry
	 * @throws \Exception
	 * @throws \Illuminate\Auth\Access\AuthorizationException
	 * @throws \Throwable
	 */
    public function add(AddMoneyRequest $request)
    {
    	$this->authorize('addMoney', User::class);

    	return \DB::transaction(function() use ($request) {

    	    $child = \Auth::user();

	        $child->money += doubleval($request->get('money'));
	        $child->save();

	        $entry = $entry = new HistoryEntry($request->only(['money', 'notes']));
	        $entry->name = 'Džeparac';
	        $entry->child_id = $child->id;
	        $entry->save();

            return $entry;
	    });
    }
}
