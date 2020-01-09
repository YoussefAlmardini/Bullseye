<?php

class user_images extends Model
{
    public function savePicture($userID, $picture){
        $query = 'INSERT INTO user_images (date, user_id, image) VALUES (:date, :user_id, :image);';
        $db = DB::connect();
        $stmt = $db->prepare($query);
        $stmt->bindValue(':date', date('Y-m-d'));
        $stmt->bindValue(':user_id', $userID);
        $stmt->bindValue(':image', $picture);
        $stmt->execute();
    }
}