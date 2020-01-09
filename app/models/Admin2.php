<?php

class Admin2 extends Model
{
    public function getAllQuestionOrderByQueue($id){
        // THIS FUNCTION CHECKS FOR EXISTANCE OF THE BY THE USER INSERTED E-MAILADDRESS

        $query = 'SELECT * FROM quests INNER JOIN `potential_answers` ON quests.answer_id = `potential_answers`.`answer_id` WHERE expedition_id = '.$id.' ORDER BY queue';
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
                'answer_id'=> $marker['answer_id'],
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
        $query = 'SELECT * FROM quests';
        $db = DB::connect();
        $stmt = $db->prepare($query);
        $stmt->execute();
        
        if($stmt->rowCount() < 1){
            //Als er geen vraag bestaat maak er 1 aan
            $query = 'INSERT INTO quests ()
            VALUES ()';
        } else {
            //Als de vraag al bestaat, update de vraag
            // $query = 'UPDATE quests SET 
            //  = ,
            // WHERE quest_id = '.$question_ID;
            return true;
        }
    }

    public function newMap($data)
    {
        error_log(print_r($data,1));
        $id = $data->id;
        $title = $data->title;        
        $loc_expedition = $data->loc_expedition;        
        $description = $data->description;        
        $info = $data->info;        
        $latitude = $data->latitude;        
        $longitude = $data->longitude;        


        $query = "INSERT INTO expeditions (organisation_id,name,location_name,description,info,start_coordinate_langitude,start_coordinate_longitude)
                VALUES ($id,'$title','$loc_expedition','$description','$info',$latitude,$longitude)"; 
        $db = DB::connect();
        $stmt = $db->prepare($query);
        $stmt->execute();
        
        if($stmt->rowCount() < 1){
            return true;
        } else {
           return false;
        }
    }
}