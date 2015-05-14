<?php

namespace Joselfonseca\LaravelAdmin\Http\Controllers;

use Joselfonseca\LaravelAdmin\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller{

	public function index(){
		return view('LaravelAdmin::home.home')->with('activeMenu', 'sidebar.Dashboard');
	}
}
