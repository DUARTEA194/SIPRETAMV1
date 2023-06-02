<?php
require_once '../models/usuarios.php';
require_once '../controllers/usuariosController.php';

$option = (empty($_GET['option'])) ? '' : $_GET['option'];
$usuarios = new UsuariosModel();
switch ($option) {
    case 'acceso':
        $accion = file_get_contents('php://input');
        $array = json_decode($accion, true);
        $email = $array['CorreoInstitucional'];
        $password = $array['Password'];
        $result = $usuarios->getLogin($email);
        $EstadoUsuario = $result['status'];

        if (empty($result)) {
            $res = array('tipo' => 'error', 'mensaje' => 'EL usuario no se encuentra registrado');
        } else {
            if ($EstadoUsuario === "1") {
                if ($password == $result['password']) {
                    session_start();
                    $_SESSION['nombre'] = $result['nombre'];
                    $_SESSION['correo'] = $result['correo'];
                    $_SESSION['idusuario'] = $result['idusuario'];
                    $_SESSION['NoCuenta'] = $result['NoCuenta'];
                    $_SESSION['RolUsuario'] = $result['RolUsuario'];
                    $_SESSION['status'] = $result['status'];
                    $res = array('tipo' => 'success', 'mensaje' => 'Bienvenido');
                } else {
                    $res = array('tipo' => 'error', 'mensaje' => 'Contraseña incorrecta');
                }
            } else {
                $res = array('tipo' => 'error', 'mensaje' => 'No se puede ingresar al sistema debido a que su cuenta esta actualmente desactivada, por favor ponganse en contacto con los administradores');
            }
        }


        echo json_encode($res);
        break;

    case 'Registrar':
        $accion = file_get_contents('php://input');
        $Array = json_decode($accion, true);
        //----- Datos del formulario de registro de usuario----
        $IdUsuario = $Array['IdUsuario'];
        $TipoUsuario = $Array["TipoUsuario"];
        $EstadoUsuario = $Array["EstadoUsuario"];
        $Nombre = $Array["Nombre"];
        $ApellidoPaterno = $Array["ApellidoPa"];
        $ApellidoMaterno = $Array["ApellidoMa"];
        $NoCuenta = $Array["NoCuenta"];
        $CorreoInstitucional = $Array["Correo"];
        $Dependencia = $Array["Dependencia"];
        $Licenciatura = $Array["Licenciatura"];
        $Semestre = $Array["Semestre"];
        $Permisos = $Array["Permisos"];
        if (!empty($Permisos)) {
            $Permisos = explode(",", $Permisos); //Paso de string a un array
        }

        if ($IdUsuario == "") {
            if ($NoCuenta == '' || $CorreoInstitucional == '') {
                $resp = array('tipo' => 'error', 'mensaje' => 'Debe llenar todos los campos');
            } else {
                $ConsultaNoCuenta = $usuarios->ValidarNoCuenta($NoCuenta);
                if (empty($ConsultaNoCuenta)) {
                    $ConsultaCorreo = $usuarios->ValidarCorreo($CorreoInstitucional);
                    if (empty($ConsultaCorreo)) {
                        $password = generarContrasena($Nombre, $ApellidoPaterno, $ApellidoMaterno);
                        if (is_array($Permisos)) {
                            // La variable $Permisos contiene los permisos de usuario. El registro se esta llevando acabo desde dentro del sistema
                            $RegistroUsuario = $usuarios->RegistrarUsuario($TipoUsuario, $Nombre, $EstadoUsuario, $CorreoInstitucional, $ApellidoMaterno, $ApellidoPaterno, $NoCuenta, $Dependencia, $Licenciatura, $Semestre, $password);
                            if ($RegistroUsuario) {
                                foreach ($Permisos as $id_permiso) {
                                    $res = $usuarios->insertarPermiso($id_permiso, $CorreoInstitucional);
                                }
                                $resp = array('tipo' => 'success', 'mensaje' => 'Usuario agreagado correctamente','usuario' =>$Nombre, 'pass'=>$password);
                            } else {
                                $resp = array('tipo' => 'error', 'mensaje' => 'Error en el registro');
                            }
                        } else {
                            // La variable $Permisos no contiene permisos. El resgistro se esta llevando acabo desde fuera del sistema
                            $EstadoUsuario = 1; //Estado comun para todos los usuarios
                            $Permisos = ($TipoUsuario == 2) ? array(10,11,12,13,14,15,16,17) : array(10,11,12,13,14,15,16,17);
                            $RegistroUsuario = $usuarios->RegistrarUsuario($TipoUsuario, $Nombre, $EstadoUsuario, $CorreoInstitucional, $ApellidoMaterno, $ApellidoPaterno, $NoCuenta, $Dependencia, $Licenciatura, $Semestre, $password);
                                if ($RegistroUsuario) {
                                    foreach ($Permisos as $id_permiso) {
                                        $res = $usuarios->insertarPermiso($id_permiso, $CorreoInstitucional);
                                    }
                                    $resp = array('tipo' => 'success', 'mensaje' => 'Usuario agreagado correctamente','usuario' =>$Nombre, 'pass'=>$password);
                                } else {
                                    $resp = array('tipo' => 'error', 'mensaje' => 'Error en el registro');
                                }
                        }
                    } else {
                        $resp = array('tipo' => 'error', 'mensaje' => 'El Correo institucional ya se encuentra registrado!');
                    }
                } else {
                    $resp = array('tipo' => 'error', 'mensaje' => 'El Numero de cuenta ya se encuentra registrado!');
                }
            }
        } else {
            $informacionUsuarioActual = $usuarios->getUser($IdUsuario);
            $numeroCuentaActual = $informacionUsuarioActual['NoCuenta'];
            $numeroCuentaIngresado = $NoCuenta;
            if ($numeroCuentaActual !== $numeroCuentaIngresado) {
                $ConsultaNoCuenta = $usuarios->ValidarNoCuenta($NoCuenta);
                if (empty($ConsultaNoCuenta)) {
                    $Resultado = $usuarios->EditarUsuario($EstadoUsuario, $TipoUsuario, $Nombre, $ApellidoPaterno, $ApellidoMaterno, $NoCuenta, $CorreoInstitucional, $Dependencia, $Licenciatura, $Semestre, $IdUsuario);
                    if ($Resultado) {
                        $resp = array('tipo' => 'success', 'mensaje' => 'Informacion del usuario actualizada correctamente');
                    } else {
                        $resp = array('tipo' => 'error', 'mensaje' => 'HUBO UN ERROR AL INTENTAR MODIFICAR LA INFORMACION, INTENTELO NUEVAMENTE O CONSULTE CON LOS ADMINISTRADORES DEL SISTEMA');
                    }
                } else {
                    $resp = array('tipo' => 'error', 'mensaje' => 'El numero de cuenta ya se encuentra registrado a nombre de otro usuario');
                }
            } else {
                $Resultado = $usuarios->EditarUsuario($EstadoUsuario, $TipoUsuario, $Nombre, $ApellidoPaterno, $ApellidoMaterno, $NoCuenta, $CorreoInstitucional, $Dependencia, $Licenciatura, $Semestre, $IdUsuario);
                if ($Resultado) {
                    $resp = array('tipo' => 'success', 'mensaje' => 'Informacion del usuario actualizada correctamente');
                } else {
                    $resp = array('tipo' => 'error', 'mensaje' => 'HUBO UN ERROR AL INTENTAR MODIFICAR LA INFORMACION, INTENTELO NUEVAMENTE O CONSULTE CON LOS ADMINISTRADORES DEL SISTEMA');
                }
            }
        }
        echo json_encode($resp);
        break;
    case 'listar':
        $Resultado = $usuarios->ObtenerUsuarios();
        for ($i = 0; $i < count($Resultado); $i++) {
            //Edicion dela etiqueta de rol por su valor textual
            switch ($Resultado[$i]['RolUsuario']) {
                case 1:
                    $Resultado[$i]['RolUsuario'] = "<span class='badge bg-danger text-white'>Administrador</span>";
                    break;
                case 2:
                    $Resultado[$i]['RolUsuario'] = "<span class='badge bg-warning text-white'>Profesor</span>";
                    break;
                case 3:
                    $Resultado[$i]['RolUsuario'] = "<span class='badge bg-info text-white'>Alumno</span>";
                    break;
                default:
                    break;
            }
            switch ($Resultado[$i]['status']) {
                case 0:
                    $Resultado[$i]['status'] = "<small><i class='fas fa-circle text-danger'></i></small>";
                    break;
                case 1:
                    $Resultado[$i]['status'] = "<small><i class='fas fa-circle' style='color:#02c41f'></i></small>";
                    break;
                default:
                    break;
            }
            $Resultado[$i]['check'] = '<input type="checkbox" value="' . $Resultado[$i]['idusuario'] . '">';
            //Union del nombre del usuario
            $Resultado[$i]['nombre'] = $Resultado[$i]['nombre'] . " " . $Resultado[$i]['ApellidoPaterno'] . " " . $Resultado[$i]['ApellidoMaterno'];
            //Botnones de acciones
            $Resultado[$i]['Acciones'] = '<a class="btn btn-info btn-sm" data-toggle="modal" data-target="#FormularioModal" onclick="VerUsuario(' . $Resultado[$i]['idusuario'] . ')"><i class="fas fa-fw fa-eye"></i><a/>
                                          <a class="btn btn-danger btn-sm" onclick="EliminarUsuario(' . $Resultado[$i]['idusuario'] . ')"><i class="fas fa-fw fa-trash"></i><a/>';
        }
        echo json_encode($Resultado);
        break;
    case 'save':
        $nombre = $_POST['Nombre'];
        $correo = $_POST['Correo'];
        //$clave = $_POST['clave'];
        $id_user = $_POST['id_user'];
        if ($id_user == '') {
            $consult = $usuarios->comprobarCorreo($correo);
            if (empty($consult)) {
                //$hash = password_hash($clave, PASSWORD_DEFAULT);
                $result = $usuarios->saveUser($nombre, $correo);
                if ($result) {
                    $res = array('tipo' => 'success', 'mensaje' => 'USUARIO REGISTRADO');
                } else {
                    $res = array('tipo' => 'error', 'mensaje' => 'ERROR AL AGREGAR');
                }
            } else {
                $res = array('tipo' => 'error', 'mensaje' => 'EL CORREO YA EXISTE');
            }
        } else {
            $result = $usuarios->updateUser($nombre, $correo, $id_user);
            if ($result) {
                $res = array('tipo' => 'success', 'mensaje' => 'USUARIO MODIFICADO');
            } else {
                $res = array('tipo' => 'error', 'mensaje' => 'ERROR AL MODIFICAR');
            }
        }
        echo json_encode($res);
        break;
    case 'delete':
        $id = $_GET['id'];
        $data = $usuarios->deleteUser($id);
        if ($data) {
            $res = array('tipo' => 'success', 'mensaje' => 'USUARIO ELIMINADO');
        } else {
            $res = array('tipo' => 'error', 'mensaje' => 'ERROR AL ELIMINAR');
        }
        echo json_encode($res);
        break;
    case 'edit':
        $id = $_GET['id'];
        $data = $usuarios->getUser($id);
        echo json_encode($data);
        break;
    case 'EditarUsuario':
        $idusuario = $_GET['idusuario'];
        $Resultado = $usuarios->ObtenerUsuario($idusuario);
        echo json_encode($Resultado);
        break;
    case 'EliminarUsuario':
        $idusuario = $_GET['idusuario'];
        $Resultado = $usuarios->EliminarUsuario($idusuario);
        if ($Resultado) {
            $resp = array('tipo' => 'success', 'mensaje' => 'Usuario eliminado correctamente!');
        } else {
            $resp = array('tipo' => 'error', 'mensaje' => 'Error al eliminar el registro');
        }
        echo json_encode($resp);
        break;
    case 'permisos':
        $idusuario = $_GET['idusuario'];
        $data['permisos'] = $usuarios->getPermisos();
        $consulta = $usuarios->getDetalle($idusuario);
        $datos = array();
        foreach ($consulta as $asignado) {
            $datos[$asignado['id_permiso']] = true;
        }
        $data['asig'] = $datos;
        echo json_encode($data);
        break;

    case 'savePermiso':
        $id_user = $_POST['id_usuario'];
        $usuarios->eliminarPermisos($id_user);
        $res = true;
        if (!empty($_POST['permisos'])) {
            for ($i = 0; $i < count($_POST['permisos']); $i++) {
                $res = $usuarios->savePermiso($_POST['permisos'][$i], $id_user);
            }
            if ($res) {
                $res = array('tipo' => 'success', 'mensaje' => 'PERMISOS ASIGNADO');
            } else {
                $res = array('tipo' => 'error', 'mensaje' => 'ERROR AL AGREGAR LOS PERMISOS');
            }
        }
        echo json_encode($res);
        break;
    case 'VerifcarEstadoCuenta':
        $NoCuenta = $_GET['NoCuenta'];
        $Resultado = $usuarios->ObtenerUsuarioNoCuenta($NoCuenta);
        $EstadoUsuario = $Resultado['status'];
        echo $EstadoUsuario;
        break;
    case 'EditarPerfil':
        $accion = file_get_contents('php://input');
        $Array = json_decode($accion, true);
        //----- Datos del formulario de registro de usuario----
        $IdUsuario = $Array['IdUsuario'];
        $TipoUsuario = $Array["TipoUsuario"];
        $EstadoUsuario = $Array["EstadoUsuario"];
        $Nombre = $Array["Nombre"];
        $ApellidoPaterno = $Array["ApellidoPa"];
        $ApellidoMaterno = $Array["ApellidoMa"];
        $NoCuenta = $Array["NoCuenta"];
        $CorreoInstitucional = $Array["Correo"];
        $Dependencia = $Array["Dependencia"];
        $Licenciatura = $Array["Licenciatura"];
        $Semestre = $Array["Semestre"];
        $Permisos = $Array["Permisos"];
        $Permisos = explode(",", $Permisos); //Paso de string a un array
        //-- ./ Datos del formulario de registro de usuario----
        if ($IdUsuario == "" || $NoCuenta == '' || $CorreoInstitucional == '') {
            $resp = array('tipo' => 'error', 'mensaje' => 'Debe llenar todos los campos');
        } else {
            $informacionUsuarioActual = $usuarios->getUser($IdUsuario);
            $numeroCuentaActual = $informacionUsuarioActual['NoCuenta'];
            $numeroCuentaIngresado = $NoCuenta;
            if ($numeroCuentaActual !== $numeroCuentaIngresado) {
                $ConsultaNoCuenta = $usuarios->ValidarNoCuenta($NoCuenta);
                if (empty($ConsultaNoCuenta)) {
                    $Resultado = $usuarios->EditarUsuario($EstadoUsuario, $TipoUsuario, $Nombre, $ApellidoPaterno, $ApellidoMaterno, $NoCuenta, $CorreoInstitucional, $Dependencia, $Licenciatura, $Semestre, $IdUsuario);
                    if ($Resultado) {
                        $resp = array('tipo' => 'success', 'mensaje' => 'Informacion del usuario actualizada correctamente');
                        $_SESSION['nombre'] = $Nombre;
                        $_SESSION['NoCuenta'] = $NoCuenta;
                        $_SESSION['status'] = $EstadoUsuario;
                    } else {
                        $resp = array('tipo' => 'error', 'mensaje' => 'HUBO UN ERROR AL INTENTAR MODIFICAR LA INFORMACION, INTENTELO NUEVAMENTE O CONSULTE CON LOS ADMINISTRADORES DEL SISTEMA');
                    }
                } else {
                    $resp = array('tipo' => 'error', 'mensaje' => 'El numero de cuenta ya se encuentra registrado a nombre de otro usuario');
                }
            } else {
                $Resultado = $usuarios->EditarUsuario($EstadoUsuario, $TipoUsuario, $Nombre, $ApellidoPaterno, $ApellidoMaterno, $NoCuenta, $CorreoInstitucional, $Dependencia, $Licenciatura, $Semestre, $IdUsuario);
                if ($Resultado) {
                    $resp = array('tipo' => 'success', 'mensaje' => 'Informacion del usuario actualizada correctamente');
                    $_SESSION['nombre'] = $Nombre;
                    $_SESSION['NoCuenta'] = $NoCuenta;
                    $_SESSION['status'] = $EstadoUsuario;
                } else {
                    $resp = array('tipo' => 'error', 'mensaje' => 'HUBO UN ERROR AL INTENTAR MODIFICAR LA INFORMACION, INTENTELO NUEVAMENTE O CONSULTE CON LOS ADMINISTRADORES DEL SISTEMA');
                }
            }
        }
        echo json_encode($resp);
        break;
    default:
        # code...
        break;
}
function generarContrasena($nombre, $ApellidoPaterno, $ApellidoMaterno)
{
    $primerasDosLetrasApellidoPaterno = substr($ApellidoPaterno, 0, 2);
    $primeraLetraApellidoMaterno = substr($ApellidoMaterno, 0, 1);
    $primeraLetraNombre = substr($nombre, 0, 1);

    $caracteresAleatorios = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    $longitudCaracteresAleatorios = 4;
    $contrasenaAleatoria = '';

    for ($i = 0; $i < $longitudCaracteresAleatorios; $i++) {
        $indiceAleatorio = mt_rand(0, strlen($caracteresAleatorios) - 1);
        $contrasenaAleatoria .= $caracteresAleatorios[$indiceAleatorio];
    }

    $contrasena = $primerasDosLetrasApellidoPaterno . $primeraLetraApellidoMaterno . $primeraLetraNombre . $contrasenaAleatoria;

    return $contrasena;
}

function ConsultaRegistro()
{
}
