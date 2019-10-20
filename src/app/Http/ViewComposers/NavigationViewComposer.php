<?php

namespace Backpack\MenuCRUD\app\Http\ViewComposers;

use Backpack\MenuCRUD\app\Models\Menu;
use Illuminate\Database\Eloquent\Collection;

class NavigationViewComposer
{
    public function compose($view)
    {
        $this->getMenus()->each(static function ($menu) use ($view) {
            $view->with($menu->slug, $menu->menuItems);
        });
    }

    /**
     * @return Collection
     */
    private function getMenus()
    {
        if (config('menus.enable_view_cache')) {
            return Cache::remember(config('menus.view_cache_key'), config('menus.view_cache_ttl'), static function () {
                return Menu::with('menu_items')->get();
            });
        }

        return Menu::with('menu_items')->get();
    }
}
