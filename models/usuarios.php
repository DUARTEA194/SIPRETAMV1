<?php
require_once '../config.php';
require_once 'conexion.php';
class UsuariosModel{
    private $pdo, $con;
    public function __construct() {
        $this->con = new Conexion();
        $this->pdo = $this->con->conectar();
    }

    public function getLogin($email)
    {
        $consult = $this->pdo->prepare("SELECT * FROM usuario WHERE correo = ?");
        $consult->execute([$email]);
        return $consult->fetch(PDO::FETCH_ASSOC);
    }
    
    public function ObtenerUsuarios(){
        $consult = $this->pdo->prepare("SELECT * FROM usuario");
        $consult->execute();
        return $consult->fetchAll(PDO::FETCH_ASSOC);
    }

    public function ValidarNoCuenta($NoCuenta){
        $consult = $this->pdo->prepare("SELECT * FROM usuario WHERE NoCuenta = ?");
        $consult->execute([$NoCuenta]);
        return $consult->fetch(PDO::FETCH_ASSOC);
    }

    public function ValidarCorreo($CorreoInstitucional){
        $consult = $this->pdo->prepare("SELECT * FROM usuario WHERE correo = ?");
        $consult->execute([$CorreoInstitucional]);
        return $consult->fetch(PDO::FETCH_ASSOC);
    }
    public function RegistrarUsuario($TipoUsuario, $Nombre,$EstadoUsuario,$CorreoInstitucional,$ApellidoMaterno,$ApellidoPaterno,$NoCuenta,$Dependencia,$Licenciatura,$Semestre,$password){
        $consult = $this->pdo->prepare("INSERT INTO usuario (RolUsuario,nombre,status,correo,ApellidoMaterno,ApellidoPaterno,NoCuenta,Dependencia,Licenciatura,Semestre,password) VALUES (?,?,?,?,?,?,?,?,?,?,?)");
        return $consult->execute([$TipoUsuario, $Nombre,$EstadoUsuario,$CorreoInstitucional,$ApellidoMaterno,$ApellidoPaterno,$NoCuenta,$Dependencia,$Licenciatura,$Semestre,$password]);
    }
    public function ObtenerUsuario($idusuario){
        $Consulta = $this->pdo->prepare("SELECT * FROM usuario WHERE idusuario = ?");
        $Consulta->execute([$idusuario]);
        return $Consulta->fetch(PDO::FETCH_ASSOC);
    }
    public function ObtenerUsuarioNoCuenta($NoCuenta){
        $Consulta = $this->pdo->prepare("SELECT * FROM usuario WHERE NoCuenta = ?");
        $Consulta->execute([$NoCuenta]);
        return $Consulta->fetch(PDO::FETCH_ASSOC);
    }
    public function EditarUsuario($EstadoUsuario, $TipoUsuario, $Nombre, $ApellidoPaterno, $ApellidoMaterno, $NoCuenta, $CorreoInstitucional,$Dependencia, $Licenciatura, $Semestre,$IdUsuario){
        $consult = $this->pdo->prepare("UPDATE usuario SET status= ?, RolUsuario = ?, nombre = ?,ApellidoPaterno = ?,ApellidoMaterno = ?,NoCuenta = ?,correo = ?,Dependencia = ?,Licenciatura = ?,Semestre = ? WHERE idusuario = ?");
        return $consult->execute([$EstadoUsuario, $TipoUsuario, $Nombre, $ApellidoPaterno, $ApellidoMaterno, $NoCuenta, $CorreoInstitucional,$Dependencia, $Licenciatura, $Semestre,$IdUsuario]);
    }
    public function EliminarUsuario($idusuario){
        $consult = $this->pdo->prepare("UPDATE usuario SET status = ? WHERE idusuario = ?");
        return $consult->execute([0, $idusuario]);
    }
    public function deleteUser($id)
    {
        $consult = $this->pdo->prepare("UPDATE usuario SET status = ? WHERE idusuario = ?");
        return $consult->execute([0, $id]);
    }
    

    public function getUsers()
    {
        $consult = $this->pdo->prepare("SELECT * FROM usuario WHERE status = 1");
        $consult->execute();
        return $consult->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getUser($id)
    {
        $consult = $this->pdo->prepare("SELECT * FROM usuario WHERE idusuario = ?");
        $consult->execute([$id]);
        return $consult->fetch(PDO::FETCH_ASSOC);
    }

    public function comprobarCorreo($correo)
    {
        $consult = $this->pdo->prepare("SELECT * FROM usuario WHERE correo = ?");
        $consult->execute([$correo]);
        return $consult->fetch(PDO::FETCH_ASSOC);
    }

    public function saveUser($nombre, $correo)
    {
        $consult = $this->pdo->prepare("INSERT INTO usuario (nombre, correo) VALUES (?,?)");
        return $consult->execute([$nombre, $correo]);
    }

    public function updateUser($nombre, $correo, $id)
    {
        $consult = $this->pdo->prepare("UPDATE usuario SET nombre=?, correo=? WHERE idusuario=?");
        return $consult->execute([$nombre, $correo, $id]);
    }

    public function getPermisos()
    {
        $consult = $this->pdo->prepare("SELECT * FROM permisos");
        $consult->execute();
        return $consult->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getDetalle($idusuario)
    {
        $consult = $this->pdo->prepare("SELECT * FROM detalle_permisos WHERE id_usuario = ?");
        $consult->execute([$idusuario]);
        return $consult->fetchAll(PDO::FETCH_ASSOC);
    }

    public function savePermiso($permiso, $idusuario)
    {
        $consult = $this->pdo->prepare("INSERT INTO detalle_permisos (id_permiso, id_usuario) VALUES (?,?)");
        return $consult->execute([$permiso, $idusuario]);
    }

    public function eliminarPermisos($idusuario)
    {
        $consult = $this->pdo->prepare("DELETE FROM detalle_permisos WHERE id_usuario = ?");
        return $consult->execute([$idusuario]);
    }
    public function insertarPermiso($id_permiso, $CorreoInstitucional)
    {
        $consult = $this->pdo->prepare("INSERT INTO detalle_permisos (id_permiso, id_usuario) VALUES (?, (SELECT idusuario FROM usuario WHERE correo = ?))");
        return $consult->execute([$id_permiso, $CorreoInstitucional]);
    }

}

?>