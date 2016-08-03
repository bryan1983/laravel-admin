<?php

namespace Joselfonseca\LaravelAdmin\Http\Controllers;

/**
 * Class HomeController
 * @package Joselfonseca\LaravelAdmin\Http\Controllers
 */
class HomeController extends Controller
{

    /**
     * @return $this
     */
    public function index()
    {
        return view('LaravelAdmin::home.home')->with('activeMenu', 'sidebar.Dashboard');
    }
}
