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
}