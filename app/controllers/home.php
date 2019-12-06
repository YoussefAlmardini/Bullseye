<?php

class Home extends Controller
{

    public function index($username = '')
    {
        $user = $this->model('User');
        $user->username = $username;
        $this->view('home/index', ['username' => $user->username]); 
        //echo "Home pagina met method 'index' met Username: " . $username;
    }

    public function test() //test function 
    {
        echo "Home pagina met method 'test'";
        
        
    }
}