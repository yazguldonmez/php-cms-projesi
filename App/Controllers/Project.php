<?php

namespace App\Controllers;

use App\Model\ModelCustomer;
use App\Model\ModelProject;
use Core\BaseController;

class Project extends BaseController
{
    public function Index()
    {
        $ModelProject = new ModelProject();
        $data['projects'] = $ModelProject->getProjects();

        $data['navbar'] = $this->view->load('static/navbar');
        $data['sidebar'] = $this->view->load('static/sidebar');
        echo $this->view->load('project/index', compact('data'));
    }
    public function Add()
    {
        $ModelCustomer = new ModelCustomer();
        $data['customers'] = $ModelCustomer->getCustomers();

        $data['navbar'] = $this->view->load('static/navbar');
        $data['sidebar'] = $this->view->load('static/sidebar');
        echo $this->view->load('project/add', compact('data'));
    }
    public function Edit($id)
    {
        $data['navbar'] = $this->view->load('static/navbar');
        $data['sidebar'] = $this->view->load('static/sidebar');
        echo $this->view->load('project/edit', compact('data'));
    }
    public function CreateProject()
    {
        $data = $this->request->post();

        if (!$data['title']) {
            $status = 'error';
            $title = 'Ops! Dikkat';
            $msg = 'Lütfen proje adını giriniz';
            echo json_encode(['status' => $status, 'title' => $title, 'msg' => $msg]);
            exit();
        }
        $ModelCustomer = new ModelProject();
        $insert = $ModelCustomer->createProject($data);
        
        if ($insert) {
            $status = 'success';
            $title = 'İşlem Başarılı';
            $msg = 'İşlem başarıyla tamamlandı.';
            echo json_encode(['status' => $status, 'title' => $title, 'msg' => $msg, 'redirect' => _link('proje')]);
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
