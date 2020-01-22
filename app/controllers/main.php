<?php

class Main extends Controller
{
    public function index()
    {
        $this->view('main/index');
    }

    public function list()
    {
        $this->view('main/list');
    }

    public function getYourQuestion()
    {
        $main = $this->model('MainModel');
        $res = $main->getYourCurrentQuestion();

        echo json_encode($res);
        exit;
    }

    public function sendAnswer() {
        $data = json_decode(file_get_contents('php://input'));
        $main = $this->model('MainModel');
        $res = $main->validateUserAnswer($data);

        echo json_encode($res);
        exit;
    }

    
    public function logOut(){
        var_dump($_SESSION);
        return json_encode($_SESSION);
    }
}