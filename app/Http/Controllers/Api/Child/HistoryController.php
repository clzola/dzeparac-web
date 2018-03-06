<?php

namespace App\Http\Controllers\Api\Child;

use App\Child;
use App\HistoryEntry;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HistoryController extends Controller
{
    /** @var Child */
    private $child;


    /**
     * HistoryController constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->child = $request->get("child");
    }


    /**
     * @param Request $request
     * @return array
     */
    public function index(Request $request)
    {
        $query = HistoryEntry::with(['category', 'wish', 'wish.tasks'])
                             ->whereChildId($this->child->id);

        if($request->has('category_id')) {
            $categoryId = intval($request->get('category_id'));
            if($categoryId > 0)
                $query->whereCategoryId($request->get('category_id'));
            else $query->whereNull('category_id');
        }

        return ["data" => $query->paginate(15)->items()];
    }


    /**
     * @param Request $request
     * @return array
     */
    public function store(Request $request)
    {
        $entry = new HistoryEntry($request->only(['name', 'category_id', 'price', 'notes']));
        $filename = basename($request->file('photo')->store('public/history/photos'));
        $entry->photo_url = "http://dzeparac.test/storage/history/photos/{$filename}";
        $entry->child_id = $this->child->id;
        $entry->save();

        return ["data" => $entry];
    }


    /**
     * @param HistoryEntry $entry
     * @return array
     */
    public function show(HistoryEntry $entry)
    {
        $entry->load(['category', 'wish', 'wish.tasks']);
        return ["data" => $entry];
    }


    /**
     * @param Request $request
     * @param HistoryEntry $entry
     * @return array
     */
    public function update(Request $request, HistoryEntry $entry)
    {
        $entry->fill($request->only(['name', 'category_id', 'price', 'notes']));

        if($request->hasFile('photo')) {
            $filename = basename($request->file('photo')->store('public/history/photos'));
            $entry->photo_url = "http://dzeparac.test/storage/history/photos/{$filename}";
        }

        $entry->save();
        return ["data" => $entry];
    }
}
