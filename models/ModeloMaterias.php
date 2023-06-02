<?php
require_once '../config.php';
require_once 'conexion.php';
class ModeloMaterias
{
    private $pdo, $con;
    public function __construct()
    {
        $this->con = new Conexion();
        $this->pdo = $this->con->Conectar();
    }
    public function RegistrarMateria($ClaveMateria, $NombreMateria, $Profesor, $Grupo){
        $consult = $this->pdo->prepare("INSERT INTO materias (ClaveMateria, NombreMateria, Profesor, Grupo) VALUES (?,?,?,?)");
        return $consult->execute([$ClaveMateria, $NombreMateria, $Profesor, $Grupo]);
    }
    public function ObtenerMaterias()
    {
        $consult = $this->pdo->prepare("SELECT * FROM materias");
        $consult->execute();
        return $consult->fetchAll(PDO::FETCH_ASSOC);
    }
    public function ObtenerMateria($idMateria){
        $consult = $this->pdo->prepare("SELECT * FROM materias WHERE IdMateria = ?");
        $consult->execute([$idMateria]);
        return $consult->fetch(PDO::FETCH_ASSOC);
    }
    public function ObtenerProfesores($textoBusqueda){
        $consult = $this->pdo->prepare("SELECT DISTINCT NombreMateria FROM materias WHERE NombreMateria LIKE '%$textoBusqueda%' ");
        $consult->execute();
        return $consult->fetchAll(PDO::FETCH_ASSOC);
    }
    public function EditarMateria($ClaveMateria, $NombreMateria, $Profesor, $Grupo, $idMateria){
        $consult = $this->pdo->prepare("UPDATE materias SET ClaveMateria = ?,NombreMateria = ?,Profesor = ?,Grupo = ? WHERE IdMateria = ?");
        return $consult->execute([$ClaveMateria, $NombreMateria, $Profesor, $Grupo, $idMateria,]);
    }
    public function EliminarMateria($idMateria){
        $consult = $this->pdo->prepare("UPDATE maquinas SET EstadoMaquina = ? WHERE idMaquina = ?");
        return $consult->execute([3, $idMateria]);
    }
}