<?php

class Ajax extends Controller
{
    public function index()
    {
        $this->view('home/index');
    }

    public function getLocation()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'GET'){
                if(isset(
                    $_GET['latitude'],
                    $_GET['longitude'],
                    $_GET['organisation_id']
                )){
                    Ajax::sendLocationToModel($_GET['latitude'], $_GET['longitude'], $_GET['organisation_id']);
                }
            }
    }

    public function sendLocationToModel($latitude, $longitude, $organisation_id){
        $model = $this->model('AnonymousLocation');
        $model->saveLocation($latitude, $longitude, $organisation_id);
    }
}