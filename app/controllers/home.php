<?php

class Home extends Controller
{

    public function index()
    {
<<<<<<< HEAD
        $this->view('home/index'); 
=======
        $this->view('home/index');
>>>>>>> development
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