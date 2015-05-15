<?php

namespace Joselfonseca\LaravelAdmin\Services\Menu;

use Joselfonseca\LaravelAdmin\Services\Acl\AclManager;

/**
 * Description of MenuBuilder
 *
 * @author desarrollo
 */
class MenuBuilder
{

    public $items;
    public $acl;
    public $frontMenu;

    public function __construct(AclManager $acl)
    {
        $this->acl = $acl;
        $this->items = [
            'sidebar' => [],
            'topnav' => [],
            'user' => [],
        ];
    }

    protected function setItems()
    {
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

    protected function parseMenu($menu)
    {
        $tree = [];
        foreach ($menu as $key => $item) {
            if ($this->checkPermission($item)) {
                $tree[] = $this->parseMenuItem($item, $key);
            }
        }
        return $tree;
    }

    protected function checkPermission($item)
    {
        $can_see = false;
        if (isset($item['permissions']) && is_array($item['permissions'])) {
            $can_see = $this->acl->canSee($item['permissions']);
        }
        return $can_see;
    }

    protected function parseMenuItem($item, $key)
    {
        $hrefClass = isset($item['link']['class']) ? $item['link']['class'] : '';
        $hrefExtra = isset($item['link']['extra']) ? $item['link']['extra'] : '';
        $liclass = isset($item['li']['class']) ? $item['li']['class'] : '';
        $sub = isset($item['submenus']) ? ' data-toggle="collapse" data-target="#' . $key . '"' : '';
        $link = ($item['link']['link'] == '#') ? '#' : url($item['link']['link']);
        $return = '<li class="' . $liclass . '"' . $sub . '><a href="' . $link . '" class="' . $hrefClass . '" ' . $hrefExtra . '>' . $item['link']['text'] . '</a>';
        if (isset($item['submenus'])) {
            $ulClass = isset($item['ul_submenu_class']) ? $item['ul_submenu_class'] : 'collapse';
            $return .= '<ul class="sub-menu ' . $ulClass . '" id="' . $key . '">';
            foreach ($item['submenus'] as $key => $submenu) {
                if ($this->checkPermission($submenu)) {
                    $return .= $this->parseMenuItem($submenu, $key);
                }
            }
            $return .= "</ul>";
        }
        $return .= '</li>';
        return $return;
    }

    public function setMenuItem(array $items = [], $group = 'sidebar')
    {
        if (!isset($this->items[$group])) {
            throw new \Exception("The group especified does not exists");
        }
        $this->items[$group] = array_merge($this->items[$group], $items);
    }

    public function render($group = 'sidebar', $active = null)
    {
        $this->setActiveMenu($active);
        if (!isset($this->items[$group])) {
            throw new \Exception("The group especified does not exists");
        }
        $menu = $this->items[$group];
        $string = "";
        foreach ($this->parseMenu($menu) as $m) {
            $string .= $m;
        }
        return $string;
    }

    protected function setSingleMenuActive($menu)
    {
        if (isset($this->items[$menu[0]][$menu[1]])) {
            if (isset($this->items[$menu[0]][$menu[1]]['li']['class'])) {
                $this->items[$menu[0]][$menu[1]]['li']['class'] = $this->items[$menu[0]][$menu[1]]['li']['class'] . ' active expanded';
            } else {
                $this->items[$menu[0]][$menu[1]]['li']['class'] = " active expanded";
            }
        }
    }

    protected function setSubMenuActive($menu, $submenu = false)
    {
        $this->setSingleMenuActive($menu);
        if (isset($this->items[$menu[0]][$menu[1]]['submenus'][$menu[2]])) {
            if (isset($this->items[$menu[0]][$menu[1]]['submenus'][$menu[2]]['li']['class'])) {
                $this->items[$menu[0]][$menu[1]]['submenus'][$menu[2]]['li']['class'] = $this->items[$menu[0]][$menu[1]]['submenus'][$menu[2]]['link']['class'] . ' active';
                $this->items[$menu[0]][$menu[1]]['ul_submenu_class'] = ' collapsed in';
            } else {
                $this->items[$menu[0]][$menu[1]]['submenus'][$menu[2]]['li']['class'] = 'active';
                $this->items[$menu[0]][$menu[1]]['ul_submenu_class'] = ' collapsed in';
            }
        }
    }

    public function setActiveMenu($name)
    {
        if (!empty($name)) {
            $menu = explode('.', $name);
            if (count($menu) === 2) {
                $this->setSingleMenuActive($menu);
            }
            if (count($menu) === 3) {
                $this->setSubMenuActive($menu);
            }
        }
    }

    public function setMenu($menu)
    {
        $this->frontMenu = $menu;
        $this->setItems();

    }

}
