<?php

use Psr\Container\ContainerInterface;

$container->set('session', function(ContainerInterface $c){
    return new Session();
});

$container->set('view', function(ContainerInterface $c){
    $settings = $c->get('renderer');
    return new Slim\Views\PhpRenderer($settings->template_path);
});

$container->set('AuthController', function(ContainerInterface $c){
    return new App\Controllers\AuthController($c);
});

$container->set('AdminController', function(ContainerInterface $c){
    return new App\Controllers\AdminController($c);
});

$container->set('UserController', function(ContainerInterface $c){
    return new App\Controllers\UserController($c);
});
$container->set('BannerController', function(ContainerInterface $c){
    return new App\Controllers\BannerController($c);
});
$container->set('HomeController', function(ContainerInterface $c){
    return new App\Controllers\HomeController($c);
});
$container->set('ShopController', function(ContainerInterface $c){
    return new App\Controllers\ShopController($c);
});

$container->set('ProductController', function(ContainerInterface $c){
    return new App\Controllers\ProductController($c);
});
