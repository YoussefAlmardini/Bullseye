<?php

class MainModel extends Model
{
    public static function GetExpeditions()
    {
      
    }

    public static function getYourCurrentQuestion()
    {
        $user_id = $_SESSION['user']['user_id'];
        $_SESSION['quests'];

        $query = "SELECT * FROM user_answers WHERE answered = 0 AND user_id = $user_id";
        $db = DB::connect();
        $stmt = $db->prepare($query);
        $stmt->execute();

        if($stmt->rowCount() === 0){
            return $_SESSION['quests'][0];
        }
        
    }
}