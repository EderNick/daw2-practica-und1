<?php

namespace dao;

use PDO;

class Prestamo
{
    private $conn;

    public function __construct()
    {
        $objConexion = new Conexion();
        $this->conn = $objConexion->getConexion();
    }

    public function registrar(\dto\Prestamo $prestamo)
    {
        $sql = "INSERT INTO prestamos (estudiante, equipo, fecha, estado)
                VALUES (:estudiante, :equipo, :fecha, :estado)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(":estudiante", $prestamo->getEstudiante(), PDO::PARAM_STR);
        $stmt->bindValue(":equipo", $prestamo->getEquipo(), PDO::PARAM_STR);
        $stmt->bindValue(":fecha", $prestamo->getFecha(), PDO::PARAM_STR);
        $stmt->bindValue(":estado", $prestamo->getEstado(), PDO::PARAM_STR);
        return $stmt->execute();
    }

    public function listar()
    {
        $stmt = $this->conn->prepare("SELECT * FROM prestamos ORDER BY id DESC");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function buscar($texto)
    {
        $stmt = $this->conn->prepare(
            "SELECT * FROM prestamos WHERE estudiante LIKE :texto ORDER BY id DESC"
        );
        $stmt->bindValue(":texto", "%" . $texto . "%", PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function cambiarEstado($id, $estado)
    {
        $stmt = $this->conn->prepare("UPDATE prestamos SET estado = :estado WHERE id = :id");
        $stmt->bindValue(":estado", $estado, PDO::PARAM_STR);
        $stmt->bindValue(":id", $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
