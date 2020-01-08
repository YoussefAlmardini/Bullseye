<?php

class Profiel extends Controller
{
    public function index()
    {
        $query = 'SELECT users.first_name, users.insertion, users.last_name, users.email_address, levels.level, users.birthdate FROM users LEFT JOIN levels ON users.level_id = levels.level_id WHERE users.user_id = :id';
        $db = DB::connect();
        $stmt = $db->prepare($query);
        $stmt->bindValue(':id', '25');
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        //print_r($user);




        $this->view('profiel/index', ['user' => $user]);
    }


    public function UpdateAccount(){
        // THIS FUNCTION CATCHES THE BY THE USER INSERTED DATA AND SENDS IT TO THE MODEL

        $firstName = htmlentities(htmlspecialchars($_POST['firstName']));
        $insertion = htmlentities(htmlspecialchars($_POST['insertion']));
        $lastName = htmlentities(htmlspecialchars($_POST['lastName']));
        $birthDate = htmlentities(htmlspecialchars($_POST['birthdate']));
        $ID = '25';

        $model = $this->model('User');

        if($model->validateUserInputUpdate($firstName, $insertion, $lastName, $birthDate, $ID)){
            echo "<script>alert('Uw account is succesvol geupdate!');</script>";
            $this->view('main/index');
        }else{
            $this->view('profiel/index');
        }
    }

}