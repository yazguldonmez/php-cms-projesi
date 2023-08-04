<?php

namespace App\Controllers;

use Core\BaseController;
use Core\Session;
use \App\Model\ModelAuth;

class Auth extends BaseController
{
    public function Index()
    {
        $data['form_link'] = _link('giris');
        echo $this->view->load('auth/index', $data);
    }
    public function Login()
    {
        $data = $this->request->post();
        if(!$data['email']){
            $status = 'error';
            $title = 'Ops! Dikkat';
            $msg = 'E-posta adresinizi girin';
            echo json_encode(['status' => $status, 'title' => $title, 'msg' => $msg]);
            exit();
        }
        if(!$data['password']){
            $status = 'error';
            $title = 'Ops! Dikkat';
            $msg = 'Şifrenizi girin';
            echo json_encode(['status' => $status, 'title' => $title, 'msg' => $msg]);
            exit();
        }
        $AuthModel = new ModelAuth();
        $access = $AuthModel->userLogin($data); //userLogin fonksiyonunda true ya da false değer dönecekti
        if ($access) { //eğer dönen değer tru ise bu işlemşer yapılacak
            $status = 'success';
            $title = 'İşlem Başarılı';
            $msg = 'İşlem başarıyla tamamlandı.';
            echo json_encode(['status' => $status, 'title' => $title, 'msg' => $msg, 'redirect' => _link()]);
            exit();
        } else { //false ise bu işlemler yapılcak
            $status = 'error';
            $title = 'Ops! Dikkat';
            $msg = 'Kullanıcı adınız veya şifreniz hatalı lütfen tekrar deneyiniz.';
            echo json_encode(['status' => $status, 'title' => $title, 'msg' => $msg]);
            exit();
        }
    }
    public function Logout()
    {
        Session::removeSession();
        redirect("giris");
    }
}
