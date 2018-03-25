<?php

namespace Dzeparac\Http\Controllers\Api\Parent;

use Dzeparac\HistoryEntry;
use Dzeparac\Child;
use Illuminate\Http\Request;
use Dzeparac\Http\Controllers\Controller;

class HistoryEntriesController extends Controller
{
    public function history(Child $child, Request $request)
    {
        $query = HistoryEntry::query()
                    ->latest()
                    ->with(["child", "wish", "category", "wish.tasks"]);

        if( $request->has('category_id') ) {
            $categoryId = intval($request->get("category_id"));
            if( $categoryId <= 0 )
                $query->whereNull("category_id");
            else $query->whereCategoryId($categoryId);
        }

        return [ "data" => $query->paginate()->all() ];
    }
}
