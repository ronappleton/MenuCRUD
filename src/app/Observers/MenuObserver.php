<?php

namespace Backpack\MenuCRUD\app\Observers;

use Backpack\MenuCRUD\app\Models\Menu;
use Illuminate\Support\Facades\Cache;

class MenuObserver
{
    /**
     * Handle the Menu "created" event.
     *
     * @param  Menu $menu
     * @return void
     */
    public function created(Menu $menu)
    {
        Cache::forget(config('menus.view_cache_key'));
    }

    /**
     * Handle the Menu "saved" event.
     *
     * @param  Menu $menu
     * @return void
     */
    public function saved(Menu $menu)
    {
        Cache::forget(config('menus.view_cache_key'));
    }

    /**
     * Handle the Menu "deleted" event.
     *
     * @param  Menu $menu
     * @return void
     */
    public function deleted(Menu $menu)
    {
        Cache::forget(config('menus.view_cache_key'));
    }
}
