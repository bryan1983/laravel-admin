<?php 

namespace Joselfonseca\LaravelAdmin\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Kodeine\Acl\Traits\HasRole;

class User extends BaseModel implements AuthenticatableContract, CanResetPasswordContract{

	use Authenticatable,
        CanResetPassword,
        HasRole;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'email', 'password'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    public function getFields() {
        return [
            'ID', trans('LaravelAdmin::laravel-admin.userName'), trans('LaravelAdmin::laravel-admin.userEmail')
        ];
    }

    public function getRows() {
        $data = [];
        $this->get()->each(function($row) use(&$data) {
            $data[] = [
                'id' => $row->id,
                'name' => $row->name,
                'email' => $row->email,
            ];
        });
        return $data;
    }

    public function getRolesForSelect()
    {
        $data = [];
        $this->roles->each(function($role) use (&$data){
            $data[] = $role->id;
        });
        //dd($data);
        return $data;
    }

}