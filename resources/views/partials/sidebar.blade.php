<section class="sidebar">
    <div class="user-panel">
        <div class="pull-left image">
            <img src="//{{'www.gravatar.com/avatar/'.md5(Auth::user()->email)}}" class="img-circle" alt="{{ Auth::user()->name }}">
        </div>
        <div class="pull-left info">
            <p>{{ Auth::user()->name }}</p>
            <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
    </div>
    <ul class="sidebar-menu">
        @if(isset($activeMenu))
        {!! $menu->render('sidebar', $activeMenu) !!}
        @else
        {!! $menu->render('sidebar') !!}
        @endif
    </ul>
</section>