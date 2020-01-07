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

}