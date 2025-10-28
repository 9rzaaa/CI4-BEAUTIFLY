<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Users::index');
$routes->get('/login', 'Users::login');
$routes->get('/signup', 'Users::signup');
$routes->get('/mb', 'Users::moodboard');
$routes->get('/rm', 'Users::roadmap');

$routes->post('auth/login', 'Auth::login');
$routes->get('auth/logout', 'Auth::logout');
$routes->post('auth/signup', 'Auth::signup');

$routes->get('admin/dashboard', function () {
    return view('admin/dashboard');
});
