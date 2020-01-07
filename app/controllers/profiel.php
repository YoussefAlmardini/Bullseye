<?php

class Profiel extends Controller
{
    public function index()
    {
        $this->view('profiel/index');
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