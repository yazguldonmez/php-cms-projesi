<?php

namespace App\Controllers;

use Core\BaseController;
use Core\Session;

class Home extends BaseController
{
    public function Index(){
        //print_r(Session::getAllSession());
        
        $data['navbar'] = $this->view->load('static/navbar');//statik altındaki navbarı ouşturduğumuz $data['navbar] değişkenine attı
        $data['sidebar'] = $this->view->load('static/sidebar');
        echo $this->view->load('home/index',compact('data'));//user arrayini şu şekilde alır 'user' => $user
        //extract metodu ile de her bir dizi elemanını key ini değişken olarak alır
    }
}
