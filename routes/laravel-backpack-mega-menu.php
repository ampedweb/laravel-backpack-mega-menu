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
 * User Routes
 */

// Route::group([
//     'middleware'=> array_merge(
//     	(array) config('backpack.base.web_middleware', 'web'),
//     ),
// ], function() {
//     Route::get('something/action', \Ampedweb\LaravelBackpackMegaMenu\Http\Controllers\SomethingController::actionName());
// });


/**
 * Admin Routes
 */

// Route::group([
//     'prefix' => config('backpack.base.route_prefix', 'admin'),
//     'middleware' => array_merge(
//         (array) config('backpack.base.web_middleware', 'web'),
//         (array) config('backpack.base.middleware_key', 'admin')
//     ),
// ], function () {
//     Route::crud('some-entity-name', \Ampedweb\LaravelBackpackMegaMenu\Http\Controllers\Admin\EntityNameCrudController::class);
// });