<div class="navbar navbar-inverse navbar-fixed-top">
  <div class="container">
    <div class="navbar-header">
      <a href="#" class="navbar-brand">{{config('laravel-admin.appName')}}</a>
      <button class="navbar-toggle" type="button" data-toggle="collapse" data-target="#navbar-main">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
    </div>
    <div class="navbar-collapse collapse" id="navbar-main">
      <ul class="nav navbar-nav">
        
      </ul>
      <ul class="nav navbar-nav navbar-right">
          @if (!Auth::guest())
          <li class="dropdown">
              <a href="#" class="navbar-profile dropdown-toggle text-bold" data-toggle="dropdown" role="button" aria-expanded="false">{{ Auth::user()->name }}<span class="caret"></span></a>
              <ul class="dropdown-menu" role="menu">
                  <li><a href="{{ route('LaravelAdminUpdateMe') }}">{{trans('LaravelAdmin::laravel-admin.editMyProfile')}}</a></li>
                  <li><a href="{{ route('LaravelAdminLogout') }}">{{trans('LaravelAdmin::laravel-admin.LogoutText')}}</a></li>
              </ul>
          </li>
          @endif
      </ul>
    </div>
  </div>
</div>