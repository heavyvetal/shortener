<?php

namespace App\Http\Controllers;

class HomeController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        return view('index');
    }
}
