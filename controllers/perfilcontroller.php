<?php
$id_user = $_GET['idUsuario'];
$opcion = (empty($_GET['opcion'])) ? '' : $_GET['opcion'];
require_once('../models/usuarios.php');
$Usuarios = new UsuariosModel();
switch ($opcion) {
    case 'EditarUsuario':
        $Resultado = $Usuarios->getUser($id_user);
        echo json_encode($Resultado);
        break;
    case 'Perfil':
        $Resultado = $Usuarios->getUser($id_user);
        echo json_encode($Resultado);
        break;
    default:
        # code...
        break;
}
