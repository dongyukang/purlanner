<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DongyuKang\PurdueCourse\Facades\Purdue;

class HomeController extends Controller
{

    /**
     * Default to welcome page
     */
    public function index()
    {
      return view('welcome');
    }

  
}
