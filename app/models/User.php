<?php

class User extends Model
{
    protected $table = 'user';
    protected $fields = [
        'id',
        'username',
        'first_name',
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
        $sql = ("SELECT * FROM `users`");
        $stmt= $db->prepare($sql);
        if($stmt->execute())
        {
            return "GELUKT!";
        };
        //$result = $stmt->fetch();
        return "niet gelukt";
    }
}