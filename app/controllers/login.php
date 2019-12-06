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
        $password = "123";
        $email = "somegamemusic@gmail.com";
        $result = $this->model('User')->checkLogin($email, $password);
    
        $this->view('login/index', ['test' => $result]);
        //return $this->model('checkLogin');
    }
}