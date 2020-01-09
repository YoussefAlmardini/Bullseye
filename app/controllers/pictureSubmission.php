<?php

class PictureSubmission extends Controller
{

    public function index()
    {
        $this->view('main/pictureSubmission');
    }

    public function sendDataToModel()
    {
        if (isset($_POST['submit'])) {
            $picture = $_POST['picture'];
            $userID = $_POST['user_id'];
            $fototype = strtolower(pathinfo(basename($picture["name"]), PATHINFO_EXTENSION));

            if (!$picture["size"] > 5000000) {
                if (!$picture["size"] > 1) {
                    if ($fototype != "jpg" && $fototype != "png" && $fototype != "gif") {
                        return "<script>alert('Foto is niet geüpload, bestand moet een .jpg, .png of een .gif zijn');</script>";
                    }else{
                        $this->model('user_images')->savePicture($picture, $userID);
                    }
                }else{
                    return "<script>alert('Foto is niet geüpload, bestand is te klein!');</script>";
                }
            }else{
                return "<script>alert('Foto is niet geüpload, bestand is te groot!');</script>";
            }
        }
    }
}
