<?php
if (PHP_SAPI !== 'cli'){
    $router->set404('ErrorController@notFound');
}

$router->setNamespace('\Application\Controllers');
$router->get('/', 'HomeController@index');
$router->get('/product/(\d+)', 'HomeController@details');

$router->mount('/cart', function() use ($router) {
    $router->get('/', 'CartController@index');
    $router->get('/add/(\d+)/(\d+)', 'CartController@addToCart');
    $router->get('/update/(\d+)/(\w+)/(\d+)', 'CartController@updateCart');
    $router->get('/remove/(\d+)', 'CartController@removeFromCart');
    $router->get('/clear', 'CartController@clearCart');
});