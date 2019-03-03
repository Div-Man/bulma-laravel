<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Category;
use App\Image;
use App\SubCategory;

class MainController extends Controller
{
    public function index()
    {
        return view('index');
    }
    
}
