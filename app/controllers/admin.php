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

    public function logout(){
        session_unset();
        session_destroy();
        header("Location: admin/index");
    }

    public function dashboard()
    {
        $this->view('admin/dashboard');
    }

    public function heatmap(){
        $this->view('admin/heatmap');
    }
}