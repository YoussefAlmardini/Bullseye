<?php

class Admin extends Controller
{
    public function index()
    {
        $this->view('admin/index');
    }
    
    public function map()
    {
        $this->view('admin/dashboardmap');
    }

    public function function_admin()
    {
        $this->view('models/admin.php');
    }


    public function api($id) 
    {
        $admin = $this->model('Admin2');
        $res = $admin->getAllQuestionOrderByQueue($id);

        echo json_encode($res);
        exit;
    }

    public function updateMarker() 
    {
        $data = $_POST;
        $admin = $this->model('Admin2');
        $res = $admin->updateOrAddQuestion($data);
        echo $res;
        exit;
        
    }

}