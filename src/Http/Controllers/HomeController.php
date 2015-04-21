<?php

namespace Joselfonseca\LaravelAdmin\Http\Controllers;

use CsdMarket\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Joselfonseca\LaravelAdmin\Services\Menu\MenuBuilder;

class HomeController extends Controller{

	public function index(MenuBuilder $m){
		$m->setActiveMenu('sidebar.Dashboard');
		return view('LaravelAdmin::home.home');
	}

}