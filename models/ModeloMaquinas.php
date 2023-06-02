<?php
require_once '../config.php';
require_once 'conexion.php';
class ModeloMaquinas
{
    private $pdo, $con;
    public function __construct()
    {
        $this->con = new Conexion();
        $this->pdo = $this->con->Conectar();
    }
    public function RegistrarMaquina($NombreMaquina, $ModeloMaquina, $EstadoMaquina,$DescripcionMaquina,$ObservacionesMaquina,$ImagenMaquina){
        $consult = $this->pdo->prepare("INSERT INTO maquinas (NombreMaquina, ModeloMaquina, EstadoMaquina, DescripcionMaquina, ObservacionesMaquina, ImagenMaquina) VALUES (?,?,?,?,?,?)");
        return $consult->execute([$NombreMaquina, $ModeloMaquina, $EstadoMaquina, $DescripcionMaquina, $ObservacionesMaquina, $ImagenMaquina]);
    }
    public function ObtenerMaquinas()
    {
        $consult = $this->pdo->prepare("SELECT * FROM maquinas");
        $consult->execute();
        return $consult->fetchAll(PDO::FETCH_ASSOC);
    }
    public function ObtenerMaquina($idMaquina){
        $consult = $this->pdo->prepare("SELECT * FROM maquinas WHERE idMaquina = ?");
        $consult->execute([$idMaquina]);
        return $consult->fetch(PDO::FETCH_ASSOC);
    }
    public function EditarMaquina($NombreMaquina, $ModeloMaquina, $EstadoMaquina,$DescripcionMaquina,$ObservacionesMaquina,$ImagenMaquina,$idMaquina){
        $consult = $this->pdo->prepare("UPDATE maquinas SET NombreMaquina = ?,ModeloMaquina = ?,EstadoMaquina = ? , DescripcionMaquina= ?,ObservacionesMaquina= ?,ImagenMaquina= ? WHERE idMaquina = ?");
        return $consult->execute([$NombreMaquina, $ModeloMaquina, $EstadoMaquina, $DescripcionMaquina, $ObservacionesMaquina, $ImagenMaquina, $idMaquina]);
    }
    public function EliminarMaquina($idMaquina){
        $consult = $this->pdo->prepare("UPDATE maquinas SET EstadoMaquina = ? WHERE idMaquina = ?");
        return $consult->execute([3, $idMaquina]);
    }
}
