<?php
require_once '../models/Prestamos.php';
$option = (empty($_GET['option'])) ? '' : $_GET['option'];
$Prestamos = new PrestamosModel();
$idUsuario = $_SESSION['idusuario'];
switch ($option) {
    case 'Registrar':
        $idUsuario = $_POST['idUsuario'];
        $idSolicitud = $_POST['InputIdSolicitud'];
        $Fecha = $_POST['InputFecha'];
        $Hora = $_POST['InputHora'];
        $Materia = $_POST['SelectMateria'];
        $Trabajo = $_POST['InputTipoTrabajo'];
        $Descripcion = $_POST['InputDescripcion'];
        $ListaMaquinas = serialize($_POST['ListaMaquinas']);

        //$ConsultaMateria = $Prestamos->ValidarMateria($Materia);
        if ($idSolicitud == "") {
            if (!ValidarTrabajo($Trabajo)) {
                $resp = array('tipo' => 'error', 'mensaje' => 'El tipo de trabajo No es valido');
            } else {
                $Resultado = $Prestamos->RegistrarSolicitud($Fecha, $Hora, $Materia, $Trabajo, $Descripcion, $ListaMaquinas);
                if ($Resultado) {
                    $consulta = $Prestamos->UltimaSolicitud();
                    $idSolicitud = $consulta['LAST_INSERT_ID()']; // Obtener el ID del último registro insertado

                    $DetalleSolicitud = $Prestamos->RegistrarDetalleSolictud($idUsuario, $id_admin, $idSolicitud);
                    if ($DetalleSolicitud) {
                        $resp = array('tipo' => 'success', 'mensaje' => 'Solicitud agregada correctamente');
                    } else {
                        $resp = array('tipo' => 'error', 'mensaje' => 'Algo salio mal, por favor intentelo nuevamente o contactese con los administradores');
                    }
                }
            }
        } else {
            $Resultado = $Prestamos->EditarSolicitud($Fecha, $Hora, $Materia, $Trabajo, $Descripcion, $ListaMaquinas, $idSolicitud);
            if ($Resultado) {
                $resp = array('tipo' => 'success', 'mensaje' => 'Solicitud actualizada correctamente');
            } else {
                $resp = array('tipo' => 'error', 'mensaje' => 'Algo salio mal, por favor intentelo nuevamente o contactese con los administradores');
            }
        }

        echo json_encode($resp);
        break;
    case 'listar':
        $Resultado = $Prestamos->ObtenerSolicitudes();

        // Mapeo de valores de "status" a etiquetas y botones
        $mapeoStatus = array(
            "Solicitud" => array(
                "etiqueta" => "<span class='badge bg-primary text-white'>Solicitud</span>",
                "acciones" => '<div class="d-flex" style="flex-wrap: nowrap">
                                    <a class="btn btn-info btn-sm" data-toggle="modal" data-target="#FormularioModal" onclick="VerSolicitud({id})"><i class="fas fa-fw fa-eye"></i> Ver</a>
                                    <a class="btn btn-danger btn-sm" onclick="CancelarSolicitud({id})"><i class="fas fa-window-close"></i> Cancelar</a>
                                </div>'

            ),
            "Activa" => array(
                "etiqueta" => "<span class='badge bg-info text-white'>Activa</span>",
                "acciones" => '<div class="d-flex" style="flex-wrap: nowrap">
                                    <a class="btn btn-info btn-sm" data-toggle="modal" data-target="#FormularioModal" onclick="VerSolicitud({id})"><i class="fas fa-fw fa-eye"></i> Ver</a>
                                    <a class="btn btn-danger btn-sm" onclick="CancelarSolicitud({id})"><i class="fas fa-window-close"></i> Cancelar</a>
                                    </div>'
            ),
            "Cancelada" => array(
                "etiqueta" => "<span class='badge bg-warning text-white'>Cancelada</span>",
                "acciones" => ' <div class="d-flex" style="flex-wrap: nowrap">
                                    <a class="btn btn-info btn-sm" data-toggle="modal" data-target="#FormularioModal" onclick="VerSolicitud({id})"><i class="fas fa-fw fa-eye"></i> Ver</a>
                                </diV'
            ),
            "Completada" => array(
                "etiqueta" => "<span class='badge bg-success text-white'>Completada</span>",
                "acciones" => '<div class="d-flex" style="flex-wrap: nowrap">
                                    <a class="btn btn-info btn-sm" data-toggle="modal" data-target="#FormularioModal" onclick="VerSolicitud({id})"><i class="fas fa-fw fa-eye"></i> Ver</a>
                                </div>'
            ),
            "Falta" => array(
                "etiqueta" => "<span class='badge bg-danger text-white'>Falta</span>",
                "acciones" => '<div class="d-flex" style="flex-wrap: nowrap">
                                    <a class="btn btn-info btn-sm" data-toggle="modal" data-target="#FormularioModal" onclick="VerSolicitud({id})"><i class="fas fa-fw fa-eye"></i> Ver</a>
                                </div>'

            )
        );

        for ($i = 0; $i < count($Resultado); $i++) {
            $status = $Resultado[$i]['status'];

            // Construir etiqueta de "status"
            $Resultado[$i]['status'] = $mapeoStatus[$status]['etiqueta'];

            // Construir acciones
            $acciones = $mapeoStatus[$status]['acciones'];
            $acciones = str_replace("{id}", $Resultado[$i]['idSolicitud'], $acciones);
            $Resultado[$i]['Acciones'] = $acciones;
        }

        echo json_encode($Resultado);
        break;

    case 'EditarSolucitud':
        $idSolicitud = $_GET['idSolicitud'];
        $Resultado = $Prestamos->ObtenerSolicitud($idSolicitud);
        $colores = array(
            'Solicitud' => '#4E73DF',
            'Activa' => '#36B9CC',
            'Cancelada' => '#f6c23e',
            'Completada' => '#487653',
            'Falta' => '#eb4034'
        );

        if (array_key_exists($Resultado['status'], $colores)) {
            $Resultado['color'] = $colores[$Resultado['status']];
        }

        $Resultado['Maquinas'] = unserialize($Resultado['Maquinas']);
        echo json_encode($Resultado);
        break;
    case 'CancelarSolicitud':
        $idSolicitud = $_GET['idSolicitud'];
        $CancelarSolicitud = $Prestamos->CancelarSolicitud($idSolicitud);
        if ($CancelarSolicitud) {
            $resp = array('tipo' => 'success', 'mensaje' => 'Solictud cancelada correctamente!');
        } else {
            $resp = array('tipo' => 'error', 'mensaje' => 'Hubo un Error al cancelar la solicitud, porfavor comuniquese con los administradores');
        }
        echo json_encode($resp);
        break;
    case 'ActivarSolicitud':
        $idSolicitud = $_GET['idSolicitud'];
        $ActivarSolicitud = $Prestamos->ActivarSolicitud($idSolicitud);
        if ($ActivarSolicitud) {
            $resp = array('tipo' => 'success', 'mensaje' => 'Solictud activada correctamente!');
        } else {
            $resp = array('tipo' => 'error', 'mensaje' => 'Hubo un Error al activar la solicitud, porfavor comuniquese con los administradores');
        }
        echo json_encode($resp);
        break;
    case 'listarXalumno':
        $idAlumno = $idUsuario;
        $Resultado = $Prestamos->ObtenerSolicitudesXalumno($idAlumno);
        // Mapeo de valores de "status" a etiquetas y botones
        $mapeoStatus = array(
            "Solicitud" => array(
                "etiqueta" => "<span class='badge bg-primary text-white'>Solicitud</span>",
                "acciones" => '<div class="d-flex" style="flex-wrap: nowrap">
                                    <a class="btn btn-info btn-sm" data-toggle="modal" data-target="#FormularioModal" onclick="VerSolicitud({id})"><i class="fas fa-fw fa-eye"></i> Ver</a>
                                    <a class="btn btn-danger btn-sm" onclick="CancelarSolicitud({id})"><i class="fas fa-window-close"></i> Cancelar</a>
                                </div>'

            ),
            "Activa" => array(
                "etiqueta" => "<span class='badge bg-info text-white'>Activa</span>",
                "acciones" => '<div class="d-flex" style="flex-wrap: nowrap">
                                    <a class="btn btn-info btn-sm" data-toggle="modal" data-target="#FormularioModal" onclick="VerSolicitud({id})"><i class="fas fa-fw fa-eye"></i> Ver</a>
                                    <a class="btn btn-danger btn-sm" onclick="CancelarSolicitud({id})"><i class="fas fa-window-close"></i> Cancelar</a>
                                    </div>'
            ),
            "Cancelada" => array(
                "etiqueta" => "<span class='badge bg-warning text-white'>Cancelada</span>",
                "acciones" => ' <div class="d-flex" style="flex-wrap: nowrap">
                                    <a class="btn btn-info btn-sm" data-toggle="modal" data-target="#FormularioModal" onclick="VerSolicitud({id})"><i class="fas fa-fw fa-eye"></i> Ver</a>
                                </diV'
            ),
            "Completada" => array(
                "etiqueta" => "<span class='badge bg-success text-white'>Completada</span>",
                "acciones" => '<div class="d-flex" style="flex-wrap: nowrap">
                                    <a class="btn btn-info btn-sm" data-toggle="modal" data-target="#FormularioModal" onclick="VerSolicitud({id})"><i class="fas fa-fw fa-eye"></i> Ver</a>
                                </div>'
            ),
            "Falta" => array(
                "etiqueta" => "<span class='badge bg-danger text-white'>Falta</span>",
                "acciones" => '<div class="d-flex" style="flex-wrap: nowrap">
                                    <a class="btn btn-info btn-sm" data-toggle="modal" data-target="#FormularioModal" onclick="VerSolicitud({id})"><i class="fas fa-fw fa-eye"></i> Ver</a>
                                </div>'

            )
        );

        for ($i = 0; $i < count($Resultado); $i++) {
            $status = $Resultado[$i]['status'];

            // Construir etiqueta de "status"
            $Resultado[$i]['status'] = $mapeoStatus[$status]['etiqueta'];

            // Construir acciones
            $acciones = $mapeoStatus[$status]['acciones'];
            $acciones = str_replace("{id}", $Resultado[$i]['idSolicitud'], $acciones);
            $Resultado[$i]['Acciones'] = $acciones;
        }

        echo json_encode($Resultado);
        break;
};
function ValidarTrabajo($Trabajo)
{
    if (!in_array($Trabajo, range(0, 5))) {
        return false;
    }
    return true;
}
function ValidarPrestamo()
{
    echo "<p>ejemplo</p>";
}
function HoraServicio()
{
    echo "<p>ejemplo</p>";
}
