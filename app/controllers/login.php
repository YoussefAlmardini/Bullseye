<?php

class Login extends Controller
{
    public function index()
    {
        $this->view('login/index');
        //echo "Home pagina met method 'index' met Username: " . $username;
    }

    public function authorize()
    {
        $password = $_POST['password'];
        $email = $_POST['email'];
        $this->model('User')->checkLogin($email, $password);
        //$this->view('login/index', ['test' => $test]);
        //return $this->model('checkLogin');
    }
}