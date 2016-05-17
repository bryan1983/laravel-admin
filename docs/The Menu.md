# Laravel Admin Menu

## Adding a menu to the sidebar

Laravel Admin has a menu that you can customize, to do that just add to your service provider the following code in the boot method.

```php
    $menu = $this->app->make('admin.menu');
    $menu->addMenu([
        'Courses' => [
            'link' => [
                'link' => '#',
                'text' => '<i class="fa fa-book fa-lg"></i> Cursos',
            ],
            'permissions' => ['administrador-de-cursos'],
            'submenus' => [
                'List' => [
                    'link' => [
                        'link' => 'backend/courses',
                        'text' => 'Listado',
                    ],
                    'permissions' => ['administrador-de-cursos'],
                ]
            ]
        ]
    ]);
```

The Menu array contains another array which is sidebar, this is meant to be the sidebar menu, in it there is another array, each key in that array represents a menu item and its structure is the following

```php
    'Dashboard' => [ //this is the key that identify the menu item
        'link' => [// this is what we use to build the link
            'link' => 'backend/home', // the URI to go to, this is placed inside a url() helper
            'text' => '<i class="fa fa-dashboard fa-lg"></i> Dashboard', // The text to display in the link, you can use font-awesome icons
        ],
        'permissions' => [] // array with the permissions required to see the item, use the slugs. You can also pass false if you want the menu to be seen by everyone
        'submenus' => [] // array with the same structure as the parent, this will create a submenu.
    ]
```

You can add as many items as you need.

## Setting the active menu item

In the controllers you can set the current menu that should be mark as active, simply pass a variable called activeMenu to the view, the value should follow this pattern {sidebar}.{Item}.{Item}, for the avobe example should look something like this:

```php
    return view('LaravelAdmin::home.home')->with('activeMenu', 'sidebar.Dashboard');
```