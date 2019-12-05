<?php

class Register extends Controller
{
    public function index()
    {
        
        // HIER WORDT DE REGISTER PAGINA OPGEVRAAGD
        $this->view('register/index');
        
    }

    public function register()
    {
        
        // HIER WORDT DATA ONTVANGEN EN M.G.V. Model opgeslagen in DB
        $this->view('register/index');
        
    }
}