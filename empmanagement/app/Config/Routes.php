<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Employees::index');
$routes->get('/add', 'Employees::create');
$routes->post('/save', 'Employees::store');
$routes->get('/edit/(:num)', 'Employees::edit/$1');
$routes->post('/edit_employee', 'Employees::update');
$routes->get('/delete/(:num)', 'Employees::delete/$1');
