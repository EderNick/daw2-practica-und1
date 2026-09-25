<?php

namespace dao;

use dto\Equipo;
use PDO;

class EquipoDAO
{
    private PDO $conexion;

    public function __construct()
    {
        // Misma carpeta/namespace que Conexion.php, no se puede modificar ese archivo
        $this->conexion = (new Conexion())->getConexion();
    }

    public function registrar(string $codigo, string $nombre, string $categoria): bool
    {
        $sql = "INSERT INTO equipos (codigo, nombre, categoria, estado)
                VALUES (:codigo, :nombre, :categoria, :estado)";

        $stmt = $this->conexion->prepare($sql);

        $estadoInicial = 'OPERATIVO';
        $stmt->bindParam(':codigo', $codigo);
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':categoria', $categoria);
        $stmt->bindParam(':estado', $estadoInicial);

        return $stmt->execute();
    }

    public function listar(): array
    {
        $sql = "SELECT id, codigo, nombre, categoria, estado FROM equipos ORDER BY id DESC";
        $stmt = $this->conexion->prepare($sql);
        $stmt->execute();

        return $this->mapearFilas($stmt);
    }

    public function buscar(string $texto): array
    {
        $sql = "SELECT id, codigo, nombre, categoria, estado
                FROM equipos
                WHERE categoria LIKE :texto
                ORDER BY id DESC";

        $stmt = $this->conexion->prepare($sql);
        $like = '%' . $texto . '%';
        $stmt->bindParam(':texto', $like);
        $stmt->execute();

        return $this->mapearFilas($stmt);
    }

    public function cambiarEstado(int $id): bool
    {
        $sqlActual = "SELECT estado FROM equipos WHERE id = :id";
        $stmtActual = $this->conexion->prepare($sqlActual);
        $stmtActual->bindParam(':id', $id, PDO::PARAM_INT);
        $stmtActual->execute();
        $fila = $stmtActual->fetch(PDO::FETCH_ASSOC);

        if (!$fila) {
            return false;
        }

        $nuevoEstado = ($fila['estado'] === 'OPERATIVO') ? 'BAJA' : 'OPERATIVO';

        $sql = "UPDATE equipos SET estado = :estado WHERE id = :id";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bindParam(':estado', $nuevoEstado);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        return $stmt->execute();
    }

    private function mapearFilas($stmt): array
    {
        $equipos = [];
        while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $equipos[] = new Equipo(
                $fila['codigo'],
                $fila['nombre'],
                $fila['categoria'],
                $fila['estado'],
                (int)$fila['id']
            );
        }
        return $equipos;
    }
}
