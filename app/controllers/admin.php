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
        $data = json_decode(file_get_contents('php://input'));
        $admin = $this->model('Admin2');
        $res = $admin->updateOrAddQuestion($data);
        echo json_encode($res);
        exit;
        
    }

    public function newMap() 
    {
        $data = json_decode(file_get_contents('php://input'));
        $admin = $this->model('Admin2');
        $res = $admin->newMap($data);
        echo json_encode($res);
        exit;
        
    }

}