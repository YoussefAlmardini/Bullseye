<?php

class MainModel extends Model
{
    public static function GetExpeditions()
    {
      
    }

    public static function getYourCurrentQuestion()
    {
        // TODO: expedition_id toevoegen aan query en in database
        $user_id = $_SESSION['user']['user_id'];
        $query = "SELECT * FROM user_answers WHERE user_id = $user_id";
        $db = DB::connect();
        $stmt = $db->prepare($query);
        $stmt->execute();

        if($stmt->rowCount() === 0){
            return $_SESSION['quests'][0];
        }else{
            $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);

            foreach($_SESSION['quests'] as $i => $question) {
                foreach($result as $row) {
                    // var_dump($row, $question);
                    //         error_log(print_r($row,TRUE));
                    if($row['quest_id'] == $question['questionID']) {
                        unset($_SESSION['quests'][$i]);
                    }
                }
            }
            $_SESSION['quests'] = array_values($_SESSION['quests']);
            // var_dump($_SESSION['quests']);
            // for($i = 0; $i < count($_SESSION['quests']); $i++) {
            //     foreach($result as $row) {
            //         error_log(print_r($row,TRUE));
            //         if($row['quest_id'] == $_SESSION[$i]['questionID']) {
            //             unset($_SESSION['quests'][$i]);
            //         }
            //     }
            // }
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

    public static function validateUserAnswer($data){
        $answer = strtolower($data->answer);
        $user_id = $_SESSION['user']['user_id'];
        $quest = MainModel::getYourCurrentQuestion();
        $quest_id =  $quest['questionID'];
        
        $query = "SELECT `answer` FROM `quests` WHERE `quest_id` = $quest_id";
        $db = DB::connect();
        $stmt = $db->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        if($result[0]['answer'] == $answer){
            MainModel::insertUserAnswer($user_id,$quest_id);
            return true;

        }else return false;
        
    }
}