<?php

class App
{
 /// website.nl/login/index/
    protected $controller = 'home'; // Standaard controller
    protected $method = 'index'; // Standaard method
    protected $params = []; // Standaard geen params

    public function __construct()
    {
        $url = $this->parseUrl();

        //print_r($url); // For testing

        if(file_exists('../app/controllers/' . $url[0] . '.php' ))
        {
            $this->controller = $url[0];
            unset($url[0]);
        }

        require_once '../app/controllers/' . $this->controller . '.php';
   

        $this->controller = new $this->controller;

        if(isset($url[1]))
        {
            if(method_exists($this->controller, $url[1])) 
            {
                var_dump($url);
                $this->method = $url[1];
                unset($url[1]);
                //echo $url[1]; // For testing
            }
        }

        $this->params = $url ? array_values($url) : [];

        call_user_func_array([$this->controller, $this->method], $this->params);
    }

    public function parseUrl()
    {
        // var_dump($_SERVER['REQUEST_URI']); die;
        if(isset($_GET['url'])) {
            return $url = explode('/', filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL));
        }
    }
}