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

    public function renderindexhtml(){
        $this->view('admin/hmp');
    }

    public function generateHeatmap(){
        $this->view('admin/generateHeatmap');
    }

    public function initHeatmapPeriod(){
        if(isset($_POST['submit'])){
            $startDate = $_POST['starting_date'];
            $endDate = $_POST['end_date'];
            $locationsObj = new stdClass();

            if($endDate < $startDate){
                echo '<script>alert("De einddatum mag niet voor de begindatum zijn!");</script>';
            }else{
                $locationsObj = $this->model('AnonymousLocation')->getLocationsArr($startDate, $endDate);
            }
        }

        return $this->view('admin/heatmap', ['locations' => $locationsObj]);
    }
}