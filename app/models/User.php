<?php

class User extends Model
{
    protected $table = 'user';
    protected $fields = [
        'user_id',
        'role_id',
        'first_name',
        'insertion',
        'last_name',
        'birthdate',
        'email_address',
        'password'
    ];

    public function validateUserInput($firstName, $insertion, $lastName, $birthDate, $email_address, $repeatedEmail_address, $password, $repeatedPassword, $hashedPassword, $role_id, $customer, $organisation)
    {
        // THIS FUNCTION VALIDATES THE BY THE USER INSERTED DATA

        if (
            filter_var($email_address, FILTER_VALIDATE_EMAIL) &&
            $email_address === $repeatedEmail_address
        ) {
            if (User::checkForExistance($email_address)) {
                if ($password === $repeatedPassword) {
                    if (strtotime($birthDate) - time() < 0) {
                        $query = 'SELECT customer_id FROM customers WHERE name = :name;';
                        $db = DB::connect();
                        $stmt = $db->prepare($query);
                        $stmt->bindValue(':name', $customer);
                        $stmt->execute();
                        $customerObj = $stmt->fetch(PDO::FETCH_OBJ);

                        $query2 = 'SELECT organisation_id FROM organisations WHERE name = :name;';
                        $db = DB::connect();
                        $stmt2 = $db->prepare($query2);
                        $stmt2->bindValue(':name', $organisation);
                        $stmt2->execute();
                        $organisationObj = $stmt2->fetch(PDO::FETCH_OBJ);

                        if ($stmt->rowCount() > 0) {
                            $customerID = $customerObj->customer_id;
                            $organisationID = null;

                            User::saveUserInDatabase($firstName, $insertion, $lastName, $birthDate, $email_address, $hashedPassword, $role_id, $customerID, $organisationID);
                            return true;
                        } else if ($stmt2->rowCount() > 0) {
                            $customerID = null;
                            $organisationID = $organisationObj->organisation_id;

                            User::saveUserInDatabase($firstName, $insertion, $lastName, $birthDate, $email_address, $hashedPassword, $role_id, $customerID, $organisationID);
                            return true;
                        } else {
                            $customerID = null;
                            $organisationID = null;

                            User::saveUserInDatabase($firstName, $insertion, $lastName, $birthDate, $email_address, $hashedPassword, $role_id, $customerID, $organisationID);
                            return true;
                        }
                    } else {
                        echo "<script>alert('Uw geboortedatum kan zich niet in de toekomst bevinden!');</script>";
                    }
                } else {
                    echo "<script>alert('De wachtwoorden in beide velden moeten overeenkomen!');</script>";
                }
            } else {
                echo "<script>alert('Er bestaat al een gebruiker met hetzelfde e-mailadres!');</script>";
            }
        } else {
            echo "<script>alert('De e-mailadressen in beide velden moeten overeenkomen!');</script>";
        }
    }

    public function checkForExistance($email_address)
    {
        // THIS FUNCTION CHECKS FOR EXISTANCE OF THE BY THE USER INSERTED E-MAILADDRESS

        $query = 'SELECT user_id FROM users WHERE email_address = :email_address';
        $db = DB::connect();
        $stmt = $db->prepare($query);
        $stmt->bindValue(':email_address', $email_address);
        $stmt->execute();

        if ($stmt->rowCount() < 1) {
            return true;
        } else {
            return false;
        }
    }

    public function saveUserInDatabase($firstName, $insertion, $lastName, $birthDate, $email_address, $password, $role_id, $customerID, $organisationID)
    {
        // THIS FUNCTION SAVES THE USER IN THE DATABASE

        $query = 'INSERT INTO users(role_id, first_name, insertion, last_name, birthdate, email_address, password, customer_id, organisation_id) VALUES (:role_id, :firstName, :insertion, :lastName, :birthDate, :email_address, :password, :customer_id, :organisation_id);';
        $db = DB::connect();
        $stmt = $db->prepare($query);
        $stmt->bindValue(':role_id', $role_id);
        $stmt->bindValue(':firstName', $firstName);
        $stmt->bindValue(':insertion', $insertion);
        $stmt->bindValue(':lastName', $lastName);
        $stmt->bindValue(':birthDate', (new Datetime($birthDate))->format('Y-m-d'));
        $stmt->bindValue(':email_address', $email_address);
        $stmt->bindValue(':password', $password);
        $stmt->bindValue(':customer_id', $customerID);
        $stmt->bindValue(':organisation_id', $organisationID);
        $stmt->execute();
    }

    function __construct()
    {
    }

    function checkLogin($email, $password)
    {
        $db = DB::connect();
        
        if ($db == false) {
            $_SESSION['errors']['no_connection'] = true;
        }

        $stmt = $db->prepare("SELECT users.*, roles.role FROM users INNER JOIN roles ON users.role_id = roles.role_id WHERE users.email_address = :email;");
        $stmt->bindValue(':email', $email);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        $_SESSION['errors'] = [];
        
        // If email is not valid
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            unset($_SESSION['errors']);
        } else {
            unset($_SESSION['errors']);
            $_SESSION['errors']['unvalid_email'] = true;
            return false;
        }

        //If user does not exist
        if ($user === false) {
            unset($_SESSION['errors']);
            $_SESSION['errors']['inc_username'] = true;
            return false;
        } else {
            $validPassword = password_verify($password, $user['password']);
            if ($validPassword) {
                $_SESSION['user'] = $user;
                $_SESSION['user_id'] = $user['user_id'];
                $_SESSION['logged_in'] = time();

                $role = $user['role'];

                if ($role === 'admin') {
                    $_SESSION['adminLoggedIn'] = true;
                    return 3;
                } else if ($role === 'customer') {
                    $_SESSION['customerLoggedIn'] = true;
                    return 2;
                } else if ($role === 'organisation') {
                    $_SESSION['organisationLoggedIn'] = true;
                    return 4;
                } else if ($role === 'ranger') {
                    $_SESSION['rangerLoggedIn'] = true;
                    return 1;
                }
                unset($_SESSION['errors']);
            } else {
                unset($_SESSION['errors']);
                $_SESSION['errors']['inc_password'] = true;
                return false;
            }
        }
    }

    public function validateUserInputUpdate($firstName, $insertion, $lastName, $birthDate, $ID, $role_id)
    {
        // THIS FUNCTION VALIDATES THE BY THE USER INSERTED DATA OF THE PROFILE PAGE

        if (strtotime($birthDate) - time() < 0) {
            User::updateUserInDatabase($firstName, $insertion, $lastName, $birthDate, $ID);
            return true;
        } else {
            echo "<script>alert('Uw geboortedatum kan zich niet in de toekomst bevinden!');</script>";
        }
    }

    public function updateUserInDatabase($firstName, $insertion, $lastName, $birthDate, $ID)
    {
        // THIS FUNCTION UPDATES THE USER IN THE DATABASE

        $query = 'Update users SET first_name = :firstName, insertion = :insertion, last_name = :lastName, birthdate = :birthDate WHERE user_id = :id;';
        $db = DB::connect();
        $stmt = $db->prepare($query);
        $stmt->bindValue(':firstName', $firstName);
        $stmt->bindValue(':insertion', $insertion);
        $stmt->bindValue(':lastName', $lastName);
        $stmt->bindValue(':birthDate', (new Datetime($birthDate))->format('Y-m-d'));
        $stmt->bindValue(':id', $ID);
        $stmt->execute();
    }




    public function validateAdminInputUpdate($firstName, $insertion, $lastName, $function, $phone_number, $ID)
    {
        // THIS FUNCTION VALIDATES THE BY THE USER INSERTED DATA OF THE PROFILE PAGE
        User::updateAdminInDatabase($firstName, $insertion, $lastName, $function, $phone_number, $ID);
        return true;
    }

    public function updateAdminInDatabase($firstName, $insertion, $lastName, $function, $phoneNumber, $ID)
    {
        // THIS FUNCTION UPDATES THE ADMIN IN THE DATABASE

        $query = 'Update contact_data SET first_name = :firstName, insertion = :insertion, last_name = :lastName, function = :function, phone_number = :phoneNumber WHERE data_id = :id;';
        $db = DB::connect();
        $stmt = $db->prepare($query);
        $stmt->bindValue(':firstName', $firstName);
        $stmt->bindValue(':insertion', $insertion);
        $stmt->bindValue(':lastName', $lastName);
        $stmt->bindValue(':function', $function);
        $stmt->bindValue(':phoneNumber', $phoneNumber);
        $stmt->bindValue(':id', $ID);
        $stmt->execute();
    }

    public function updateAdminProfile($firstName, $insertion, $lastName, $email){
        $query = 'UPDATE users SET first_name = :firstName, insertion = :insertion, last_name = :lastName, email_address = :email WHERE user_id = :userID;';
        $db = DB::connect();
        $stmt = $db->prepare($query);
        $stmt->bindValue(':firstName', $firstName);
        $stmt->bindValue(':insertion', $insertion);
        $stmt->bindValue(':lastName', $lastName);
        $stmt->bindValue(':email', $email);
        $stmt->bindValue(':userID', $_SESSION['user_id']);
        $stmt->execute();
    }
}
