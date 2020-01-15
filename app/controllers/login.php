<?php

class Login extends Controller
{
    public function index()
    {
        $this->view('login/index');
    }

    public function authenticate()
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

    public function redirectUser($role){
        if($role === 'ranger'){
            header('Location: /main');
            echo "<script>confirm('U bent ingelogd als ranger');</script>";
        } else if($role === 'admin'){
            echo "<script>window.location.href = '/admin/map';</script>";
        }
    }

    public function authorizeAdmin(){
        $password = $_POST['password'];
        $email = $_POST['email'];

        if(Login::authenticate($email, $password, 'admin')){
            Login::redirectUser('admin');
        }
    }

    public function authorizeRanger(){
        $password = $_POST['password'];
        $email = $_POST['email'];

        if(login::authenticate($email, $password, 'ranger')){
            Login::redirectUser('ranger');
        }
    }
}