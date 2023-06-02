<?php
$option = (empty($_GET['option'])) ? '' : $_GET['option'];
require_once('../models/ModeloMaterias.php');
$Materias = new ModeloMaterias();
switch ($option) {
    case 'Registrar':
        $accion = file_get_contents('php://input');
        $Array = json_decode($accion, true);
        //echo json_encode($Array);
        //----- Datos del formulario de registro de Materia----
        $idMateria = $Array['idMateria'];
        $ClaveMateria = $Array['ClaveMateria'];
        $NombreMateria = $Array["NombreMateria"];
        $Profesor = $Array["Profesor"];
        $Grupo = $Array["Grupo"];
        //-- ./ Datos del formulario de registro de Materia----
        if ($idMateria == "") {
            if ($ClaveMateria == '' || $NombreMateria == '' || $Profesor == '') {
                $resp = array('tipo' => 'error', 'mensaje' => 'Debe llenar todos los campos');
            } else {
                $Resultado = $Materias->RegistrarMateria($ClaveMateria, $NombreMateria, $Profesor, $Grupo);
                if ($Resultado) {
                    $resp = array('tipo' => 'success', 'mensaje' => 'Materia registrada correctamente');
                } else {
                    $resp = array('tipo' => 'error', 'mensaje' => 'Error en el registro');
                }
            }
        } else {
            $Resultado = $Materias->EditarMateria($ClaveMateria, $NombreMateria, $Profesor, $Grupo, $idMateria);
            if ($Resultado) {
                $resp = array('tipo' => 'success', 'mensaje' => 'Materia actualizada correctamente');
            } else {
                $resp = array('tipo' => 'error', 'mensaje' => 'Error la actualizacion de la informacio');
            }
        }



        echo json_encode($resp);
        break;

    case 'listar':
        $Resultado = $Materias->ObtenerMaterias();
        for ($i = 0; $i < count($Resultado); $i++) {
            //Edicion dela etiqueta de estado por su valor textual
            switch ($Resultado[$i]['Grupo']) {
                case 1:
                    $Resultado[$i]['Grupo'] = "<span class='badge bg-primary text-white'>C001</span>";
                    break;
                case 2:
                    $Resultado[$i]['Grupo'] = "<span class='badge bg-warning text-white'>C002</span>";
                    break;
                case 3:
                    $Resultado[$i]['Grupo'] = "<span class='badge bg-danger text-white'>C003</span>";
                    break;
                default:
                    break;
            }
            $Resultado[$i]['Acciones'] = '
                                        <a class="btn btn-info btn-sm" href="#" data-toggle="modal" data-target="#ModalRegistroMateria" onclick="VerMateria(' . $Resultado[$i]['IdMateria'] . ')"><i class="fas fa-fw fa-eye"></i><a/>
                                        <a class="btn btn-danger btn-sm" href="#" onclick="EliminarMateria(' . $Resultado[$i]['IdMateria'] . ')"><i class="fas fa-fw fa-trash"></i><a/>
                                        ';
        }
        echo json_encode($Resultado);

        break;
    case 'ListarProfesores':
        $textoBusqueda = $_GET['texto'];
        $Resultado = $Materias->ObtenerProfesores($textoBusqueda);
        echo json_encode($Resultado);
        break;
    case 'EditarMateria':
        $idMateria = $_GET['idMateria'];
        $Resultado = $Materias->ObtenerMateria($idMateria);
        echo json_encode($Resultado);
        break;
        /*case 'EliminarMateria':
        $idMateria = $_GET['idMateria'];
        $Resultado = $Materias->EliminarMateria($idMateria);
        if ($Resultado) {
            $resp = array('tipo' => 'success', 'mensaje' => 'Materia eliminada correctamente!');
        } else {
            $resp = array('tipo' => 'error', 'mensaje' => 'Error al eliminar el registro');
        }
        echo json_encode($resp);
        break;*/

    default:
        # code...
        break;
}
