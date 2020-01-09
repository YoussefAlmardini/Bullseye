<?php

class Main extends Model
{
    public static function GetExpeditions()
    {
        $query = 'SELECT *,`organisations`.`name` as `organisation`,`expeditions`.`name` as `expedition` FROM `expeditions` INNER JOIN `organisations` ON `organisations`.`organisation_id` = `expeditions`.`organisation_id`';
        $db = \DB::connect();
        $stmt = $db->prepare($query);
        $stmt->execute();

        if ($stmt->rowCount() === 0) {
            return [];
        }

        $res = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        return array_map(function ($expedition) {
            return [
                'id' => $expedition['expedition_id'],
                'expedition_name' => $expedition['expedition'],
                'location' => $expedition['location'],
                'info' => $expedition['description'],
                'organistion' => $expedition['organisation'],
                'level' => $expedition['level'],
            ];
        }, $res);
    }
}