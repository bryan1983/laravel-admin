<?php

namespace Joselfonseca\LaravelAdmin\Http\Controllers;

use CsdMarket\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller{

	public function index(){
		return "home";
	}

}