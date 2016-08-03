<?php

namespace Joselfonseca\LaravelAdmin\Http\Controllers;

use Illuminate\Http\Request;
use Joselfonseca\LaravelAdmin\Http\Controllers\Controller;
use Joselfonseca\LaravelAdmin\Http\Middleware\AuthMiddleware;

/**
 * Class HomeController
 * @package Joselfonseca\LaravelAdmin\Http\Controllers
 */
class HomeController extends Controller
{

    /**
     * HomeController constructor.
     */
    public function __construct()
    {
        $this->middleware(AuthMiddleware::class);
    }

    /**
     * @return $this
     */
    public function index()
    {
        return view('LaravelAdmin::home.home')->with('activeMenu', 'sidebar.Dashboard');
    }
}
