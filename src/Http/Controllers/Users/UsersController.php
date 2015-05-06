<?php

namespace Joselfonseca\LaravelAdmin\Http\Controllers\Users;

use Joselfonseca\LaravelAdmin\Http\Controllers\Controller;
use Joselfonseca\LaravelAdmin\Models\User;

/**
 * Description of UsersController
 *
 * @author jfonseca
 */
class UsersController extends Controller {

    public function index()
    {
    	$users = User::paginate(20);
		return view('LaravelAdmin::users.index')->with('user', $users)->with('activeMenu', 'sidebar.Users.List');    	    
    }

}
