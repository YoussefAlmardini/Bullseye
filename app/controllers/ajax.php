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
                    $_GET['longitude']
                )){
                    Ajax::sendLocationToModel($_GET['latitude'], $_GET['longitude']);
                }
            }
    }

    public function sendLocationToModel($latitude, $longitude){
        $model = $this->model('AnonymousLocation');
        $model->saveLocation($latitude, $longitude);
    }
}