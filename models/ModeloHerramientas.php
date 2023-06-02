<?php
require_once '../config.php';
require_once 'conexion.php';
class ModeloHerramientas
{
    private $pdo, $con;
    public function __construct()
    {
        $this->con = new Conexion();
        $this->pdo = $this->con->Conectar();
    }
    public function RegistrarHerramienta($NombreHerramienta, $CantidadHerramienta, $EstadoHerramienta){
        $consult = $this->pdo->prepare("INSERT INTO herramientas (NombreHerramienta, CantidadHerramienta, EstadoHerramienta) VALUES (?,?,?)");
        return $consult->execute([$NombreHerramienta, $CantidadHerramienta, $EstadoHerramienta]);
    }
    public function ObtenerHerramientas()
    {
        $consult = $this->pdo->prepare("SELECT * FROM herramientas");
        $consult->execute();
        return $consult->fetchAll(PDO::FETCH_ASSOC);
    }
    public function ObtenerHerramienta($idHerramienta){
        $consult = $this->pdo->prepare("SELECT * FROM herramientas WHERE idHerramienta = ?");
        $consult->execute([$idHerramienta]);
        return $consult->fetch(PDO::FETCH_ASSOC);
    }
    public function EditarHerramienta($NombreHerramienta, $CantidadHerramienta, $EstadoHerramienta, $idHerramienta){
        $consult = $this->pdo->prepare("UPDATE herramientas SET NombreHerramienta = ?,CantidadHerramienta = ?,EstadoHerramienta = ? WHERE idHerramienta = ?");
        return $consult->execute([$NombreHerramienta, $CantidadHerramienta, $EstadoHerramienta, $idHerramienta]);
    }
    public function EliminarHerramienta($idHerramienta){
        $consult = $this->pdo->prepare("UPDATE herramientas SET EstadoHerramienta = ? WHERE idHerramienta = ?");
        return $consult->execute([3, $idHerramienta]);
    }
}
