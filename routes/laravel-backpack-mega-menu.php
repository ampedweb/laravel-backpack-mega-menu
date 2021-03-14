<?php

/*
|--------------------------------------------------------------------------
| Ampedweb\LaravelBackpackMegaMenu Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are
| handled by the Ampedweb\LaravelBackpackMegaMenu package.
|
*/

/**
 * Admin Routes
 */

use Ampedweb\LaravelBackpackMegaMenu\Http\Controllers\Admin\MegaMenuController;

Route::group([
     'prefix' => config('backpack.base.route_prefix', 'admin'),
     'middleware' => array_merge(
         (array) config('backpack.base.web_middleware', 'web'),
         (array) config('backpack.base.middleware_key', 'admin')
     ),
 ], function () {
     Route::crud('mega-menu', MegaMenuController::class);
 });
