<?php

class MainModel extends Model
{
    public static function GetExpeditions()
    {
      
    }

    public static function getYourCurrentQuestion()
    {
        $user_id = $_SESSION['user']['user_id'];
        error_log(print_r($_SESSION['quests'],TRUE));
        $query = "SELECT * FROM user_answers WHERE answered = 0 AND user_id = $user_id";
        $db = DB::connect();
        $stmt = $db->prepare($query);
        $stmt->execute();

        if($stmt->rowCount() === 0){
            return $_SESSION['quests'][0];
        }else{
            $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            for($i = 0; $i < count($result); $i++) {
               if($_SESSION['quests'][$i]['quest_id'] == $result['quest_id']){
                    unset($_SESSION['quests'][$i]);
               }
            }
            return $_SESSION['quests'][0];
        }
    }

    public static function insertUserAnswer($user_id, $quest_id){
        $query_insert = 'INSERT INTO `user_answers` (`user_id`, `quest_id`, `answered`, `answer`) VALUES (:u_id,:quest_id , :answerd, NULL)';
        $db = DB::connect();
        $stmt = $db->prepare($query_insert);
        $stmt->bindValue(':u_id', $user_id);
        $stmt->bindValue(':quest_id',  $quest_id);
        $stmt->bindValue(':answerd', 1);
        $stmt->execute();
    }

    public static function validateUserAnswer($userAnswer){

        $user_id = $_SESSION['user']['user_id'];
        $quest = this::getYourCurrentQuestion();
        $quest_id =  $quest['quest_id'];

        $query = "SELECT `answer` FROM `quests` WHERE `quest_id` = $quest_id";
        $db = DB::connect();
        $stmt = $db->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        if($result[0]['answer'] == $userAnswer){
            this::insertUserAnswer($user_id,$quest_id);
            return true;

        }else return false;
        
    }
}