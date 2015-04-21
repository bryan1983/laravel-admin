<div class="nav-side-menu">
    <i class="fa fa-bars fa-2x toggle-btn" data-toggle="collapse" data-target="#menu-content"></i>
    <div class="menu-list">
    <ul id="menu-content" class="menu-content collapse out">
      @if(isset($activeMenu))
        {!! $menu->render('sidebar', $activeMenu) !!}
      @else
        {!! $menu->render('sidebar') !!}
      @endif  
    </ul>
  </div>
</div>