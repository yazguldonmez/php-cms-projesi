<?php
$cms->router->before('GET|POST', '/', 'Middlewares\AuthMiddleware@isLogin');
$cms->router->before('GET|POST', '/musteri.*', 'Middlewares\AuthMiddleware@isLogin');
//getten musteri sorgusu gelirse önce login'i kontrol edecek oturum yoksa islogin giris sayfasına yönlendirecek
//sadece musteriyi kontrol etmiycek müsteri ardındaki tüm sorguları mesela musteri/ekle oturum yoksa burayada giremez
$cms->router->before('GET|POST', '/proje.*', 'Middlewares\AuthMiddleware@isLogin');

$cms->router->get('/', 'Controllers\Home@Index');
//Login page
$cms->router->get('/giris', 'Controllers\Auth@Index'); //get ile gidilirse index sayfası çalşıacak post ile gidilirse login
//Login post
$cms->router->post('/giris', 'Controllers\Auth@Login');
$cms->router->get('/cikis', 'Controllers\Auth@Logout');

//Musteriler
$cms->router->mount('/musteri', function () use ($cms) {
    $cms->router->get('/', 'Controllers\Customer@Index');
    $cms->router->get('/ekle', 'Controllers\Customer@Add');
    $cms->router->post('/ekle', 'Controllers\Customer@CreateCustomer');
    $cms->router->get('/guncelle/([0-9]+)', 'Controllers\Customer@Edit');
    $cms->router->post('/guncelle', 'Controllers\Customer@EditCustomer');
    $cms->router->post('/sil', 'Controllers\Customer@RemoveCustomer');
});
$cms->router->mount('/proje', function () use ($cms) {
    $cms->router->get('/', 'Controllers\Project@Index');
    $cms->router->get('/ekle', 'Controllers\Project@Add');
    $cms->router->post('/ekle', 'Controllers\Project@CreateProject');
    $cms->router->get('/guncelle/([0-9]+)', 'Controllers\Project@Edit');
});
