# Using the master view with the sidebar

You have access to the master layout of the admin panel to create your own interfaces, in your blade template simply extend LaravelAdmin::layouts.withsidebar and use Bootstrap classes for your markup.

Example blank page:

```html
    @extends('LaravelAdmin::layouts.withsidebar')
    @section('pageTitle')
    {{isset($pageTitle) ? $pageTitle : "Home"}}
    @endsection
    @section('content')
     
    @endsection
```