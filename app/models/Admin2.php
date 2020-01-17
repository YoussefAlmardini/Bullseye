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
        $question_ID = $data->id;
        $expedition_id = $data->expedition_id;
        $answer = strtolower($data->answer);
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

    public function newMap($data)
    {
        $id = $data->id;
        $title = $data->title;        
        $loc_expedition = $data->loc_expedition;        
        $description = $data->description;        
        $info = $data->info;        
        $latitude = $data->latitude;        
        $longitude = $data->longitude;  
        $levels = $data->levels;
        $expedition_id = $data->expedition_id;      

        if(empty($expedition_id)){
       //Als er geen expeditie/map bestaat maak er 1 aan

        $query = "INSERT INTO expeditions (expedition_id,organisation_id,name,location_name,levels,description,info,start_coordinate_langitude,start_coordinate_longitude)
                VALUES ('',$id,'$title','$loc_expedition','$levels','$description','$info',$latitude,$longitude)"; 
        $db = DB::connect();
        $stmt = $db->prepare($query);
            if ($stmt->execute()) { 
                return true;
            } else {
                return false;
            }
        } else {
                    $query = "UPDATE expeditions SET 
                    name = '$title', 
                    location_name = '$loc_expedition',
                    levels = $levels,
                    description = '$description',
                    info = '$info' WHERE organisation_id = $id AND expedition_id = $expedition_id"; 
                    $db = DB::connect();
                    $stmt = $db->prepare($query);
                    if ($stmt->execute()) { 
                        return true;
                     } else {
                        return false;
                    }
                }
        }
    

    public function deleteQuest($data) {
        $id = $data->id;
        error_log($id);
        $query = "DELETE FROM quests WHERE quest_id = $id";
        $db = DB::connect();
        $stmt = $db->prepare($query);
        if($stmt->execute()){
            return true;
        } else {
           return false;
        }
    }

    public function deleteMap($data) {
        error_log(print_r($data,1));
        $expedition_id = $data->expedition_id;

        $query = "DELETE FROM quests WHERE expedition_id = $expedition_id";
        $db = DB::connect();
        $stmt = $db->prepare($query);
        if($stmt->execute()){
            $query = "DELETE FROM expeditions WHERE expedition_id = $expedition_id";
            $db = DB::connect();
            $stmt = $db->prepare($query);
            if($stmt->execute()){
                return true;
            } else {
               return false;
            }
        } else {
           return false;
        }

       
    }

    public function getAllMapsOrderByID($id){
        // THIS FUNCTION CHECKS FOR EXISTANCE OF THE MAPS BY ORDER OF ID's
        $query = 'SELECT * FROM expeditions WHERE organisation_id = '.$id.' ORDER BY expedition_id';
        $db = DB::connect();
        $stmt = $db->prepare($query);
        $stmt->execute();
        
        if($stmt->rowCount() === 0){
            return [];
        }     

        $res = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            return array_map(function($maps) {
            return [
                'expedition_id' => $maps['expedition_id'],
                'organisation_id' => $maps['organisation_id'],
                'nameMap'=> $maps['name'],
                'name'=> $maps['location_name'],
                'description' => $maps['description'],
                'info' => $maps['info'],
                'levels' => $maps['levels'],
                'cordinates' => [
                    'lat'=> $maps['start_coordinate_langitude'],
                    'lng'=> $maps['start_coordinate_longitude'],
                ],
            ];
        }, $res);
    }
}