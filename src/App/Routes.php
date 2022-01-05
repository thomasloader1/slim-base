<?php

use Slim\Routing\RouteCollectorProxy;
use App\Middlewares\AdminSessionMiddleware;

$app->group('/admin', function ($app) {

    // GENERAL
    $app->get('', 'AdminController:getIndex');

    $app->get('/dashboard/graph', 'AdminController:getKPI');
    $app->get('/login', 'AuthController:getAdminLogIn');
    $app->post('/login', 'AuthController:postAdminLogIn');
    $app->get('/logout', 'AuthController:getAdminLogOut');
    $app->get('/account', 'AdminController:getAccount');

    $app->post('/forms/account/edit', 'AdminController:postAccountUpdate');

    //USUARIOS
    $app->get('/users', 'UserController:getUsers');
    $app->get('/tables/users', 'UserController:getUsersTable');
    $app->post('/forms/users/add', 'UserController:postUser');
    $app->get('/forms/users/edit', 'UserController:getUserModalEdit');
    $app->post('/forms/users/edit', 'UserController:postUserUpdate');
    $app->delete('/forms/users/{id}', 'UserController:deleteUser');

    //BANNERS
    $app->get('/banners', 'BannerController:getBanners');
    $app->get('/tables/banners', 'BannerController:getBannersTable');
    $app->get('/banners/sort', 'BannerController:getSortBanners');
    $app->post('/banners/forms/sort', 'BannerController:postSortBanners');
    $app->get('/banners/add', 'BannerController:getAddBanners');
    $app->get('/banners/edit/{id}', 'BannerController:getEditBanners');
    $app->post('/banners/edit/{id}', 'BannerController:postEditBanners');
    $app->post('/forms/banners/active', 'BannerController:postActiveBanners');
    $app->post('/forms/banners/add', 'BannerController:postAddBanners');
    $app->delete('/forms/banners/{id}', 'BannerController:deleteBanners');

    //IMAGENES

    $app->post('/forms/products/images/add/{id}', 'ProductController:postAddImages');
    $app->get('/products/image-sort/{id}', 'ProductController:getSortImages');
    $app->post('/products/image-sort', 'ProductController:postSortImages');

    //CATEGORIAS 
    $app->get('/categories', 'ProductController:getCategory');
    $app->get('/tables/categories', 'ProductController:getCategoryTable');
    $app->get('/categories/add', 'ProductController:getAddCategory');
    $app->post('/categories/add', 'ProductController:postAddCategory');
    $app->get('/categories/edit/{id}', 'ProductController:getEditCategory');
    $app->get('/select/categories', 'ProductController:getSelectCategory');
    $app->post('/categories/edit/{id}', 'ProductController:postEditCategory');
    $app->delete('/forms/categories/{id}', 'ProductController:deleteCategory');


    //MARCAS
    $app->get('/brands', 'ProductController:getBrand');
    $app->get('/tables/brands', 'ProductController:getBrandTable');
    $app->get('/brands/add', 'ProductController:getAddBrand');
    $app->post('/brands/add', 'ProductController:postAddBrand');
    $app->get('/brands/edit/{id}', 'ProductController:getEditBrand');
    $app->get('/select/brands', 'ProductController:getSelectBrand');
    $app->post('/brands/edit/{id}', 'ProductController:postEditBrand');
    $app->delete('/forms/brands/{id}', 'ProductController:deleteBrand');
    $app->post('/forms/brands/active', 'ProductController:postActiveBrand');



    //PRODUCTOS
    $app->get('/products', 'ProductController:getProducts');
    $app->get('/tables/products', 'ProductController:getProductsTable');
    $app->get('/products/add', 'ProductController:getAddProducts');
    $app->get('/products/edit/{id}', 'ProductController:getEditProducts');
    $app->post('/products/edit/{id}', 'ProductController:postEditProducts');
    $app->post('/forms/products/active', 'ProductController:postActiveProducts');
    $app->post('/forms/products/add', 'ProductController:postAddProducts');
    $app->delete('/forms/products/{id}', 'ProductController:deleteProducts');

    
})->add(AdminSessionMiddleware::class);


$app->get('', 'HomeController:getIndex');
$app->get('/', 'HomeController:getIndex');
