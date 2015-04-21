<?php

namespace Joselfonseca\LaravelAdmin\Services\Menu;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Session;
use Joselfonseca\LaravelAdmin\Services\Acl\AclManager;

/**
 * Description of MenuBuilder
 *
 * @author desarrollo
 */
class MenuBuilder {

    public $items;
    public $acl;
    public $frontMenu;

    public function __construct(AclManager $acl) {
        $this->acl = $acl;
        $this->items = [
            'sidebar' => [],
            'topnav' => [],
            'user' => []
        ];
    }

    protected function setItems() {
        if (isset($this->frontMenu['sidebar'])) {
            $this->setMenuItem($this->frontMenu['sidebar'], 'sidebar');
        }
        if (isset($this->frontMenu['topnav'])) {
            $this->setMenuItem($this->frontMenu['topnav'], 'topnav');
        }
        if (isset($this->frontMenu['user'])) {
            $this->setMenuItem($this->frontMenu['user'], 'user');
        }
    }

    protected function parseMenu($menu) {
        $tree = [];
        foreach ($menu as $item) {
            if ($this->checkPermission($item)) {
                $tree[] = $this->parseMenuItem($item);
            }
        }
        return $tree;
    }

    protected function checkPermission($item) {
        $can_see = true;
        if (isset($item['permissions']) && is_array($item['permissions'])) {
            foreach ($item['permissions'] as $permission) {
                if ($this->acl->canSee($permission)) {
                    $can_see = true;
                    continue;
                }
            }
            return $can_see;
        }
        return $can_see;
    }

    protected function parseMenuItem($item) {
        $hrefClass = isset($item['link']['class']) ? $item['link']['class'] : '';
        $hrefExtra = isset($item['link']['extra']) ? $item['link']['extra'] : '';
        $liclass = isset($item['li']['class']) ? $item['li']['class'] : '';
        $return = '<li class="' . $liclass . '"><a href="' . $item['link']['link'] . '" class="' . $hrefClass . '" ' . $hrefExtra . '>' . $item['link']['text'] . '</a>';
        if (isset($item['submenus'])) {
            $ulClass = isset($item['ul_submenu_class']) ? $item['ul_submenu_class'] : '';
            $return .= '<ul class="' . $ulClass . '">';
            foreach ($item['submenus'] as $submenu) {
                if ($this->checkPermission($submenu)) {
                    $return .= $this->parseMenuItem($submenu);
                }
            }
            $return .= "</ul>";
        }
        $return .= '</li>';
        return $return;
    }

    public function setMenuItem(array $items = [], $group = 'sidebar') {
        if (!isset($this->items[$group])) {
            throw new \Exception("The group especified does not exists");
        }
        $this->items[$group] = array_merge($this->items[$group], $items);
    }

    public function render($group = 'sidebar', $active = null) {
        $this->setActiveMenu($active);
        if (!isset($this->items[$group])) {
            throw new \Exception("The group especified does not exists");
        }
        $menu = $this->items[$group];
        $string = "";
        foreach($this->parseMenu($menu) as $m){
            $string .= $m;
        }
        return $string;
    }

    protected function setSingleMenuActive($menu) {
        if (isset($this->items[$menu[0]][$menu[1]])) {
            if (isset($this->items[$menu[0]][$menu[1]]['li']['class'])) {
                $this->items[$menu[0]][$menu[1]]['li']['class'] = $this->items[$menu[0]][$menu[1]]['li']['class'] . ' active expanded';
            } else {
                $this->items[$menu[0]][$menu[1]]['li']['class'] = " active expanded";
            }
        }
    }

    protected function setSubMenuActive($menu, $submenu = false) {
        $this->setSingleMenuActive($menu);
        if (isset($this->items[$menu[0]][$menu[1]]['submenus'][$menu[2]])) {
            if ($submenu === true) {
                if (isset($this->items[$menu[0]][$menu[1]]['submenus'][$menu[2]]['li']['class'])) {
                    $this->items[$menu[0]][$menu[1]]['submenus'][$menu[2]]['li']['class'] = $this->items[$menu[0]][$menu[1]]['submenus'][$menu[2]]['li']['class'] . ' expanded';
                } else {
                    $this->items[$menu[0]][$menu[1]]['submenus'][$menu[2]]['li']['class'] = ' expanded';
                }
            } else {
                if (isset($this->items[$menu[0]][$menu[1]]['submenus'][$menu[2]]['link']['class'])) {
                    $this->items[$menu[0]][$menu[1]]['submenus'][$menu[2]]['link']['class'] = $this->items[$menu[0]][$menu[1]]['submenus'][$menu[2]]['link']['class'] . ' active';
                } else {
                    $this->items[$menu[0]][$menu[1]]['submenus'][$menu[2]]['link']['class'] = 'active';
                }
            }
        }
    }

    protected function setSubSubMenuActive($menu) {
        $this->setSingleMenuActive($menu);
        $this->setSubMenuActive($menu, true);
        if (isset($this->items[$menu[0]][$menu[1]]['submenus'][$menu[2]]['submenus'][$menu[3]])) {
            if (isset($this->items[$menu[0]][$menu[1]]['submenus'][$menu[2]]['submenus'][$menu[3]]['li']['class'])) {
                $this->items[$menu[0]][$menu[1]]['submenus'][$menu[2]]['submenus'][$menu[3]]['link']['class'] = $this->items[$menu[0]][$menu[1]]['submenus'][$menu[2]]['submenus'][$menu[3]]['link']['class'] . ' active';
            } else {
                $this->items[$menu[0]][$menu[1]]['submenus'][$menu[2]]['submenus'][$menu[3]]['link']['class'] = 'active';
            }
        }
    }

    public function setActiveMenu($name) {
        if(!empty($name)){
            $menu = explode('.', $name);
            if (count($menu) === 2) {
                $this->setSingleMenuActive($menu);
            }
            if (count($menu) === 3) {
                $this->setSubMenuActive($menu);
            }
            if (count($menu) === 4) {
                $this->setSubSubMenuActive($menu);
            }
        }
    }
    
    public function setMenu($menu){
        $this->frontMenu = $menu;
        $this->setItems();

    }

}
