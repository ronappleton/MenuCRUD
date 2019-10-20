<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Enable View Cache
    |--------------------------------------------------------------------------
    |
    | This option controls whether or not you application will use caching for
    | menus within views.
    |
    */

    'enable_view_cache' => true,

    /*
    |--------------------------------------------------------------------------
    | View Cache Key
    |--------------------------------------------------------------------------
    |
    | This option controls whether or not you application will use caching for
    | menus within views.
    |
    */

    'view_cache_key' => 'menuCrud_menus',

    /*
    |--------------------------------------------------------------------------
    | View Cache TTL
    |--------------------------------------------------------------------------
    |
    | This option controls the period of time that laravel will keep you menus
    | cached for your views.
    |
    */

    'view_cache_ttl' => 60 * 60, // 60 times 60 seconds (1 hour)

    /*
    |--------------------------------------------------------------------------
    | Invalidate View Cache
    |--------------------------------------------------------------------------
    |
    | This option will allow you to have your view caches automatically clear
    | the menu view cache on update of menus or menu items.
    |
    */

    'invalidate_caches' => true,
];
