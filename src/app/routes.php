<?php

use App\Controllers\BatteryController;
use App\Controllers\BicycleController;
use App\Controllers\FeatureController;
use App\Controllers\HomeController;
use App\Controllers\SupplierController;
use App\Controllers\TypeController;
use Core\Router\Router;

/** @var Router $router */

$router->get('/', [HomeController::class, 'home']);

$router->get('/batteries', [BatteryController::class, 'index']);
$router->get('/batteries/create', [BatteryController::class, 'create']);
$router->post('/batteries/store', [BatteryController::class, 'store']);
$router->get('/batteries/{id}', [BatteryController::class, 'show']);
$router->get('/batteries/{id}/edit', [BatteryController::class, 'edit']);
$router->post('/batteries/{id}/update', [BatteryController::class, 'update']);
$router->post('/batteries/{id}/delete', [BatteryController::class, 'delete']);

$router->get('/bicycles', [BicycleController::class, 'index']);
$router->get('/bicycles/create', [BicycleController::class, 'create']);
$router->post('/bicycles/store', [BicycleController::class, 'store']);
$router->get('/bicycles/{id}', [BicycleController::class, 'show']);
$router->get('/bicycles/{id}/edit', [BicycleController::class, 'edit']);
$router->post('/bicycles/{id}/update', [BicycleController::class, 'update']);
$router->post('/bicycles/{id}/delete', [BicycleController::class, 'delete']);

$router->get('/types', [TypeController::class, 'index']);
$router->get('/types/create', [TypeController::class, 'create']);
$router->post('/types/store', [TypeController::class, 'store']);
$router->get('/types/{id}', [TypeController::class, 'show']);
$router->get('/types/{id}/edit', [TypeController::class, 'edit']);
$router->post('/types/{id}/update', [TypeController::class, 'update']);
$router->post('/types/{id}/delete', [TypeController::class, 'delete']);

$router->get('/features', [FeatureController::class, 'index']);
$router->get('/features/create', [FeatureController::class, 'create']);
$router->post('/features/store', [FeatureController::class, 'store']);
$router->get('/features/{id}', [FeatureController::class, 'show']);
$router->get('/features/{id}/edit', [FeatureController::class, 'edit']);
$router->post('/features/{id}/update', [FeatureController::class, 'update']);
$router->post('/features/{id}/delete', [FeatureController::class, 'delete']);

$router->get('/suppliers', [SupplierController::class, 'index']);
$router->get('/suppliers/create', [SupplierController::class, 'create']);
$router->post('/suppliers/store', [SupplierController::class, 'store']);
$router->get('/suppliers/{id}', [SupplierController::class, 'show']);
$router->get('/suppliers/{id}/edit', [SupplierController::class, 'edit']);
$router->post('/suppliers/{id}/update', [SupplierController::class, 'update']);
$router->post('/suppliers/{id}/delete', [SupplierController::class, 'delete']);
