<?php
$cms->router->setNamespace('App');
//user/detail/12 şeklinde girilirse App\Controllers altında user sınıfının içindeki showProfile metodunu çalıştır.
require BASEDIR . '/App/Routes/api.php';
require BASEDIR . '/App/Routes/web.php';
require BASEDIR . '/App/Routes/admin.php';
//Routes dosyasının içindeki dosyaları route.phpye kaydettik artık herhangi bir yere route.php yi çağaırınca onlarda gelecek
$cms->router->run();
