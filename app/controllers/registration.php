<?php

class Registration extends Controller
{
    public function index()
    {
        // THIS FUNCTION SERVES THE REGISTRATION PAGE

        $this->view('registration/index');
    }

    public function catchData(){
        // THIS FUNCTION CATCHES THE BY THE USER INSERTED DATA AND SENDS IT TO THE MODEL

        $firstName = htmlentities(htmlspecialchars($_POST['firstName']));
        $insertion = htmlentities(htmlspecialchars($_POST['insertion']));
        $lastName = htmlentities(htmlspecialchars($_POST['lastName']));
        $birthDate = htmlentities(htmlspecialchars($_POST['birthDate']));
        $email_address = htmlentities(htmlspecialchars($_POST['email_address']));
        $repeatedEmail_address = htmlentities(htmlspecialchars($_POST['repeated_email_address']));
        $password = $_POST['password'];
        $repeatedPassword = $_POST['repeatedPassword'];
        $hashedPassword = password_hash($_POST['password'], PASSWORD_DEFAULT);

        $model = $this->model('User');

        if($model->validateUserInput($firstName, $insertion, $lastName, $birthDate, $email_address, $repeatedEmail_address, $password, $repeatedPassword, $hashedPassword)){
            $this->view('login/index');
        }else{
            $this->view('registration/index');
        }
    }
}