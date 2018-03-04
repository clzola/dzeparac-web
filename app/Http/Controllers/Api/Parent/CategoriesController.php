<?php

namespace App\Http\Controllers\Api\Parent;

use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoriesController extends Controller
{
    public function index() 
    {
        return ["data" => Category::all()];
    }
}
