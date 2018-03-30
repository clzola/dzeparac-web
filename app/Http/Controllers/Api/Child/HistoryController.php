<?php

namespace Dzeparac\Http\Controllers\Api\Child;

use Dzeparac\Child;
use Dzeparac\HistoryEntry;
use Dzeparac\Http\Controllers\Controller;
use Dzeparac\Http\Requests\Api\Child\CreateHistoryEntryRequest;
use Dzeparac\Http\Requests\Api\Child\UpdateHistoryEntryRequest;
use Illuminate\Http\Request;

class HistoryController extends Controller
{
	/**
	 * @param Request $request
	 *
	 * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
	 */
    public function index(Request $request)
    {
    	$child = \Auth::user();

        $query = HistoryEntry::with(['category', 'wish', 'wish.tasks'])
                             ->latest()
                             ->whereChildId($child->id);

        if($request->has('category_id')) {
            $categoryId = intval($request->get('category_id'));
            if($categoryId > 0)
                $query->whereCategoryId($request->get('category_id'));
            else $query->whereNull('category_id');
        }

        return $query->paginate();
    }


	/**
	 * @param CreateHistoryEntryRequest $request
	 *
	 * @return array
	 * @throws \Exception
	 * @throws \Illuminate\Auth\Access\AuthorizationException
	 * @throws \Throwable
	 */
    public function store(CreateHistoryEntryRequest $request)
    {
	    $this->authorize('create', HistoryEntry::class);

    	return \DB::transaction(function() use ($request) {
	        $child = \Auth::user();
	        $entry = new HistoryEntry($request->only(['name', 'category_id', 'price', 'notes']));

		    $entry->photo_filename = basename($request->file('photo')->store('public/history/images'));
	        $entry->child_id = $child->id;
	        $entry->save();

	        $child->money -= $entry->price;
	        $child->save();

	        $entry->load('category');

	        return $entry;
	    });
    }


	/**
	 * @param HistoryEntry $entry
	 *
	 * @return HistoryEntry
	 * @throws \Illuminate\Auth\Access\AuthorizationException
	 */
    public function show(HistoryEntry $entry)
    {
	    $this->authorize('show', HistoryEntry::class);

        $entry->load(['category', 'wish', 'wish.tasks']);

        return $entry;
    }


	/**
	 * @param UpdateHistoryEntryRequest $request
	 * @param HistoryEntry $entry
	 *
	 * @return array
	 * @throws \Exception
	 * @throws \Illuminate\Auth\Access\AuthorizationException
	 * @throws \Throwable
	 */
    public function update(UpdateHistoryEntryRequest $request, HistoryEntry $entry)
    {
	    $this->authorize('update', HistoryEntry::class);

	    return \DB::transaction(function() use ($request, $entry) {
            $entry->fill($request->only(['name', 'category_id', 'price', 'notes']));

            if($request->hasFile('photo'))
	            $entry->photo_filename = basename($request->file('photo')->store('public/history/images'));

            $entry->save();
            $entry->load("category");

            return $entry;
	    });
    }
}
