<?php
class Login{
    
    public function index()
    {
        include 'views/login.php';
    }
    public function Registro()
    {
        include 'views/Registro.php';
    }
    //PAGINA NOT FOUND
    public function NotFound()
    {
        include 'views/errors.php';
    }
}

?>