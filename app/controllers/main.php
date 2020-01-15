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
}