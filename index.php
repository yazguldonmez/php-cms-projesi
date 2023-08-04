<?php

use Bramus\Router\Router;
use Core\Request;
use Core\Starter;

require __DIR__ . '/config.php';
require __DIR__ . '/vendor/autoload.php';
$cms = new \Core\Starter();
require __DIR__ . '/App/Routes/Route.php';

//$router->match('GET|POST', 'pattern', function() { echo "test" ;});//Hem get hem ost isteklerinde işlem yapar.
//$router->get('pattern', function() { /* ... */ });//ya da bu şekilde sadece get istekleri şeklinde belirtebiliriz.
/*$router->get('/user', function() {//url /user olduğunda burası çalışsın
    echo "User Page";
});*/
/*$router->mount('/user', function () use ($router) {//eğer /user ise kapsayıcı oluşturur. yani /user sonrası herhangi işlemi
    //tek bir çatı altında toplamış oluyoruz

    // will result in '/movies/'
    $router->get('/home', function () {
        echo 'User Home Page';
    });

    // will result in '/movies/id'
    $router->get('/([a-zA-Z0-9]+)/([0-9]+)', function ($id, $par) {//user/yazgul/12 şeklinde yazıldığında çalışır
        echo 'User Kullanıcısı : ' . htmlentities($id) . ' ' . $par;
    });
});*/
