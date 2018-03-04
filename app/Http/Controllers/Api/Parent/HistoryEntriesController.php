<?php

namespace App\Http\Controllers\Api\Parent;

use App\HistoryEntry;
use App\Child;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
