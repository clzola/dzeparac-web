<?php

namespace App\Http\Controllers\Api\Child;

use App\Child;
use App\Wish;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class WishesController extends Controller
{
    /** @var Child */
    private $child;


    /**
     * WishesController constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->child = $request->get('user');
    }


    /**
     * @return array
     */
    public function index(Request $request)
    {
        $wishes = $this->child->wishes()->where('flag_fulfilled', false)->with(['tasks', 'category'])->get();
        return [ "data" => $wishes ];
    }


    /**
     * @param Request $request
     * @return array
     */
    public function store(Request $request)
    {
        $wish = new Wish($request->only(['name', 'category_id', 'price', 'notes']));
        $filename = basename($request->file('photo')->store('public/wishes/photos'));
        $wish->photo_url = "http://dzeparac.test/storage/wishes/photos/{$filename}";
        $wish->child_id = $this->child->id;
        $wish->save();

        $wish->setRelation("tasks", collect());
        return ["data" => $wish];
    }


    /**
     * @param Wish $wish
     * @return array
     */
    public function show(Wish $wish)
    {
        $wish->load("tasks");
        return ["data" => $wish];
    }


    /**
     * @param Request $request
     * @param Wish $wish
     * @return array
     */
    public function update(Request $request, Wish $wish)
    {
        $wish->fill($request->only(['name', 'category_id', 'price', 'notes']));

        if($request->hasFile('photo')) {
            $filename = basename($request->file('photo')->store('public/wishes/photos'));
            $wish->photo_url = "http://dzeparac.test/storage/wishes/photos/{$filename}";
        }

        $wish->save();
        $wish->load('tasks');

        return ["data" => $wish];
    }
}
