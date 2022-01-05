<?php 

$container->set('db_illuminate',function(){
    return[
            'driver'=>'mysql',
            'host'=>'localhost',
            'database'=>'test',
            'username'=>'root',
            'password'=>'',
            'charset'=>'utf8',
            'collate'=>'utf8_unicode_ci',
            'prefix'=>''
    ];
});
