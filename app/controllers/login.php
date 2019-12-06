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
        $test = $this->model('User');
        $test->checkLogin();
        //$this->view('login/index', ['test' => $test]);
        //return $this->model('checkLogin');

    }
}