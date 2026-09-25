<?php

namespace dao;

use \dto\Incidencia as IncidenciaDTO;
use \PDO;

class Incidencia
{
    private $conn = null;

    public function __construct()
    {
        $objConexion = new Conexion();
        $this->conn = $objConexion->getConexion();
    }

    public function registrar(IncidenciaDTO $incidencia)
    {
        $stmt = $this->conn->prepare(
            "INSERT INTO incidencias (usuario, asunto, prioridad, estado) 
             VALUES (:usuario, :asunto, :prioridad, :estado)"
        );
        $stmt->bindValue(":usuario", $incidencia->getUsuario(), PDO::PARAM_STR);
        $stmt->bindValue(":asunto", $incidencia->getAsunto(), PDO::PARAM_STR);
        $stmt->bindValue(":prioridad", $incidencia->getPrioridad(), PDO::PARAM_STR);
        $stmt->bindValue(":estado", $incidencia->getEstado(), PDO::PARAM_STR);
        return $stmt->execute();
    }

    public function listar(): array
    {
        $stmt = $this->conn->prepare(
            "SELECT id, usuario, asunto, prioridad, estado FROM incidencias ORDER BY id DESC"
        );
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function buscar($texto): array
    {
        $stmt = $this->conn->prepare(
            "SELECT id, usuario, asunto, prioridad, estado FROM incidencias 
             WHERE usuario LIKE :texto OR asunto LIKE :texto ORDER BY id DESC"
        );
        $stmt->bindValue(":texto", "%" . $texto . "%", PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function cambiarEstado($id)
    {
        // Cambia el estado a ATENDIDO según lo exige la variante B
        $stmt = $this->conn->prepare(
            "UPDATE incidencias SET estado = 'ATENDIDO' WHERE id = :id AND estado = 'PENDIENTE'"
        );
        $stmt->bindValue(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->rowCount() > 0;
    }
}