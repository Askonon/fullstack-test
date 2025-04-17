<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Comments::index');
$routes->get('/api/comments/read', 'Comments::read');
$routes->post('/api/comments/create', 'Comments::create');
$routes->post('/api/comments/update', 'Comments::update');
$routes->post('/api/comments/delete', 'Comments::delete');

