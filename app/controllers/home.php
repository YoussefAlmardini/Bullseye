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
        //echo "Home pagina met method 'test'";
        $db = DB::connect();
        $sql = ("SELECT `test`.`test` FROM `test`");
        $stmt= $db->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch();

        print_r($result);
        
    }
}