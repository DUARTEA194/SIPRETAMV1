<?php
$option = (empty($_GET['option'])) ? '' : $_GET['option'];
require_once('../models/ModeloMaquinas.php');
$Maquinas = new ModeloMaquinas();
$id_user = $_SESSION['idusuario'];
$RolUsuario = $_SESSION['RolUsuario'];
switch ($option) {
    case 'Registrar':
        $accion = file_get_contents('php://input');
        $Array = json_decode($accion, true);
        //echo json_encode($Array);
        //----- Datos del formulario de registro de Maquina----
        $idMaquina = $Array['idMaquina'];
        $NombreMaquina = $Array["NombreMaquina"];
        $ModeloMaquina = $Array["ModeloMaquina"];
        $EstadoMaquina = $Array["EstadoMaquina"];
        $DescripcionMaquina = $Array["DescripcionMaquina"];
        $ObservacionesMaquina = $Array["ObservacionesMaquina"];
        $ImagenMaquina = $Array["ImagenMaquina"];
        //-- ./ Datos del formulario de registro de Maquina----
        if ($idMaquina == "") {
            if ($NombreMaquina == '' || $ModeloMaquina == '' || $EstadoMaquina == '') {
                $resp = array('tipo' => 'error', 'mensaje' => 'Debe llenar todos los campos');
            } else {
                $Resultado = $Maquinas->RegistrarMaquina($NombreMaquina, $ModeloMaquina, $EstadoMaquina, $DescripcionMaquina, $ObservacionesMaquina, $ImagenMaquina);
                if ($Resultado) {
                    $resp = array('tipo' => 'success', 'mensaje' => 'Maquina registrada correctamente');
                } else {
                    $resp = array('tipo' => 'error', 'mensaje' => 'Error en el registro');
                }
            }
        } else {
            $Resultado = $Maquinas->EditarMaquina($NombreMaquina, $ModeloMaquina, $EstadoMaquina, $DescripcionMaquina, $ObservacionesMaquina, $ImagenMaquina, $idMaquina);
            if ($Resultado) {
                $resp = array('tipo' => 'success', 'mensaje' => 'Maquina actualizada correctamente');
            } else {
                $resp = array('tipo' => 'error', 'mensaje' => 'Error la actualizacion de la informacio');
            }
        }



        echo json_encode($resp);
        break;
    case 'listar':
        $Resultado = $Maquinas->ObtenerMaquinas();
        for ($i = 0; $i < count($Resultado); $i++) {
            //Edicion dela etiqueta de estado por su valor textual
            switch ($Resultado[$i]['EstadoMaquina']) {
                case 1:
                    $Resultado[$i]['EstadoMaquina'] = "<span class='badge bg-primary text-white'>Disponible</span>";
                    break;
                case 2:
                    $Resultado[$i]['EstadoMaquina'] = "<span class='badge bg-warning text-white'>Mantenimiento</span>";
                    break;
                case 3:
                    $Resultado[$i]['EstadoMaquina'] = "<span class='badge bg-danger text-white'>No disponible</span>";
                    break;
                default:
                    break;
            }
            if ($RolUsuario == "Administrador") {
                $Resultado[$i]['Acciones'] = '<div class="text-center">
                <a class="btn btn-info btn-sm" href="#" data-toggle="modal" data-target="#ModalRegistroMaquina" onclick="VerMaquina(' . $Resultado[$i]['idMaquina'] . ')"><i class="fas fa-fw fa-eye"></i> Ver<a/>
                <a class="btn btn-danger btn-sm" href="#" onclick="EliminarMaquina(' . $Resultado[$i]['idMaquina'] . ')"><i class="fas fa-fw fa-trash"></i>Borrar<a/>
                </div>';
            } else {
                $Resultado[$i]['Acciones'] = '<div class="text-center">
                    <a class="btn btn-info btn-sm" href="#" data-toggle="modal" data-target="#ModalRegistroMaquina" onclick="VerMaquina(' . $Resultado[$i]['idMaquina'] . ')"><i class="fas fa-fw fa-eye"></i> Ver<a/>
                </div>';
            }
        }
        echo json_encode($Resultado);
        break;

    case 'EditarMaquina':
        $idMaquina = $_GET['idMaquina'];
        $Resultado = $Maquinas->ObtenerMaquina($idMaquina);
        echo json_encode($Resultado);
        break;
    case 'EliminarMaquina':
        $idMaquina = $_GET['idMaquina'];
        $Resultado = $Maquinas->EliminarMaquina($idMaquina);
        if ($Resultado) {
            $resp = array('tipo' => 'success', 'mensaje' => 'Maquina eliminada correctamente!');
        } else {
            $resp = array('tipo' => 'error', 'mensaje' => 'Error al eliminar el registro');
        }
        echo json_encode($resp);
        break;
    default:
        # code...
        break;
}
