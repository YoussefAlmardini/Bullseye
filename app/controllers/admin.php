<?php

class Admin extends Controller
{
    #map page
    public function index()
    {
        $this->view('admin/dashboardmap');
    }

    public function map()
    {
        $this->view('admin/dashboardmap');
    }

    #profile page
    public function profiel()
    {
        $query = 'SELECT contact_data.first_name, contact_data.insertion, contact_data.last_name, contact_data.email_address, contact_data.function, contact_data.phone_number 
        FROM organisations 
        LEFT JOIN customers_customer_data ON organisations.customer_id = customers_customer_data.customer_id 
        LEFT JOIN contact_data ON customers_customer_data.data_id = contact_data.data_id 
        WHERE organisations.organisation_id = :id';
        $db = DB::connect();
        $stmt = $db->prepare($query);
        $stmt->bindValue(':id', '2');
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->view('admin/profiel', ['user' => $user]);
    }

    #admin register page
    public function registeradmin()
    {
        $this->view('admin/registeradmin');
    }



    public function CreateNewAdmin()
    {

        $role_id = 2;
        $first_name = $_POST['firstName'];
        $insertion = $_POST['insertion'];
        $last_name = $_POST['lastName'];
        $birth_date = $_POST['birthDate'];
        $email_address = $_POST['email_address'];
        $password = $_POST['password'];


        $model = $this->model('AdminCreate');

        if ($model->CreateAdmin($role_id, $first_name, $insertion, $last_name, $birth_date, $email_address, $password)) {
            echo "<script>alert('Het admin account is gemaakt!');</script>";
            $this->view('admin/dashboardmap');
        } else {
            $this->view('/admin/registeradmin');
        }
    }

    public function UpdateAdminAccount()
    {
        // THIS FUNCTION CATCHES THE BY THE USER INSERTED DATA AND SENDS IT TO THE MODEL

        $firstName = htmlentities(htmlspecialchars($_POST['firstName']));
        $insertion = htmlentities(htmlspecialchars($_POST['insertion']));
        $lastName = htmlentities(htmlspecialchars($_POST['lastName']));
        $function = htmlentities(htmlspecialchars($_POST['function']));
        $phone_number = htmlentities(htmlspecialchars($_POST['phone_number']));
        $ID = '1';

        $model = $this->model('User');

        if ($model->validateAdminInputUpdate($firstName, $insertion, $lastName, $function, $phone_number, $ID)) {
            echo "<script>alert('Uw account is succesvol geupdate!');</script>";
            $this->view('admin/dashboardmap');
        } else {
            $this->view('/admin/profiel');
        }
    }


    public function function_admin()
    {
        $this->view('models/admin.php');
    }


    public function api($id)
    {
        $admin = $this->model('Admin2');
        $res = $admin->getAllQuestionOrderByQueue($id);

        echo json_encode($res);
        exit;
    }

    public function updateMarker()
    {
        $data = json_decode(file_get_contents('php://input'));
        $admin = $this->model('Admin2');
        $res = $admin->updateOrAddQuestion($data);
        echo json_encode($res);
        exit;
    }

    public function deleteQuest()
    {
        $data = json_decode(file_get_contents('php://input'));
        $admin = $this->model('Admin2');
        $res = $admin->deleteQuest($data);
        echo json_encode($res);
        exit;
    }

    public function newMap()
    {
        $data = json_decode(file_get_contents('php://input'));
        $admin = $this->model('Admin2');
        $res = $admin->newMap($data);
        echo json_encode($res);
        exit;
    }

    public function deleteMap()
    {
        $data = json_decode(file_get_contents('php://input'));
        $admin = $this->model('Admin2');
        $res = $admin->deleteMap($data);
        echo json_encode($res);
        exit;
    }

    public function getMaps($id)
    {
        $admin = $this->model('Admin2');
        $res = $admin->getAllMapsOrderByID($id);

        echo json_encode($res);
        exit;
    }

    public function generateHeatmap()
    {
        return $this->view('admin/generateHeatmap', ['organisations' => Admin::getOrganisations()]);
    }

    public function initHeatmapPeriod()
    {
        if (isset($_POST['submit'])) {
            $startDate = $_POST['starting_date'];
            $endDate = $_POST['end_date'];
            $organisationName = $_POST['organisation'];
            $locationsObj = new stdClass();

            if ($endDate < $startDate) {
                echo '<script>alert("De einddatum mag niet voor de begindatum zijn!");</script>';
            } else {
                $locationsObj = $this->model('AnonymousLocation')->getLocationsArr($startDate, $endDate, $organisationName);
            }
        }

        return $this->view('admin/heatmap', ['locations' => $locationsObj]);
    }

    public function addCustomer()
    {
        return $this->view('admin/addCustomer');
    }

    public function getCustomers()
    {
        $customers = [];
        $query = 'SELECT name FROM customers;';
        $db = DB::connect();
        $stmt = $db->prepare($query);
        $stmt->execute();
        $res = $stmt->fetchAll();

        for ($i = 0; $i < count($res); $i++) {
            array_push($customers, $res[$i]['name']);
        }

        return $customers;
    }

    public function getOrganisations()
    {
        $organisations = [];
        $query = 'SELECT name FROM organisations WHERE customer_id = :customer_id;';
        $db = DB::connect();
        $stmt = $db->prepare($query);
        $stmt->bindValue(':customer_id', $_SESSION['customer_id']);
        $stmt->execute();
        $res = $stmt->fetchAll();

        for ($i = 0; $i < count($res); $i++) {
            array_push($organisations, $res[$i]['name']);
        }

        return $organisations;
    }

    public function getCustomerID()
    {
        $query = 'SELECT customer_id FROM users WHERE user_id = :user_id;';
        $db = DB::connect();
        $stmt = $db->prepare($query);
        $stmt->bindValue(':user_id', $_SESSION['user_id']);
        $stmt->execute();
        $res = $stmt->fetch(PDO::FETCH_OBJ);

        return $res->customer_id;
    }

    public function addOrganisation()
    {
        return $this->view('admin/addOrganisation', ['customer_id' => Admin::getCustomerID()]);
    }

    public function sendCustomerDataToModel()
    {
        if (isset($_POST['submit'])) {
            $companyName = $_POST['company_name'];
            $postalCode = $_POST['postal_code'];
            $streetName = $_POST['street_name'];
            $houseNumber = $_POST['house_number'];
            $houseLetter = $_POST['house_letter'];
            $mailingAddressPostalCode = $_POST['mailing_address_postal_code'];
            $mailingAddressStreetName = $_POST['mailing_address_street_name'];
            $mailingAddressHouseNumber = $_POST['mailing_address_house_number'];
            $mailingAddressHouseLetter = $_POST['mailing_address_house_letter'];

            if ($this->model('Customer')->saveCustomer($companyName, $postalCode, $streetName, $houseNumber, $houseLetter, $mailingAddressPostalCode, $mailingAddressStreetName, $mailingAddressHouseNumber, $mailingAddressHouseLetter)) {
                header('Location: /admin/map');
            }
        }
    }

    public function sendOrganisationDataToModel()
    {
        if (isset($_POST['submit'])) {
            $customer = $_POST['customer_id'];
            $organisationName = $_POST['organisation_name'];
            $postalCode = $_POST['postal_code'];
            $streetName = $_POST['street_name'];
            $houseNumber = $_POST['house_number'];
            $houseLetter = $_POST['house_letter'];
            $mailingAddressPostalCode = $_POST['mailing_address_postal_code'];
            $mailingAddressStreetName = $_POST['mailing_address_street_name'];
            $mailingAddressHouseNumber = $_POST['mailing_address_house_number'];
            $mailingAddressHouseLetter = $_POST['mailing_address_house_letter'];

            if ($this->model('Organisation')->saveOrganisation($customer, $organisationName, $postalCode, $streetName, $houseNumber, $houseLetter, $mailingAddressPostalCode, $mailingAddressStreetName, $mailingAddressHouseNumber, $mailingAddressHouseLetter)) {
                header('Location: /admin/map');
            }
        }
    }

    public function getProfileData()
    {
        $profileData = [];
        $query = 'SELECT first_name, insertion, last_name, email_address FROM users WHERE user_id = :user_id;';
        $db = DB::connect();
        $stmt = $db->prepare($query);
        $stmt->bindValue(':user_id', $_SESSION['user_id']);
        $stmt->execute();
        $res = $stmt->fetchAll();

        for ($i = 0; $i < count($res); $i++) {
            array_push($profileData, $res[$i]);
        }

        return $profileData;
    }

    public function addCustomerAccount()
    {
        $this->view('admin/addCustomerAccount', ['customers' => Admin::getCustomers()]);
    }

    public function addOrganisationAccount()
    {
        $this->view('admin/addOrganisationAccount', ['organisations' => Admin::getOrganisations()]);
    }

    public function updateProfile()
    {
        return $this->view('admin/updateProfile', ['profileData' => Admin::getProfileData()]);
    }

    public function sendProfileDataToModel()
    {
        if (isset($_POST['submit'])) {
            $firstName = $_POST['firstName'];
            $insertion = $_POST['insertion'];
            $lastName = $_POST['lastName'];
            $email = $_POST['email'];

            if ($this->model('User')->updateAdminProfile($firstName, $insertion, $lastName, $email)) {
                header('Location: /admin/map');
            }
        }
    }

    public function addContact()
    {

        $customers = [];
        $query = 'SELECT name FROM customers;';
        $db = DB::connect();
        $stmt = $db->prepare($query);
        $stmt->execute();
        $res = $stmt->fetchAll();

        for ($i = 0; $i < count($res); $i++) {
            array_push($customers, $res[$i]['name']);
        }

        return $this->view('admin/addContact', ['customers' => $customers]);
    }

    public function sendContactDataToModel()
    {
        if (isset($_POST['submit'])) {

            $customer = $_POST['customer'];
            $first_name = $_POST['firstname'];
            $insertion = $_POST['insertion'];
            $last_name = $_POST['lastname'];
            $function = $_POST['function'];
            $email = $_POST['email'];
            $phone_number = $_POST['phonenumber'];


            if ($this->model('Contact')->saveContact($customer, $first_name, $insertion, $last_name, $function, $email, $phone_number)) {
                header('Location: /admin/map');
            }
        }
    }
}
