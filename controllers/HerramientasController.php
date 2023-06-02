<?php
$option = (empty($_GET['option'])) ? '' : $_GET['option'];
require_once('../models/ModeloHerramientas.php');
$Herramientas = new ModeloHerramientas();
$RolUsuario = $_SESSION['RolUsuario'];
switch ($option) {
    case 'Registrar':
        $accion = file_get_contents('php://input');
        $Array = json_decode($accion, true);
        //echo json_encode($Array);
        //----- Datos del formulario de registro de Herramienta----
        $idHerramienta = $Array['idHerramienta'];
        $NombreHerramienta = $Array["NombreHerramienta"];
        $CantidadHerramienta = $Array["CantidadHerramienta"];
        $EstadoHerramienta = $Array["EstadoHerramienta"];
        //-- ./ Datos del formulario de registro de Herramienta----
        if ($idHerramienta == "") {
            if ($NombreHerramienta == '' || $CantidadHerramienta == '' || $EstadoHerramienta == '') {
                $resp = array('tipo' => 'error', 'mensaje' => 'Debe llenar todos los campos');
            } else {
                $Resultado = $Herramientas->RegistrarHerramienta($NombreHerramienta, $CantidadHerramienta, $EstadoHerramienta);
                if ($Resultado) {
                    $resp = array('tipo' => 'success', 'mensaje' => 'Herramienta registrada correctamente');
                } else {
                    $resp = array('tipo' => 'error', 'mensaje' => 'Error en el registro');
                }
            }
        } else {
            $Resultado = $Herramientas->EditarHerramienta($NombreHerramienta, $CantidadHerramienta, $EstadoHerramienta, $idHerramienta);
            if ($Resultado) {
                $resp = array('tipo' => 'success', 'mensaje' => 'Herramienta actualizada correctamente');
            } else {
                $resp = array('tipo' => 'error', 'mensaje' => 'Error la actualizacion de la informacio');
            }
        }



        echo json_encode($resp);
        break;
    case 'listar':
        $Resultado = $Herramientas->ObtenerHerramientas();
        for ($i = 0; $i < count($Resultado); $i++) {
            //Edicion dela etiqueta de estado por su valor textual
            switch ($Resultado[$i]['EstadoHerramienta']) {
                case 1:
                    $Resultado[$i]['EstadoHerramienta'] = "<span class='badge bg-primary text-white'>Disponible</span>";
                    break;
                case 2:
                    $Resultado[$i]['EstadoHerramienta'] = "<span class='badge bg-warning text-white'>Mantenimiento</span>";
                    break;
                case 3:
                    $Resultado[$i]['EstadoHerramienta'] = "<span class='badge bg-danger text-white'>No disponible</span>";
                    break;
                default:
                    break;
            }
            if ($RolUsuario == "Administrador") {
                $Resultado[$i]['Acciones'] = '<div class="text-center">
                                          <a class="btn btn-info btn-sm" href="#" data-toggle="modal" data-target="#ModalRegistroHerramienta" onclick="VerHerramienta(' . $Resultado[$i]['idHerramienta'] . ')"><i class="fas fa-fw fa-eye"></i> Ver<a/>
                                          <a class="btn btn-danger btn-sm" href="#" onclick="EliminarHerramienta(' . $Resultado[$i]['idHerramienta'] . ')"><i class="fas fa-fw fa-trash"></i>Borrar<a/>
                                          </div>';
            } else {
                $Resultado[$i]['Acciones'] = '<div class="text-center">
                                          <a class="btn btn-info btn-sm" href="#" data-toggle="modal" data-target="#ModalRegistroHerramienta" onclick="VerHerramienta(' . $Resultado[$i]['idHerramienta'] . ')"><i class="fas fa-fw fa-eye"></i> Ver<a/>
                                          </div>';
            }
        }
        echo json_encode($Resultado);

        break;

    case 'EditarHerramienta':
        $idHerramienta = $_GET['idHerramienta'];
        $Resultado = $Herramientas->ObtenerHerramienta($idHerramienta);
        echo json_encode($Resultado);
        break;
    case 'EliminarHerramienta':
        $idHerramienta = $_GET['idHerramienta'];
        $Resultado = $Herramientas->EliminarHerramienta($idHerramienta);
        if ($Resultado) {
            $resp = array('tipo' => 'success', 'mensaje' => 'Herramienta eliminada correctamente!');
        } else {
            $resp = array('tipo' => 'error', 'mensaje' => 'Error al eliminar el registro');
        }
        echo json_encode($resp);
        break;
    default:
        # code...
        break;
}
