<?php

use Illuminate\Routing\Router;

Admin::registerAuthRoutes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
], function (Router $router) {

    $router->get('/', 'HomeController@index');
    $router->resource('/vendors', VendorController::class);
    $router->resource('/expenses', ExpenseController::class);
    $router->resource('/images', ImageController::class);
    $router->resource('/pos-days', PosDayController::class);
    $router->resource('/items', ItemController::class);

});
