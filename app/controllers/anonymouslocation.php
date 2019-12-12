<?php

class AnonymousLocation extends Model
{
    function __construct()
    {
        $model = $this->model('AnonymousLocation');

        if ($_SERVER['REQUEST_METHOD'] === 'POST'){
            if(isset(
                $_POST['latitude'],
                $_POST['longitude']
            )){
                $model->saveLocation($_POST['latitude'], $_POST['longitude']);
            }
        }
    
    }
}