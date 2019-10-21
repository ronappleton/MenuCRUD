<?php

namespace Backpack\MenuCRUD\app\Http\ViewComposers;

use Backpack\MenuCRUD\app\Models\MenuItem;
use Illuminate\Support\Facades\Cache;
use Backpack\MenuCRUD\app\Models\Menu;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class NavigationViewComposer
 *
 * @package Backpack\MenuCRUD\app\Http\ViewComposers
 */
class NavigationViewComposer
{
    /**
     * @param $view
     * @return void
     */
    public function compose($view)
    {
        $this->getMenus()->each(static function ($menu) use ($view) {
            return $view->with($menu->slug, $menu->menu_items);
        });
    }

    /**
     * @return Collection
     */
    private function getMenus()
    {
        if (config('menus.enable_view_cache')) {
            return Cache::remember(config('menus.view_cache_key'), config('menus.view_cache_ttl'), static function () {
                return self::fetch();
            });
        }

        return self::fetch();
    }

    /**
     * @static
     * @return Menu[]|Collection
     */
    private static function fetch()
    {
        $menus = Menu::all();
        foreach ($menus as &$menu) {
            $menu['menu_items'] = MenuItem::getTree($menu['id']);
        }
        unset($menu);

        return $menus;
    }
}
