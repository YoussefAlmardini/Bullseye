<?php

class AnonymousLocation extends Model
{
    protected $table = 'user';
    protected $fields = [
        'location_id',
        'latitude',
        'longitude',
        'date'
    ];

    public function saveLocation($latitude, $longitude){
        $query = 'INSERT INTO anonymous_user_locations (latitude, longitude, date) VALUES (:latitude, :longitude, :date);';
        $db = DB::connect();
        $stmt = $db->prepare($query);
        $stmt->bindValue(':latitude', $latitude);
        $stmt->bindValue(':longitude', $longitude);
        $smtm->bindValue(':date', date('Y-m-d'));
        $stmt->execute();
    }
}