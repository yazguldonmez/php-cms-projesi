<?php

namespace App\Controllers;

use App\Model\ModelCustomer;
use Core\BaseController;

class Customer extends BaseController
{
    public function Index()
    {
        $ModelCustomer = new ModelCustomer();
        $data['customers'] = $ModelCustomer->getCustomers();

        $data['navbar'] = $this->view->load('static/navbar');
        $data['sidebar'] = $this->view->load('static/sidebar');

        echo $this->view->load('customer/index', compact('data'));
    }
    public function Add()
    {
        $data['navbar'] = $this->view->load('static/navbar');
        $data['sidebar'] = $this->view->load('static/sidebar');
        echo $this->view->load('customer/add', compact('data'));
    }
    public function Edit($id)
    {
        $ModelCustomer = new ModelCustomer();
        $data['customer'] = $ModelCustomer->getCustomer($id);
        //print_r($data['customer']);
        $data['navbar'] = $this->view->load('static/navbar');
        $data['sidebar'] = $this->view->load('static/sidebar');
        echo $this->view->load('customer/edit', compact('data'));
    }
    public function getCustomer($id)
    {
        return $this->db->query("SELECT * FROM customers WHERE id = '$id'", false);
    }
    public function EditCustomer()
    {
        $data = $this->request->post();
        if (!$data['customer_id']) {
            $status = 'error';
            $title = 'Ops! Dikkat';
            $msg = 'Müşteri bilgisine ulaşılmadı lütfen tekrar deneyin';
            echo json_encode(['status' => $status, 'title' => $title, 'msg' => $msg]);
            exit();
        }
        if (!$data['customer_name'] || !$data['customer_surname']) {
            $status = 'error';
            $title = 'Ops! Dikkat';
            $msg = 'Lütfen müşteri adını ve soyadını giriniz';
            echo json_encode(['status' => $status, 'title' => $title, 'msg' => $msg]);
            exit();
        }
        $ModelCustomer = new ModelCustomer();
        $update = $ModelCustomer->editCustomer($data);

        if ($update) {
            $status = 'success';
            $title = 'İşlem Başarılı';
            $msg = 'Müşteri başarıyla güncellendi.';
            echo json_encode(['status' => $status, 'title' => $title, 'msg' => $msg, 'redirect' => _link('musteri')]);
            exit();
        } else {
            $status = 'error';
            $title = 'Ops! Dikkat';
            $msg = 'Beklenmedik bir hata meydana geldi. Lüfen sayfanızı yenileyerek tekrar deneyin.';
            echo json_encode(['status' => $status, 'title' => $title, 'msg' => $msg]);
            exit();
        }
        $data['navbar'] = $this->view->load('static/navbar');
        $data['sidebar'] = $this->view->load('static/sidebar');
        echo $this->view->load('customer/edit', compact('data'));
    }
    public function RemoveCustomer()
    {
        
        $data = $this->request->post();
        if (!$data['customer_id']) {
            $status = 'error';
            $title = 'Ops! Dikkat';
            $msg = 'Müşteri bilgisine ulaşılmadı lütfen tekrar deneyin';
            echo json_encode(['status' => $status, 'title' => $title, 'msg' => $msg]);
            exit();
        }
        $remove = $this->db->remove("DELETE FROM customers WHERE customers.id = '{$data['customer_id']}' ");

        if ($remove) {
            $status = 'success';
            $title = 'İşlem Başarılı';
            $msg = 'Müşteri başarıyla silindi.';
            echo json_encode(['status' => $status, 'title' => $title, 'msg' => $msg, 'removed'=> $data['customer_id']]);
            exit();
        } else {
            $status = 'error';
            $title = 'Ops! Dikkat';
            $msg = 'Beklenmedik bir hata meydana geldi. Lüfen sayfanızı yenileyerek tekrar deneyin.';
            echo json_encode(['status' => $status, 'title' => $title, 'msg' => $msg]);
            exit();
        }
    }
    public function CreateCustomer()
    {
        $data = $this->request->post();

        if (!$data['customer_name'] || !$data['customer_surname']) {
            $status = 'error';
            $title = 'Ops! Dikkat';
            $msg = 'Lütfen müşteri adını ve soyadını giriniz';
            echo json_encode(['status' => $status, 'title' => $title, 'msg' => $msg]);
            exit();
        }
        $ModelCustomer = new ModelCustomer();
        $insert = $ModelCustomer->createCustomer($data);
        if ($insert) {
            $status = 'success';
            $title = 'İşlem Başarılı';
            $msg = 'İşlem başarıyla tamamlandı.';
            echo json_encode(['status' => $status, 'title' => $title, 'msg' => $msg, 'redirect' => _link('musteri')]);
            exit();
        } else {
            $status = 'error';
            $title = 'Ops! Dikkat';
            $msg = 'Bir hata oluştu Lütfen tekarar deneyin';
            echo json_encode(['status' => $status, 'title' => $title, 'msg' => $msg]);
            exit();
        }
    }
}
