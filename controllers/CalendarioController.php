<?php
require_once '../models/Prestamos.php';
$option = (empty($_GET['option'])) ? '' : $_GET['option'];
$Prestamos = new PrestamosModel();
switch ($option) {
    case 'Registrar':
        $Fecha = $_POST['InputFecha'];
        $Hora = $_POST['InputHora'];
        $Materia = $_POST['SelectMateria'];
        $Trabajo = $_POST['InputTipoTrabajo'];
        $Descripcion = $_POST['InputDescripcion'];
        $ListaMaquinas = serialize($_POST['ListaMaquinas']);

        //$ConsultaMateria = $Prestamos->ValidarMateria($Materia);

        if (!ValidarTrabajo($Trabajo)) {
            $resp = array('tipo' => 'error', 'mensaje' => 'El tipo de trabajo No es valido');
        } else {
            $Resultado = $Prestamos->RegistrarSolicitud($Fecha, $Hora, $Materia, $Trabajo, $Descripcion, $ListaMaquinas);
            if ($Resultado) {
                $resp = array('tipo' => 'success', 'mensaje' => 'Solicitud regisrada correctamente');
            }
        }
        echo json_encode($resp);
        break;
        case 'listar':
            $Resultado = $Prestamos->ObtenerSolicitudes();
            $colors = [
                'Cancelada' => '#f6c23e',
                'Falta' => '#eb4034',
                'Activa' => '#36B9CC',
                'Solicitud' => '#4E73DF',
                'Completada' => '#487653',
            ];
            foreach ($Resultado as &$evento) {
                $evento['title'] = $evento['status'];
                $evento['start'] = $evento['Fecha_estimada'] . 'T' . $evento['Hora_estimada'];
                $evento['end'] = date('Y-m-d H:i:s', strtotime($evento['start'] . ' + 3 hours'));
                if (isset($colors[$evento['title']])) {
                    $evento['color'] = $colors[$evento['title']];
                }
            }
            unset($evento);
            echo json_encode($Resultado);
            break;
        }
        
