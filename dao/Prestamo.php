<?php

namespace dao;

use dto\Prestamo as PrestamoDTO;
use PDO;

class Prestamo
{
    private PDO $conexion;

    public function __construct()
    {
        $this->conexion = (new Conexion())->getConexion();
    }

    public function registrar(PrestamoDTO $prestamo): bool
    {
        $sql = "INSERT INTO prestamos (estudiante, equipo, fecha, estado)
                VALUES (:estudiante, :equipo, :fecha, :estado)";

        $stmt = $this->conexion->prepare($sql);

        $stmt->bindValue(":estudiante", $prestamo->getEstudiante());
        $stmt->bindValue(":equipo", $prestamo->getEquipo());
        $stmt->bindValue(":fecha", $prestamo->getFecha());
        $stmt->bindValue(":estado", $prestamo->getEstado());

        return $stmt->execute();
    }

    public function listar(): array
    {
        $sql = "SELECT id, estudiante, equipo, fecha, estado
                FROM prestamos
                ORDER BY id DESC";

        $stmt = $this->conexion->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function buscar(string $texto): array
    {
        $sql = "SELECT id, estudiante, equipo, fecha, estado
                FROM prestamos
                WHERE estudiante LIKE :texto
                ORDER BY id DESC";

        $stmt = $this->conexion->prepare($sql);
        $stmt->bindValue(":texto", "%{$texto}%");
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function cambiarEstado(int $id, string $estado = "DEVUELTO"): bool
    {
        $sql = "UPDATE prestamos
                SET estado = :estado
                WHERE id = :id";

        $stmt = $this->conexion->prepare($sql);
        $stmt->bindValue(":estado", $estado);
        $stmt->bindValue(":id", $id, PDO::PARAM_INT);

        return $stmt->execute();
    }
}
