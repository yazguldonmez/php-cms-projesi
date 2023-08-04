<?php

namespace App\Controllers;

use Core\BaseController;
use Core\Session;

class User extends BaseController
{
    public function showProfile($id)
    {
        /*$users = $this->db->connect->query("SELECT * FROM members WHERE member_id = '$id'")->fetch(\PDO::FETCH_ASSOC);
        echo "<pre>";
        print_r($users);*/
        $users = $this->db->query("SELECT * FROM members WHERE member_id = '$id'", true);
        echo "<pre>";
        print_r($users);
    }
    public function Test()
    {
        $this->view->load('test', ['isim' => 'şahin']);//require BASEDIR . '/App/View/' . test . '.php'; yi dahil etti
    }
    public function getTest()
    {
        $get = $this->request->post();
        print_r($get);
    }
}
