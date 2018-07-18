<?php

use Illuminate\Routing\Router;

Admin::registerAuthRoutes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
], function (Router $router) {

    $router->get('/', 'HomeController@index');
    $router->resource('/accountinfo', AccountInfoController::class);
    $router->resource('/fishroletableinfo', FishRoleTableInfoController::class);
    $router->resource('/fishphonepaylog', FishPhonePayLogController::class);
    $router->resource('/fishmail', FishMailController::class);
    $router->resource('/fishrechargelog', FishRechargeLogController::class);
    $router->resource('/fishexchange', FishExchangeController::class);
    $router->resource('/fishentityitem', FishEntityItemController::class);
    $router->resource('/fishentityitemlog', FishEntityItemLogController::class);
});
