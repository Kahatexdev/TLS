<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */


$routes->get('/', 'AuthController::index');
$routes->get('/login', 'AuthController::index');
$routes->post('/logout', 'AuthController::logout');
$routes->post('authverify', 'AuthController::login');

$routes->group('/kepalaarea', ['filter' => 'kepalaarea'], function ($routes) {
    $routes->get('', 'KepalaAreaController::index');
});


$routes->group('/monitoring', ['filter' => 'monitoring'], function ($routes) {
    $routes->get('', 'MonitoringController::index');
});

$routes->group('/area', ['filter' => 'area'], function ($routes) {
    $routes->get('', 'AreaController::index');
    $routes->get('dataproduksi', 'AreaController::dataproduksi');
    $routes->get('dataorder', 'AreaController::dataorder');
});
