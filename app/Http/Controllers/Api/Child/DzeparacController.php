<?php

namespace Dzeparac\Http\Controllers\Api\Child;

use Dzeparac\Child;
use Dzeparac\HistoryEntry;
use Illuminate\Http\Request;
use Dzeparac\Http\Controllers\Controller;

class DzeparacController extends Controller
{
    /** @var Child */
    private $child;


    /**
     * DzeparacController constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->child = $request->get("user");
    }


    /**
     * @return array
     */
    public function index()
    {
        return ["data" => $this->child->money];
    }


    /**
     * @param Request $request
     * @return array
     */
    public function add(Request $request)
    {
        $this->child->money += doubleval($request->get('price'));
        $this->child->save();

        $entry = $entry = new HistoryEntry($request->only(['price', 'notes']));
        $entry->name = 'Džeparac';
        $entry->child_id = $this->child->id;
        $entry->save();

        return [ "data" => $entry ];
    }
}
