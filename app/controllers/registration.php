<?php

class Registration extends Controller
{
    public function index()
    {
        // THIS FUNCTION SERVES THE REGISTRATION PAGE

        $this->view('registration/index');
    }

    public function catchData(){
        // THIS FUNCTION CATCHES THE BY THE USER INSERTED DATA

        $firstName = $_POST['firstName'];
        $insertion = $_POST['insertion'];
        $lastName = $_POST['lastName'];
        $birthDate = $_POST['birthDate'];
        $email_address = $_POST['email_address'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

        $model = $this->model('User');
        $model->saveUserInDatabase($firstName, $insertion, $lastName, $birthDate, $email_address, $password);

        $this->view('login/index');
    }
    
    private function generateSalt() {
        // THIS FUNCTION GENERATES A SALT FOR THE HASH OF THE PASSWORD

        $charset = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789/\\][{}\'";:?.>,<!@#$%^&*()-_=+|';
        $randString = "";
        $randStringLen = 64;
    
        while(strlen($randString) < $randStringLen) {
            $randChar = substr(str_shuffle($charset), mt_rand(0, strlen($charset)), 1);
            $randString .= $randChar;
        }
    
        return $randString;
    }
}