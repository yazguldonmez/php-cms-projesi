<?php

namespace App\Middlewares;
use Core\BaseMiddleware;
use Core\Session;

class AuthMiddleware extends BaseMiddleware
{
    public function isLogin()
    {
        $login = Session::getSession('login');
        if (!$login) {
        //     echo "oturum kapalı";
        // }else{
        //     echo "oturum açık";
        // }
        session_destroy();
        redirect('giris');
        }
    }
}
