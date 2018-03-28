<?php

namespace Dzeparac\Http\Controllers\Api\Parent;

use Dzeparac\HistoryEntry;
use Dzeparac\Child;
use Dzeparac\User;
use Illuminate\Http\Request;
use Dzeparac\Http\Controllers\Controller;

class HistoryEntriesController extends Controller
{
	/**
	 * @param User $child
	 *
	 * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
	 * @throws \Illuminate\Auth\Access\AuthorizationException
	 */
    public function history(User $child)
    {
    	$this->authorize('history', [HistoryEntry::class, $child]);

        $query = HistoryEntry::query()
                    ->latest()
                    ->with(["child", "wish", "category", "wish.tasks"]);

        $categoryId = request('category_id', null);

        if( !is_null($categoryId) ) {
        	if($categoryId < 0)
        		$query->whereNull('category_id');
        	else $query->where('category_id', $categoryId);
        }

        return $query->paginate();
    }
}
