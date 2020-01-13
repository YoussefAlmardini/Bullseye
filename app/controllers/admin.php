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

    public function addCustomer(){
        return $this->view('admin/addCustomer');
    }

    public function sendCustomerDataToModel(){
        if(isset($_POST['submit'])){
            $companyName = $_POST['company_name'];
            $postalCode = $_POST['postal_code'];
            $streetName = $_POST['street_name'];
            $houseNumber = $_POST['house_number'];
            $houseLetter = $_POST['house_letter'];
            $mailingAddressPostalCode = $_POST['mailing_address_postal_code'];
            $mailingAddressStreetName = $_POST['mailing_address_street_name'];
            $mailingAddressHouseNumber = $_POST['mailing_address_house_number'];
            $mailingAddressHouseLetter = $_POST['mailing_address_house_letter'];

            $this->model('Customer')->saveCustomer($companyName, $postalCode, $streetName, $houseNumber, $houseLetter, $mailingAddressPostalCode, $mailingAddressStreetName, $mailingAddressHouseNumber, $mailingAddressHouseLetter);
        }
    }
}