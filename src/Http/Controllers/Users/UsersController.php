<?php

namespace Joselfonseca\LaravelAdmin\Http\Controllers\Users;

use Joselfonseca\LaravelAdmin\Http\Controllers\Controller;
use Joselfonseca\LaravelAdmin\Models\User;
use Joselfonseca\LaravelAdmin\Services\TableBuilder\TableBuilder;

/**
 * Description of UsersController
 *
 * @author jfonseca
 */
class UsersController extends Controller {

    public function index(TableBuilder $table)
    {
    	$table->setActions([
            'edit' => [
                'link' => url('AclManager/role/edit/-id-'),
                'text' => '<i class="fa fa-pencil"></i> Editar',
                'class' => 'btn btn-primary btn-sm'
            ],
            'permissions' => [
                'link' => url('AclManager/role/edit/-id-'),
                'text' => '<i class="fa fa-lock"></i> Permisos',
                'class' => 'btn btn-default btn-sm'
            ],
            'delete' => [
                'link' => url('AclManager/role/delete/-id-'),
                'text' => '<i class="fa fa-times"></i> Eliminar',
                'class' => 'btn btn-danger btn-sm logic-delete',
                'confirm' => true
            ]
        ]);
		return view('LaravelAdmin::users.index')->with('table', $table->setModel(new User())->render())->with('activeMenu', 'sidebar.Users.List');    	    
    }

}
