<?php

namespace Backpack\MenuCRUD\app\Http\ViewComposers;

use Backpack\MenuCRUD\app\Models\MenuItem;
use Illuminate\Support\Facades\Cache;
use Backpack\MenuCRUD\app\Models\Menu;
use Illuminate\Database\Eloquent\Collection;

class NavigationViewComposer
{
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
                $menus = Menu::all();

                $menus->each(static function (&$menu) {
                    $menu->push('menu_items', MenuItem::getTree($menu->id));
                });
            });
        }

        return Menu::with('menu_items')->get();
    }
}
