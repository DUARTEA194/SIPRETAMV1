<?php
require_once 'config.php';
require_once 'controllers/logincontroller.php';
$login = new Login();
if (isset($_GET['pagina'])) {
    if (empty($_GET['pagina'])) {
        $login->index();
    } else {
        try {
            $archivo = $_GET['pagina'];
            if ($archivo == 'Registro') {
                $login->Registro();
            } else if ($archivo != 'Registro') {
                $login->NotFound();
            }
        } catch (\Throwable $th) {
            $login->NotFound();
        }
    }
} else {
    $login->index();
}
