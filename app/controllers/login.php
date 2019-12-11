<?php

class Login extends Controller
{
    public function index()
    {
        $this->view('login/index');
    }

    public function authorize()
    {
        $password = $_POST['password'];
        $email = $_POST['email'];
        $result = $this->model('User')->checkLogin($email, $password);
        if($result) {
            header('Location: /main');
        } else {
            header('Location: /login');
        }
    }
}