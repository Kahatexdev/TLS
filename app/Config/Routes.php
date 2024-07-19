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
    $routes->get('', 'MonitoringController::dataproduksi');
    $routes->get('dataproduksi', 'MonitoringController::dataproduksi');
    $routes->post('editproduksi/(:any)', 'MonitoringController::editproduksi/$1');
    $routes->post('deleteproduksi/(:any)', 'MonitoringController::deleteproduksi/$1');
    $routes->get('dataorder', 'MonitoringController::dataorder');
    $routes->post('editorder/(:any)', 'MonitoringController::editorder/$1');
    $routes->post('deleteorder/(:any)', 'MonitoringController::deleteorder/$1');
});

$routes->group('/area', ['filter' => 'area'], function ($routes) {
    $routes->get('', 'AreaController::index');
    $routes->get('dataproduksi', 'AreaController::dataproduksi');
    $routes->post('inputproduksi', 'AreaController::inputproduksi');
    $routes->get('dataorder', 'AreaController::dataorder');
    $routes->get('checkDataRedis', 'AreaController::checkDataRedis');
    $routes->post('importorder', 'AreaController::importorder');
});
