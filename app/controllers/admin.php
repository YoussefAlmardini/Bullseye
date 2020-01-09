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

    public function profiel()
    {
        $query = 'SELECT users.first_name, users.insertion, users.last_name, users.email_address, levels.level, users.birthdate FROM users LEFT JOIN levels ON users.level_id = levels.level_id WHERE users.user_id = :id';
        $db = DB::connect();
        $stmt = $db->prepare($query);
        $stmt->bindValue(':id', '25');
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->view('profiel/index', ['user' => $user]);

        $this->view('admin/profiel', ['user' => $user]);
    }

    public function registeradmin()
    {
        $this->view('admin/registeradmin');
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