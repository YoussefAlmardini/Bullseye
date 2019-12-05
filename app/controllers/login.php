<?php

class Login extends Controller
{
    public function index()
    {
        $this->view('login/index');
        //echo "Home pagina met method 'index' met Username: " . $username;
    }
}