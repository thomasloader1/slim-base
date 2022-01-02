<?php 

$container->set('db_illuminate',function(){
    return[
            'driver'=>'mysql',
            'host'=>'localhost',
            'database'=>'base_ecommerce',
            'username'=>'user_ecommerce',
            'password'=>'Ecommerce615*',
            'charset'=>'utf8',
            'collate'=>'utf8_unicode_ci',
            'prefix'=>''
    ];
});
