<?php

class Admin extends Controller
{
    public function index()
    {
        $this->view('admin/index');
    }
    
    public function map()
    {
        $this->view('admin/dashboardmap');
    }

    public function function_admin()
    {
        $this->view('models/admin.php');
    }

}