<?php

namespace Joselfonseca\LaravelAdmin\Http\Controllers;

use CsdMarket\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Joselfonseca\LaravelAdmin\Services\Menu\MenuBuilder;

class HomeController extends Controller{

	private $m;

	public function __construct(MenuBuilder $m){
		$this->m = $m;
	}

	public function index(){
		return view('LaravelAdmin::home.home')->with('activeMenu', 'sidebar.Dashboard');
	}

}