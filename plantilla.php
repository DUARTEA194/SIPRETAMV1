<?php
require_once 'config.php';
require_once 'controllers/plantillaController.php';
$plantilla = new Plantilla();
##### PERMISOS #####

require_once 'models/permisos.php';
$id_user = $_SESSION['idusuario'];
$RolUsuario = $_SESSION['RolUsuario'];
$permisos = new PermisosModel();
$configuracion = $permisos->getPermiso(1, $id_user);
$usuarios = $permisos->getPermiso(2, $id_user);
$clientes = $permisos->getPermiso(3, $id_user);
$productos = $permisos->getPermiso(4, $id_user);
$ventas = $permisos->getPermiso(5, $id_user);
$nueva_venta = $permisos->getPermiso(6, $id_user);
$compras = $permisos->getPermiso(7, $id_user);
$nueva_compra = $permisos->getPermiso(8, $id_user);
$proveedor = $permisos->getPermiso(9, $id_user);
$perfil = $permisos->getPermiso(10, $id_user);
$maquinas = $permisos->getPermiso(11, $id_user);
$herramientas = $permisos->getPermiso(12, $id_user);
$prestamos = $permisos->getPermiso(13, $id_user);
$Historial = $permisos->getPermiso(17, $id_user);
$materias = $permisos->getPermiso(14, $id_user);
$nuevo_prestamo = $permisos->getPermiso(15, $id_user);
$calendario = $permisos->getPermiso(16, $id_user);

##### FIN PERMISOS ####
require_once 'views/includes/header.php';
if (isset($_GET['pagina'])) {
    if (empty($_GET['pagina'])) {
        if ($RolUsuario == "Administrador") {
            $plantilla->index();
        } else {
            $plantilla->indexAlumnos();
        }
    }else{
        try {
            $archivo = $_GET['pagina'];
            if ($archivo == 'usuarios' && !empty($usuarios)) {
                $plantilla->usuarios();
            } else if ($archivo == 'configuracion' && !empty($configuracion)) {
                $plantilla->configuracion();
            } else if ($archivo == 'clientes' && !empty($clientes)) {
                $plantilla->clientes();
            } else if ($archivo == 'proveedor' && !empty($proveedor)) {
                $plantilla->proveedor();
            }else if ($archivo == 'productos' && !empty($productos)) {
                $plantilla->productos();
            } else if ($archivo == 'ventas' && !empty($nueva_venta)) {
                $plantilla->ventas();
            } else if ($archivo == 'historial' && !empty($ventas)) {                
                $plantilla->historial();
            } else if ($archivo == 'reporte' && !empty($ventas)) {
                $plantilla->reporte();
            } else if ($archivo == 'compras' && !empty($nueva_compra)) {
                $plantilla->compras();
            } else if ($archivo == 'historial_compras' && !empty($ventas)) {
                $plantilla->historial_compras();
            } else if ($archivo == 'reporte_compra' && !empty($compras)) {
                $plantilla->reporte_compra();
            } else if ($archivo == 'Perfil' && !empty($perfil)) {
                $plantilla->perfil();
            }else if ($archivo == 'maquinas' && !empty($maquinas)) {
                $plantilla->Maquinas();
            }else if ($archivo == 'herramientas' && !empty($herramientas)) {
                $plantilla->Herramientas();
            }else if ($archivo == 'Prestamos' && !empty($prestamos)) {
                $plantilla->Prestamos();
            }else if ($archivo == 'materias' && !empty($materias)) {
                $plantilla->Materias();
            }else if ($archivo == 'NuevaSolicitud' && !empty($nuevo_prestamo)) {
                $plantilla->Nuevo_Prestamo();
            }else if ($archivo == 'calendario' && !empty($calendario)) {
                $plantilla->Calendario();
            }else if ($archivo == 'general') {
                $plantilla->general();
            }else if ($archivo == 'preguntas_frecuentes') {
                $plantilla->preguntasFrecuentes();
            }else if ($archivo == 'acercade') {
                $plantilla->acerca_de();
            }else{                
                $plantilla->notFound();
            }          
        } catch (\Throwable $th) {            
            $plantilla->notFound();
        }
    }
}else{
    if ($RolUsuario == "Administrador") {
        $plantilla->index();
    } else {
        $plantilla->indexAlumnos();
    }
}
require_once 'views/includes/footer.php';
?>