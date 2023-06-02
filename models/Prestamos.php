<?php
require_once '../config.php';
require_once 'conexion.php';
class PrestamosModel{
    private $pdo, $con;
    public function __construct() {
        $this->con = new Conexion();
        $this->pdo = $this->con->conectar();
    }
    public function ValidarMateria($NoCuenta){
        $consult = $this->pdo->prepare("SELECT * FROM usuario WHERE NoCuenta = ?");
        $consult->execute([$NoCuenta]);
        return $consult->fetch(PDO::FETCH_ASSOC);
    }
    public function RegistrarSolicitud($Fecha,$Hora,$Materia,$Trabajo,$Descripcion,$ListaMaquinas){
        $consult = $this->pdo->prepare("INSERT INTO solicitudes (Fecha_estimada,Hora_estimada,Materia_id,TipoTrabajo,Descripcion,Maquinas) VALUES (?,?,?,?,?,?)");
        return $consult->execute([$Fecha,$Hora,$Materia,$Trabajo,$Descripcion,$ListaMaquinas]);
    }
    public function UltimaSolicitud(){
        $consult = $this->pdo->prepare("SELECT LAST_INSERT_ID() from solicitudes limit 1;");
        $consult->execute();
        return $consult->fetch(PDO::FETCH_ASSOC);
    }
    public function RegistrarDetalleSolictud($idUsuario,$id_admin, $idSolicitud)
    {
        $consult = $this->pdo->prepare("INSERT INTO detalle_prestamos (id_alumno,id_admin,id_prestamo) VALUES (?,?,?)");
        return $consult->execute([$idUsuario,$id_admin, $idSolicitud]);
    }
    public function EditarSolicitud($Fecha,$Hora,$Materia,$Trabajo,$Descripcion,$ListaMaquinas,$idSolicitud){
        $consult = $this->pdo->prepare("UPDATE solicitudes SET Fecha_estimada= ?,Hora_estimada= ?,Materia_id= ?,TipoTrabajo= ?,Descripcion= ?,Maquinas= ? WHERE idSolicitud = ?");
        return $consult->execute([$Fecha,$Hora,$Materia,$Trabajo,$Descripcion,$ListaMaquinas,$idSolicitud]);
    }
    public function ObtenerSolicitudes(){
        $consult = $this->pdo->prepare("SELECT * FROM solicitudes");
        $consult->execute();
        return $consult->fetchAll(PDO::FETCH_ASSOC);
    }
    public function ObtenerSolicitudesXalumno($idSolicitud){
        $Consulta = $this->pdo->prepare("SELECT s.* FROM solicitudes s JOIN detalle_prestamos dp ON s.idSolicitud = dp.id_prestamo WHERE dp.id_alumno = ?;");
        $Consulta->execute([$idSolicitud]);
        return $Consulta->fetchAll(PDO::FETCH_ASSOC);
    }

    public function ObtenerSolicitud($idSolicitud){
        $Consulta = $this->pdo->prepare("SELECT * FROM solicitudes WHERE idSolicitud = ?");
        $Consulta->execute([$idSolicitud]);
        return $Consulta->fetch(PDO::FETCH_ASSOC);
    }
    public function CancelarSolicitud($idSolicitud){
        $consult = $this->pdo->prepare("UPDATE solicitudes SET status = ? WHERE idSolicitud = ?");
        return $consult->execute([3, $idSolicitud]);
    }
    public function ActivarSolicitud($idSolicitud){
        $consult = $this->pdo->prepare("UPDATE solicitudes SET status = ? WHERE idSolicitud = ?");
        return $consult->execute([2, $idSolicitud]);
    }
    
}