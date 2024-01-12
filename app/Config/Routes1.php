<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Login::index');

//$routes->get('/', 'Home::index');
$routes->get('login', 'Login::login');
