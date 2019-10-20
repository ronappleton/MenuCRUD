<?php

namespace Backpack\MenuCRUD\app\Observers;

use Backpack\MenuCRUD\app\Models\MenuItem;
use Illuminate\Support\Facades\Cache;

class MenuItemObserver
{
    /**
     * Handle the MenuItem "created" event.
     *
     * @param  MenuItem $menuItem
     * @return void
     */
    public function created(MenuItem $menuItem)
    {
        Cache::forget(config('menus.view_cache_key'));
    }

    /**
     * Handle the MenuItem "saved" event.
     *
     * @param  MenuItem $menuItem
     * @return void
     */
    public function saved(MenuItem $menuItem)
    {
        Cache::forget(config('menus.view_cache_key'));
    }

    /**
     * Handle the MenuItem "deleted" event.
     *
     * @param  MenuItem $menuItem
     * @return void
     */
    public function deleted(MenuItem $menuItem)
    {
        Cache::forget(config('menus.view_cache_key'));
    }
}
