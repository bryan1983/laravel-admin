# Simple Table Builder

Laravel admin comes with a simple table builder for eloquent models, the idea for this is to have a fast way to create a simple table for a model without having to worry about the markup, you may use it, you may not, but it can come handy sometimes.

First thing you need to do is add 2 methods to your eloquent model.

```php
    // This method will give the heading columns the text they need.
    public function getFields(){
        return [
            'ID', 'Name', 'Slug', 'Description'
        ];
    }
    // This method will give the rows the information from the model, you can format the data however you want
    public function getRows(){
        $data = [];
        $this->get()->each(function($rol) use (&$data){
            $data[] = [
                'id' => $rol->id,
                'name' => $rol->display_name,
                'slug' => $rol->name,
                'description' => $rol->description
            ];
        });
        return $data;
    }
```

Once you have this methods in your model, use the TableBuilder class to generate the table from the controller:

```php
    use Joselfonseca\LaravelAdmin\Services\TableBuilder\TableBuilder;
     
    public function index(TableBuilder $table)
       {
           $table->setActions([
               'edit' => [
                   'link' => url('backend/permissions/-id-/edit/'), // the -id- wildcard will be replace for the resource ID
                   'text' => '<i class="fa fa-pencil"></i> ' . trans('LaravelAdmin::laravel-admin.edit'),
                   'class' => 'btn btn-primary btn-sm',
               ],
               'delete' => [
                   'link' => url('backend/permissions/-id-/delete'), // the -id- wildcard will be replace for the resource ID
                   'text' => '<i class="fa fa-times"></i> ' . trans('LaravelAdmin::laravel-admin.delete'),
                   'class' => 'btn btn-danger btn-sm confirm', // add the class confirm so when the button is clicked it will prompt the user to confirm the action before sending him/her to the link
               ],
           ]);
           return view('LaravelAdmin::permissions.index')
               ->with('table', $table->setModel($this->model)->render())
               ->with('activeMenu', 'sidebar.Users.Permissions');
       }
```
The setModel method of the table builder receives a new instance of the model you want to generate the table for.

The render method will return the HTML of the table.

## Example

### Permissions Model.

```php
    <?php
     
    namespace Joselfonseca\LaravelAdmin\Services\Users;
     
    use Zizaco\Entrust\EntrustPermission as Model;
     
    class Permission extends Model
    {
     
       protected $fillable = ['display_name', 'name', 'description'];
     
       public function getFields(){
            return [
               'ID', 'Name', 'Slug', 'Description'
            ];
        }
         
        public function getRows(){
           $data = [];
           $this->get()->each(function($rol) use (&$data){
              $data[] = [
                 'id' => $rol->id,
                 'name' => $rol->display_name,
                 'slug' => $rol->name,
                 'description' => $rol->description
              ];
           });
            return $data;
        }
     
    }
```

### Controller

```php
    <?php
     
    namespace Joselfonseca\LaravelAdmin\Http\Controllers\Users;
     
    use Joselfonseca\LaravelAdmin\Http\Controllers\Controller;
    use Joselfonseca\LaravelAdmin\Services\Users\Permission;
    use Joselfonseca\LaravelAdmin\Services\TableBuilder\TableBuilder;
    use Illuminate\Http\Request;
     
    class PermissionsController extends Controller
    {
       private $model;
     
       public function __construct(Permission $p)
       {
          $this->model = $p;
       }
     
       public function index(TableBuilder $table)
        {
           $table->setActions([
                'edit' => [
                    'link' => url('backend/permissions/-id-/edit/'),
                    'text' => '<i class="fa fa-pencil"></i> ' . trans('LaravelAdmin::laravel-admin.edit'),
                    'class' => 'btn btn-primary btn-sm',
                ],
                'delete' => [
                    'link' => url('backend/permissions/-id-/delete'),
                    'text' => '<i class="fa fa-times"></i> ' . trans('LaravelAdmin::laravel-admin.delete'),
                    'class' => 'btn btn-danger btn-sm confirm',
                    'confirm' => true,
                ],
            ]);
            return view('LaravelAdmin::permissions.index')
               ->with('table', $table->setModel($this->model)->render())
                ->with('activeMenu', 'sidebar.Users.Permissions');
        }
    }
```

### View

```html
    @extends('LaravelAdmin::layouts.withsidebar')
    @section('pageTitle')
    {{isset($pageTitle) ? $pageTitle : 'Permissions'}}
    @endsection
    @section('content')
     
    <div class="container-fluid admin">
       <div class="panel panel-primary">
          <div class="panel-heading">
             {{trans('LaravelAdmin::laravel-admin.permissionsListTitle')}}
          </div>
          <div class="panel-body">
             <div class="row">
                  <div class="col-lg-10">
                     @include('flash::message')
                  </div>
                  <div class="col-lg-2">
                     <a href="{{route('LaravelAdminPermissionsCreate')}}" class="btn btn-block btn-primary"><i class="fa fa-plus"></i> {{trans('LaravelAdmin::laravel-admin.createPermissionTitle')}}</a>
                  </div>
               </div>
               <hr />
             {!! $table !!}
          </div>
       </div>
    </div>
     
    @endsection    
```