<?php

class Admin2 extends Model
{
    public function getAllQuestionOrderByQueue($id){
        // THIS FUNCTION CHECKS FOR EXISTANCE OF THE BY THE USER INSERTED E-MAILADDRESS

        $query = 'SELECT * FROM quests WHERE expedition_id = '.$id.' ORDER BY queue';
        $db = DB::connect();
        $stmt = $db->prepare($query);
        $stmt->execute();
        
        if($stmt->rowCount() === 0){
            return [];
        }     

        $res = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        return array_map(function($marker) {
            return [
                'id' => $marker['quest_id'],
                'expedition_id' => $marker['expedition_id'],
                'type_id' => $marker['type_id'],
                'answer'=> $marker['answer'],
                'queue'=> $marker['queue'],
                'quest' => $marker['quest'],
                'cordinates' => [
                    'lat'=> $marker['coordinate_langitude'],
                    'lng'=> $marker['coordinate_longitude'],
                ],
                'tips'=> [
                    $marker['tip_1'],
                    $marker['tip_2'] ?? '',
                ],
                'answer'=> $marker['answer']
            ];
        }, $res);
    }

    public function updateOrAddQuestion($data)
    {
        error_log(print_r($data,1));
        $question_ID = $data->id;
        $expedition_id = $data->expedition_id;
        $answer = $data->answer;
        $type_id = $data->type_id;
        $queue = $data->queue;
        $quest = $data->title;
        $tip1 = $data->tip1;
        $tip2 = $data->tip2;
        $latitude = $data->latitude;
        $longitude = $data->longitude;

        if(empty($question_ID)){
            //Als er geen vraag bestaat maak er 1 aan
            $query = "INSERT INTO quests (`expedition_id`, `type_id`, `answer`, `queue`, `quest`, `coordinate_langitude`, `coordinate_longitude`, `tip_1`, `tip_2`)
            VALUES ($expedition_id, $type_id, '$answer', $queue, '$quest', $latitude, $longitude, '$tip1', '$tip2')";
            $db = DB::connect();
            $stmt = $db->prepare($query);
            if ($stmt->execute()) { 
                return true;
             } else {
                return false;
            }
        } else{
            //Als de vraag al bestaat, update de vraag
            $query = "UPDATE quests SET 
            `expedition_id` = $expedition_id, 
            `type_id` = $type_id, 
            `answer` = '$answer',
            `queue` = $queue,
            `quest` = '$quest',
            `tip_1` = '$tip1',
            `tip_2` = '$tip2',
            `coordinate_langitude` = $latitude,
            `coordinate_langitude` = $longitude WHERE quest_id = ".$question_ID;
            $db = DB::connect();
            $stmt = $db->prepare($query);
            if ($stmt->execute()) { 
                return true;
             } else {
                return false;
            }
        }
    }
}