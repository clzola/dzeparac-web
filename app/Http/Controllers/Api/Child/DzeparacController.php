<?php

namespace App\Http\Controllers\Api\Child;

use App\Child;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
}
