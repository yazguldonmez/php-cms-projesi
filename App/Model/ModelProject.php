<?php

namespace App\Model;

use Core\BaseModel;
use Core\Session;

class ModelProject extends BaseModel
{
    public function createProject($data)
    {
        extract($data);
        if(!$customer_id || $customer_id == null || is_string($customer_id)){
            $customer_id = 0;
        }
        $start_date = !$start_date ? date('Y-m-d') : $start_date;
        $end_date = !$end_date ? date('Y-m-d') : $end_date;

        $user = $this->db->connect->prepare('INSERT INTO projects SET 
                          projects.customer_id =?,
                          projects.title =?,
                          projects.description =?,
                          projects.start_date =?,
                          projects.end_date =?,
                          projects.added_id =?,
                          projects.progress =?,
                          projects.status =?
                          ');
        $insert = $user->execute([
            $customer_id,
            $title,
            $description ?? '',
            $start_date,
            $end_date,
            intval(Session::getSession('id')),
            $progress ?? 1,
            $status ?? 'a'
        ]);

        if ($insert) {
            return true;
        } else {
            return false;
        }
    }
    public function getProjects()
    {
        return $this->db->query("SELECT * FROM projects", true);
    }
    public function getProject($id)
    {
        return $this->db->query("SELECT * FROM projects WHERE id = '$id'", false);
    }
    public function editProject($data)
    {
        extract($data);
        $user = $this->db->connect->prepare('UPDATE projects SET 
        projects.name =?,
        projects.surname =?,
        projects.email =?,
        projects.phone =?,
        projects.gsm =?,
        projects.address =?,
        projects.company =? WHERE Projects.id = ?
        ');
        $update = $user->execute([
            $Project_name,
            $Project_surname,
            $Project_email,
            $Project_phone,
            $Project_gsm,
            $Project_address,
            $Project_company,
            $Project_id
        ]);

        if ($update) {
            return true;
        } else {
            return false;
        }
    }
}
