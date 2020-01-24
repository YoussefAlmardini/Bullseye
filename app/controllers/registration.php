<?php

class Registration extends Controller
{
    public function index()
    {
        // THIS FUNCTION SERVES THE REGISTRATION PAGE

        $this->view('registration/index');
    }

    public function catchData()
    {
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
        $role_id = $_POST['role_id'];

        if (isset($_POST['customer'])) {
            $customer = $_POST['customer'];
        } else {
            $customer = 0;
        }

        if (isset($_POST['organisation'])) {
            $organisation = $_POST['organisation'];
        } else {
            $organisation = 0;
        }

        $model = $this->model('User');

        if ($model->validateUserInput($firstName, $insertion, $lastName, $birthDate, $email_address, $repeatedEmail_address, $password, $repeatedPassword, $hashedPassword, $role_id, $customer, $organisation)) {
            echo "<script>alert('Uw account is succesvol aangemaakt!');</script>";

            if ($role_id === "1") {
                $this->view('login/index');
            } else if ($role_id !== "1") {
                $this->view('admin/dashboardmap');
            }
        } else {
            echo "<script>alert('Er is iets fout gegaan');</script>";

            if ($role_id === "1") {
                $this->view('registration/index');
            } else if ($role_id === "2") {
                $this->view('admin/addCustomerAccount');
            } else if ($role_id === "4") {
                $this->view('admin/addOrganisationAccount');
            }
        }
    }
}
