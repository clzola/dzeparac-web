<?php

namespace Dzeparac\Http\Controllers\Api;

use Dzeparac\Category;
use Illuminate\Http\Request;
use Dzeparac\Http\Controllers\Controller;

class CategoriesController extends Controller
{
	/**
	 * @return \Illuminate\Database\Eloquent\Collection|static[]
	 * @throws \Illuminate\Auth\Access\AuthorizationException
	 */
    public function index() 
    {
        $this->authorize('index', Category::class);

        return Category::all();
    }
}
