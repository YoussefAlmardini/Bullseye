<?php

class Admin extends Controller
{
    #index page
    public function index()
    {
        $this->view('admin/index');
    }

    #map page
    public function map()
    {
        $this->view('admin/dashboardmap');
    }

    #profile page
    public function profiel()
    {
        $query = 'SELECT contact_data.first_name, contact_data.insertion, contact_data.last_name, contact_data.email_address, contact_data.function, contact_data.phone_number 
        FROM organisations 
        LEFT JOIN customers_customer_data ON organisations.customer_id = customers_customer_data.customer_id 
        LEFT JOIN contact_data ON customers_customer_data.data_id = contact_data.data_id 
        WHERE organisations.organisation_id = :id';
        $db = DB::connect();
        $stmt = $db->prepare($query);
        $stmt->bindValue(':id', '2');
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->view('admin/profiel', ['user' => $user]);
    }

    #admin register page
    public function registeradmin()
    {
        $this->view('admin/registeradmin');
    }





    public function UpdateAdminAccount(){
        // THIS FUNCTION CATCHES THE BY THE USER INSERTED DATA AND SENDS IT TO THE MODEL

        $firstName = htmlentities(htmlspecialchars($_POST['firstName']));
        $insertion = htmlentities(htmlspecialchars($_POST['insertion']));
        $lastName = htmlentities(htmlspecialchars($_POST['lastName']));
        $function = htmlentities(htmlspecialchars($_POST['function']));
        $phone_number = htmlentities(htmlspecialchars($_POST['phone_number']));
        $ID = '1';

        $model = $this->model('User');

        if($model->validateAdminInputUpdate($firstName, $insertion, $lastName, $function, $phone_number, $ID)){
            echo "<script>alert('Uw account is succesvol geupdate!');</script>";
            $this->view('admin/dashboardmap');
        }else{
            $this->view('/admin/profiel');
        }
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

    public function deleteQuest()
    {
        $data = json_decode(file_get_contents('php://input'));
        $admin = $this->model('Admin2');
        $res = $admin->deleteQuest($data);
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