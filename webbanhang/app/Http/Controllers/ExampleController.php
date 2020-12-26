<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ExampleController extends Controller
{
    public function Mainview() {
        
         return view('backend.layouts.master');
    }
}
