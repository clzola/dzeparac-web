<?php

namespace Dzeparac\Http\Controllers\Api\Parent;

use Dzeparac\Category;
use Illuminate\Http\Request;
use Dzeparac\Http\Controllers\Controller;

class CategoriesController extends Controller
{
    public function index() 
    {
        return ["data" => Category::all()];
    }
}
