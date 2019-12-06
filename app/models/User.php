<?php

class User extends Model
{
    protected $table = 'user';
    protected $fields = [
        'id',
        'role_id',
        'email',
        'password',
        'birthdate',
        'first_name',
        'insertion',
        'last_name'
    ];

    function __construct()
    {
        $db = DB::connect();
        $sql = ("SELECT `test`.`test` FROM `test`");
        $stmt= $db->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch();
    }

    function checkLogin() 
    {
        $db = DB::connect();
        $sql = ("SELECT * FROM `users` WHERE `email` = ?");
        $stmt= $db->prepare($sql);
        if($stmt->execute())
        {
            return "GELUKT!";
        };
        //$result = $stmt->fetch();
        return "niet gelukt";
    }
}