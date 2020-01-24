<?php

class Home extends Controller
{

    public function index()
    {
        $this->view('home/index');
    }

    public function test() //test function 
    {
        echo "Home pagina met method 'test'";
    }
    public function logout()
    {
        $_SESSION = [];
        session_destroy();
        header("Location: /login");
    }
}
