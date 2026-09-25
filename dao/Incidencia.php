<?php

namespace dao;

use dto\Incidencia as IncidenciaDTO;
use PDO;

class Incidencia
{
    private PDO $conexion;

    public function __construct()
    {
        $conexion = new Conexion();
        $this->conexion = $conexion->getConexion();
    }

    public function registrar(IncidenciaDTO $incidencia): bool
    {
        $sql = "INSERT INTO incidencias (usuario, asunto, prioridad)
                VALUES (:usuario, :asunto, :prioridad)";

        $sentencia = $this->conexion->prepare($sql);

        return $sentencia->execute([
            'usuario' => $incidencia->getUsuario(),
            'asunto' => $incidencia->getAsunto(),
            'prioridad' => $incidencia->getPrioridad(),
        ]);
    }

    public function listar(): array
    {
        $sql = "SELECT id, usuario, asunto, prioridad, estado
                FROM incidencias
                ORDER BY id DESC";

        $sentencia = $this->conexion->prepare($sql);
        $sentencia->execute();

        return $sentencia->fetchAll(PDO::FETCH_ASSOC);
    }

    public function buscar(string $texto): array
    {
        $sql = "SELECT id, usuario, asunto, prioridad, estado
                FROM incidencias
                WHERE usuario LIKE :texto OR asunto LIKE :texto
                ORDER BY id DESC";

        $sentencia = $this->conexion->prepare($sql);
        $sentencia->execute([
            'texto' => '%' . $texto . '%',
        ]);

        return $sentencia->fetchAll(PDO::FETCH_ASSOC);
    }

    public function cambiarEstado(int $id): bool
    {
        $sql = "UPDATE incidencias
                SET estado = :estado
                WHERE id = :id";

        $sentencia = $this->conexion->prepare($sql);

        return $sentencia->execute([
            'estado' => 'ATENDIDO',
            'id' => $id,
        ]);
    }
}
