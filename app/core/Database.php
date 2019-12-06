<?php

class DB {
    public function connect() {
        $user = "localhost";
        $pass = "xlcaBw";
        try {
            $options = [
                PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION
            ];
            $db = new PDO('mysql:host=localhost;dbname=student4a7_525889', $user, $pass, $options); 
        } catch (PDOException $e) {
            error_log($e->getMessage() . "\n", 3, "log/errorlog.log");
        }
        return $db;
    }

    public static function register($username, $password) {
        $retval = false;
        try {
            $db = DB::connect();
            $sql = ("SELECT * FROM `user` WHERE username = ?");
            $stmt= $db->prepare($sql);
            $stmt->execute([$username]);
            $result = $stmt->fetchAll();
            if (count($result) == 0) {
                $hash = password_hash($password, PASSWORD_DEFAULT);
                $stmt = $db->prepare("INSERT INTO `user` (username, password) VALUES (?,?)");
                $stmt->execute([$username, $hash]);
            }   
        } 
        catch (PDOException $e) {
            error_log($e->getMessage() . "\n", 3, "errorlog.log");
        } 
    } 
}