<?php

namespace dao;
use PDO;

class Incidencia extends Conexion
{
    public function registrar($incidencia)
    {
        $sql = "INSERT INTO incidencias (usuario, asunto, prioridad, estado) VALUES (?, ?, ?, ?)";
        $stmt = $this->conexion->prepare($sql);
        return $stmt->execute([
            $incidencia->getUsuario(),
            $incidencia->getAsunto(),
            $incidencia->getPrioridad(),
            $incidencia->getEstado()
        ]);
    }

    public function listar()
    {
        $stmt = $this->conexion->prepare("SELECT * FROM incidencias");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function buscar($texto)
    {
        $sql = "SELECT * FROM incidencias WHERE usuario LIKE ? OR asunto LIKE ?";
        $stmt = $this->conexion->prepare($sql);
        $stmt->execute(["%$texto%", "%$texto%"]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function cambiarEstado($id)
    {
        $stmt = $this->conexion->prepare("UPDATE incidencias SET estado = 'ATENDIDO' WHERE id = ?");
        return $stmt->execute([$id]);
    }
}